@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Jadwal Layanan</h1>
        <a href="{{ route('jadwal_layanans.generateJadwal') }}" class="btn btn-primary">Generate Jadwal</a>
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

<table class="table table-bordered table-striped mt-3">
    <thead class="table-secondary text-center">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kapasitas</th>
            <th>Terisi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if ($jadwal_layanan->count() > 0)
            @foreach ($jadwal_layanan as $jadwal)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $jadwal->kapasitas }}</td>
                    <td>{{ $jadwal->terisi }}</td>
                    <td>
                        @if ($jadwal->status == 'Tersedia')
                            <span class="badge bg-success text-white">{{ $jadwal->status }}</span>
                        @else
                            <span class="badge bg-danger text-white">{{ $jadwal->status }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Belum ada jadwal layanan</td>
            </tr>
        @endif
    </tbody>
</table>

@endsection