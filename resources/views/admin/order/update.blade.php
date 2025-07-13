@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Update Stock Darah</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-blood-stock-update" action="{{ route('api.bloodStock.update', ['id' => $id])}}" method="POST" data-id="{{$id}}
        ">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">No Stock</label>
                    <input type="text" class="form-control" id="stock_no"
                        placeholder="No Stock" name="stock_no" readonly>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Tanggal Kadaluarsa</label>
                    <input type="text" class="form-control datepicker" id="expiry_date"
                        placeholder="Tanggal kadaluarsa" name="expiry_date">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Jenis Darah</label>
                    <select class="form-control" id="blood_id"
                        placeholder="Jenis Darah" name="blood_id">
                        <option value="">Pilih</option>
                        @foreach($bloods as $key => $blood)
                            <option value="{{ $key }}">{{ $blood }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Jumlah (ml)</label>
                    <input type="number" class="form-control" id="unit_volume"
                        placeholder="Jumlah (ml)" name="unit_volume">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Golongan Darah</label>
                    <select class="form-control" id="blood_group"
                        placeholder="Golongan Darah" name="blood_group">
                        <option value="">Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Rhesus Darah</label>
                    <select class="form-control" id="blood_rhesus"
                        placeholder="Rhesus Darah" name="blood_rhesus">
                        <option value="">Pilih</option>
                        <option value="positif">+ (Positif)</option>
                        <option value="negatif">- (Negatif)</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="status"
                        placeholder="Status" name="status">
                        <option value="1">Tersedia</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    &nbsp;
                </div>
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
<script src="{{ asset('js/pages/blood_stock/update.js') }}"></script>
@endpush
