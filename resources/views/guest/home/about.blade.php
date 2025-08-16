@extends('guest.layouts.main')
@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('images/about_2.jpeg') }});">
    <div class="container position-relative">
    </div>
</div>

<section id="travel-tours" class="travel-tours section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2>Tentang Kami</h2>
                <h4>Sejarah</h4>
                <p>Palang Merah Indonesia</p>
            </div>
        </div>

        <!-- Tour Filters -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12">
                <!-- About Us Content -->
                    <div class="row align-items-center mb-5">
                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                            <div class="about-image">
                                <img src="https://www.pmi.or.id/png/history/overview.png" alt="" class="img-fluid rounded-4">
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                            <div class="content">
                                <p>
                                    Palang Merah Indonesia sebenarnya dimulai sebelum Perang Dunia II. Pada 21 Oktober 1873, 
                                    Pemerintah Kolonial Belanda mendirikan Palang Merah di Indonesia dengan nama Nederlands Rode Kruis Afdeling Indie (Nerkai). Namun, organisasi ini kemudian dibubarkan selama pendudukan Jepang. 
                                    Perjuangan untuk mendirikan Palang Merah Indonesia dimulai sekitar tahun 1932, dipelopori oleh Dr. RCL Senduk dan Dr. Bahder Djohan. Inisiatif ini mendapatkan dukungan luas, terutama dari kalangan terpelajar Indonesia. 
                                    Meskipun mereka berusaha menyampaikan proposal tersebut pada Konferensi Nerkai tahun 1940, proposal itu ditolak mentah-mentah. Tanpa menyerah, rencana itu sementara diabaikan, menunggu kesempatan yang tepat. Selama pendudukan Jepang, mereka mencoba sekali lagi untuk membentuk Badan Palang Merah Nasional, tetapi usaha ini kembali digagalkan oleh pemerintah militer Jepang, 
                                    memaksa proposal tersebut untuk disimpan kembali untuk kedua kalinya.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                            <div class="content">
                                <p>
                                    Unit donor darah PMI adalah fasilitas pelanayan kesehatan yang menyelenggarakan 
                                    pengerahan dan pelestarian pendonor darah, penyedian darah dan pendistribusian
                                    darah. Untuk selanjutnya disebut Unit Donor Darah PMI atau disingkat UDD PMI yang 
                                    berdasarkan tingakatannya dibagi menjadi UDD Nasional, Propinsi, Kabupaten/Kota dan 
                                    berdasarkan kemampuannya dibagi menjadi UDD Utama, Madya dan Pratama.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                            <div class="about-image">
                                <img src="{{ asset('images/about_2.png') }}" alt="" class="img-fluid rounded-4">
                            </div>
                        </div>
                        
                    </div><!-- End About Us Content -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-3">
                <h2>Alamat UPD</h2>
            </div>
            <div class="col-lg-12 mx-auto text-center mb-5">
                <p>Jl. Jend. Ahmad Yani No.15, RT.005/RW.001, Sukaasih, Kec. Tangerang, Kota Tangerang, Banten 15111</p>
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection