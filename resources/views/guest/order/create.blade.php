@extends('guest.layouts.main')

@push('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('images/about_2.jpeg') }});">
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
                <p>Buat baru pemesanan untuk <span id="hospital-name"></span></p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <form action="{{ route('api.order.create') }}" method="POST" class="form-order-create">
                        @csrf
                        <div class="accordion" id="accordion-create">
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
                                                    <select id="tipe" name="tipe" class="form-control" disabled>
                                                        <option value="bdrs">BDRS</option>
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
                                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                        <b>Informasi Pemesanan</b>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 mb-3">                                                
                                                <div class="form-group mb-3">
                                                    <label for="item">Item</label>
                                                    <select class="form-control" id="item" name="item" data-url="{{ route('api.blood.index') }}">
                                                        <option value="">Pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 mb-3">
                                                <div class="form-group mb-3">
                                                    <label for="golongan">Gologan</label>
                                                    <select name="golongan" id="golongan" class="form-control">
                                                        <option value=""></option>
                                                        <option value="a_positif">A+</option>
                                                        <option value="a_negatif">A-</option>
                                                        <option value="b_positif">B+</option>
                                                        <option value="b_negatif">B-</option>
                                                        <option value="ab_positif">AB+</option>
                                                        <option value="ab_negatif">AB-</option>
                                                        <option value="o_positif">O+</option>
                                                        <option value="o_negatif">O-</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 mb-3">
                                                <div class="form-group mb-3">
                                                    <label for="jumlah">Jumlah (unit/mL)</label>
                                                    <select name="jumlah_ml" id="jumlah_ml" class="form-control" data-url="{{ route('api.bloodStock.ml') }}"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 mb-3">
                                                <div class="form-group mb-3">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="number" name="jumlah" id="jumlah" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 mb-3">
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
                                                        <th>Golongan</th>
                                                        <th>Jumlah (ml)</th>
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

                        <div class="d-flex text-center">
                            <button type="submit"class="btn btn-primary w-50 btn-submit mt-5 ml-2">
                                <span class="text">Submit</span>
                            </button>
                            <a type="button"class="btn btn-danger w-50 mt-5 mr-2 a-auth" href="{{ route('order.index') }}">
                                <span class="text"><b>Cancel</b></span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/guest/order/create.js') }}"></script>
@endpush