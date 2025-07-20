@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Darah</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-blood-create" action="{{ route('api.admin.blood.create') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name"
                        placeholder="Nama" name="name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Kategory</label>
                    <select class="form-control" id="blood_type_alias"
                        placeholder="Kategori" name="blood_type_alias">
                        <option value="">Pilih</option>
                        <option value="Whole Blood">Darah Lengkap</option>
                        <option value="Packed Red Cell">Darah Merah Pekat</option>
                        <option value="WE">Washed Erytrocyte</option>
                        <option value="TC">Thrombocyte Concentrate</option>
                        <option value="Plasma">Plasma</option>
                    </select>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.blood.index') }}" class="btn btn-danger btn-icon-split m-2">
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
<script src="{{ asset('js/pages/blood/create.js') }}"></script>
@endpush
