<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitansi</title>
    <style>
        body {
            font-size: 18px;
        }
        th {
            height: 100px;
            text-align: left;
            padding: 5px;
        }
        .main {
            border: 1px solid #000;   /* garis hitam */
            padding: 10px;            /* jarak isi dengan border */
            margin: 10px;             /* jarak div dengan luar */
            border-radius: 6px;  
        }
        .main-table {
            background: url("{{asset('images/lunas.png')}}") no-repeat center center;
            background-size: 500px;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-start mb-2">
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%">
            <tr>
                <td>
                    <div style="width:48px;height:48px;border:1px solid #ccc; background-image: url('{{asset('images/donor_bg.jpg')}}'); background-size: cover;"></div>
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
    <hr />

    <div style="text-align: center"><h1>Kwitansi</h1></div>
    <div style="text-align: right; margin: 10px"><h3>No. {{ $data->kode_pemesanan }}</h3></div>
    <div class="main">
        
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%;" class="main-table">
            <tr>
                <th rowspan="5" style="border-right: 2px solid #000; width: 20%; 
                    writing-mode: vertical-rl; 
                    text-orientation: mixed; 
                    text-align: center;
                    font-size: 80px;
                    color: red">
                </th>
            </tr>
            <tr>
                <th style="width: 25%">Sudah Terima dari</th>
                <th style="width: 5%">&nbsp;</th>
                <td><div><b>{{ $data->nama_rs }}</b></div><div>{{ $data->alamat_rs }}</div></td>
            </tr>
            <tr>
                <th style="width: 25%">Uang Sejumlah</th>
                <th style="width: 5%">&nbsp;</th>
                <td>{{ ucfirst($data->amount_text) }} Rupiah</td>
            </tr>
            <tr>
                <th style="width: 25%">Untuk Pembayaran</th>
                <th style="width: 5%">&nbsp;</th>
                <td>Pembelian paket donor darah {{ str_replace('_', ' ', strtoupper($data->tipe)) }} </td>
            </tr>
            <tr>
                <th style="width: 25%">Status</th>
                <th style="width: 5%">&nbsp;</th>
                <td>LUNAS</td>
            </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="4" style="width:100%;">
            <tr>
                <td><div style="text-align: left; margin: 10px"><h3>Rp. {{ number_format($data->total_harga, 2, ",", ".") }}</h3></div></td>
                <td><div style="text-align: right; margin: 10px"><h3>Tangerang, {{ date('d F Y', strtotime($data->updated_at)) }}</h3></div></td>
            </tr>
        </table>
    </div>
</body>
</html>
