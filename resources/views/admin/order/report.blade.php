@extends('admin.layouts.main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Transaksi Donor Darah</h6>
        </div>
    </div>
    <div class="card-body">
        <form class="form-order-report" action="{{ route('api.admin.order.report') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Tanggal Pemesanan dari</label>
                    <input type="text" class="form-control datepicker" id="order_start_date"
                        placeholder="Tanggal Pemesanan dari" name="order_start_date">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Tanggal Pemesanan sampai</label>
                    <input type="text" class="form-control datepicker" id="order_end_date"
                        placeholder="Tanggal Pemesanan sampai" name="order_end_date">
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
                    <span class="text">Submit</span>
                </button>
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/pages/order/report.js') }}"></script>
@endpush
