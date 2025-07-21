@extends('admin.layouts.app')

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
                text: 'Reservasi Berhasil Dikonfirmasi!',
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
            icon: 'success',
            title: 'Pembatalan Berhasil Dikonfirmasi',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
        @endif

        @if (session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: '{{ session('info') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
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
                                    @endif

                                    @if ($rs->pengajuanPembatalan)
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#konfirmasiPembatalanModal{{ $rs->id }}">
                                            Lihat Pembatalan
                                        </button>
                                    @elseif($rs->status != 'Pending')
                                        <span class="text-muted">Sudah dikonfirmasi</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if ($rs->pengajuanPembatalan)
                        <!-- Modal Konfirmasi Pembatalan -->
                        <div class="modal fade" id="konfirmasiPembatalanModal{{ $rs->id }}" tabindex="-1" aria-labelledby="konfirmasiPembatalanModalLabel{{ $rs->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.reservasi.konfirmasiPembatalan', $rs->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Pembatalan</h5>
                                            <button type="button" class="btn ms-auto p-0 border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 6L6 18M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Alasan Pembatalan:</strong></p>
                                            <p>{{ $rs->pengajuanPembatalan->alasan }}</p>
                                            <p>Setujui permintaan pembatalan ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button name="konfirmasi" value="tolak" type="submit" class="btn btn-danger">Tolak</button>
                                            <button name="konfirmasi" value="terima" type="submit" class="btn btn-success">Terima</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endif
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
