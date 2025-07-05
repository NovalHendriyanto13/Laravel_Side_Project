<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">PMI</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a href="destinations.html">Destinations</a></li>
                <li class="dropdown"><a href="#"><span>Syarat Donor Darah</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="destination-details.html">BDRS</a></li>
                        <li><a href="tour-details.html">Non BDRS</a></li>
                    </ul>
                </li>
                
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('register') }}">Daftar</a>
        
    </div>
</header>