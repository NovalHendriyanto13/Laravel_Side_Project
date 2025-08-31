<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-size: 18px;
        }
        .table-order {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-start mb-2">
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%">
            <tr>
                <td>
                    <div style="width:48px;height:48px;border:1px solid #ccc; background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Logo_of_Indonesian_Red_Cross.svg/512px-Logo_of_Indonesian_Red_Cross.svg.png'); background-size: 'cover';">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Logo_of_Indonesian_Red_Cross.svg/512px-Logo_of_Indonesian_Red_Cross.svg.png" style="width:48px;height:48px;" />
                    </div>
                </td>
                <td>
                    <div>
                        <div class="fw-bold">Unit Pengelola Darah (UPD) Kota Tangerang</div>
                        <div class="xs">Jl. Jend. Ahmad Yani No.15, RT.005/RW.001, Sukaasih Kec. Tangerang, Kota Tangerang, Banten 15111 • Telp. 3906646 Fax 3101107</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <h1>Laporan Pemesanan</h1>
    <p>Tanggal: {{ $dates['start_date'] }} - {{ $dates['end_date'] }}</p>
    <table border="1" cellspacing="0" cellpadding="4" style="width:100%" class="table-order">
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
            <td>{{ date('d F Y', strtotime($item->tgl_pemesanan)) }}</td>
            <td>{{ date('d F Y', strtotime($item->tgl_diperlukan)) }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </table>

    <div style="margin-top: 10px">
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%">
            <tr>
                <td width="50%">&nbsp;</td>
                <td width="5%">&nbsp;</td>
                <td>Tangerang, {{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td><div style="height: 50px">&nbsp;</div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Petugas UPD Kota Tangerang</td>
            </tr>
        </table>
    </div>
</body>
</html>
