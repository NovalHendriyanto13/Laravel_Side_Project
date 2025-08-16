$(document).ready(async function() {

    _gesture();

    async function _gesture() {
        $('.btn-submit').click(async function(e) {
            e.preventDefault();

            const payload = [];
            await submitDownloadFileToken('.form-order-report', payload) || null;
        });
    }
})