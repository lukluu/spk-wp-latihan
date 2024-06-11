<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK-WP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') || Request::is('user') || Request::is('dosen') ? 'active' : '' }} ">
        @if (Auth::user()->role == 'admin')
        <a class="nav-link" href="/admin">
            @elseif (Auth::user()->role == 'mahasiswa')
            <a class="nav-link" href="/user">
                @elseif (Auth::user()->role == 'dosen')
                <a class="nav-link" href="/dosen">
                    @endif
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    @if (Auth::user()->role == 'admin')
    <div class="sidebar-heading">
        Pengelolaan SPK
    </div>
    <li class="nav-item mb-0 {{ Request::is('admin/kelola-dosen*') || Request::is('admin/kelola-mahasiswa*') ? 'active' : '' }}">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#kelola-user" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Kelola User</span>
        </a>
        <div id="kelola-user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola User:</h6>
                <a class="collapse-item" href="/admin/kelola-dosen">Dosen</a>
                <a class="collapse-item" href="/admin/kelola-mahasiswa">Mahasiswa</a>
            </div>
        </div>
    </li>
    <li class="nav-item mt-0 p-0 m-0 {{ Request::is('admin/kelola-jadwal*') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/kelola-jadwal">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Atur Jadwal</span></a>
    </li>
    <li class="nav-item mt-0 p-0 m-0 {{ Request::is('admin/kelola-kriteria') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/kelola-kriteria">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Kriteria</span></a>
    </li>
    <li class="nav-item mt-0 p-0 m-0 {{ Request::is('admin/kelola-perhitungan*') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/kelola-perhitungan">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Kelola Perhitungan</span></a>
    </li>
    @endif



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
