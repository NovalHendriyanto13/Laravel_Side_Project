$(document).ready(async function() {

    _init();

    async function _init() {
        const table = $('.table-blood');
        const apiUrl = table.data('url');
        const token = localStorage.getItem('_token');

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
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token');
                        return `<a href="${_appUrl}/admin/blood/${row.id}?token=${token}" class="a-auth">${row.code}</a>`;
                    } 
                },
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