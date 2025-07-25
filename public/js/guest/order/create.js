$(document).ready(async function() {

    let selectedItems = [];
    let selectedTable;
    await _init();
    _gesture();

    async function _init() {
        const user = localStorage.getItem('_user_guest') || "{}";
        const userLogged = JSON.parse(user);
        
        $('#hospital-name').text(userLogged.name);

        const today = new Date();
        const formattedDate = today.toLocaleDateString('en-GB');

        // $('input').val("");
        $('#tgl_pemesanan').val(formattedDate);

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
        })
    }

    function _gesture() {
        $('#jenis_kelamin').change(function(e) {
            const value = $(this).val();
            const hamil = $('#hamil');
            const jmlHamil = $('#jumlah_kehamilan');
            const aborsi = $('#pernah_aborsi');

            if (value == 'perempuan') {
                hamil.removeAttr("disabled");
                jmlHamil.removeAttr("readonly");
                aborsi.removeAttr("disabled");
            } else {
                hamil.attr("disabled", true);
                jmlHamil.attr("readonly", true);
                aborsi.attr("disabled", true);
            }
        });

        $('#status_nikah').change(function(e) {
            const value = $(this).val();
            const namaPasangan = $('#nama_pasangan');

            if (value == 'menikah') {
                namaPasangan.removeAttr("disabled");
            } else {
                namaPasangan.attr("disabled", true);
            }
        });

        $('#select_item').click(function() {
            const item = $('#item').find(':selected');
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
                name: "rs_id",
                value: hospital.id,
            }, {
                name: "items",
                value: JSON.stringify(selectedItems)
            }];

            const response = await submitPostFormGuestToken('.form-order-create', payload) || null;

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
                        text: "Blood Stock Data is created",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            // return redirectWithToken('/admin/blood-stock');
                        });
                }                
            }
        });
    }
});