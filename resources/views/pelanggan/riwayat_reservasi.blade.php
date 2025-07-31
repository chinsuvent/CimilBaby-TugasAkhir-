@extends('pelanggan.layouts.app')

@section('contents')
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Data Reservasi</h1>
    </div>
    <div class="mt-2 d-flex flex-wrap gap-3">
        <button type="button" class="btn btn-tambah mr-3"
            data-bs-toggle="modal"
            data-bs-target="#reservasiModal"
            data-layanan="Harian"
            data-biaya="{{ $layanans['Harian']->biaya }}">
            Buat Reservasi Harian
        </button>

        <button type="button" class="btn btn-success mr-3"
            data-bs-toggle="modal"
            data-bs-target="#reservasiModal"
            data-layanan="Bulanan"
            data-biaya="{{ $layanans['Bulanan']->biaya }}">
            Buat Reservasi Bulanan
        </button>

        <button type="button" class="btn btn-warning text-white"
            data-bs-toggle="modal"
            data-bs-target="#reservasiModal"
            data-layanan="Khusus"
            data-biaya="{{ $layanans['Khusus']->biaya }}">
            Buat Reservasi Khusus
        </button>
    </div>


    <hr />

    {{-- @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}


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

        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: 'Reservasi Gagal Dibuat. Reservasi Hanya Bisa Dilakukan Satu Kali.',
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
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
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
                        @php
                            $now = \Carbon\Carbon::now();
                            $masuk = \Carbon\Carbon::parse($rs->tgl_masuk);
                            $keluar = \Carbon\Carbon::parse($rs->tgl_keluar);
                            $isBelumSelesai = $keluar->gte($now); // jika tgl_keluar >= hari ini
                        @endphp

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
                                    @if ($rs->status === 'Selesai')
                                        <span class="text-muted">Reservasi Selesai</span>
                                    @elseif ($rs->status == 'Pending')
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
                                        @if (!$rs->pengajuanPembatalan && $isBelumSelesai)
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalBatal{{ $rs->id }}">
                                                Ajukan Pembatalan
                                            </button>
                                        @elseif ($rs->pengajuanPembatalan && $rs->pengajuanPembatalan->status == 'Menunggu')
                                            <span class="text-muted">Menunggu<br> Konfirmasi <br>Admin</span>
                                        @elseif ($rs->pengajuanPembatalan && $rs->pengajuanPembatalan->status == 'Ditolak')
                                            <span class="tetx-muted">Pengajuan Ditolak</span>
                                        @elseif ($rs->pengajuanPembatalan && $rs->pengajuanPembatalan->status == 'Disetujui')
                                            <span class="text-muted">Pembatalan Disetujui</span>
                                        @else
                                            <span class="text-muted">Reservasi Aktif</span>
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
    @if ($rs->status == 'Diterima' && !$rs->pembatalan && (\Carbon\Carbon::parse($rs->tgl_keluar)->gte(\Carbon\Carbon::today())))

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

        @auth
           <!-- Modal Reservasi -->
            <div class="modal fade" id="reservasiModal" tabindex="-1" aria-labelledby="reservasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4" style="background-color: #C9A7F3; color: white;">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center fw-bold text-white" id="modalReservasiLabel">Form Reservasi</h5>
                    <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal" aria-label="Tutup">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M18 6L6 18M6 6l12 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Nama Lengkap"
                            value="{{ auth()->user()->name }}" readonly required>
                    </div>
                    <div class="mb-3">
                        <select name="anaks_id" class="form-control rounded-3" required >
                        <option value="">Pilih Anak</option>
                       @if (!empty($anakUser) && count($anakUser) > 0)
                            @foreach ($anakUser as $anak)
                                <option value="{{ $anak->id }}">{{ $anak->nama_anak }}</option>
                            @endforeach
                        @else
                            <option disabled>Tidak ada data anak</option>
                        @endif

                        </select>

                    </div>
                    <div class="mb-3">
                        <input type="text" name="jenis_layanan" id="jenisLayananInput" class="form-control rounded-3" placeholder="Jenis Layanan" readonly required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control rounded-3" placeholder="Tanggal Masuk" required>
                        </div>
                        <div class="col">
                            <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control rounded-3" placeholder="Tanggal Keluar" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="biaya" id="biayaInput" class="form-control rounded-3" placeholder="Biaya" readonly required>
                    </div>
                    <div class="mb-3">
                        <select name="metode_pembayaran" class="form-control rounded-3" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn w-100 rounded-pill" style="background-color: #9672F3; color: white;">Buat Reservasi</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            @endauth


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


    document.addEventListener('DOMContentLoaded', function () {
        let selectedLayanan = "";

        // === Bagian 1: Isi layanan dan biaya dari tombol ===
        document.querySelectorAll('button[data-bs-target="#reservasiModal"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const layanan = btn.getAttribute('data-layanan');
                const biaya = btn.getAttribute('data-biaya');

                selectedLayanan = layanan?.toLowerCase() ?? '';

                document.getElementById('jenisLayananInput').value = layanan ?? '';
                document.getElementById('biayaInput').value = biaya ? formatRupiah(biaya) : '';
            });
        });

        const tglMasukInput = document.querySelector('input[name="tgl_masuk"]');
        const tglKeluarInput = document.querySelector('input[name="tgl_keluar"]');

        if (tglMasukInput) {
            const today = new Date().toISOString().split('T')[0];
            tglMasukInput.setAttribute('min', today);
        }

        if (tglKeluarInput) {
            tglKeluarInput.setAttribute('readonly', true);
            tglKeluarInput.addEventListener('keydown', function (e) {
                e.preventDefault(); // Mencegah input via keyboard
            });
            tglKeluarInput.addEventListener('paste', function (e) {
                e.preventDefault(); // Mencegah input via paste
            });
        }


        // Fungsi Format Rupiah
        function formatRupiah(angka) {
            angka = parseInt(angka);
            let numberString = angka.toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return 'Rp. ' + rupiah;
        }

        // Ambil data tanggal merah dari API
        async function getTanggalMerah(year) {
            try {
                const response = await fetch(`https://api-harilibur.vercel.app/api?year=${year}`);
                return response.ok ? await response.json() : [];
            } catch (err) {
                console.error("Gagal memuat tanggal merah:", err);
                return [];
            }
        }

        function isTanggalMerah(dateStr, liburList) {
            return liburList.some(item => item.holiday_date === dateStr);
        }

        function isWeekendOrHoliday(date, tanggalMerahList) {
            const day = date.getDay();
            const dateStr = date.toISOString().split('T')[0];
            return day === 6 || day === 0 || isTanggalMerah(dateStr, tanggalMerahList);
        }

        (async () => {
            const tahunIni = new Date().getFullYear();
            const tanggalMerahList = await getTanggalMerah(tahunIni);

            if (tglMasukInput && tglKeluarInput) {
               tglMasukInput.addEventListener("change", function () {
    const masukDate = new Date(this.value);
    if (isNaN(masukDate)) return;

    // ❌ Tidak boleh Sabtu/Minggu untuk layanan harian dan bulanan
    if (selectedLayanan === "harian" || selectedLayanan === "bulanan") {
        const day = masukDate.getDay();
        if (day === 0 || day === 6) {
            Swal.fire({
                title: 'Tanggal Tidak Valid',
                text: 'Layanan harian dan bulanan tidak tersedia pada hari Sabtu atau Minggu.',
                icon: 'warning',
                toast: true,
                position: 'top',
                confirmButtonText: 'OK',
                showConfirmButton: true,
                customClass: {
                    popup: 'small-swal'
                }
            });
            this.value = "";
            tglKeluarInput.value = "";
            return;
        }
    }

    if (selectedLayanan === "bulanan") {
        let keluarDate = new Date(masukDate);
        keluarDate.setDate(keluarDate.getDate() + 30);
        const year = keluarDate.getFullYear();
        const month = String(keluarDate.getMonth() + 1).padStart(2, '0');
        const day = String(keluarDate.getDate()).padStart(2, '0');
        tglKeluarInput.value = `${year}-${month}-${day}`;
    } else if (selectedLayanan === "harian") {
        tglKeluarInput.value = this.value;
        tglKeluarInput.setAttribute('readonly', true);
    } else if (selectedLayanan === "khusus") {
        if (!isWeekendOrHoliday(masukDate, tanggalMerahList)) {
            Swal.fire({
                title: 'Tanggal Tidak Valid',
                text: 'Tanggal masuk untuk layanan khusus hanya boleh hari Sabtu, Minggu, atau tanggal merah.',
                icon: 'warning',
                toast: true,
                position: 'top',
                confirmButtonText: 'OK',
                showConfirmButton: true,
                customClass: {
                    popup: 'small-swal'
                }
            });
            this.value = "";
            tglKeluarInput.value = "";
            return;
        }

        const year = masukDate.getFullYear();
        const month = String(masukDate.getMonth() + 1).padStart(2, '0');
        const day = String(masukDate.getDate()).padStart(2, '0');
        tglKeluarInput.value = `${year}-${month}-${day}`;
    }
});

                tglKeluarInput.addEventListener("input", function () {
                    const keluarDate = new Date(this.value);
                    if (selectedLayanan === "khusus" && !isWeekendOrHoliday(keluarDate, tanggalMerahList)) {
                        Swal.fire({
                            title: 'Tanggal Tidak Valid',
                            text: 'Tanggal keluar untuk layanan khusus hanya boleh hari Sabtu, Minggu, atau tanggal merah.',
                            icon: 'warning',
                            toast: true,
                            position: 'top',
                            confirmButtonText: 'OK',
                            showConfirmButton: true,
                            customClass: {
                                popup: 'small-swal'
                            }
                        });
                        this.value = "";
                    }
                });
            }
        })();
    });

    const modalElement = document.getElementById('reservasiModal');
    if (modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function () {
    modalElement.querySelectorAll('input, select, textarea').forEach(function (input) {
        const name = input.getAttribute('name');
        if (name !== 'name') { // jangan reset field nama
            input.value = '';
            input.removeAttribute('readonly');
        }
    });
});

    }






</script>
@endpush

