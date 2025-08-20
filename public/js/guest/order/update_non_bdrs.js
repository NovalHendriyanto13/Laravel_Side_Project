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
                    jumlah_ml: item.jumlah_ml,
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
        }

    }

    function _gesture() {
        $('#tipe').change(function(e) {
            const value = $(this).val();
            const patientTab = $('.patient-info');
            const additionalTab = $('.additional-info');

            if (value == 'bdrs') {
                patientTab.css("display", "none");
                additionalTab.css("display", "none");
            } else {
                patientTab.css("display", "block");
                additionalTab.css("display", "block");
            }
        });

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

        $('#transfusi_sebelumnya').change(function(e) {
            const value = $(this).val();
            const tglTransfusiSebelumnya = $('#tgl_transfusi_sebelumnya');
            const tempatSerologi = $('#tempat_serologi');
            const tglSerologi = $('#tgl_serologi');
            const hasilSerologi = $('#hasil_serologi');
            const gejalaReaksi = $('#gejala_reaksi');

            if (value == 1) {
                tglTransfusiSebelumnya.removeAttr("disabled");
                tempatSerologi.removeAttr("disabled");
                tglSerologi.removeAttr("disabled");
                hasilSerologi.removeAttr("disabled");
                gejalaReaksi.removeAttr("disabled");
            } else {
                tglTransfusiSebelumnya.attr("disabled", true);
                tempatSerologi.attr("disabled", true);
                tglSerologi.attr("disabled", true);
                hasilSerologi.attr("disabled", true);
                gejalaReaksi.attr("disabled", true);
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
                pid: null,
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
                value: "non_bdrs",
            }, {
                name: "items",
                value: JSON.stringify(selectedItems)
            }];

            const response = await submitPutFormGuestToken('.form-order-update', payload, true) || null;

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
                        text: "Blood Stock Data is updated",
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