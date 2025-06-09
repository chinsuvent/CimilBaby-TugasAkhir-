@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Jadwal Layanan</h1>
        <div class="d-flex justify-content-end mb-3">
            <div class="col-12 d-flex justify-content-end">
                <form method="GET" action="{{ route('jadwal_layanans.index') }}" id="searchForm">
                    <div class="search-wrapper d-flex align-items-center">
                        <i class="fas fa-search search-icon me-2"></i>
                        <input 
                            type="text" 
                            name="cari" 
                            class="text-white border-0" 
                            placeholder="Cari"
                            value="{{ request('cari') }}"
                            id="searchInput"
                            style="width: 300px;"
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>


    <hr />

    @push('scripts')
    <script>
        @if (session('added'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Ditambahkan',
                icon: 'success'
            });
        @endif

        @if (session('edited'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Diubah',
                icon: 'success'
            });
        @endif

        @if (session('generated'))
            Swal.fire({
                title: 'Jadwal Berhasil Dibuat',
                text: 'Jadwal layanan berhasil digenerate',
                icon: 'success'
            });
        @endif

        @if (session('deleted'))
            Swal.fire({
                title: 'Hapus',
                text: 'Data Berhasil Dihapus',
                icon: 'success'
            });
        @endif


        // Harus tetap dimuat selalu
        function hapus(button) {
            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
                text: 'Data Akan Benar Benar Terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
    @endpush
    

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Jenis Layanan</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
        <tbody>
            @if ($reservasi->count() > 0)
                @foreach ($reservasi as $jadwal)
                    <tr class="text-center">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $jadwal->anak->nama_anak ?? '-' }}</td>
                        <td class="align-middle">{{ $jadwal->layanan->jenis_layanan ?? '-' }}</td>
                        <td class="align-middle">{{ $jadwal->tgl_masuk ? \Carbon\Carbon::parse($jadwal->tgl_masuk)->format('d-m-Y') : '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
            </tr>
        @endif
        </tbody>
    </table>
    </div>

@endsection