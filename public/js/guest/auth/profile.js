$(document).ready(async function() {

    _init();
    _gesture();

    async function _init() {
        const getHospital = localStorage.getItem('_user_hospital') || "{}";
        const hospital = JSON.parse(getHospital);

        const url = `${_apiBaseUrl}/api/hospitals/${hospital.id}`;
        const response = await httpGetGuest(url);
        if (response?.error == false) {
            const data = response?.data;

            $('#kode_rs').val(data?.kode_rs);
            $('#nama_rs').val(data?.nama_rs);
            $('#alamat').val(data?.alamat);
            $('#email').val(data?.email);
            $('#kode_pos').val(data?.kode_pos);
            $('#kota').val(data?.kota);
            $('#no_telp').val(data?.no_telp);
            $('#penanggung_jawab_rs').val(data?.penanggung_jawab_rs);
        }
    }

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const getHospital = localStorage.getItem('_user_hospital') || "{}";
            const hospital = JSON.parse(getHospital);

            const payload = [{ 
                name: "id",
                value: hospital.id,
            }];

            const response = await submitPutFormGuestToken('.form-hospital-update', payload) || null;

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
                        text: "Profile is updated",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                        });
                }                
            }
        });
    }
})