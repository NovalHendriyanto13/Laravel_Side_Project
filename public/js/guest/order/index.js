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
                { data: 'kode_pemesanan' },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
                { data: 'status' },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        let urlUpdate = `${_appUrl}/order/non-bdrs/${row.id}?token=${token}`;
                        if (data.tipe == 'bdrs') {
                            urlUpdate = `${_appUrl}/order/${row.id}?token=${token}`
                        }
                        return `
                            <div class="d-flex">
                                <a href="${urlUpdate}" class="btn btn-success a-auth" style="margin-right: 2px">Ubah</a>
                            </div> 
                        `;
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        const receiptLetter = row.status_id == '5' ? `<a href="${_appUrl}/api/order/receipt-letter/${row.id}?token=${token}" target="_blank" class="dropdown-item">Kwitansi</a>` : '';
                        const receipt = row.status_id == '5' ? `<a href="${_appUrl}/api/order/receipt/${row.id}?token=${token}" target="_blank" class="dropdown-item">Bukti Penerimaan</a>` : '';
                        const form = row.tipe == 'non_bdrs' ? `<a href="${_appUrl}/api/order/preview/${row.id}?token=${token}" target="_blank" class="dropdown-item">Form</a>` : '';
                        return `
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Print
                                </button>
                                <div class="dropdown-menu">
                                    ${form}
                                    ${receipt}
                                    ${receiptLetter}
                                </div>
                            </div>
                        `;
                        
                    } 
                },
            ]
        })
    }
})