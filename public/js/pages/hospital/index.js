$(document).ready(async function() {

    _init();

    async function _init() {
        const table = $('.table-hospital');
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
                { data: 'kode_rs' },
                { data: 'nama_rs' },
                { data: 'email' },
                { data: 'no_telp' },
                { data: 'penanggung_jawab_rs' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token');
                        return `
                            <a class="btn btn-sm btn-info view-btn" data-id="${row.id}" href="${_appUrl}/admin/hospital/${row.id}?token=${token}">
                                View
                            </a>
                        `;
                    }
                }
            ]
        })
    }
})