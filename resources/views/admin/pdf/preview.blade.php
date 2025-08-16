<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Permintaan & Pemberian Darah</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{ --border:#212529; --muted:#f8f9fa; }
    body { font-size: 12px; }
    .a4 { width: 210mm; min-height: 297mm; margin: 0 auto; background: #fff; padding: 12mm; }
    .b { border:1px solid var(--border); }
    .bh { border-top:1px solid var(--border); border-bottom:1px solid var(--border); }
    .label { font-weight: 600; }
    .cb { display:inline-block; width:14px; height:14px; border:1px solid var(--border); margin-right:6px; vertical-align:-2px; }
    .small { font-size: 11px; }
    .xs { font-size: 10px; }
    .muted { background: var(--muted); }
    .sign { height: 42px; border: 1px solid var(--border); }
    .stamp { height: 56px; border: 1px dashed #888; }
    .grid-2 { display:grid; grid-template-columns: 1fr 1fr; gap:8px; }
    .grid-3 { display:grid; grid-template-columns: 1fr 1fr 1fr; gap:8px; }
    .grid-4 { display:grid; grid-template-columns: repeat(4, 1fr); gap:8px; }
    .table-tight td, .table-tight th { padding:.35rem .4rem; }
    @media print {
      .a4 { padding: 8mm; box-shadow:none; }
      .no-print { display:none !important; }
    }
  </style>
</head>
<body class="bg-light">

<div class="a4 shadow-sm">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-start mb-2">
    <div class="d-flex align-items-center gap-2">
      <!-- Ganti src logo PMI kalau ada -->
      <div style="width:48px;height:48px;border:1px solid #ccc; background: url('../../../images/donor_bg.jpg');"></div>
      <div>
        <div class="fw-bold">UNIT DONOR DARAH – DKI JAKARTA</div>
        <div class="xs">Jl. Kramat Raya 47, Jakarta 10450 • Telp. 3906646 Fax 3101107</div>
      </div>
    </div>
    <div class="text-end">
      <div class="xs">NO.</div>
      <div class="b px-2 py-1" style="min-width:140px">{{ $data->kode_pemesanan }}</div>
    </div>
  </div>

  <!-- PETUNJUK (ringkas) -->
  <div class="xs text-muted mb-2">
    <span class="me-2">• Isi lengkap & jelas. • Cantumkan diagnosa & jenis darah diminta. • Biasa / Cito harus ditandai.</span>
  </div>

  <!-- BAGIAN RS & PERMINTAAN -->
  <div class="b p-2 mb-2">
    <div class="grid-4">
      <div><span class="label">Rumah Sakit</span>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="Nama RS / Bagian" value="{{ $data->nama_rs }}" readonly>   
      </div>
      <div><span class="label">Dokter yang meminta</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->dokter }}" readonly>
      </div>
      <div><span class="label">Tgl Permintaan</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tgl_pemesanan }}" readonly>
      </div>
      <div><span class="label">Diperlukan</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tgl_diperlukan }}" readonly>
      </div>
    </div>
    <div class="mt-2 grid-3">
      <div><span class="label">Alamat RS</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->alamat }}" readonly>
      </div>
      <div><span class="label">Diagnosa Klinis</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->diagnosis }}" readonly>
      </div>
      <div><span class="label">Alasan Transfusi</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->alasan_transfusi }}" readonly>
      </div>
    </div>
    <div class="mt-2 grid-3">
      <div><span class="label">HB</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->hb }}" readonly>
      </div>
      <div><span class="label">Trombosit</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->trombosit }}" readonly>
      </div>
      <div><span class="label">Berat Badan (Kg)</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->berat_badan }}" readonly>
      </div>
    </div>
  </div>

  <!-- DATA PASIEN -->
  <div class="b p-2 mb-2">
    <div class="grid-4">
      <div><span class="label">Nama Pasien</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->nama_pasien }}" readonly>
      </div>
      <div><span class="label">Jenis Kelamin</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->jenis_kelamin }}" readonly>
      </div>
      <div><span class="label">Tempat Lahir</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tempat_lahir }}" readonly>
      </div>
      <div><span class="label">Tanggal Lahir</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tanggal_lahir }}" readonly>
      </div>
    </div>

    <div class="grid-4">
      <div><span class="label">Alamat</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->alamat }}" readonly>
      </div>
      <div><span class="label">No Telp</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->no_telp }}" readonly>
      </div>
      <div><span class="label">Status Nikah</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->status_nikah }}" readonly>
      </div>
      <div><span class="label">Nama Pasangan</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->nama_pasangan }}" readonly>
      </div>
    </div>
    
  </div>

  <div class="b p-2 mb-2">
    <div class="grid-3">
      <div><span class="label">Transfusi Sebelumnya</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->transfusi_sebelumnya }}" readonly>
      </div>
      <div><span class="label">Tanggal Transfusi Sebelumnya</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tgl_transfusi_sebelumnya }}" readonly>
      </div>
      <div><span class="label">Gejala reaksi</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->gejala_reaksi }}" readonly>
      </div>
    </div>

    <div class="grid-3">
        <div><span class="label">Tempat Serologi</span>
            <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tempat_serologi }}" readonly>
        </div>
        <div><span class="label">Tanggal Serologi</span>
            <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->tgl_serologi }}" readonly>
        </div>
        <div><span class="label">Hasil Serologi</span>
            <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->hasil_serologi }}" readonly>
        </div>
    </div>

    <div class="grid-3">
      <div><span class="label">Sedang Hamil</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->hamil }}" readonly>
      </div>
      <div><span class="label">Jumlah Kehamilan</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->jumlah_kehamilan }}" readonly>
      </div>
      <div><span class="label">Pernah Aborsi</span>
        <input class="form-control form-control-sm mt-1" type="text" value="{{ $data->pernah_aborsi }}" readonly>
      </div>
    </div>
    
  </div>

  <!-- JENIS KOMPONEN DARAH -->
  <div class="b p-2 mb-2">
    <div class="label mb-1">Darah Diminta</div>
    <div class="row g-2">
      <div class="col-6 col-md-4">
        <label class="form-check-label"><span class="cb"></span> WB Segar / Biasa</label>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="Jumlah kantong / catatan">
      </div>
      <div class="col-6 col-md-4">
        <label class="form-check-label"><span class="cb"></span> PRC (Packed Cells)</label>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="Jumlah / catatan">
      </div>
      <div class="col-6 col-md-4">
        <label class="form-check-label"><span class="cb"></span> Trombocyte Concentrate</label>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="TC Biasa / Apheresis">
      </div>
      <div class="col-6 col-md-4">
        <label class="form-check-label"><span class="cb"></span> Plasma Segar Beku (FFP)</label>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="Jumlah / catatan">
      </div>
      <div class="col-6 col-md-4">
        <label class="form-check-label"><span class="cb"></span> Lainnya</label>
        <input class="form-control form-control-sm mt-1" type="text" placeholder="Sebutkan">
      </div>
    </div>
  </div>

  <!-- PENERIMAAN SAMPEL -->
  <div class="b p-2 mb-2">
    <div class="label mb-1">Penerimaan Sampel (oleh BDRS/UDD)</div>
    <div class="grid-4">
      <div><span class="xs">Nama</span><input class="form-control form-control-sm mt-1" type="text"></div>
      <div><span class="xs">Tanggal</span><input class="form-control form-control-sm mt-1" type="text"></div>
      <div><span class="xs">Jam</span><input class="form-control form-control-sm mt-1" type="time"></div>
      <div><span class="xs">Petugas</span><input class="form-control form-control-sm mt-1" type="text"></div>
    </div>
  </div>

  <!-- PEMERIKSAAN & PEMBERIAN DARAH -->
  <div class="b p-2 mb-2">
    <div class="d-flex justify-content-between">
      <div class="label">Pemeriksaan & Pemberian Darah (oleh BDRS/UDD)</div>
      <div class="xs">Hasil: Cocok / Tidak Cocok / Emergency</div>
    </div>

    <table class="table table-tight table-bordered align-middle mt-2">
      <thead class="table-light">
      <tr class="text-center">
        <th style="width:36px">No</th>
        <th>Nomor Stock</th>
        <th style="width:80px">Gol</th>
        <th style="width:140px">Tgl Kadaluwarsa</th>
        <th style="width:80px">Vol (mL)</th>
        <th style="width:120px">Petugas</th>
        <th>Nama yang Mengambil</th>
        <th style="width:160px">Tanda Tangan Keluarga</th>
      </tr>
      </thead>
      <tbody>
      <!-- Ubah jumlah baris sesuai kebutuhan -->
      <tr>
        <td class="text-center">1</td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="text" placeholder="A+/A-"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="number"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><div class="sign"></div></td>
      </tr>
      <tr>
        <td class="text-center">2</td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="number"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><input class="form-control form-control-sm" type="text"></td>
        <td><div class="sign"></div></td>
      </tr>
      </tbody>
    </table>
  </div>

  <!-- TANDA TANGAN / STEMPEL -->
  <div class="row g-2">
    <div class="col-4">
      <div class="b p-2 h-100">
        <div class="label mb-2">Stempel & Paraf UDD</div>
        <div class="stamp"></div>
      </div>
    </div>
    <div class="col-4">
      <div class="b p-2 h-100">
        <div class="label mb-2">Dokter / Petugas</div>
        <div class="sign"></div>
      </div>
    </div>
    <div class="col-4">
      <div class="b p-2 h-100">
        <div class="label mb-2">Keluarga Pasien</div>
        <div class="sign"></div>
      </div>
    </div>
  </div>

  <!-- CATATAN -->
  <div class="mt-2 xs text-muted">
    <strong>Keterangan:</strong> Template ini merupakan versi HTML dari formulir pada gambar. Silakan sesuaikan label, teks statis, dan logic (Biasa/Cito, Coombs, dsb.) sesuai kebutuhan.
  </div>

  <div class="no-print mt-3 d-flex gap-2">
    <button class="btn btn-sm btn-primary" onclick="window.print()">Cetak</button>
  </div>

</div>

</body>
</html>
