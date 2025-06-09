@extends('layouts.app')

@section('contents')
  <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Laporan</h1>
  </div>
  <hr />

  @push('scripts')
  <script>
    function setShowLimit(limit) {
        const url = new URL(window.location.href);
        url.searchParams.set('limit', limit);
        window.location.href = url.toString(); // refresh halaman dengan query baru
    }


    // Saat halaman dimuat, update teks tombol show limit sesuai nilai limit sekarang
    document.addEventListener('DOMContentLoaded', function () {
      const currentLimit = document.getElementById('limitInput').value || 10;
      document.getElementById('dropdownShow').textContent = 'Lihat ' + currentLimit;
      
      // Juga set pilihan filter sesuai request saat ini (opsional, kalau pakai blade bisa langsung set value)
      const params = new URLSearchParams(window.location.search);
      const gender = params.get('gender');
      const service = params.get('service');

      if (gender) {
        document.querySelector('select[name="gender"]').value = gender;
      }
      if (service) {
        document.querySelector('select[name="service"]').value = service;
      }
    });

    window.addEventListener('pageshow', function (event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 1)) {
      // Jika halaman direfresh
      const url = new URL(window.location.href);
      const baseUrl = url.origin + url.pathname;
      // Hilangkan semua query parameter dan reload
      window.location.replace(baseUrl);
    }
  });


  let typingTimer;
  const debounceDelay = 500; // waktu tunda 500ms
  const searchInput = document.getElementById('searchInput');
  const searchForm = document.getElementById('searchForm');

  searchInput.addEventListener('input', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
      searchForm.submit();
    }, debounceDelay);
  });
  </script>
  @endpush



  <!-- Filter Atas -->
  <form method="GET" action="{{ route('laporans.index') }}" class="mb-3">
  <div class="row g-2">
    <!-- Kolom 1: Label + Input Tanggal Awal -->
    <div class="col-md-3">
      <label for="tgl_awal" class="form-label px-2 py-1 rounded" style="font-size: 1.3rem;">
        Tanggal Awal
      </label>
      <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}" style="background-color: #8979FF; color:white;">
    </div>

    <!-- Kolom 2: Label + Input Tanggal Akhir -->
    <div class="col-md-3">
      <label for="tgl_akhir" class="form-label px-2 py-1 rounded" style="font-size:1.3rem">
        Tanggal Akhir
      </label>
      <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}" style="background-color: #8979FF; color:white;">
    </div>

    <!-- Kolom 3: Tombol Tampilkan -->
    <div class="col-md-3 d-flex align-items-end">
      <button type="submit" class="btn btn-purple w-100">Tampilkan</button>
    </div>

    <!-- Kolom 4: Tombol Cetak PDF -->
    <div class="col-md-3 d-flex align-items-end">
      <a href="{{ route('laporans.cetak', request()->all()) }}" target="_blank" class="btn btn-purple w-100">Cetak PDF</a>
    </div>
  </div>
</form>




<div class="row mb-4 align-items-center">
  <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0" style="gap: 20px;">

    <div class="dropdown">
      <button class="btn btn-purple dropdown-toggle d-flex align-items-center" type="button" id="dropdownShow" data-bs-toggle="dropdown" aria-expanded="false">
        Lihat 10
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownShow">
        <li><button type="button" class="dropdown-item" onclick="setShowLimit(10)">10</button></li>
        <li><button type="button" class="dropdown-item" onclick="setShowLimit(25)">25</button></li>
        <li><button type="button" class="dropdown-item" onclick="setShowLimit(50)">50</button></li>
        <li><button type="button" class="dropdown-item" onclick="setShowLimit(100)">100</button></li>
      </ul>
    </div>

    <div class="dropdown">
      <button class="btn btn-purple dropdown-toggle d-flex align-items-center" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
        Filter
      </button>
      <div class="dropdown-menu p-3" style="min-width: 250px;">
        <form id="filterForm" method="GET" action="{{ route('laporans.index') }}">
          <input type="hidden" name="limit" id="limitInput" value="{{ request('limit', 10) }}">
          
          <div class="mb-2">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="gender">
              <option value="">Semua</option>
              <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label">Jenis Layanan</label>
            <select class="form-select" name="service">
              <option value="">Semua</option>
              <option value="Bulanan" {{ request('service') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
              <option value="Harian" {{ request('service') == 'Harian' ? 'selected' : '' }}>Harian</option>
            </select>
          </div>
          <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Terapkan Filter</button>
          <a href="{{ route('laporans.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">Reset</a>

        </form>
      </div>
    </div>
  </div>
    <!-- Kolom 2: Input Cari -->
    <div class="col-12 col-md-6">
      <form method="GET" action="{{ route('laporans.index') }}" id="searchForm">
        <div class="search-wrapper d-flex align-items-center">
          <i class="fas fa-search search-icon me-2"></i>
          <input 
            type="text" 
            name="cari" 
            class="text-white border-0" 
            placeholder="Cari"
            value="{{ request('cari') }}"
            id="searchInput"
          />
        </div>
      </form>
    </div>
  </div>
</div>


  <!-- Tabel -->
  <div class="px-4">
    <div class="table-responsive">
      <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-primary text-center">
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Anak</th>
            <th>Jenis Layanan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Biaya</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
                  @if ($laporan->count() > 0)
                      @foreach ($laporan as $la)
                          <tr class="text-center">
                              <td class="align-middle">{{ $loop->iteration }}</td>
                              <td class="align-middle">{{ $la->pengguna->name ?? '-' }}</td>
                              <td class="align-middle">{{ $la->anak->nama_anak ?? '-' }}</td>
                              <td class="align-middle">{{ $la->layanan->jenis_layanan ?? '-' }}</td>
                              <td class="align-middle">{{ \Carbon\Carbon::parse($la->tgl_masuk)->format('d-m-Y') }}</td>
                              <td class="align-middle">{{ \Carbon\Carbon::parse($la->tgl_keluar)->format('d-m-Y') }}</td>
                              <td class="align-middle">{{ $la->layanan->biaya ?? '-' }}</td>
                              <td class="align-middle">{{ $la->status }}</td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                          <td class="text-center" colspan="15" style="background-color: white;">Data Tidak Ditemukan</td>
                      </tr>
                  @endif
              </tbody>
      </table>
    </div>
  </div>

@endsection
