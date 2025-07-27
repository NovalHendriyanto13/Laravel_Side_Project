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
        <form class="form-order-update" action="{{ route('api.admin.order.update', ['id' => $id])}}" method="POST" data-id="{{$id}}
        ">
            @csrf
            <ul class="nav nav-tabs" id="order-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-tab" data-toggle="tab" data-target="#main" type="button" role="tab" aria-controls="main" aria-selected="true">Info Pemesanan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fulfill-tab" data-toggle="tab" data-target="#fulfill" type="button" role="tab" aria-controls="fulfill" aria-selected="false">Proses Pemesanan</button>
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
                                                <label for="tipe">Tipe</label>
                                                <select id="tipe" name="tipe" class="form-control">
                                                    <option value="bdrs">BDRS</option>
                                                    <option value="non_bdrs">NON BDRS</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_pemesanan">Tanggal Pemesanan</label>
                                                <input type="text" name="tgl_pemesanan" id="tgl_pemesanan" class="form-control" required=""
                                                    value="{{ date('d / m / Y') }}" readonly
                                                >
                                            </div>

                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="dokter">Dokter yang meminta</label>
                                                <input type="text" name="dokter" id="dokter" class="form-control" required="">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_diperlukan">Tanggal Diperlukan</label>
                                                <input type="date" name="tgl_diperlukan" id="tgl_diperlukan" class="form-control" required="">
                                            </div>                                                
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
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
                                                <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required="">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="nama_pasangan">Nama Pasangan</label>
                                                <input type="text" name="nama_pasangan" id="nama_pasangan" class="form-control" disabled>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                                    <option value="laki-laki">Laki-Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="diagnosis">Diagnosis</label>
                                                <input type="text" name="diagnosis" id="diagnosis" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hb">HB</label>
                                                <input type="text" name="hb" id="hb" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="trombosit">Trombosit</label>
                                                <input type="text" name="trombosit" id="trombosit" class="form-control" required>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="status_nikah">Status</label>
                                                <select name="status_nikah" class="form-control" id="status_nikah">
                                                    <option value="lajang">Lajang</option>
                                                    <option value="menikah">Menikah</option>
                                                    <option value="cerai">Cerai</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required="">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required="">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="alasan_transfusi">Alasan Transfusi</label>
                                                <input type="text" name="alasan_transfusi" id="alasan_transfusi" class="form-control" required="">
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="berat_badan">Berat Badan</label>
                                                <input type="number" name="berat_badan" id="berat_badan" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="no_telp">No Telp</label>
                                                <input type="number" name="no_telp" id="no_telp" class="form-control" required>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
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
                                                <select class="form-control" id="transfusi_sebelumnya" name="transfusi_sebelumnya">
                                                    <option value="0">Tidak</option>
                                                    <option value="1">Ya</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_transfusi_sebelumnya">Tanggal Transfusi Sebelumnya</label>
                                                <input type="date" name="tgl_transfusi_sebelumnya" id="tgl_transfusi_sebelumnya" class="form-control" >
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tempat_serologi">Tempat Serologi</label>
                                                <input type="text" name="tempat_serologi" id="tempat_serologi" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="tgl_serologi">Tanggal Serologi</label>
                                                <input type="date" name="tgl_serologi" id="tgl_serologi" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="hasil_serologi">Hasil Serologi</label>
                                                <input type="text" name="hasil_serologi" id="hasil_serologi" class="form-control">
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="gejala_reaksi">Gejala Reaksi</label>
                                                <input type="text" name="gejala_reaksi" id="gejala_reaksi" class="form-control">
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
                                                <input type="text" name="jumlah_kehamilan" id="jumlah_kehamilan" class="form-control" readonly>
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
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 mb-3">                                                
                                            <div class="form-group mb-3">
                                                <label for="item">Item</label>
                                                <select class="form-control" id="item" name="item" data-url="{{ route('api.blood.index') }}"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="jumlah">Jumlah (unit/mL)</label>
                                                <input type="number" name="jumlah" id="jumlah" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 mb-3 mt-3">
                                            <div class="form-group mb-3">
                                                <button type="button" class="btn btn-primary" id="select_item">Pilih</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-item" id="dataTable" width="100%" cellspacing="0"
                                            data-url="{{ route('api.order.index') }}"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Jumlah</th>
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
                <div class="tab-pane fade" id="fulfill" role="tabpanel" aria-labelledby="fulfill-tab">...</div>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{ route('admin.bloodStock.index') }}" class="btn btn-danger btn-icon-split m-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Cancel</span>
                </a>
                <button type="submit"class="btn btn-primary btn-icon-split m-2 btn-submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/order/update.js') }}"></script>
@endpush
