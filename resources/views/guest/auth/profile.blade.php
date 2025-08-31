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
                <li class="current">Profil</li>
            </ol>
        </nav>
    </div>
</div>

    <!-- Travel Tours Section -->
<section id="travel-tours" class="travel-tours section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2>Profil User</h2>
                <p>Detail dan Update Profile User</p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <form action="{{ route('api.hospitals.profile') }}" method="POST" class="form-hospital-update">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                
                                <div class="form-group mb-3">
                                    <label for="tipe">Kode RS</label>
                                    <input type="text" id="kode_rs" name="kode_rs" class="form-control" disabled />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" required=""/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kota">Kota</label>
                                    <input type="text" name="kota" id="kota" class="form-control" required=""/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="penanggung_jawab_rs">Penanggung Jawab RS</label>
                                    <input type="text" name="penanggung_jawab_rs" id="penanggung_jawab_rs" class="form-control" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-group mb-3">
                                    <label for="nama_rs">Nama RS</label>
                                    <input type="text" name="nama_rs" id="nama_rs" class="form-control" required=""/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control" required="">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" name="kode_pos" id="kode_pos" class="form-control" required="">
                                </div>                                                
                            </div>

                            <div class="col-lg-12 col-md-6 mb-3">
                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat Rumah Sakit</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
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
<script src="{{ asset('js/guest/auth/profile.js') }}"></script>
@endpush