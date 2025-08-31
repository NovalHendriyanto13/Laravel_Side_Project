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
                <h2>Ganti Password</h2>
                <p>Ganti Passrword User</p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <div class="tour-filters">
                    <form action="{{ route('api.auth.changePassword') }}" method="POST" class="form-auth-password">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3">
                                
                                <div class="form-group mb-3">
                                    <label for="tipe">Password Lama</label>
                                    <input type="password" id="old_password" name="old_password" class="form-control" required />
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="tipe">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="re_password">Ketik Password Kembali</label>
                                    <input type="password" name="re_password" id="re_password" class="form-control" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex text-center">
                            <button type="submit"class="btn btn-primary w-50 btn-submit mt-5 ml-2">
                                <span class="text">Submit</span>
                            </button>
                            <a type="button"class="btn btn-danger w-50 mt-5 mr-2 a-auth" href="{{ route('home') }}">
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
<script src="{{ asset('js/guest/auth/password.js') }}"></script>
@endpush