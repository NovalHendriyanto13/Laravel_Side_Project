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
                        return `<a href="${_appUrl}/order/${row.id}?token=${token}" class="a-auth">${row.kode_pemesanan}</a>`;
                    } 
                },
                { data: 'tipe' },
                { data: 'dokter' },
                { data: 'tgl_pemesanan' },
                { data: 'tgl_diperlukan' },
                { data: 'nama_pasien' },
                { data: 'jenis_kelamin' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return row.tempat_lahir + ', ' + row.tanggal_lahir;
                    } 
                },
                { data: 'no_telp' },
                { data: 'diagnosis' },
                { data: 'status' },
                {
                    data: null,
                    render: function(data, type, row) {
                        const token = localStorage.getItem('_token_guest');
                        return `<a href="${_appUrl}/order/preview/${row.id}?token=${token}" target="_blank" class="btn btn-primary a-auth">Preview</a>`;
                    } 
                },
            ]
        })
    }
})