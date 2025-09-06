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
            order: [[3, 'desc']],
            columns: [
                { data: 'kode_pemesanan' },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
                // { data: 'status' },
                {
                    data: null,
                    render: function(data, type, row) {
                        let status = null;
                        let colors = '#000';
                        
                        if (data.tipe == 'bdrs') {
                            status = data.status;
                            if (data.status_id == 0) {
                                colors = '#FF0000';   
                            } else if (data.status_id == 5) {
                                colors = '#008000'; 
                            }
                        } else {
                            if (data.status_penerimaan == null) {
                                status = data.status;
                            } else {
                                if (data.status_id == 6) {
                                    status = data.status;
                                    colors = '#FF0000';
                                } else {
                                    status = data.status_penerimaan_label;
                                }
                                 if (data.status_penerimaan == 5 && data.status_id != 6) {
                                    colors = '#008000'; 
                                }
                            }
                        }
                        return `<span style="color: ${colors}">${status}</span>`;
                        //return status;
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        let urlUpdate = `${_appUrl}/order/non-bdrs/${row.id}?token=${token}`;
                        if (data.tipe == 'bdrs') {
                            urlUpdate = `${_appUrl}/order/${row.id}?token=${token}`
                        }
                        let anchor = 'a';
                        let anchorClass = 'btn-success';

                        if (data.status_id != 1) {
                            anchor = 'button';
                            anchorClass = 'btn-secondary';
                        }
                        return `
                            <div class="d-flex">
                                <${anchor} href="${urlUpdate}" class="btn ${anchorClass} a-auth" style="margin-right: 2px">Ubah</${anchor}>
                            </div> 
                        `;
                    } 
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        const receiptLetter = row.status_id == '5' ? `<a href="${_appUrl}/api/order/receipt-letter/${row.id}?token=${token}" target="_blank" class="dropdown-item">Kwitansi Pembayaran</a>` : '';
                        const receipt = row.status_id == '5' ? `<a href="${_appUrl}/api/order/receipt/${row.id}?token=${token}" target="_blank" class="dropdown-item">Bukti Penerimaan</a>` : '';
                        const form = `<a href="${_appUrl}/api/order/preview/${row.id}?token=${token}" target="_blank" class="dropdown-item">Form Pemesanan</a>`;
                        return `
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
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