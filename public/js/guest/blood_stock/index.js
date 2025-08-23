$(document).ready(async function() {

    _init();

    async function _init() {
        const table = $('.table-stock');
        const apiUrl = table.data('url');
        const token = localStorage.getItem('_token_guest');
        const payload = {
            "status": 1,
        }

        table.DataTable({
            ajax: {
                url: apiUrl,
                type: 'GET',
                data: payload,
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
                { 
                    data: null,
                    render: function(data, type, row) {
                        return (row.harga).toLocaleString('id-ID');
                    } 
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        const status = ['Tidak Tersedia', 'Tersedia', 'Kadaluarsa'];
                        return status[row.status];
                    } 
                },
            ]
        })
    }
})