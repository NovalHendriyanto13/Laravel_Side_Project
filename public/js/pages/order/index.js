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
            order: [[3, 'desc']],
            columns: [
                { data: 'kode_pemesanan' },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
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

                        const receiptLetter = row.status_id == '5' ? `<a href="${_appUrl}/api/admin-order/receipt-letter/${row.id}?token=${token}" target="_blank" class="dropdown-item">Kwitansi Pembayaran</a>` : '';
                        const form = `<a href="${_appUrl}/api/admin-order/preview/${row.id}?token=${token}" target="_blank" class="dropdown-item">Form Pemesanan</a>`;

                        return `
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    ${actionView}
                                    ${form}
                                    ${receipt}
                                    ${receiptLetter}
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        })
    }
})