
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
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->name }}
                                    <br>
                                    <small>{{ auth()->user()->level }}</small>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg">
                            </a>
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
</script>
