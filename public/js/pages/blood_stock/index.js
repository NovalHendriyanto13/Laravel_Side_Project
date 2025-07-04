$(document).ready(async function() {

    _init();

    async function _init() {
        const table = $('.table-stock');
        const apiUrl = table.data('url');
        const token = localStorage.getItem('_token');

        $('.table-stock').DataTable({
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
                { data: 'expiry_date' },
                { data: 'stock_no' },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return row.blood_type + ' ' + row.name;
                    } 
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return row.blood_group + ' ' + row.blood_rhesus;
                    } 
                },
                { data: 'unit_volume' },
                { data: 'status' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-info view-btn" data-id="${row.id}">View</button>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">Edit</button>
                        `;
                    }
                }
            ]
        })
    }
})