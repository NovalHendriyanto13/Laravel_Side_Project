$(document).ready(function() {
    let _user = null;
    _gesture();
    _init();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const response = await submitPutFormToken('.form-blood-stock-update') || null;

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
                            return redirectWithToken('/admin/blood-stock');
                    });
                }
                
            }
        })

        $('.btn-delete').click(async function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Delete!',
                text: "Apakah Anda yakin akan menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",

            }).then(async (result) => {
                if (result.isConfirmed) {
                    const id = $('.form-blood-stock-update').data('id');
                    const url = `${_apiBaseUrl}/api/admin-blood-stock/delete/${id}`;
                    const response = await httpPost(url) || null;

                    if (response != null) {
                        if (response?.error == false) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: response?.message,
                                icon: "error"
                            });
                        }
                    }
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
        })
    }

    async function _init() {
        _user = JSON.parse(localStorage.getItem('_user'));
        if (_user.role == 'admin' || _user.role == 'checker') {
            $('.btn-submit').attr('disabled', true);
        }

        const id = $('.form-blood-stock-update').data('id');
        const url = `${_apiBaseUrl}/api/admin-blood-stock/${id}`;
        const response = await httpGet(url) || null;

        if (response != null) {
             if (response?.error == false) {
                const data = response?.data || null;
                $('#stock_no').val(data.stock_no || '');
                $('#expiry_date').val(data.expiry_date || '');
                $('#blood_group').val(data.blood_group || '');
                $('#unit_volume').val(data.unit_volume || '');
                $('#blood_id').val(data.blood_id || '');
                $('#blood_rhesus').val(data.blood_rhesus || '');
                $('#harga').val(data.harga || '');
                $('#status').val(data.status || '');
            }
        }
    }
});