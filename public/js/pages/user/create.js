$(document).ready(function() {
    _gesture();

    async function _gesture() {

        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const password = $('#password').val();
            const rePassword = $('#repeat_password').val();

            if (password !== rePassword) {
                Swal.fire({
                        title: 'Error!',
                        text: 'Password tidak cocok',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                    return false;
            }
            
            const response = await submitPostFormToken('.form-user') || null;

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
                            return redirectWithToken('/admin/user');
                        });
                }                
            }
        })
    }
});