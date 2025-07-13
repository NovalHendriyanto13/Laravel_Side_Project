$(document).ready(function() {
    _init();

    async function _init() {
        const id = $('.form-hospital-update').data('id');
        const url = `${_apiBaseUrl}/api/hospital/${id}`;
        const response = await httpGet(url) || null;

        if (response != null) {
             if (response?.error == false) {
                const data = response?.data || null;
                $('#kode_rs').val(data.kode_rs || '');
                $('#nama_rs').val(data.nama_rs || '');
                $('#email').val(data.email || '');
                $('#penanggung_jawab_rs').val(data.penanggung_jawab_rs || '');
                $('#kota').val(data.kota || '');
                $('#kode_pos').val(data.kode_pos || '');
                $('#no_telp').val(data.no_telp || '');
                $('#alamat').val(data.alamat || '');
            }
        }
    }
});