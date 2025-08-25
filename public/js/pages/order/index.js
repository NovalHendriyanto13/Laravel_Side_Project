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
                        let url = `${_appUrl}/admin/order/non-bdrs/${row.id}?token=${token}`;
                        if (data.tipe == 'bdrs') {
                            url = `${_appUrl}/admin/order/${row.id}?token=${token}`;
                        }

                        const actionView = `<a class="dropdown-item" data-id="${row.id}" href="${url}">Lihat Detail</a>`
                        let receipt = '';
                        if (data.status_id == 5) {
                            receipt = `<a href="${_appUrl}/api/admin-order/receipt/${row.id}?token=${token}" target="_blank" class="dropdown-item">Bukti Penerimaan</a>`;
                        }

                        return `
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    ${actionView}
                                    ${receipt}
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        })
    }
})