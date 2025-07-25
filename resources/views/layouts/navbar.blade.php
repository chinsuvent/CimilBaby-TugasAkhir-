<header id="header" class="header fixed-top">
   <div class="container d-flex align-items-center justify-content-between position-relative py-1">


        <!-- Logo Desktop - kiri -->
        <a href="index.html" class="logo d-none d-xl-flex align-items-center">
            <h1 class="sitename m-0">Ci'mil Baby</h1>
        </a>

        <!-- Logo Mobile - tengah -->
        <div class="d-flex d-xl-none flex-grow-1 justify-content-center">
            <a href="index.html" class="logo-mobile text-center">
                <h1 class="sitename m-0">Ci'mil Baby</h1>
            </a>
        </div>


        <!-- Menu navigasi di tengah (desktop only) -->
        <nav id="navmenu" class="d-none d-xl-block position-absolute start-50 translate-middle-x">
            <ul class="d-flex flex-row align-items-center gap-3 m-0 p-0 list-unstyled">
                <li><a href="/" class="active px-3 py-2 bg-beranda text-white rounded text-nowrap">Beranda</a></li>
                <li><a href="/tentang_kami" class="px-3 py-2 bg-about text-white rounded text-nowrap">Tentang Kami</a></li>
                <li><a href="/layanan" class="px-3 py-2 bg-layanan text-white rounded text-nowrap">Layanan</a></li>
                <li><a href="/jadwal_layanan" class="px-3 py-2 bg-jadwal text-white rounded text-nowrap">Jadwal Layanan</a></li>
                <li><a href="/menu_fasilitas" class="px-3 py-2 bg-fasilitas text-white rounded text-nowrap">Fasilitas</a></li>
            </ul>
        </nav>

        <!-- Tombol Masuk / Profil di kanan (desktop only) -->
        <div class="d-none d-xl-flex align-items-center ms-auto">
            @auth
            <div class="dropdown d-inline">
                <a class="btn btn-masuk dropdown-toggle" href="#" role="button" id="dropdownUserMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                        src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg"
                        style="width: 40px; height: 40px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUserMenu">
                    <li>
                        <a class="dropdown-item" href="{{ route('pelanggan.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a class="btn btn-masuk" href="{{ route('login') }}">Masuk</a>
            @endauth
        </div>

        <!-- Tombol menu (mobile only) -->
        <i class="mobile-nav-toggle d-xl-none bi bi-list fs-3 text-dark position-absolute start-0 top-50 translate-middle-y ms-3" id="mobileMenuToggle" style="z-index: 1100; cursor: pointer;"></i>
    </div>

    <!-- Menu navigasi versi mobile -->
    <div id="mobileNavMenu" class="d-xl-none position-relative" style="display: none;">
        <nav class="navmenu-mobile">
            <ul class="flex-column align-items-start gap-2 m-0 p-3 list-unstyled bg-white rounded shadow">
                <li class="mb-2"><a href="/" class="active px-4 py-2 bg-beranda text-white rounded d-block">Beranda</a></li>
                <li class="mb-2"><a href="/tentang_kami" class="px-4 py-2 bg-about text-white rounded d-block">Tentang Kami</a></li>
                <li class="mb-2"><a href="/layanan" class="px-4 py-2 bg-layanan text-white rounded d-block">Layanan</a></li>
                <li class="mb-2"><a href="/jadwal_layanan" class="px-4 py-2 bg-jadwal text-white rounded d-block">Jadwal Layanan</a></li>
                <li class="mb-2"><a href="/menu_fasilitas" class="px-4 py-2 bg-fasilitas text-white rounded d-block">Fasilitas</a></li>
                <li>
                    @auth
                    <div class="dropdown">
                        <a class="btn btn-masuk dropdown-toggle d-flex align-items-center px-3 py-2" href="#" role="button" id="dropdownUserMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-profile rounded-circle me-2"
                                src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg"
                                style="width: 32px; height: 32px;">
                            Profil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUserMenu">
                            <li>
                                <a class="dropdown-item" href="{{ route('pelanggan.dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a class="btn btn-masuk px-3 py-2 d-inline-block text-nowrap" href="{{ route('login') }}">Masuk</a>
                    @endauth
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    // Script untuk toggle menu mobile
    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.getElementById('mobileMenuToggle');
        var mobileNav = document.getElementById('mobileNavMenu');
        var isOpen = false;

        if (toggle && mobileNav) {
            toggle.addEventListener('click', function () {
                isOpen = !isOpen;
                mobileNav.style.display = isOpen ? 'block' : 'none';

                if (isOpen) {
                    toggle.classList.remove('bi-list');
                    toggle.classList.add('bi-x');
                } else {
                    toggle.classList.remove('bi-x');
                    toggle.classList.add('bi-list');
                }
            });
        }
    });
</script>
