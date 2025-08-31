$(document).ready(async function() {
    _gesture();
    
    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const response = await submitPutFormGuestToken('.form-auth-password') || null;

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