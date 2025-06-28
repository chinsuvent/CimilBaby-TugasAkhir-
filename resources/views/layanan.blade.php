@extends('layouts.app')


@section('contents')



    <!-- Hero Section -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

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
                  <li class="text-white my-2"><i class="bi bi-check-circle-fill text-white me-2"></i>Layanan penitipan harian</li>
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
            </div>
          </div>


@endsection