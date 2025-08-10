$(document).ready(async function() {

    let selectedItems = [];
    let selectedTable;

    let processedItems = [];
    let processedTable;

    await _init();
    _gesture();

    async function _init() {
        const item = $('#item');
        const itemUrl = item.data('url');
        let responseItem = [];
        const items = await httpGet(itemUrl);

        if (items?.error == false) {
            item.empty()
            responseItem = items?.data;
            responseItem.forEach(function(value) {
                $(item).append(
                    $('<option>', {
                        value: value?.id,
                        text: (value?.blood_type + ' - '+ value?.name)
                    })
                );
            });
        }

        const table = $('.table-item');
        selectedTable = table.DataTable({
            data: selectedItems,
            columns: [
                { data: 'name' },
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
            $('#diagnosis').val(data.diagnosis);
            $('#alasan_transfusi').val(data.alasan_transfusi);
            $('#hb').val(data.hb);
            $('#trombosit').val(data.trombosit);
            $('#berat_badan').val(data.berat_badan);
            $('#nama_pasien').val(data.nama_pasien);
            $('#status_nikah').val(data.status_nikah);
            $('#nama_pasangan').val(data.nama_pasangan);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#alamat').val(data.alamat);
            $('#no_telp').val(data.no_telp);
            $('#transfusi_sebelumnya').val(data.transfusi_sebelumnya);
            $('#tgl_transfusi_sebelumnya').val(data.tgl_transfusi_sebelumnya);
            $('#gejala_reaksi').val(data.gejala_reaksi);
            $('#tempat_serologi').val(data.tempat_serologi);
            $('#tgl_serologi').val(data.tgl_serologi);
            $('#hasil_serologi').val(data.hasil_serologi);
            $('#hamil').val(data.hamil);
            $('#jumlah_kehamilan').val(data.jumlah_kehamilan);
            $('#pernah_aborsi').val(data.pernah_aborsi);
            $('#status').val(data.status);

            const lenSelectedItem = selectedItems.length;
            const orderDetail = data.order_detail;

            orderDetail.forEach(function(item) {
                let ix = lenSelectedItem;
                const blood = additionalParam.bloods.find( (e) => e.id == item.id);

                selectedItems.push({
                    index: (ix),
                    name: `${blood.blood_type} - ${blood.name}`,
                    jumlah: item.jumlah,
                    id: item.blood_id, 
                    pid: item.id,
                });
                ix = ix + 1;
            });
            

            selectedTable.clear().rows.add(selectedItems).draw();

            const patientTab = $('.patient-info');
            const additionalTab = $('.additional-info');

            if (data.tipe == 'bdrs') {
                patientTab.css("display", "none");
                additionalTab.css("display", "none");
            } else {
                patientTab.css("display", "block");
                additionalTab.css("display", "block");
            }

            await _detailProcessTab(selectedItems, id);
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
                { data: 'jumlah' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return 0;
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const dataRow = JSON.stringify(row);
                        return `
                            <a class="btn btn-sm btn-info view-btn-fulfill" data-row='${dataRow}' href="#">Detail</a>
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
            const data = response?.data || null;
            const urlStep = `${_apiBaseUrl}/api/admin-receipt/process/${data.id}`;
            
            $('.form-order-update').attr('action', urlStep);
            $('.form-order-update').data('receipt', data.id);
            $('.form-order-update').data('step', steps[data.status]);

            $('#kode_penerimaan').val(data.kode_penerimaan);
            $('#tgl_penerimaan').val(data.tgl_penerimaan);
            $('#tgl_ambil_sampel').val(`${data.tgl_ambil_sampel} ${data.jam_ambil_sampel}`);
            
        } else {
            console.log('No Data Found');
        }

    }

    function _gesture() {
        $('.table-receive-item tbody').on('click', '.view-btn-fulfill', async function (e){
            e.preventDefault();
            const data = $(this).data('row');
            console.log(data);
            let modalEl = $('#fulfillment-modal');

            const table = $('.table-fulfillment');
            if ( $.fn.dataTable.isDataTable('.table-fulfillment') ) {
                table.DataTable().clear().destroy(); // optional
            }
            const url = `${_apiBaseUrl}/api/blood-stock`;
            const payload = {
                "blood_id": data.id,
                "status": 0,
            }
            const response = await httpGet(url, payload);

            if (response?.error == false) {
                const data = response?.data || null;
                processedTable = table.DataTable({
                    data: data,
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

            if (selectedItems.length <= 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap lengkapi data di INFORMASI PEMESANAN',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return false;
            }

            const step = form.data('step') || null;

            const payload = [{
                name: "items",
                value: JSON.stringify(selectedItems)
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
                            
                        });

                    await _detailProcessTab(selectedItems, orderId);
                }                
            }
        });
    }
});