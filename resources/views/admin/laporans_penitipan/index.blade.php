@extends('admin.layouts.app')

@section('contents')
  <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Laporan Penitipan</h1>
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



  <div class="row mb-4 align-items-center g-3">
  <!-- Tombol Cetak PDF -->
  <div class="col-md-auto ms-auto order-md-3 mr-4">
    <a href="{{ route('laporans_penitipan.cetak', request()->all()) }}" target="_blank" class="btn btn-purple w-100 w-md-auto">Cetak PDF</a>
  </div>

  <!-- Filter Dropdown -->
  <div class="col-md-auto order-md-1">
    <div class="dropdown">
      <button class="btn btn-purple dropdown-toggle d-flex align-items-center ml-4" type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
        Filter
      </button>
      <div class="dropdown-menu p-3" style="min-width: 300px;">
        <form id="filterForm" method="GET" action="{{ route('laporans_penitipan.index') }}">
          <input type="hidden" name="limit" id="limitInput" value="{{ request('limit', 10) }}">

          <!-- Tanggal Awal -->
          <div class="mb-2">
            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
            <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
          </div>

          <!-- Tanggal Akhir -->
          <div class="mb-2">
            <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
          </div>

          <!-- Jenis Kelamin -->
          <div class="mb-2">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="gender">
              <option value="">Semua</option>
              <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          <!-- Jenis Layanan -->
          <div class="mb-2">
            <label class="form-label">Jenis Layanan</label>
            <select class="form-select" name="service">
              <option value="">Semua</option>
              <option value="Bulanan" {{ request('service') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
              <option value="Harian" {{ request('service') == 'Harian' ? 'selected' : '' }}>Harian</option>
              <option value="Khusus" {{ request('service') == 'Khusus' ? 'selected' : '' }}>Khusus</option>
            </select>
          </div>

          <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Terapkan Filter</button>
          <a href="{{ route('laporans_penitipan.index') }}" class="btn btn-sm btn-secondary w-100 mt-2">Reset</a>
        </form>
      </div>
    </div>
  </div>

  <!-- Input Cari -->
  <div class="col-md order-md-2">
    <form method="GET" action="{{ route('laporans_penitipan.index') }}" id="searchForm">
      <div class="search-wrapper d-flex align-items-center rounded px-3 py-1">
        <i class="fas fa-search search-icon ml-3"></i>
        <input
          type="text"
          name="cari"
          class="form-cari text-white"
          placeholder="Cari"
          value="{{ request('cari') }}"
          id="input-cari"
        />
      </div>
    </form>
  </div>
</div>



  <!-- Tabel -->
  <div id="laporan-content" class="px-4">
    <div class="table-responsive">
      <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-primary text-center">
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Anak</th>
            <th>Jenis Layanan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Biaya</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
                  @if ($laporan->count() > 0)
                      @foreach ($laporan as $la)
                          <tr class="text-center">
                              <td class="align-middle">{{ $loop->iteration + ($laporan->currentPage()-1)*$laporan->perPage() }}</td>
                              <td class="align-middle">{{ $la->anak->orangTua->user->name ?? '-' }}</td>
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
  <div class="d-flex justify-content-center mt-3 mb-4">
          @if ($laporan->hasPages())
              {{ $laporan->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
          @else
              {{-- Paksa tampil pagination minimal --}}
              <nav>
                  <ul class="pagination">
                      <li class="page-item active"><span class="page-link">1</span></li>
                  </ul>
              </nav>
        @endif
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let typingTimer;
const debounceDelay = 500;

$('#input-cari').on('input', function () {
  clearTimeout(typingTimer);
  const search = $(this).val();

  typingTimer = setTimeout(() => {
    const params = {
      cari: search,
      tgl_awal: $('input[name="tgl_awal"]').val(),
      tgl_akhir: $('input[name="tgl_akhir"]').val(),
      gender: $('select[name="gender"]').val(),
      service: $('select[name="service"]').val(),
      limit: $('#limitInput').val()
    };

    $.ajax({
      url: "{{ route('laporans_penitipan.index') }}",
      type: "GET",
      data: params,
 success: function (data) {
  const html = $(data).find('#laporan-content').html();
  $('#laporan-content').html(html);

  // Isi kembali nilai form agar tetap tampil
  $('#input-cari').val(params.cari);
  $('input[name="tgl_awal"]').val(params.tgl_awal);
  $('input[name="tgl_akhir"]').val(params.tgl_akhir);
  $('select[name="gender"]').val(params.gender);
  $('select[name="service"]').val(params.service);
  $('#limitInput').val(params.limit);

  // Bind ulang event pagination
  $('#laporan-content').find('.pagination a').on('click', function (e) {
    e.preventDefault();
    const url = new URL($(this).attr('href'));
    const page = url.searchParams.get('page');

    if (page) {
      params.page = page;

      $.ajax({
        url: "{{ route('laporans_penitipan.index') }}",
        type: "GET",
        data: params,
        success: function (data) {
          const html = $(data).find('#laporan-content').html();
          $('#laporan-content').html(html);

          // Isi ulang form
          $('#input-cari').val(params.cari);
          $('input[name="tgl_awal"]').val(params.tgl_awal);
          $('input[name="tgl_akhir"]').val(params.tgl_akhir);
          $('select[name="gender"]').val(params.gender);
          $('select[name="service"]').val(params.service);
          $('#limitInput').val(params.limit);
        },
        error: function () {
          console.error("Gagal load data halaman baru.");
        }
      });
    }
  });
},


});
</script>
@endsection
