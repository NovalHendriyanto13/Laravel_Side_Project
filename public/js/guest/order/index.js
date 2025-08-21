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
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        if (data.tipe == 'bdrs') {
                            return `<a href="${_appUrl}/order/${row.id}?token=${token}" class="a-auth">${row.kode_pemesanan}</a>`;
                        }
                        return `<a href="${_appUrl}/order/non-bdrs/${row.id}?token=${token}" class="a-auth">${row.kode_pemesanan}</a>`;
                    } 
                },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
                { data: 'status' },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        if (row.tipe == 'non_bdrs') {
                            return `<a href="${_appUrl}/api/order/preview/${row.id}?token=${token}" target="_blank" class="btn btn-primary a-auth" style="margin-right: 5px">Lihat</a>`
                        } else { 
                            return '';
                        }
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        if (row.status_id == '4' || row.status_id == '5') {
                            return `<a href="${_appUrl}/api/order/receipt/${row.id}?token=${token}" target="_blank" class="btn btn-primary a-auth" style="margin-right: 5px">Lihat</a>`
                        }
                        return '';
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        if (row.status_id == '4') {
                            return `<a href="${_appUrl}/api/order/receipt-letter/${row.id}?token=${token}" target="_blank" class="btn btn-primary a-auth" style="margin-right: 5px">Form</a>`
                        }
                        return '';
                        
                    } 
                },
            ]
        })
    }
})