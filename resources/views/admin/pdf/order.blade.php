<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
</head>
<body>
    <div class="d-flex justify-content-between align-items-start mb-2">
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%">
            <tr>
                <td>
                    <div style="width:48px;height:48px;border:1px solid #ccc; background-image: url('../../../images/donor_bg.jpg'); background-size: 'cover';"></div>
                </td>
                <td>
                    <div>
                        <div class="fw-bold">UNIT DONOR DARAH – DKI JAKARTA</div>
                        <div class="xs">Jl. Kramat Raya 47, Jakarta 10450 • Telp. 3906646 Fax 3101107</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <h1>Laporan Pemesanan</h1>
    <p>Tanggal: {{ $dates['start_date'] }} - {{ $dates['end_date'] }}</p>
    <table border="1" cellspacing="0" cellpadding="4" style="width:100%">
        <tr>
            <th>Kode Pemesanan</th>
            <th>Tipe</th>
            <th>Kode Rumah Sakit</th>
            <th>Rumah Sakit</th>
            <th>Dokter</th>
            <th>Tanggal Pemesanan</th>
            <th>Tanggal Diperlukan</th>
            <th>Status</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->kode_pemesanan }}</td>
            <td>{{ $item->tipe }}</td>
            <td>{{ $item->nama_rs }}</td>
            <td>{{ $item->kode_rs }}</td>
            <td>{{ $item->dokter }}</td>
            <td>{{ $item->tgl_pemesanan }}</td>
            <td>{{ $item->tgl_diperlukan }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
