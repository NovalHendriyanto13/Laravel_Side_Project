@extends('guest.layouts.main')

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
                <p>Buat baru pemesanan untuk <span id="hospital-name"></span></p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <form action="{{ route('api.order.create') }}" method="POST" class="form-order-create">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Accordion Item #1
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
                                                    <input type="text" name="tgl_pemesanan" id="tgl_pemesanan" class="form-control" required="">
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
                                                    <label for="dokter">Dokter yang meminta</label>
                                                    <input type="text" name="dokter" id="dokter" class="form-control" required="">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tgl_diperlukan">Tanggal Diperlukan</label>
                                                    <input type="text" name="tgl_diperlukan" id="tgl_diperlukan" class="form-control" required="">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="alasan_transfusi">Alasan Transfusi</label>
                                                    <input type="text" name="alasan_transfusi" id="alasan_transfusi" class="form-control" required="">
                                                </div>
                                                
                                                <div class="form-group mb-3">
                                                    <label for="berat_badan">Berat Badan</label>
                                                    <input type="text" name="berat_badan" id="berat_badan" class="form-control" required>
                                                </div>
                                                
                                            </div>

                                            <div class="col-lg-12 col-md-6 mb-3">
                                                <div class="form-group mb-3">
                                                    <label for="alamat">Alamat Rumah Sakit</label>
                                                    <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Accordion Item #2
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection

@push('scripts')
<script src="{{ asset('js/guest/order/create.js') }}"></script>
@endpush