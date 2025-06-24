@extends('admin.layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Data Anak</h1>
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
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Nama Orang Tua</th>
                    <th>No. HP</th>
                    <th>Alergi</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @if ($anak->count() > 0)
                    @foreach ($anak as $an)
                        <tr class="text-center">
                            <td class="align-middle">{{ $loop->iteration + ($anak->currentPage()-1)*$anak->perPage() }}</td>
                            <td class="align-middle">{{ $an->nama_anak }}</td>
                            <td class="align-middle">{{ $an->tempat_lahir }}</td>
                            <td class="align-middle">{{ $an->tanggal_lahir }}</td>
                            <td class="align-middle">{{ $an->jenis_kelamin }}</td>
                            <td class="align-middle">{{ $an->hitungUsia() }}</td>
                            <td class="align-middle">{{ $an->pengguna->name ?? '-' }}</td> 
                            <td class="align-middle">{{ $an->pengguna->no_hp ?? '-' }}</td> 
                            <td class="align-middle">{{ $an->alergi }}</td>
                        </tr>
                    @endforeach
                @else
                        <tr>
                            <td class="text-center" colspan="8">Data Tidak Ditemukan</td>
                        </tr>
                @endif
            </tbody>
        </table>  
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        @if ($anak->hasPages())
            {{ $anak->links('pagination::bootstrap-5') }}
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