@extends('admin.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Darah</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-blood" id="dataTable" width="100%" cellspacing="0"
                data-url="{{ route('api.admin.blood.index') }}"
            >
                <thead>
                    <tr>
                        <th>Kode Darah</th>
                        <th>Nama</th>
                        <th>Jenis Darah</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Darah</th>
                        <th>Nama</th>
                        <th>Jenis Darah</th>
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
<script src="{{ asset('js/pages/blood/index.js') }}"></script> 
@endpush