$(document).ready(function() {
    _gesture();
    _init();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const response = await submitPutFormToken('.form-user-update') || null;

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
                        text: response?.message,
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/admin/user');
                    });
                }
                
            }
        });

        $('.btn-change-password').click(async function(e) {
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

            const response = await submitPutFormToken('.form-change-password') || null;

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
                        text: response?.message,
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return true;
                    });
                }
                
            }
        })
    }

    async function _init() {
        const id = $('.form-user-update').data('id');
        const url = `${_apiBaseUrl}/api/user/${id}`;
        const response = await httpGet(url) || null;

        if (response != null) {
             if (response?.error == false) {
                const data = response?.data || null;
                $('#nik').val(data.nik || '');
                $('#name').val(data.name || '');
                $('#email').val(data.email || '');
                $('#role').val(data.role || '');
            }
        }
    }
});