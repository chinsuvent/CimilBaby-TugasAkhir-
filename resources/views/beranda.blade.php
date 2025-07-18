@php
  $boxClasses = ['box-bulanan', 'box-harian', 'box-khusus'];
  $icons = [
    // Khusus
    '<svg xmlns="http://www.w3.org/2000/svg" width="4.5em" height="4.5em" viewBox="0 0 24 24">
                    <path fill="#fff" d="M8.5 14a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m0 3.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0M12 17.5a1.25 1.25 0 1 0 0-2.5a1.25 1.25 0 0 0 0 2.5m4.75-4.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0" />
                    <path fill="#fff" fill-rule="evenodd" d="M8 3.25a.75.75 0 0 1 .75.75v.75h6.5V4a.75.75 0 0 1 1.5 0v.758q.228.006.425.022c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v7.66c0 .535 0 .98-.03 1.345c-.03.38-.098.736-.27 1.073a2.75 2.75 0 0 1-1.201 1.202c-.338.172-.694.24-1.074.27c-.365.03-.81.03-1.344.03H8.17c-.535 0-.98 0-1.345-.03c-.38-.03-.736-.098-1.073-.27a2.75 2.75 0 0 1-1.202-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.344V8.67c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 5.752 5.05c.337-.172.693-.24 1.073-.27q.197-.016.425-.022V4A.75.75 0 0 1 8 3.25m10.25 7H5.75v6.05c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.12.236.311.427.547.547c.09.046.227.088.514.111c.296.024.68.025 1.253.025h7.6c.572 0 .957 0 1.252-.025c.288-.023.425-.065.515-.111a1.25 1.25 0 0 0 .547-.547c.046-.09.088-.227.111-.515c.024-.295.025-.68.025-1.252zM10.5 7a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5z" clip-rule="evenodd" />
                  </svg>',

    // Harian
    '        <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 24 24">
                    <path fill="#fff" d="M6.96 2c.418 0 .756.31.756.692V4.09c.67-.012 1.422-.012 2.268-.012h4.032c.846 0 1.597 0 2.268.012V2.692c0-.382.338-.692.756-.692s.756.31.756.692V4.15c1.45.106 2.403.368 3.103 1.008c.7.641.985 1.513 1.101 2.842v1H2V8c.116-1.329.401-2.2 1.101-2.842c.7-.64 1.652-.902 3.103-1.008V2.692c0-.382.339-.692.756-.692" />
                    <path fill="#fff" d="M22 14v-2c0-.839-.013-2.335-.026-3H2.006c-.013.665 0 2.161 0 3v2c0 3.771 0 5.657 1.17 6.828C4.349 22 6.234 22 10.004 22h4c3.77 0 5.654 0 6.826-1.172S22 17.771 22 14" opacity="0.5" />
                    <path fill="#fff" fill-rule="evenodd" d="M14 12.25A1.75 1.75 0 0 0 12.25 14v2a1.75 1.75 0 1 0 3.5 0v-2A1.75 1.75 0 0 0 14 12.25m0 1.5a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25" clip-rule="evenodd" />
                    <path fill="#fff" d="M11.25 13a.75.75 0 0 0-1.28-.53l-1.5 1.5a.75.75 0 0 0 1.06 1.06l.22-.22V17a.75.75 0 0 0 1.5 0z" />
                  </svg>',
    // Bulanan
            '<svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 2048 2048">
                                <path fill="#fff" d="M1920 128v1792H0V128h384V0h128v128h896V0h128v128zM128 256v256h1664V256h-256v128h-128V256H512v128H384V256zm1664 1536V640H128v1152zm-440-768l-241 189l101 315l-252-197l-252 197l101-315l-241-189h302l90-280l90 280z" />
                            </svg>',
  ];
  $buttonClasses = ['btn-bulanan', 'btn-harian', 'btn-khusus'];
  $deskripsiItem = ['<ul class="list-unstyled">
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan penitipan bulanan</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                    </ul>',
                '<ul class="list-unstyled">
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan penitipan harian</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                    </ul>',
                    '<ul class="list-unstyled">
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan penitipan khusus</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                        <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                    </ul>',
                ];
@endphp


@extends('layouts.app')


@section('contents')

  <main class="main">

    <!-- Hero Section -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center mb-5">
          <div class="col-lg-6 mb-4 mb-lg-0">


            <h1 class="hero-title mb-4 text-white">Jasa Penitipan Anak<br>Ci'mil Baby</h1>

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
            @foreach ($layanan as $index => $item)
                @php
                $boxClass = $boxClasses[$index % count($boxClasses)];
                $icon = $icons[$index % count($icons)];
                $buttonClass = $buttonClasses[$index % count($buttonClasses)];
                $deskripsi = $deskripsiItem[$index % count($deskripsiItem)];
                @endphp
                <div class="col-lg-4 mb-4 mb-lg-0 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-box text-center {{ $boxClass }}">
                    <div class="feature-content">
                    <h3 class="feature-title text-white">{{ $item->jenis_layanan }}</h3>
                    <div class="text-center mb-3">
                        {!! $icon !!}
                    </div>
                    <h3 class="text-white">Rp. {{ number_format($item->biaya, 0, ',', '.') }}</h3>
                    {!! $deskripsi !!}
                 @auth
                <a href="#" class="btn btn-reservasi mt-3 {{ $buttonClass }}"
                    data-bs-toggle="modal"
                    data-bs-target="#reservasiModal"
                    data-layanan="{{ $item->jenis_layanan }}"
                    data-biaya="{{ number_format($item->biaya, 0, ',', '.') }}">
                    Reservasi Sekarang
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-reservasi mt-3 {{ $buttonClass }}">
                    Reservasi Sekarang
                </a>
                @endauth



                    </div>
                </div>
                </div>
            @endforeach
            </div>

            @auth
           <!-- Modal Reservasi -->
            <div class="modal fade" id="reservasiModal" tabindex="-1" aria-labelledby="reservasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4" style="background-color: #C9A7F3; color: white;">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center fw-bold text-white" id="modalReservasiLabel">Form Reservasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reservasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Nama Lengkap"
                            value="{{ auth()->user()->name }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <select name="anaks_id" class="form-select">
                        <option value="">Pilih Anak</option>
                        @foreach ($anakUser as $anak)
                            <option value="{{ $anak->id }}">{{ $anak->nama_anak }}</option>
                        @endforeach
                        </select>

                    </div>
                    <div class="mb-3">
                        <input type="text" name="jenis_layanan" id="jenisLayananInput" class="form-control rounded-3" placeholder="Jenis Layanan" readonly required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col">
                        <input type="date" name="tgl_masuk" class="form-control rounded-3" placeholder="Tanggal Masuk" required>
                        </div>
                        <div class="col">
                        <input type="date" name="tgl_keluar" class="form-control rounded-3" placeholder="Tanggal Keluar" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="biaya" id="biayaInput" class="form-control rounded-3" placeholder="Biaya" readonly required>
                    </div>
                    <div class="mb-3">
                        <select name="metode_pembayaran" class="form-select rounded-3" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn w-100 rounded-pill" style="background-color: #9672F3; color: white;">Kirim</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            @endauth


            </div>

{{--
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
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan penitipan bulanan</li>
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

          <div class="col-lg-4 mb-4 mb-lg-0 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-box text-center box-khusus">
              <div class="feature-content ">
                <h3 class="feature-title text-white">Khusus</h3>
                <div class="text-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 2048 2048">
                    <path fill="#fff" d="M1920 128v1792H0V128h384V0h128v128h896V0h128v128zM128 256v256h1664V256h-256v128h-128V256H512v128H384V256zm1664 1536V640H128v1152zm-440-768l-241 189l101 315l-252-197l-252 197l101-315l-241-189h302l90-280l90 280z" />
                  </svg>
                </div>
                <h3 class="text-white">Rp. 120.000 / hari</h3>
                <ul class="list-unstyled">
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan hari libur</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Penitipan anak selama 9 jam</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Makan Siang Sehat</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Bermain</li>
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Terdapat Ruang Tidur</li>
                </ul>
                <a href="#" class="btn btn-reservasi mt-3" target="_blank" style="color: #FF9D3D;">
                  Reservasi Sekarang
                </a>
              </div>
            </div> --}}
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Seleksi semua tombol dengan class btn-reservasi
    document.querySelectorAll('.btn-reservasi').forEach(function (btn) {
        btn.addEventListener('click', function () {
            // Ambil data-layanan dan data-biaya dari tombol yang diklik
            const layanan = btn.getAttribute('data-layanan');
            const biaya = btn.getAttribute('data-biaya');

            // Isi ke input di modal
            document.getElementById('jenisLayananInput').value = layanan ?? '';
            document.getElementById('biayaInput').value = biaya ?? '';
        });
    });
});


</script>





@endsection
