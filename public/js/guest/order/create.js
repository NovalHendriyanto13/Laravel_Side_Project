$(document).ready(async function() {

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

        $('.btn-submit').click(async function(e) {
            e.preventDefault();
            const getHospital = localStorage.getItem('_user_hospital') || "{}";
            const hospital = JSON.parse(getHospital);

            const payload = { "name": "rs_id", "value" : hospital.id }

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
        })
    }
});