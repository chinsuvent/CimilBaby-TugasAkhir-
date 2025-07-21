@extends('pelanggan.layouts.app')

@section('contents')
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Data Reservasi</h1>
    </div>
    <hr />

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


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

        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Reservasi Berhasil Dibuat!',
                confirmButtonColor: '#9672F3',
            });
        @endif

        @if (session('cancel'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Reservasi Berhasil Dibatalkan',
                confirmButtonColor: '#9672F3',
            });
        @endif

        @if (session('batal'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Pengajuan Pembatalan Berhasil Dikirim. Silahkan Menunggu Konfirmasi Admin',
                confirmButtonColor: '#9672F3',
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
                    {{-- <th>Durasi</th> --}}
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
                            <td class="align-middle">{{ $rs->anak->orangTua->user->name ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->layanan->jenis_layanan ?? '-' }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_masuk)->format('d-m-Y') }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_keluar)->format('d-m-Y') }}</td>
                            {{-- <td class="align-middle">{{ $rs->hitungDurasi() }}</td> --}}
                            <td class="align-middle">{{ $rs->layanan->biaya ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->metode_pembayaran }}</td>
                            <td class="align-middle">{{ $rs->status }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($rs->status == 'Pending')
                                        <a href="{{ route('pelanggan.edit', $rs->id) }}" class="btn btn-warning d-flex align-items-center justify-content-center" title="Edit" style="margin-right: 0.5rem;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path fill="#fff" d="m21.561 5.318l-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672L9.328 12.5l6.293-6.293l2.172 2.172zm-2.561-1.339l1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289c-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29c.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293l2.171 2.172z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pelanggan.cancel', $rs->id) }}" method="POST" onsubmit="event.preventDefault(); batalReservasi(this);">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" title="Batalkan Reservasi" onclick="batalReservasi(this)">
                                                <i class="bi bi-x-circle"></i>Batal
                                            </button>
                                        </form>
                                    @elseif ($rs->status == 'Diterima')
                                        {{-- Tombol Ajukan Pembatalan --}}
                                        @if (!$rs->pembatalan) {{-- Cegah dobel ajukan --}}
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalBatal{{ $rs->id }}">
                                                Ajukan Pembatalan
                                            </button>
                                        @else
                                            <span class="text-muted">Menunggu Konfirmasi Pembatalan</span>
                                        @endif

                                    @elseif ($rs->status == 'Dibatalkan')
                                        @if ($rs->pembatalan && $rs->pembatalan->status == 'Disetujui')
                                            <span class="text-danger">Dibatalkan (Disetujui Admin)</span>
                                        @elseif ($rs->pembatalan && $rs->pembatalan->status == 'Ditolak')
                                            <span class="text-warning">Pengajuan Dibatalkan (Ditolak Admin)</span>
                                        @else
                                            <span class="text-muted">Reservasi Dibatalkan</span>
                                        @endif
                                    @endif
                                </div>
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
        @foreach ($reservasi as $rs)
    @if ($rs->status == 'Diterima' && !$rs->pembatalan)
        <!-- Modal Ajukan Pembatalan -->
        <div class="modal fade" id="modalBatal{{ $rs->id }}" tabindex="-1" aria-labelledby="modalBatalLabel{{ $rs->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('pelanggan.ajukanPembatalan', $rs->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajukan Pembatalan</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="border:none; background:transparent;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan Pembatalan</label>
                                <textarea name="alasan" class="form-control" required rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Kirim Pengajuan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endforeach

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
@push('scripts')
<script>
function batalReservasi(button) {
    Swal.fire({
        title: 'Batalkan Reservasi?',
        text: 'Reservasi akan dibatalkan jika Anda melanjutkan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit();
        }
    });
}
</script>
@endpush

