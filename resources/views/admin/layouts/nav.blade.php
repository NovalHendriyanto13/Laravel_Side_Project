@php 
    $user = auth()->user();
    $isAdmin = $user->role == 'admin' ? true : false;
    $isCrossMatch = $user->role == 'checker' ? true :  false;
    $isUpdOfficer = $user->role == 'upd_officer' ? true :  false;
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UPD PMI Kota Tangerang<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if ($isAdmin)
    <!-- Heading -->
    <div class="sidebar-heading">
        Masters
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blood.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Darah</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.hospital.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Rumah Sakit</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.bloodStock.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Stock Darah</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @endif
    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pemesanan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order.payment-list') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if ($isAdmin)
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order.report') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Pemesanan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Users</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->