@extends('guest.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page-title dark-background" data-aos="fade">
    <div class="container position-relative">
        <h1>Tahun Berganti Dedikasi Tak Terhenti</h1>
        <p>Bergabunglah dalam misi kami untuk memberikan bantuan dan harapan yang menyelamatkan jiwa 
            bagi mereka yang membutuhkan</p>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Pemesanan</li>
            </ol>
        </nav>
    </div>
</div>

    <!-- Travel Tours Section -->
<section id="travel-tours" class="travel-tours section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2>Pemesanan</h2>
                <p>Daftar pemesanan untuk <span id="hospital-name"></span></p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <div class="table-responsive">
                        <table class="table table-bordered table-order" id="dataTable" width="100%" cellspacing="0"
                            data-url="{{ route('api.blood.index') }}"
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
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/guest/order/index.js') }}"></script>
@endpush