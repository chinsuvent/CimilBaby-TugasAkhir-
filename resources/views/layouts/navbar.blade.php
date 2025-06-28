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
        <a class="btn btn-masuk ms-auto d-sm-inline-block" href="{{ route('login') }}">Masuk</a>
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