@extends('guest.layouts.main')
@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('images/about_2.jpeg') }});">
    <div class="container position-relative">
        <h1>Tahun Berganti Dedikasi Tak Terhenti</h1>
        <p>Bergabunglah dalam misi kami untuk memberikan bantuan dan harapan yang menyelamatkan jiwa 
            bagi mereka yang membutuhkan</p>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>

<section id="travel-tours" class="travel-tours section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2>Tentang Kami</h2>
                <p>Kami memberikan yang terbaik bagi Anda</p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <!-- About Us Content -->
                    <div class="row align-items-center mb-5">
                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                            <div class="about-image">
                                <img src="{{ asset('images/about_2.jpeg') }}" alt="" class="img-fluid rounded-4">
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                            <!-- <div class="content">
                                <h3>Palang Merah Indonesia ( PMI )</h3>
                                <p>
                                    unit donor darah PMI adalah fasilitas pelayanan kesehatan yang menyelenggarakan pengerahan dan pelestarian pendonor darah, penyedia darah 
                                    dan pendistribusian darah, untuk selanjutnya disebut Unit Donor Darah PMI atau disingkat UDD PMI yang 
                                    berdasarkan tingkatannya dibagi menjadi UDD Nasional, Propinsi, Kabupaten/Kota dan berdasarkan kemampuannya 
                                    dibagi menjadi UDD Utama, Madya dan Pratama.
                                </p>
                                <p>
                                    Berdasarkan peraturan Organisasi PMI nomor 001/PO/PP.PMI/I/2016 dan Peraturan Menteri Kesehatan No. 83
                                    tahun 2014 maka UDD PMI Kota Tangerang masuk ke dalam UDD Madya.
                                </p>
                            </div> -->
                        </div>
                    </div><!-- End About Us Content -->
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection