$(document).ready(function() {
    _gesture();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const response = await submitPostForm('.form-submit') || null;

            if (response != null) {
                localStorage.setItem("_token", response.token);
                
                return redirectWithToken('/');
            }
        })
    }
});