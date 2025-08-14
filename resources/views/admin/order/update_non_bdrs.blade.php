@extends('admin.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pemesanan</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-order-update" action="{{ route('api.admin.receipt.create')}}" method="POST" data-id="{{$id}}">
            @csrf
            <ul class="nav nav-tabs" id="order-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-tab" data-toggle="tab" data-target="#main" type="button" role="tab" aria-controls="main" aria-selected="true">Info Pemesanan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fulfill-tab" data-toggle="tab" data-target="#fulfill" type="button" role="tab" aria-controls="fulfill" aria-selected="false">Proses Penerimaan</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <div class="accordion" id="accordion-update">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <b>Informasi Utama</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="kode_pemesanan">Kode Pemesanan</label>
                                                <input type="text" name="kode_pemesanan" id="kode_pemesanan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tipe">Tipe</label>
                                                <select id="tipe" name="tipe" class="form-control" disabled>
                                                    <option value="bdrs">BDRS</option>
                                                    <option value="non_bdrs">NON BDRS</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_pemesanan">Tanggal Pemesanan</label>
                                                <input type="text" name="tgl_pemesanan" id="tgl_pemesanan" class="form-control" 
                                                    value="{{ date('d / m / Y') }}" disabled
                                                >
                                            </div>
                                    
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="dokter">Dokter yang meminta</label>
                                                <input type="text" name="dokter" id="dokter" class="form-control"  disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_diperlukan">Tanggal Diperlukan</label>
                                                <input type="date" name="tgl_diperlukan" id="tgl_diperlukan" class="form-control"  disabled>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <input type="text" name="status" id="status" class="form-control"  disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item patient-info">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    <b>Informasi Pasien</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            
                                            <div class="form-group mb-3">
                                                <label for="nama_pasien">Nama Pasien</label>
                                                <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="nama_pasangan">Nama Pasangan</label>
                                                <input type="text" name="nama_pasangan" id="nama_pasangan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" disabled>
                                                    <option value="laki-laki">Laki-Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="diagnosis">Diagnosis</label>
                                                <input type="text" name="diagnosis" id="diagnosis" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hb">HB</label>
                                                <input type="text" name="hb" id="hb" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="trombosit">Trombosit</label>
                                                <input type="text" name="trombosit" id="trombosit" class="form-control" disabled >
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="status_nikah">Status</label>
                                                <select name="status_nikah" class="form-control" disabled id="status_nikah">
                                                    <option value="lajang">Lajang</option>
                                                    <option value="menikah">Menikah</option>
                                                    <option value="cerai">Cerai</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="alasan_transfusi">Alasan Transfusi</label>
                                                <input type="text" name="alasan_transfusi" id="alasan_transfusi" class="form-control" disabled >
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="berat_badan">Berat Badan</label>
                                                <input type="number" name="berat_badan" id="berat_badan" class="form-control" disabled >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="no_telp">No Telp</label>
                                                <input type="number" name="no_telp" id="no_telp" class="form-control" disabled >
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control" disabled ></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item additional-info">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    <b>Informasi Tambahan</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            
                                            <div class="form-group mb-3">
                                                <label for="transfusi_sebelumnya">Transfusi Sebelumnya</label>
                                                <select class="form-control" id="transfusi_sebelumnya" name="transfusi_sebelumnya" disabled>
                                                    <option value="0">Tidak</option>
                                                    <option value="1">Ya</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_transfusi_sebelumnya">Tanggal Transfusi Sebelumnya</label>
                                                <input type="date" name="tgl_transfusi_sebelumnya" id="tgl_transfusi_sebelumnya" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tempat_serologi">Tempat Serologi</label>
                                                <input type="text" name="tempat_serologi" id="tempat_serologi" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_serologi">Tanggal Serologi</label>
                                                <input type="date" name="tgl_serologi" id="tgl_serologi" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hasil_serologi">Hasil Serologi</label>
                                                <input type="text" name="hasil_serologi" id="hasil_serologi" class="form-control" disabled>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="gejala_reaksi">Gejala Reaksi</label>
                                                <input type="text" name="gejala_reaksi" id="gejala_reaksi" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tempat_serologi">Pernah Hamil</label>
                                                <select class="form-control" id="hamil" name="hamil" disabled>
                                                    <option value="0">Tidak</option>
                                                    <option value="1">Ya</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="jumlah_kehamilan">Jumlah Kehamilan</label>
                                                <input type="text" name="jumlah_kehamilan" id="jumlah_kehamilan" class="form-control" disabled>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="tempat_serologi">Pernah Aborsi</label>
                                                <select class="form-control" id="pernah_aborsi" name="pernah_aborsi" disabled>
                                                    <option value="0">Tidak</option>
                                                    <option value="1">Ya</option>
                                                </select>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    <b>Informasi Pemesanan</b>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-item" id="dataTable" width="100%" cellspacing="0"
                                            data-url="{{ route('api.order.index') }}"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Jumlah (ml)</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="fulfill" role="tabpanel" aria-labelledby="fulfill-tab">
                    <div class="accordion" id="accordion-update">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#penerimaan-collapseOne" aria-expanded="true" aria-controls="penerimaan-collapseOne">
                                    <b>Informasi Penerimaan</b>
                                </button>
                            </h2>
                            <div id="penerimaan-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="kode_penerimaan">Kode Penerimaan</label>
                                                <input type="text" name="kode_penerimaan" id="kode_penerimaan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_ambil_sampel">Waktu Pengambilan Sampel</label>
                                                <input type="text" name="tgl_ambil_sampel" id="tgl_ambil_sampel" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_terima_sampel">Waktu Penerimaan Sampel</label>
                                                <input type="text" name="tgl_terima_sampel" id="tgl_terima_sampel" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_periksa_sampel">Waktu Pemeriksaan Sampel</label>
                                                <input type="text" name="tgl_periksa_sampel" id="tgl_periksa_sampel" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hasil_pemeriksaan">Hasil Pemeriksaan Sampel</label>
                                                <select name="hasil_pemeriksaan" id="hasil_pemeriksaan" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="0">Tidak cocok</option>
                                                    <option value="1">Cocok</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hasil_golongan_sampel">Hasil Golongan Sampel</label>
                                                <select name="hasil_golongan_sampel" id="hasil_golongan_sampel" class="form-control" >
                                                    <option value="">Pilih</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                    <option value="O">O</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="tgl_penerimaan">Tanggal Proses</label>
                                                <input type="text" name="tgl_penerimaan" id="tgl_penerimaan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="ambil_sampel_oleh">Pengambilan Sampel Oleh</label>
                                                <input type="text" name="ambil_sampel_oleh" id="ambil_sampel_oleh" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="terima_sampel_oleh">Penerimaan Sampel Oleh</label>
                                                <input type="text" name="terima_sampel_oleh" id="terima_sampel_oleh" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="periksa_sampel_oleh">Pemeriksaan Sampel Oleh</label>
                                                <input type="text" name="periksa_sampel_oleh" id="periksa_sampel_oleh" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hasil_rhesus_sampel">Hasil Rhesus Sampel</label>
                                                <select name="hasil_rhesus_sampel" id="hasil_rhesus_sampel" class="form-control" >
                                                    <option value="">Pilih</option>
                                                        <option value="positif">+ (Positif)</option>
                                                        <option value="negatif">- (Negatif)</option>
                                                    </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#penerimaan-collapseTwo" aria-expanded="false" aria-controls="penerimaan-collapseTwo">
                                    <b>Penerimaan Item</b>
                                </button>
                            </h2>
                            <div id="penerimaan-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-receive-item" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Jumlah(ml)</th>
                                                    <th>Jumlah Permintaan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('admin.order.index') }}" class="btn btn-danger btn-icon-split m-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Cancel</span>
                </a>
                <button type="submit"class="btn btn-primary btn-icon-split m-2 btn-submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Process</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="fulfillment-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Fulfillment</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-3">
                <div class="form-group mb-3">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" class="form-control" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah">Jumlah Permintaan</label>
                    <input type="text" name="jumlah" id="jumlah" class="form-control" disabled>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-3">
                <div class="form-group mb-3">
                    <label for="jumlah_ml">Jumlah(ml)</label>
                    <input type="text" name="jumlah_ml" id="jumlah_ml" class="form-control" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="jumlah_terpenuhi">Jumlah Terpenuhi (ml)</label>
                    <input type="text" name="jumlah_terpenuhi" id="jumlah_terpenuhi" class="form-control" disabled>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-fulfillment">
                <thead>
                <tr>
                    <td>Stock No</td>
                    <td>Tgl Kadaluarsa</td>
                    <td>Deskripsi</td>
                    <td>Golongan</td>
                    <td>Rhesus</td>
                    <td>Volume</td>
                    <td></td>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="fulfillment-detail-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Fulfillment</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-fulfillment-detail">
                <thead>
                <tr>
                    <td>Stock No</td>
                    <td>Tgl Kadaluarsa</td>
                    <td>Deskripsi</td>
                    <td>Golongan</td>
                    <td>Rhesus</td>
                    <td>Volume</td>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div> 
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/order/update_non_bdrs.js') }}"></script>
@endpush
