@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Rumah Sakit</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-hospital-update" action="#" method="POST" data-id="{{$id}}
        ">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="kode_rs">Kode Rumah Sakit</label>
                    <input type="text" name="kode_rs" id="kode_rs" class="form-control" required="" disabled>
                </div>
                <div class="col-sm-6">
                    <label for="nama_rs">Nama Rumah Sakit</label>
                    <input type="text" name="nama_rs" id="nama_rs" class="form-control" required="">
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" required="">
                </div>
                <div class="col-sm-6">
                    <label for="no_telp">No Telp</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="penanggung_jawab_rs">Penanggung Jawab Rs</label>
                    <input type="text" name="penanggung_jawab_rs" id="penanggung_jawab_rs" class="form-control" required="">
                </div>
                <div class="col-sm-6">
                    <label for="kota">Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="kode_pos">Kode Pos</label>
                    <input type="text" name="kode_pos" id="kode_pos" class="form-control" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
                </div>
            </div>
            
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.hospital.index') }}" class="btn btn-danger btn-icon-split m-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pages/hospital/update.js') }}"></script>
@endpush
