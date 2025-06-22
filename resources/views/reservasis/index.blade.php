@extends('layouts.app')

@section('contents')
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Data Reservasi</h1>
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
                    <th>Jenis Kelamin</th>
                    {{-- <th>Usia</th> --}}
                    <th>Nama Orang Tua</th>
                    <th>Jenis Layanan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Durasi</th>
                    <th>Total</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($reservasi->count() > 0)
                    @foreach ($reservasi as $rs)
                        <tr class="text-center">
                            <td class="align-middle">{{ $loop->iteration + ($reservasi->currentPage()-1)*$reservasi->perPage() }}</td>
                            <td class="align-middle">{{ $rs->anak->nama_anak ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->anak->jenis_kelamin ?? '-' }}</td>
                            {{-- <td class="align-middle">{{ $rs->anak->usia ?? '-' }}</td> --}}
                            <td class="align-middle">{{ $rs->pengguna->name ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->layanan->jenis_layanan ?? '-' }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_masuk)->format('d-m-Y') }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_keluar)->format('d-m-Y') }}</td>
                            <td class="align-middle">{{ $rs->hitungDurasi() }}</td>
                            <td class="align-middle">{{ $rs->layanan->biaya ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->metode_pembayaran }}</td>
                            <td class="align-middle">{{ $rs->status }}</td>
                            <td class="align-middle">
                                @if ($rs->status == 'Pending')
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('reservasis.konfirmasi', $rs->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Diterima">
                                            <button type="submit" class="btn btn-success btn-sm mr-2">Terima</button>
                                        </form>

                                        <form action="{{ route('reservasis.konfirmasi', $rs->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">Sudah dikonfirmasi</span>
                                @endif
                            </td>

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
    <div class="d-flex justify-content-center mt-3 mb-4">
            @if ($reservasi->hasPages())
                {{ $reservasi->links('pagination::bootstrap-5') }}
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