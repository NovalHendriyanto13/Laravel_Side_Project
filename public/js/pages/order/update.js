$(document).ready(async function() {

    let selectedItems = [];
    let selectedTable;

    let processedItems = [];
    let processedTable;

    let fulfillmentItems = [];

    await _init();
    _gesture();

    async function _init() {
        const itemUrl = `${_apiBaseUrl}/api/admin-blood`;
        let responseItem = [];
        const items = await httpGet(itemUrl);

        if (items?.error == false) {
            responseItem = items?.data;
        }

        const table = $('.table-item');
        selectedTable = table.DataTable({
            data: selectedItems,
            columns: [
                { data: 'name' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        let str = data.golongan;
                        str = str.replace(/_/g, ' ');
                        str = str.charAt(0).toUpperCase() + str.slice(1);
                        return str;
                    }
                },
                { data: 'jumlah_ml' },
                { data: 'jumlah' },     
            ]
        });

        const id = $('.form-order-update').data('id');
        await _getDetail(id, { "bloods": responseItem });
    }

    async function _getDetail(id, additionalParam = {}) {
        const url = `${_apiBaseUrl}/api/admin-order/${id}`;
        const response = await httpGet(url);

        if (response?.error == false) {
            const data = response?.data || null;
            $('#kode_pemesanan').val(data.kode_pemesanan);
            $('#tipe').val(data.tipe);
            $('#dokter').val(data.dokter);
            $('#tgl_pemesanan').val(data.tgl_pemesanan);
            $('#tgl_diperlukan').val(data.tgl_diperlukan);
            $('#status').val(data.status);

            const lenSelectedItem = selectedItems.length;
            const orderDetail = data.order_detail;

            orderDetail.forEach(function(item) {
                let ix = lenSelectedItem;
                const blood = additionalParam.bloods.find( (e) => e.id == item.blood_id);

                selectedItems.push({
                    index: (ix),
                    name: `${blood.blood_type} - ${blood.name}`,
                    golongan: `${item.golongan} - ${item.rhesus}`,
                    jumlah_ml: item.jumlah_ml,
                    jumlah: item.jumlah,
                    id: item.blood_id, 
                    pid: item.id,
                });
                ix = ix + 1;
            });
            

            selectedTable.clear().rows.add(selectedItems).draw();

            await _detailProcessTab(selectedItems, id);

            if (data.status.toLowerCase() == 'selesai') {
                $('.btn-submit').attr('disabled', true);
                Swal.fire({
                    title: 'Info!',
                    text: 'Pemesanan sudah selesai',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });

                return false;
            }
        }

    }

    async function _detailProcessTab(defaultItem, id) {

        processedItems = defaultItem;
        const table = $('.table-receive-item');

        if ( $.fn.dataTable.isDataTable('.table-receive-item') ) {
            table.DataTable().clear().destroy(); // optional
        }
        processedTable = table.DataTable({
            data: processedItems,
            columns: [
                { data: 'name' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        let str = data.golongan;
                        str = str.replace(/_/g, ' ');
                        str = str.charAt(0).toUpperCase() + str.slice(1);
                        return str;
                    }
                },
                { data: 'jumlah_ml' },
                { data: 'jumlah' },
                {
                    data: null,
                    render: function(data, type, row) {
                        const dataRow = JSON.stringify(row);
                        return `
                            <div class="d-flex">
                                <a class="btn btn-sm btn-info view-btn-fulfill-detail mr-2" data-row='${dataRow}' href="#">Detail</a>
                                <a class="btn btn-sm btn-danger view-btn-fulfill" data-row='${dataRow}' href="#">Fulfillment</a>
                            </div> 
                        `;
                    } 
                },
            ]
        });

        const steps = [
            'ambil_sampel', 'terima_sampel', 'periksa_sampel'
        ];

        const url = `${_apiBaseUrl}/api/admin-receipt/${id}`;
        const response = await httpGet(url);

        if (response?.error == false) {
            $('.penerimaan-item').removeAttr('style');

            const data = response?.data || null;
            const urlStep = `${_apiBaseUrl}/api/admin-receipt/process/${data.id}`;
            
            $('.form-order-update').attr('action', urlStep);
            $('.form-order-update').data('receipt', data.id);
            $('.form-order-update').data('step', steps[data.status]);

            $('#kode_penerimaan').val(data.kode_penerimaan);
            $('#tgl_penerimaan').val(data.tgl_penerimaan);

            if (data.tgl_ambil_sampel != null) {
                $('#tgl_ambil_sampel').val(data.tgl_ambil_sampel + ' ' + data.jam_ambil_sampel);
            }
            if (data.tgl_terima_sampel != null) {
                $('#tgl_terima_sampel').val(data.tgl_terima_sampel + ' ' + data.jam_terima_sampel);
            }
            if (data.tgl_periksa_sampel != null) {
                $('#tgl_periksa_sampel').val(data.tgl_periksa_sampel + ' ' + data.jam_periksa_sampel);
            }
            $('#ambil_sampel_oleh').val(data.ambil_sampel_oleh);
            $('#terima_sampel_oleh').val(data.terima_sampel_oleh);
            $('#periksa_sampel_oleh').val(data.periksa_sampel_oleh);
            
        } else {
            $('.penerimaan-item').attr('style', 'display:none');
        }
    }

    function _gesture() {
        /** fulfillment block start */
        $('.table-receive-item tbody').on('click', '.view-btn-fulfill', async function (e){
            e.preventDefault();
            const data = $(this).data('row');

            let modalEl = $('#fulfillment-modal');

            const table = $('.table-fulfillment');
            if ( $.fn.dataTable.isDataTable('.table-fulfillment') ) {
                table.DataTable().clear().destroy(); // optional
            }
            const url = `${_apiBaseUrl}/api/admin-blood-stock`;
            let parts = (data.golongan).split(" - ");
            const golongan = parts[0];
            const rhesus = parts[1];
            
            const payload = {
                "blood_id": data.id,
                "blood_group": golongan,
                "blood_rhesus": rhesus,
                "status": 1,
            }
            const response = await httpGet(url, payload);

            if (response?.error == false) {
                const responseData = response?.data || null;

                $('#item').val(data.name);
                $('#jumlah_ml').val(data.jumlah_ml);
                $('#jumlah').val(data.jumlah);
                
                processedTable = table.DataTable({
                    data: responseData,
                    columns: [
                        { data: 'stock_no' },
                        { data: 'expiry_date' },
                        { data: 'name' },
                        { data: 'blood_group' },
                        { data: 'blood_rhesus' },
                        { data: 'unit_volume' },
                        {
                            data: null,
                            render: function(dataObj, type, row) {
                                row.pemesanan_detail_id = data.pid;
                                const dataRow = JSON.stringify(row);
                                
                                return `
                                    <a class="btn btn-sm btn-info view-btn-fulfillment" data-row='${dataRow}' href="#">Pilih</a>
                                `;
                            } 
                        },
                    ]
                });
            }

            let modal = new bootstrap.Modal(modalEl[0]);
            modal.show();
        });

        $('.table-fulfillment tbody').on('click', '.view-btn-fulfillment', async function (e){
            e.preventDefault();
            const data = $(this).data('row');
            $(this).parent().closest('tr').attr('style', 'background-color: #ffeeba !important; ');

            const jumlahMl = $('#jumlah_ml').val();
            const jumlah =$('#jumlah').val();

            const total = jumlahMl * jumlah;

            fulfillmentItems.push(data);
            const fulfillmentTotal = fulfillmentItems.reduce((sum, obj) => sum + obj.unit_volume, 0);

            $('#jumlah_terpenuhi').val(fulfillmentTotal);

            $(this).html('Hapus');

            $(this).addClass('remove-btn-fulfillment');
            $(this).addClass('btn-danger');

            $(this).removeClass('view-btn-fulfillment');
            $(this).removeClass('btn-info');

        });

        $('.table-fulfillment tbody').on('click', '.remove-btn-fulfillment', async function (e){
            e.preventDefault();
            const data = $(this).data('row');
            $(this).parent().closest('tr').attr('style', 'background-color: #ffeeba !important; ')

            const index = fulfillmentItems.findIndex(item => item.id === data.id);
            if (index !== -1) {
                fulfillmentItems.splice(index, 1);
            }
            $(this).html('Pilih');

            $(this).addClass('view-btn-fulfillment');
            $(this).addClass('btn-info');

            $(this).removeClass('remove-btn-fulfillment');
            $(this).removeClass('btn-danger');
        });

        /** fulfillment block end */

        /** fulfillment detail */
        $('.table-receive-item tbody').on('click', '.view-btn-fulfill-detail', async function (e){
            e.preventDefault();
            const data = $(this).data('row');
            
            let modalEl = $('#fulfillment-detail-modal');

            const table = $('.table-fulfillment-detail');
            if ( $.fn.dataTable.isDataTable('.table-fulfillment') ) {
                table.DataTable().clear().destroy(); // optional
            }
            const url = `${_apiBaseUrl}/api/admin-receipt/detail/${data.pid}`;
            const response = await httpGet(url);

            if (response?.error == false) {
                const responseData = response?.data || null;
                
                processedTable = table.DataTable({
                    data: responseData,
                    columns: [
                        { data: 'stock_no' },
                        { data: 'expiry_date' },
                        { data: 'name' },
                        { data: 'blood_group' },
                        { data: 'blood_rhesus' },
                        { data: 'unit_volume' },
                    ]
                });
            }

            let modal = new bootstrap.Modal(modalEl[0]);
            modal.show();
        });


        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const form = $('.form-order-update');
            const orderId = form.data('id');

            const step = form.data('step') || null;

            const payload = [{
                name: "items",
                value: JSON.stringify(fulfillmentItems)
            }, {
                name: "order_id",
                value: orderId
            }, {
                name: "type",
                value: step
            }];

            const response = await submitPostFormToken('.form-order-update', payload) || null;

            if (response != null) {
                if (response?.error) {
                    Swal.fire({
                        title: 'Error!',
                        text: response?.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                    return false;
                } else {
                    Swal.fire({
                        title: "Success",
                        text: "Order is Processed",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/admin/order');
                        });

                    await _detailProcessTab(selectedItems, orderId);
                }                
            }
        });
    }
});