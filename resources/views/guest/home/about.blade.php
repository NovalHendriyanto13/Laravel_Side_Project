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
                        <div class="col-lg-12">
                            <div class="bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light w-full max-w-4xl py-4 rounded-xl">
                                <h3 class="font-bold text-center text-xs md:text-xl text-pmi-white">
                                Sejarah Gerakan Palang Merah dan Bulan Sabit Merah
                                </h3>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <div class="border rounded-2xl max-w-screen-lg bg-white shadow-lg m-2">
                                    <div class="bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-t-2xl py-2">
                                        <h3 class="font-bold text-center text-2xl text-pmi-white">Tugas PMI</h3>
                                    </div>
                                    <div class="space-y-8 px-12 py-6">
                                        <p class="text-center text-lg text-pmi-black">
                                            berdasarkan Undang-Undang No. 1 Tahun 2018 tentang Kepalangmerahan
                                        </p>
                                        <div class="flex items-start gap-4">
                                            <div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]">
                                                <p class="font-bold text-base text-pmi-white">01</p>
                                            </div>
                                            <div class="relative">
                                                <p class="font-medium text-base text-pmi-gray">
                                                    Memberikan bantuan kepada korban konflik bersenjata, kerusuhan, dan gangguan lainnya;
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-4">
                                            <div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">02</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Menawarkan layanan darah sesuai dengan peraturan hukum;</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">03</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Mengembangkan dan mengelola relawan;</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">04</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Melaksanakan pendidikan dan pelatihan terkait kegiatan Palang Merah;</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">05</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Menyebarluaskan informasi tentang kegiatan Palang Merah;</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">06</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Memberikan bantuan dalam manajemen bencana baik di dalam negeri maupun internasional;</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">07</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Memberikan layanan kesehatan dan sosial; dan</p></div></div><div class="flex items-start gap-4"><div class="flex justify-center items-center px-4 py-2 bg-pmi-red-dark bg-gradient-to-r from-pmi-red-dark to-pmi-red-light rounded-br-[1.5rem] rounded-tl-[1.5rem]"><p class="font-bold text-base text-pmi-white">08</p></div><div class="relative"><p class="font-medium text-base text-pmi-gray">Melaksanakan tugas kemanusiaan lainnya yang ditugaskan oleh pemerintah.</p></div></div></div></div></div>
                        </div>
                    </div><!-- End About Us Content -->
            </div>
        </div>
    </div>

</section><!-- /Travel Tours Section -->

@endsection