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

  <!-- =======================================================
  * Template Name: Invent
  * Template URL: https://bootstrapmade.com/invent-bootstrap-business-template/
  * Updated: May 12 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

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
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="#hero" class="active px-5 py-2 bg-beranda text-white rounded">Beranda</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="#about" class="px-5 py-2 bg-about text-white rounded">Tentang Kami</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="#services" class="px-5 py-2 bg-layanan text-white rounded">Layanan</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="#portfolio" class="px-5 py-2 bg-jadwal text-white rounded">Jadwal Layanan</a></li>
            <li class="me-xl-3 mb-2 mb-xl-0"><a href="#pricing" class="px-5 py-2 bg-fasilitas text-white rounded">Fasilitas</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>


  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section" style="background-image: url('pelanggan_assets/img/bg-hero.png'); background-size: cover; background-position: center; margin-top:50px">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center mb-5">
          <div class="col-lg-6 mb-4 mb-lg-0">
            

            <h1 class="hero-title mb-4 text-white">Jasa Penitipan Anak Ci'mil Baby</h1>

            <p class="hero-description mb-4 text-white">Ci'mil Baby, tempat aman dan nyaman untuk buah hati Anda. Kami hadir dengan layanan penitipan anak yang penuh kasih sayang dan perhatian.</p>

            <div class="cta-wrapper">
              <a href="{{ route('register') }}" class="btn btn-daftar text-white">Daftar Untuk Reservasi</a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image">
              <img src="{{ 'pelanggan_assets/img/illustration/gambar_anak.png' }}" alt="Business Growth" class="img-fluid" loading="lazy">
            </div>
          </div>
        </div>

        <div class="row feature-boxes">
          <div class="col-lg-4 mb-4 mb-lg-0 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-box text-center box-harian">
              <div class="feature-content">
                <h3 class="feature-title text-white">Harian</h3>
                <div class="text-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 24 24">
                    <path fill="#fff" d="M6.96 2c.418 0 .756.31.756.692V4.09c.67-.012 1.422-.012 2.268-.012h4.032c.846 0 1.597 0 2.268.012V2.692c0-.382.338-.692.756-.692s.756.31.756.692V4.15c1.45.106 2.403.368 3.103 1.008c.7.641.985 1.513 1.101 2.842v1H2V8c.116-1.329.401-2.2 1.101-2.842c.7-.64 1.652-.902 3.103-1.008V2.692c0-.382.339-.692.756-.692" />
                    <path fill="#fff" d="M22 14v-2c0-.839-.013-2.335-.026-3H2.006c-.013.665 0 2.161 0 3v2c0 3.771 0 5.657 1.17 6.828C4.349 22 6.234 22 10.004 22h4c3.77 0 5.654 0 6.826-1.172S22 17.771 22 14" opacity="0.5" />
                    <path fill="#fff" fill-rule="evenodd" d="M14 12.25A1.75 1.75 0 0 0 12.25 14v2a1.75 1.75 0 1 0 3.5 0v-2A1.75 1.75 0 0 0 14 12.25m0 1.5a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25" clip-rule="evenodd" />
                    <path fill="#fff" d="M11.25 13a.75.75 0 0 0-1.28-.53l-1.5 1.5a.75.75 0 0 0 1.06 1.06l.22-.22V17a.75.75 0 0 0 1.5 0z" />
                  </svg>
                </div>
                <h3 class="text-white">Rp. 100.000 / hari</h3>
                <ul class="list-unstyled">
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                </ul>
                <a href="#" class="btn btn-reservasi mt-3" target="_blank" style="color: #FF8282;">
                  Reservasi Sekarang
                </a>
              </div>
            </div>
          </div>


          <div class="col-lg-4 mb-4 mb-lg-0 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-box text-center box-bulanan">
              <div class="feature-content ">
                <h3 class="feature-title text-white">Bulanan</h3>
                <div class="text-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="4.5em" height="4.5em" viewBox="0 0 24 24">
                    <path fill="#fff" d="M8.5 14a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m0 3.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12 17.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0" />
                    <path fill="#fff" fill-rule="evenodd" d="M8 3.25a.75.75 0 0 1 .75.75v.75h6.5V4a.75.75 0 0 1 1.5 0v.758q.228.006.425.022c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v7.66c0 .535 0 .98-.03 1.345c-.03.38-.098.736-.27 1.073a2.75 2.75 0 0 1-1.201 1.202c-.338.172-.694.24-1.074.27c-.365.03-.81.03-1.344.03H8.17c-.535 0-.98 0-1.345-.03c-.38-.03-.736-.098-1.073-.27a2.75 2.75 0 0 1-1.202-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.344V8.67c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 5.752 5.05c.337-.172.693-.24 1.073-.27q.197-.016.425-.022V4A.75.75 0 0 1 8 3.25m10.25 7H5.75v6.05c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.12.236.311.427.547.547c.09.046.227.088.514.111c.296.024.68.025 1.253.025h7.6c.572 0 .957 0 1.252-.025c.288-.023.425-.065.515-.111a1.25 1.25 0 0 0 .547-.547c.046-.09.088-.227.111-.515c.024-.295.025-.68.025-1.252zM10.5 7a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5z" clip-rule="evenodd" />
                  </svg>
                </div>
                <h3 class="text-white">Rp. 800.000 / bulan</h3>
                <ul class="list-unstyled">
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                </ul>
                <a href="#" class="btn btn-reservasi mt-3" target="_blank" style="color: #81BFDA;">
                  Reservasi Sekarang
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="400">
            <div class="feature-box text-center box-khusus">
              <div class="feature-content">
                <h3 class="feature-title text-white">Khusus</h3>
                <div class="text-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 2048 2048">
                    <path fill="#fff" d="M1920 128v1792H0V128h384V0h128v128h896V0h128v128zM128 256v256h1664V256h-256v128h-128V256H512v128H384V256zm1664 1536V640H128v1152zm-440-768l-241 189l101 315l-252-197l-252 197l101-315l-241-189h302l90-280l90 280z" />
                  </svg>
                </div>
                <h3 class="text-white">Rp. 120.000 / hari</h3>
                <ul class="list-unstyled">
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                </ul>
                <a href="#" class="btn btn-reservasi mt-3" target="_blank" style="color: #FF9D3D;">Reservasi Sekarang</a>
              </div>
            </div>
    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #7D65EC;">Selamat Datang di Jasa Penitipan<br>Anak Ci'mil Baby</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center g-5">
          <div class="row align-items-center">
            <!-- Kiri gambar -->
            <div class="col-md-4">
              <!-- Service Item 1 -->
              <div class="service-item mb-4" data-aos="fade-right" data-aos-delay="100">
                <div class="service-icon">
                  <i class="bi bi-clock"></i>
                </div>
                <div class="service-content">
                  <h3>Jam Pelayanan Fleksibel</h3>
                  <p>Jam pelayanan tersedia dari pukul 07.00 hingga 17.00 untuk kenyamanan Anda</p>
                  
                </div>
              </div>

              <!-- Service Item 2 -->
              <div class="service-item" data-aos="fade-right" data-aos-delay="200">
                <div class="service-icon">
                  <i class="bi bi-fork-knife"></i>
                </div>
                <div class="service-content">
                  <h3>Makanan Sehat & Gratis</h3>
                  <p>Tersedia Makan Siang Yang Sehat Di Setiap Layanan</p>
                </div>
              </div>
            </div>

            <!-- Gambar Tengah -->
            <div class="col-md-4 d-flex justify-content-center my-4">
              <img src="{{ asset('pelanggan_assets/img/gambar_beranda.png') }}" alt="Service Center" class="img-fluid" style="max-width: 200px;">
            </div>

            <!-- Kanan gambar -->
            <div class="col-md-4">
              <!-- Service Item 3 -->
              <div class="service-item mb-4" data-aos="fade-left" data-aos-delay="100">
                <div class="service-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <div class="service-content">
                  <h3>Lingkungan Aman & Menyenangkan</h3>
                  <p>Lingkungan aman, hangat, dan menyenangkan agar anak nyaman seperti di rumah sendiri</p>
                  
                </div>
              </div>

              <!-- Service Item 4 -->
              <div class="service-item" data-aos="fade-left" data-aos-delay="200">
                <div class="service-icon">
                  <i class="bi bi-building-check"></i>
                </div>
                <div class="service-content">
                  <h3>Fasilitas Yang Bersih</h3>
                  <p>Kebersihan fasilitas di Cimil Baby selalu dijaga demi kenyamanan dan kesehatan anak</p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->


  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">MyWebsite</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">MyWebsite</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

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

</body>

</html>