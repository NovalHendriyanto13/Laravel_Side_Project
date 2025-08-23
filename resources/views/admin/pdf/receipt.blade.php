<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Bukti Penerimaan Permintaan Darah</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
    }
    .container {
      width: 700px;
      margin: auto;
      border: 1px solid #000;
      padding: 20px;
    }
    h2 {
      text-align: center;
      text-decoration: underline;
      margin: 5px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      padding: 4px;
      vertical-align: top;
    }
    .signature {
      margin-top: 40px;
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <p style="text-align:center; margin:0;">
      <b>UDD PMI Kota Tangerang</b><br>
      Jl. Kramat Raya 47, Jakarta 10450 • Telp. 3906646 Fax 3101107
    </p>
    <h2>BUKTI PENERIMAAN PERMINTAAN DARAH</h2>

    <table>
      <tr>
        <td width="150">No. Reg</td>
        <td>: {{ $data->kode_pemesanan }}</td>
      </tr>
      <tr>
        <td>No. RM</td>
        <td>: {{ $dataReceipt->kode_penerimaan }}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>: {{ $data->dokter }}</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>: {{ $data->alamat_rs }}</td>
      </tr>
      <tr>
        <td>RS</td>
        <td>: {{ $data->nama_rs }}</td>
      </tr>
      <tr>
        <td>Sifat Permintaan</td>
        <td>: Biasa</td>
      </tr>
    </table>

    <br>

    <table border="1" cellpadding="4">
      <tr>
        <td width="300">Komponen Darah</td>
        <td width="100">Jumlah</td>
      </tr>
      @php $total = 0; @endphp
      @foreach($groupBloodPack as $item)
      
      <tr>
        <td>
            <div><b>{{ $item->name }}</b></div>
            <div>{{ $item->blood_group }} {{ $item->blood_rhesus }} {{ $item->unit_volume }} mL</div>
        </td>
        <td>{{ $count[$item->blood_id]}} Kantong</td>
      </tr>

      @php $total = $total + $count[$item->blood_id]; @endphp
      @endforeach
    </table>

    <p>Jumlah: Agt : {{ $total }} Kantong</p>

    <p>Sampel diterima pukul {{ $dataReceipt->jam_terima_sampel }} <br>
    {{ date('d F Y', strtotime($dataReceipt->tgl_terima_sampel)) }}<br>
    Petugas UDD</p>

    <div class="signature">
      <p>(ttd)</p>
      <p>{{ $dataReceipt->penerima }}</p>
    </div>
  </div>
</body>
</html>
