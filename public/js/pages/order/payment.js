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

        const id = $('.form-order-payment').data('id');
        await _getDetail(id, { "bloods": responseItem });
    }

    async function _getDetail(id, additionalParam = {}) {
        const url = `${_apiBaseUrl}/api/admin-receipt/detail-order/${id}`;
        const response = await httpGet(url);

        if (response?.error == false) {
            const data = response?.data || null;
            $('#kode_pemesanan').val(data.kode_pemesanan);
            $('#tipe').val(data.tipe);
            $('#dokter').val(data.dokter);
            $('#tgl_pemesanan').val(data.tgl_pemesanan);
            $('#tgl_diperlukan').val(data.tgl_diperlukan);
            $('#status').val(data.status);
            $('#total_harga').val((data.total_harga).toLocaleString('id-ID'));

            const lenSelectedItem = selectedItems.length;
            const orderDetail = data.receipt_detail;

            orderDetail.forEach(function(item) {
                let ix = lenSelectedItem;
                const blood = additionalParam.bloods.find( (e) => e.id == item.blood_id);

                selectedItems.push({
                    index: (ix),
                    name: `${blood.blood_type} - ${blood.name}`,
                    golongan: `${item.blood_group} - ${item.blood_rhesus}`,
                    jumlah_ml: item.unit_volume,
                    jumlah: item.harga,
                    id: item.blood_id, 
                    pid: item.id,
                });
                ix = ix + 1;
            });
            

            selectedTable.clear().rows.add(selectedItems).draw();

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

    function _gesture() {

        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const totalHarga = $('#total_harga').val();
            const totalBayar = $('#jumlah_pembayaran').val();

            if (parseInt(totalBayar.replace(/\./g, ''), 10) != parseInt(totalHarga.replace(/\./g, ''), 10)) {
                Swal.fire({
                    title: "Error",
                    text: "Jumlah Bayar tidak sama dengan jumlah harga",
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                    }).then((result) => {
                    });
                
                return false;
            }

            const response = await submitPostFormToken('.form-order-payment') || null;

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
                        text: "Order is Done",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/admin/order');
                        });
                }                
            }
        });
    }
});