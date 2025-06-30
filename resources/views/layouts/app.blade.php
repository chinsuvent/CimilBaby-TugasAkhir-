<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ci'mil Baby</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- =======================================================
  * Template Name: Invent
  * Template URL: https://bootstrapmade.com/invent-bootstrap-business-template/
  * Updated: May 12 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  @include('layouts.navbar')

  <section id="hero" class="hero section"
  style="background-image: url('pelanggan_assets/img/bg-hero.png');
         background-size: cover;
         background-repeat: no-repeat;
         background-position: center top;
         height: auto;
         margin-top: 50px;">
  @yield('contents')
  </section>

  @include('layouts.footer')
  
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ 'pelanggan_assets/vendor/bootstrap/js/bootstrap.bundle.min.js' }}"></script>
  <script src="{{ 'pelanggan_assets/vendor/php-email-form/validate.js'}}"></script>
  <script src="{{ 'pelanggan_assets/vendor/aos/aos.js' }}"></script>
  <script src="{{ 'pelanggan_assets/vendor/glightbox/js/glightbox.min.js' }}"></script>
  <script src="{{ 'pelanggan_assets/vendor/imagesloaded/imagesloaded.pkgd.min.js' }}"></script>
  <script src="{{ 'pelanggan_assets/vendor/isotope-layout/isotope.pkgd.min.js' }}"></script>
  <script src="{{ 'pelanggan_assets/vendor/swiper/swiper-bundle.min.js' }}"></script>

  <!-- Main JS File -->
  <script src="{{ 'pelanggan_assets/js/main.js' }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
