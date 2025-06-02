@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Jadwal Layanan</h1>
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
            @if ($jadwal_layanan->count() > 0)
                @foreach ($jadwal_layanan as $jadwal)
                    <tr class="text-center">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $jadwal->anak->nama_anak ?? '-' }}</td>
                        <td class="align-middle">{{ $jadwal->layanan->jenis_layanan ?? '-' }}</td>
                        {{-- <td class="align-middle">
                            @forelse ($jadwal->reservasi ?? [] as $reservasi)
                                {{ \Carbon\Carbon::parse($reservasi->tgl_masuk)->format('d-m-Y') }}<br>
                            @empty
                                -
                            @endforelse
                        </td> --}}
                        

                        
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