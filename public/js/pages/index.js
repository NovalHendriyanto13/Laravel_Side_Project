$(document).ready(function() {
    let _user = null;
    let allowedMenu = {
        "master-blood": false,
        hospital: false,
        "blood-stock": false,
        order: false,
        payment: false,
        report: false,
        users: false,
    };

    _init();
    _defaultGesture();
    
    async function _init() {
       _user = JSON.parse(localStorage.getItem('_user')); 
        
       if (_user?.role == 'admin') {
            allowedMenu["master-blood"] = true;
            allowedMenu.hospital = true;
            allowedMenu["blood-stock"] = true;
            allowedMenu.order = true;
            allowedMenu.users = true;
       } else if (_user?.role == 'upd_officer') {
            allowedMenu["blood-stock"] = true;
            allowedMenu.order = true;
            allowedMenu.payment = true;
       } else if (_user?.role == 'checker') {
            allowedMenu["blood-stock"] = true;
            allowedMenu.order = true;
       }

       for (const k in allowedMenu) {
            if (allowedMenu[k] == false) {
                const menuClassItem = `.menu-${k}`;
                $(menuClassItem).attr('style', 'display:none');
            }
       }
       
    }

    async function _defaultGesture() {
        $('.btn-logout').click(async function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            const response = await logout(url) || null;

            if (response != null) {
                if (response?.error == false) {
                    localStorage.removeItem("_token");
                    localStorage.removeItem("_user");
                    
                    return redirect('/admin');
                }
            } 
            return redirect('/admin');
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