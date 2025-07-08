$(document).ready(async function() {

    _init();

    async function _init() {
        const user = localStorage.getItem('_user_guest') || "{}";
        const userLogged = JSON.parse(user);
        
        $('#hospital-name').text(userLogged.name);
        
        const table = $('.table-order');
        const apiUrl = table.data('url');
        const token = localStorage.getItem('_token_guest');

        table.DataTable({
            ajax: {
                url: apiUrl,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error('AJAX error:', xhr.responseText);
                }
            },
            columns: [
                { data: 'code' },
                { data: 'name' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.blood_type + ' ' + row.blood_type_alias;
                    } 
                },
            ]
        })
    }
})