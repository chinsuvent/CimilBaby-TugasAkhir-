@extends('admin.layouts.app')

@section('contents')
    <div class="row align-items-center">
    <div class="col-md-6 col-12">
        <h1 class="mb-3 text-title">Jadwal Layanan</h1>
    </div>
    <div class="col-md-6 col-12">
        <div class="d-flex justify-content-end">
            {{-- <form method="GET" action="{{ route('jadwal_layanans.index') }}" id="searchForm">
                <div class="search-wrapper d-flex align-items-center">
                    <i class="fas fa-search search-icon me-2"></i>
                    <input
                        type="text"
                        name="cari"
                        class="text-white border-0"
                        placeholder="Cari"
                        value="{{ request('cari') }}"
                        id="searchInput"
                        style="max-width: 300px;"
                    />
                </div>
            </form> --}}
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
                    <th>Hari</th>
                    <th>Jam Layanan</th>
                </tr>
            </thead>
            <tbody>
            @if ($jadwal->count() > 0)
                @foreach ($jadwal as $item)
                    <tr class="text-center">
                        <td class="align-middle">{{ $loop->iteration + ($jadwal->currentPage() - 1) * $jadwal->perPage() }}</td>
                        <td class="align-middle">{{ $item->hari }}</td>
                        <td class="align-middle">{{ $item->jam_layanan }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">Data Jadwal Layanan Tidak Ditemukan</td>
                </tr>
            @endif
        </tbody>

    </table>
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        @if ($jadwal->hasPages())
            {{ $jadwal->links('pagination::bootstrap-5') }}
        @else
            {{-- Paksa tampil pagination minimal --}}
            <nav>
                <ul class="pagination">
                    <li class="page-item active"><span class="page-link">1</span></li>
                </ul>
            </nav>
        @endif
    </div>
@endsection
