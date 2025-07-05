@extends('guest.layouts.main')

@section('content')
 <section id="travel-hero" class="travel-hero section dark-background">

    <div class="hero-background"></div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
            <div class="hero-text" data-aos="fade-up" data-aos-delay="100">
                <h1 class="hero-title">Tahun Berganti Dedikasi Tak Terhenti</h1>
                <p class="hero-subtitle">Bergabunglah dalam misi kami untuk memberikan bantuan dan harapan yang menyelamatkan jiwa 
                    bagi mereka yang membutuhkan
                </p>
                <div class="hero-buttons">
                <a href="#" class="btn btn-primary me-3">Donasi</a>
                </div>
            </div>
            </div>

            <div class="col-lg-5">
            <div class="booking-form-wrapper" data-aos="fade-left" data-aos-delay="200">
                <div class="booking-form">
                <h3 class="form-title">Masuk</h3>
                <form action="" class="">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required="">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required="">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>

</section>

<!-- Why Us Section -->
<section id="why-us" class="why-us section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- About Us Content -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="content">
                    <h3>Bersama untuk kemanusiaan</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="stats-row">
                        <div class="stat-item">
                            <span data-purecounter-start="0" data-purecounter-end="791" data-purecounter-duration="2" class="purecounter">0</span>
                            <div class="stat-label">Total Pengunjung Hari ini</div>
                        </div>
                        <div class="stat-item">
                            <span data-purecounter-start="0" data-purecounter-end="20747" data-purecounter-duration="2" class="purecounter">0</span>
                            <div class="stat-label">Total Pengunjung Sepanjang Waktu</div>
                        </div>
                        <div class="stat-item">
                            <span data-purecounter-start="0" data-purecounter-end="1784" data-purecounter-duration="2" class="purecounter">0</span>
                            <div class="stat-label">Total Unduhan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="about-image">
                    <img src="{{ asset('images/about_1.jpeg') }}" alt="" class="img-fluid rounded-4">
                </div>
            </div>
        </div><!-- End About Us Content -->

    </div>

</section><!-- /Why Us Section -->

<!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="newsletter-section" data-aos="fade-up" data-aos-delay="300">
            <div class="newsletter-card">
                <div class="newsletter-content">
                    <div class="newsletter-icon">
                        <i class="bi bi-envelope-heart"></i>
                    </div>
                    <div class="newsletter-text">
                        <h3>Stay in the Loop</h3>
                        <p>Get exclusive travel deals and destination guides delivered to your inbox</p>
                    </div>
                </div>

                <form class="php-email-form newsletter-form" action="forms/newsletter.php" method="post">
                    <div class="form-wrapper">
                        <input type="email" name="email" class="email-input" placeholder="Your email address" required="">
                        <button type="submit" class="subscribe-btn">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Welcome aboard! Check your email for exclusive offers.</div>

                    <div class="trust-indicators">
                        <i class="bi bi-lock"></i>
                        <span>We protect your privacy. Unsubscribe anytime.</span>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section><!-- /Call To Action Section -->
@endsection