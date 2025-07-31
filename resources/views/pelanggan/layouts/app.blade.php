<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ci'mil Baby - Pelanggan</title>

    <!-- Custom fonts for this template-->
    <!-- Favicons -->
  <link href="{{ 'pelanggan_assets/img/favicon.png' }}" rel="icon">
  <link href="{{ 'pelanggan_assets/img/apple-touch-icon.png' }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ 'pelanggan_assets/vendor/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet">
  <link href="{{ 'pelanggan_assets/vendor/bootstrap-icons/bootstrap-icons.css' }}" rel="stylesheet">
  <link href="{{ 'pelanggan_assets/vendor/aos/aos.css' }}" rel="stylesheet">
  <link href="{{ 'pelanggan_assets/vendor/glightbox/css/glightbox.min.css' }}" rel="stylesheet">
  <link href="{{ 'pelanggan_assets/vendor/swiper/swiper-bundle.min.css' }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ 'pelanggan_assets/css/main.css' }}" rel="stylesheet">
  <link href="{{ 'pelanggan_assets/css/custom.css' }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ 'pelanggan_assets/vendor/flatpickr/flatpickr.min.css' }}">
<script src="{{ 'pelanggan_assets/vendor/flatpickr/flatpickr.min.js' }}"></script>


    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('pelanggan_assets/css/custom.css') }}" rel="stylesheet"> --}}


    {{-- <script>
        setInterval(function() {
            window.location.reload();
        }, 5000);
    </script> --}}

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('pelanggan.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('pelanggan.layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>

                    @yield('contents')

                    <!-- Content Row -->

            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('layouts.footer') --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('pelanggan_assets/vendor/jquery/jquery-3.7.1.min.js') }}"></script>


    <script src="{{ asset('admin_assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Bootstrap JS dan Popper.js -->




    @stack('scripts')

</body>

</html>
