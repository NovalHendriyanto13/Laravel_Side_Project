$(document).ready(function() {
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
                            return redirectWithToken('/blood-stock');
                    });
                }
                
            }
        })
    }

    async function _init() {
        const id = $('.form-blood-stock-update').data('id');
        const url = `${_apiBaseUrl}/api/blood-stock/${id}`;
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
                $('#status').val(data.status || '');
            }
        }
    }
});