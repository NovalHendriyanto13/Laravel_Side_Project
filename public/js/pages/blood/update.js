$(document).ready(function() {
    _init();
    _gesture();

    async function _init() {
        const id = $('.form-blood-update').data('id');
        const url = `${_apiBaseUrl}/api/admin-blood/${id}`;
        const response = await httpGet(url) || null;

        if (response != null) {
             if (response?.error == false) {
                const data = response?.data || null;
                $('#code').val(data.code || '');
                $('#name').val(data.name || '');
                $('#blood_type_alias').val(data.blood_type_alias || '');
            }
        }
    }

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const additionalPayload = [{
                name: "blood_type",
                value: $("#blood_type_alias").find(':selected').text(),
            }]
            
            const response = await submitPutFormToken('.form-blood-update', additionalPayload) || null;

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
                        text: "Master Data is updated",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        }).then((result) => {
                            return redirectWithToken('/admin/blood');
                        });
                }                
            }
        })
    }
});