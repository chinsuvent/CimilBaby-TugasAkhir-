

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Ci'mil Baby</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
                    <span class="mr-2">Dashboard</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <g fill="none" fill-rule="evenodd">
                            <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="#fff" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m1 2.062V5a1 1 0 0 1-1.993.117L11 5v-.938a8.005 8.005 0 0 0-6.902 6.68L4.062 11H5a1 1 0 0 1 .117 1.993L5 13h-.938a8.001 8.001 0 0 0 15.84.25l.036-.25H19a1 1 0 0 1-.117-1.993L19 11h.938a7.98 7.98 0 0 0-2.241-4.617l-2.424 4.759l-.155.294l-.31.61c-.37.72-.772 1.454-1.323 2.005c-.972.971-2.588 1.089-3.606.07c-1.019-1.018-.901-2.634.07-3.606c.472-.472 1.078-.835 1.696-1.162l.919-.471l.849-.444l4.203-2.135A7.98 7.98 0 0 0 13 4.062m.162 6.776l-.21.112l-.216.113c-.402.209-.822.426-1.172.698l-.201.17l-.073.084c-.193.26-.135.554.003.692s.432.196.692.003l.086-.074l.168-.2c.217-.28.4-.605.571-.93l.127-.242q.112-.22.225-.426" />
                        </g>
                    </svg>

                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('users') }}">
                    <span class="mr-2">Data Pengguna</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('anaks') }}">
                    <span class="mr-2">Data Anak</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" aria-hidden="true">
                        <path fill="#fff" d="M425.39 200.035A184.3 184.3 0 0 0 290.812 91.289l26.756-42.809l-27.136-16.96l-35.305 56.488A184.05 184.05 0 0 0 86.61 200.035a71.978 71.978 0 0 0 0 143.93a184.071 184.071 0 0 0 338.78 0a71.978 71.978 0 0 0 0-143.93m27.152 99.975a39.77 39.77 0 0 1-27.76 11.961l-20.725.394l-8.113 19.074a152.066 152.066 0 0 1-279.887 0l-8.114-19.074l-20.725-.394a39.978 39.978 0 0 1 0-79.942l20.725-.394l8.114-19.074a152.067 152.067 0 0 1 279.887 0l8.113 19.074l20.725.394a39.974 39.974 0 0 1 27.76 67.981" />
                        <path fill="#fff" d="M168 232h40v40h-40zm136 0h40v40h-40zm-48 152a80 80 0 0 0 80-80H176a80 80 0 0 0 80 80" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('layanans') }}">
                    <span class="mr-2">Data Layanan</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M2 19v-2h20v2zm1-3v-1q0-3.2 1.963-5.65T10 6.25V6q0-.825.588-1.412T12 4t1.413.588T14 6v.25q3.1.65 5.05 3.1T21 15v1z" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('jadwal_layanans') }}">
                    <span class="mr-2">Jadwal Layanan</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048" aria-hidden="true">
                        <path fill="#fff" d="M1792 993q60 41 107 93t81 114t50 131t18 141q0 119-45 224t-124 183t-183 123t-224 46q-91 0-176-27t-156-78t-126-122t-85-157H128V128h256V0h128v128h896V0h128v128h256zM256 256v256h1408V256h-128v128h-128V256H512v128H384V256zm643 1280q-3-31-3-64q0-86 24-167t73-153h-97v-128h128v86q41-51 91-90t108-67t121-42t128-15q100 0 192 33V640H256v896zm573 384q93 0 174-35t142-96t96-142t36-175q0-93-35-174t-96-142t-142-96t-175-36q-93 0-174 35t-142 96t-96 142t-36 175q0 93 35 174t96 142t142 96t175 36m64-512h192v128h-320v-384h128zM384 1024h128v128H384zm256 0h128v128H640zm0-256h128v128H640zm-256 512h128v128H384zm256 0h128v128H640zm384-384H896V768h128zm256 0h-128V768h128zm256 0h-128V768h128z" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('fasilitas') }}">
                    <span class="mr-2">Data Fasilitas</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 64 64" aria-hidden="true">
                        <path fill="#fff" d="M32 2C15.432 2 2 15.432 2 32c0 16.566 13.432 30 30 30s30-13.434 30-30C62 15.432 48.568 2 32 2m-5 12.5c0-1.25 1.25-2.5 2.5-2.5h5c1.25 0 2.5 1.25 2.5 2.5v5c0 1.25-1.25 2.502-2.5 2.5h-5c-1.25.002-2.5-1.25-2.5-2.5zM29 51l-3 1l-3-7l3-7l5 3l-4 4zm9 1l-3-1l2-6l-4-4l5-3l3 7zm0-24v6q0 3-3 3h-6q-3 0-3-3v-6l-7-5l1-2l7.946 3H36l8-3l1 2z" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('reservasis') }}">
                    <span class="mr-2">Data Reservasi</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" aria-hidden="true">
                        <path fill="#fff" d="M6.5 1a1.5 1.5 0 0 0-1.415 1H4.5A1.5 1.5 0 0 0 3 3.5v10A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 11.5 2h-.585A1.5 1.5 0 0 0 9.5 1zM6 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m4.854 5.354l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('checkin_checkout.index') }}">
                    <span class="mr-2">Kehadiran Anak</span>
                    <!-- Icon: User Check (Kehadiran Anak) -->
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M12 4a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 10c-3.31 0-6 1.34-6 3v3h12v-3c0-1.66-2.69-3-6-3m7.71-1.29a1 1 0 0 0-1.42 0l-2.29 2.3l-.71-.7a1 1 0 1 0-1.42 1.41l1.41 1.41a1 1 0 0 0 1.42 0l3-3a1 1 0 0 0 0-1.42"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('laporans_reservasi.index') }}">
                    <span class="mr-2">Laporan Reservasi</span>
                    <!-- Icon: File Chart (Laporan Reservasi) -->
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zm0 2l6 6h-6zm-4 10v4h2v-4zm4-2v6h2v-6zm-8 4v2h2v-2z"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('laporans_penitipan.index') }}">
                    <span class="mr-2">Laporan Penitipan</span>
                    <!-- Icon: Clipboard List (Laporan Penitipan) -->
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M19 3h-4.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H5a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2m-7 0a1 1 0 0 1 2 0zm8 18H5V5h2v2h10V5h2zm-9-7h2v2h-2zm0-4h2v2h-2zm4 4h2v2h-2zm0-4h2v2h-2z"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('admin.settings.index') }}">
                    <span class="mr-2">Ubah Nomor Admin</span>
                    <!-- Icon: Gear (Settings) -->
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M19.14 12.94c.04-.31.06-.63.06-.94s-.02-.63-.06-.94l2.03-1.58a.5.5 0 0 0 .12-.65l-1.92-3.32a.5.5 0 0 0-.61-.22l-2.39.96a7.03 7.03 0 0 0-1.62-.94l-.36-2.53A.5.5 0 0 0 13 2h-3a.5.5 0 0 0-.5.42l-.36 2.53c-.59.23-1.14.54-1.62.94l-2.39-.96a.5.5 0 0 0-.61.22l-1.92 3.32a.5.5 0 0 0 .12.65l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58a.5.5 0 0 0-.12.65l1.92 3.32c.14.24.44.33.68.22l2.39-.96c.48.4 1.03.71 1.62.94l.36 2.53c.05.27.27.46.5.46h3c.23 0 .45-.19.5-.46l.36-2.53c.59-.23 1.14-.54 1.62-.94l2.39.96c.24.11.54.02.68-.22l1.92-3.32a.5.5 0 0 0-.12-.65zm-7.14 2.56a3 3 0 1 1 0-6a3 3 0 0 1 0 6z"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('admin.whatsapp.index') }}">
                    <span class="mr-2">Ubah API Key</span>
                    <!-- Icon: Gear (Settings) -->
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#fff" d="M19.14 12.94c.04-.31.06-.63.06-.94s-.02-.63-.06-.94l2.03-1.58a.5.5 0 0 0 .12-.65l-1.92-3.32a.5.5 0 0 0-.61-.22l-2.39.96a7.03 7.03 0 0 0-1.62-.94l-.36-2.53A.5.5 0 0 0 13 2h-3a.5.5 0 0 0-.5.42l-.36 2.53c-.59.23-1.14.54-1.62.94l-2.39-.96a.5.5 0 0 0-.61.22l-1.92 3.32a.5.5 0 0 0 .12.65l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58a.5.5 0 0 0-.12.65l1.92 3.32c.14.24.44.33.68.22l2.39-.96c.48.4 1.03.71 1.62.94l.36 2.53c.05.27.27.46.5.46h3c.23 0 .45-.19.5-.46l.36-2.53c.59-.23 1.14-.54 1.62-.94l2.39.96c.24.11.54.02.68-.22l1.92-3.32a.5.5 0 0 0-.12-.65zm-7.14 2.56a3 3 0 1 1 0-6a3 3 0 0 1 0 6z"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" onclick="confirmLogout(event)">
                    <span class="mr-2">Logout</span>
                    <svg class="ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h6q.425 0 .713.288T12 4t-.288.713T11 5H5v14h6q.425 0 .713.288T12 20t-.288.713T11 21zm12.175-8H10q-.425 0-.712-.288T9 12t.288-.712T10 11h7.175L15.3 9.125q-.275-.275-.275-.675t.275-.7t.7-.313t.725.288L20.3 11.3q.3.3.3.7t-.3.7l-3.575 3.575q-.3.3-.712.288t-.713-.313q-.275-.3-.262-.712t.287-.688z" />
                    </svg>
                </a>
            </li>

            <!-- Form logout tersembunyi -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

<!-- Script SweetAlert2 dan fungsi confirmLogout -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<script>

    // function toggleSidebar() {
    //     const sidebar = document.getElementById("accordionSidebar");
    //     const backdrop = document.getElementById("sidebar-backdrop");
    //     console.log('Toggle clicked');
    //     sidebar.classList.toggle("show");
    //     backdrop.classList.toggle("hidden");
    // }




    function confirmLogout(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Anda akan keluar dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
</ul>

