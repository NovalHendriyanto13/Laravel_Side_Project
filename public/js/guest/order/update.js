$(document).ready(async function() {

    let selectedItems = [];
    let selectedTable;
    await _init();
    _gesture();

    async function _init() {
        const user = localStorage.getItem('_user_guest') || "{}";
        const userLogged = JSON.parse(user);
        
        $('#hospital-name').text(userLogged.name);

        const item = $('#item');
        const itemUrl = item.data('url');
        let responseItem = [];
        const items = await httpGetGuest(itemUrl);
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
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a class="btn btn-sm btn-danger btn-delete-item" data-id="${row.id}" data-index="${row.index}">
                                Hapus
                            </a>
                        `;
                    }
                }
                
            ]
        });

        const id = $('.form-order-update').data('id');
        await _getDetail(id, { "bloods": responseItem });
    }

    async function _getDetail(id, additionalParam = {}) {
        const url = `${_apiBaseUrl}/api/order/${id}`;
        const response = await httpGetGuest(url);

        if (response?.error == false) {
            const data = response?.data || null;
            $('#kode_pemesanan').val(data.kode_pemesanan);
            $('#tipe').val(data.tipe);
            $('#dokter').val(data.dokter);
            $('#tgl_pemesanan').val(data.tgl_pemesanan);
            $('#tgl_diperlukan').val(data.tgl_diperlukan);
            
            const lenSelectedItem = selectedItems.length;
            const orderDetail = data.order_detail;

            orderDetail.forEach(function(item) {
                let ix = lenSelectedItem;
                const blood = additionalParam.bloods.find( (e) => e.id == item.id);

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
        
        $('#golongan').change(async function(e) {
            const value = $(this).val();
            const bloodId = $('#item').val();
            const jumlahMl = $('#jumlah_ml');
            const itemUrl = jumlahMl.data('url');

            let golongan = '';
            let rhesus = '';
            if (value != '') {
                let parts = value.split("_");
                golongan = parts[0];
                rhesus = parts[1];
            }
            const payload = {
                "blood_id": bloodId,
                "blood_group": golongan,
                "blood_rhesus": rhesus,
            }        

            const items = await httpGetGuest(itemUrl, payload);
            if (items?.error == false) {
                jumlahMl.empty()
                responseItem = items?.data;
                $(jumlahMl).append(
                    $('<option>', {
                        value: "",
                        text: "Pilih"
                    })
                );
                responseItem.forEach(function(value) {
                    $(jumlahMl).append(
                        $('<option>', {
                            value: value?.unit_volume,
                            text: (value?.unit_volume)
                        })
                    );
                });
            }
        });

        $('#select_item').click(function() {
            const item = $('#item').find(':selected');
            const jmlMl = $('#jumlah_ml').find(':selected');
            const gol = $('#golongan').find(':selected');
            const jml = $('#jumlah');

            if (jml.val() == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Jumlah harus diisi',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                return false;
            }

            const lenSelectedItem = selectedItems.length;
            selectedItems.push({
                index: (lenSelectedItem),
                name: item.text(),
                golongan: gol.val(),
                jumlah_ml: jmlMl.val(),
                jumlah: jml.val(),
                id: item.val(), 
            });
            

            selectedTable.clear().rows.add(selectedItems).draw();
        });

        $('.table-item tbody').on('click', '.btn-delete-item', function () {
            const data = selectedTable.row($(this).closest('tr')).data();
            selectedItems = selectedItems.filter(item => !((item.index === data.index) && (item.id === data.id)));
            selectedTable.clear().rows.add(selectedItems).draw();
        });

        $('.btn-submit').click(async function(e) {
            e.preventDefault();
            const getHospital = localStorage.getItem('_user_hospital') || "{}";
            const hospital = JSON.parse(getHospital);

            if (selectedItems.length <= 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap lengkapi data di INFORMASI PEMESANAN',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return false;
            }

            const payload = [{
                name: "tipe",
                value: "bdrs",
            }, {
                name: "items",
                value: JSON.stringify(selectedItems)
            }];

            const response = await submitPutFormGuestToken('.form-order-update', payload, false) || null;

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
                        text: "Order Data is updated",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/order', '_token_guest');
                        });
                }                
            }
        });
    }
});