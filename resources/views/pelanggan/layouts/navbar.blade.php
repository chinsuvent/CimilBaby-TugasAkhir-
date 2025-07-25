
<nav class="navbar navbar-expand  topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3 d-md-none" onclick="toggleSidebar()">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 text-gray-600 small">
                                    {{ auth()->user()->name }}
                                    <br>
                                    <small>{{ auth()->user()->level }}</small>
                                </span>
        <img class="img-profile rounded-circle"
            src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg"
            style="width: 32px; height: 32px;">
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</li>

                    </ul>


                </nav>
                <div id="sidebar-backdrop" class="sidebar-backdrop" onclick="toggleSidebar()"></div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("accordionSidebar");
    const backdrop = document.getElementById("sidebar-backdrop");

    sidebar.classList.toggle("show");
    backdrop.classList.toggle("show");

    if (sidebar.classList.contains("show")) {
      document.body.classList.add("sidebar-open");
    } else {
      document.body.classList.remove("sidebar-open");
    }
  }

  // ✅ Perbaiki agar kembali ke sidebar desktop penuh (bukan mini/toggled)
  window.addEventListener('resize', function () {
    const sidebar = document.getElementById("accordionSidebar");
    const backdrop = document.getElementById("sidebar-backdrop");

    if (window.innerWidth > 768) {
      sidebar.classList.remove("show"); // Tutup mobile sidebar
      backdrop.classList.remove("show");
      document.body.classList.remove("sidebar-open");

      // ❌ Jangan pakai toggled! Justru HAPUS agar sidebar normal penuh
      sidebar.classList.remove("toggled");
    }
  });
</script>
