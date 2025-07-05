@extends('guest.layouts.main')

@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/travel/showcase-8.webp);">
    <div class="container position-relative">
        <h1>Tahun Berganti Dedikasi Tak Terhenti</h1>
        <p>Bergabunglah dalam misi kami untuk memberikan bantuan dan harapan yang menyelamatkan jiwa 
            bagi mereka yang membutuhkan</p>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Pendaftaran</li>
            </ol>
        </nav>
    </div>
</div>

    <!-- Travel Tours Section -->
<section id="travel-tours" class="travel-tours section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2>Pendaftaran</h2>
                <p>Silakan melakukan pendaftaran untuk melakukan transaksi</p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <form action="{{ route('api.auth.registerGuest') }}" method="POST" class="form-register">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                
                                <div class="form-group mb-3">
                                    <label for="nama_rs">Nama Rumah Sakit</label>
                                    <input type="text" name="nama_rs" id="nama_rs" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kota">Kota</label>
                                    <input type="text" name="kota" id="kota" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required="">
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                
                                <div class="form-group mb-3">
                                    <label for="penanggung_jawab_rs">Penanggung Jawab Rumah Sakit</label>
                                    <input type="text" name="penanggung_jawab_rs" id="penanggung_jawab_rs" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" name="kode_pos" id="kode_pos" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="re_password">Ketik Ulang Password</label>
                                    <input type="password" name="re_password" id="re_password" class="form-control" required="">
                                </div>
                                
                                
                            </div>

                            <div class="col-lg-12 col-md-6 mb-3">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat Rumah Sakit</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary m-3 btn-submit">Daftar</button>
                            <a class="btn btn-warning m-3" href="{{ route('home') }}">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection

@push('scripts')
<script src="{{ asset('js/guest/auth.js') }}"></script>
@endpush