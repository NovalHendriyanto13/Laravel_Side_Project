@extends('admin.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
            <a href="{{ route('bloodStock.create') }}" class="btn btn-primary btn-icon-split ml-3">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">New</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stock" id="dataTable" width="100%" cellspacing="0"
                data-url="{{ route('api.bloodStock.index') }}"
            >
                <thead>
                    <tr>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Nomor Stock</th>
                        <th>Jenis Darah</th>
                        <th>Golongan Darah</th>
                        <th>Volume</th>
                        <th>Status</th>
                        <th> </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Nomor Stock</th>
                        <th>Jenis Darah</th>
                        <th>Golongan Darah</th>
                        <th>Volume</th>
                        <th>Status</th>
                        <th> </th>
                    </tr>
                </tfoot>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/blood_stock/index.js') }}"></script> 
@endpush