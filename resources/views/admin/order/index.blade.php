@extends('admin.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Pemesanan</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-order" id="dataTable" width="100%" cellspacing="0"
                data-url="{{ route('api.admin.order.index') }}"
            >
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tipe</th>
                        <th>Dokter</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Tanggal Di perlukan</th>
                        <th>Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>No Telp</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode</th>
                        <th>Tipe</th>
                        <th>Dokter</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Tanggal Di perlukan</th>
                        <th>Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>No Telp</th>
                        <th>Diagnosis</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/order/index.js') }}"></script> 
@endpush