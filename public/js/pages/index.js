$(document).ready(function() {
    _defaultGesture();

    async function _defaultGesture() {
        $('.btn-logout').click(async function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            const response = await logout(url) || null;

            if (response != null) {
                localStorage.removeItem("_token");
                
                return redirect('/auth/login');
            } 
        });

        $('a').click(function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            const token = localStorage.getItem('_token') || '';

            return window.location.href = `${url}?token=${token}`;
        });

        if ($.fn.DataTable) {
            $('.table-datatable').DataTable();
        }

        $('.datepicker').datepicker();
    }

})