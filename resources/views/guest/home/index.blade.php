@extends('guest.layouts.main')

@section('content')
 <section id="travel-hero" class="travel-hero section dark-background">

    <div class="hero-background"></div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="@guest col-lg-7 @endguest @auth col-lg-12 @endauth">
                <!-- <div class="hero-text" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="hero-title">Tahun Berganti Dedikasi Tak Terhenti</h1>
                    <p class="hero-subtitle">Bergabunglah dalam misi kami untuk memberikan bantuan dan harapan yang menyelamatkan jiwa 
                        bagi mereka yang membutuhkan
                    </p>
                    <div class="hero-buttons">
                    <a href="#" class="btn btn-primary me-3">Donasi</a>
                    </div>
                </div> -->
                <img src="{{ asset('images/about_1.jpeg') }}" alt="" class="img-fluid rounded-4">
            </div>

            @guest
            <div class="col-lg-5">
                <div class="booking-form-wrapper" data-aos="fade-left" data-aos-delay="200">
                    <div class="booking-form">
                        <h3 class="form-title">Masuk</h3>
                        <form action="{{ route('api.auth.loginGuest') }}" method="POST" class="form-login">
                            <div class="form-group mb-3">
                                <label for="email">Username</label>
                                <input type="text" name="email" id="email" class="form-control" required="">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required="">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            @endguest
        </div>
    </div>

</section>

@endsection

@push('scripts')
<script src="{{ asset('js/guest/auth.js') }}"></script>
@endpush
