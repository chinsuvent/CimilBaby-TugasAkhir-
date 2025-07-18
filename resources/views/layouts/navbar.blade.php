<header id="header" class="header fixed-top">
    <div class="container d-flex flex-column">

      <!-- Baris atas: Logo, tombol Get Started, dan tombol menu (☰) untuk mobile -->
      <div class="d-flex justify-content-between align-items-center py-2 position-relative w-100">

        <!-- Tombol menu (mobile only) -->
        <i class="mobile-nav-toggle d-xl-none bi bi-list fs-3"></i>

        <!-- Logo -->
        <a href="index.html" class="logo d-flex align-items-center position-absolute start-50 translate-middle-x"
          style="left: 50%; transform: translateX(-50%); z-index: 1;">
          <h1 class="sitename m-0">Ci'mil Baby</h1>
        </a>

        <!-- Tombol Get Started (desktop & mobile) -->

<div class="ms-auto d-sm-inline-block">
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
                    <button type="submit" class="dropdown-item">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
    @else
    <a class="btn btn-masuk" href="{{ route('login') }}">Masuk</a>
    @endauth
</div>


      </div>

      <!-- Baris bawah: Menu navigasi -->
      <div class="d-flex align-items-center justify-content-between w-100 gap-5">
        <nav id="navmenu" class="navmenu mx-auto">
          <ul class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center gap-3 m-0 p-0 list-unstyled">
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="/" class="active px-5 py-2 bg-beranda text-white rounded">Beranda</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="/tentang_kami" class="px-5 py-2 bg-about text-white rounded">Tentang Kami</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="/layanan" class="px-5 py-2 bg-layanan text-white rounded">Layanan</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="/jadwal_layanan" class="px-5 py-2 bg-jadwal text-white rounded">Jadwal Layanan</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="/menu_fasilitas" class="px-5 py-2 bg-fasilitas text-white rounded">Fasilitas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
