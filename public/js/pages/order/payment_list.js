$(document).ready(async function() {

    _init();

    async function _init() {
        const table = $('.table-order');
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
                { data: 'kode_pemesanan' },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
                { data: 'status' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token');
                            return `
                                <a class="btn btn-sm btn-info view-btn" data-id="${row.id}" href="${_appUrl}/admin/order/payment/${row.id}?token=${token}">
                                    Bayar
                                </a>
                            `;
                    }
                }
            ]
        })
    }
})