$(document).ready(function() {
    _gesture();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const additionalPayload = [{
                name: "blood_type",
                value: $("#blood_type_alias").find(':selected').text(),
            }]

            const response = await submitPostFormToken('.form-blood-create', additionalPayload) || null;

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
                            return redirectWithToken('/admin/blood');
                        });
                }                
            }
        })
    }
});