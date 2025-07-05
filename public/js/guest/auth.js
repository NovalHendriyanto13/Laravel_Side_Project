$(document).ready(function() {
    _gesture();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const password = $('#password').val();
            const rePassword = $('#re_password').val();

            if (password != rePassword) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Password tidak sesuai',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return false;
            }

            const response = await submitPostForm('.form-register') || null;
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
                        text: "Registrasi berhasil, silakan login di halaman utama",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/');
                        });
                }                
            }
            
        })
    }
});