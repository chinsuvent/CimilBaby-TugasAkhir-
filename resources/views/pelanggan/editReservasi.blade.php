@extends('pelanggan.layouts.app')

@section('contents')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1 class="mb-4 text-title">Edit Reservasi</h1>
    <div class="card p-4 shadow-sm">
        <form action="{{ route('pelanggan.update', $reservasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Anak -->
            <div class="col-6 mb-3">
                <label class="form-label" for="anak">Nama Anak</label>
                <input type="text" class="form-control" value="{{ $reservasi->anak->nama_anak }}" readonly>
            </div>

            <!-- Jenis Layanan -->
            <div class="col-6 mb-3">
                <label class="form-label" for="layanans_id">Jenis Layanan</label>
                <select name="layanans_id" class="form-select" disabled>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}" {{ $reservasi->layanans_id == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->jenis_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex">
            <!-- Tanggal Masuk -->
            <div class="col-3 mb-3">
                <label class="form-label" for="tgl_masuk">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', $reservasi->tgl_masuk->format('Y-m-d')) }}" required>
            </div>

                 <!-- Tanggal Keluar -->
            <div class="col-3 mb-3">
                 <label class="form-label" for="tgl_keluar">Tanggal Keluar</label>
                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $reservasi->tgl_keluar->format('Y-m-d')) }}" required>
            </div>
        </div>



            <!-- Metode Pembayaran -->
            <div class="col-6 mb-4">
                <label class="form-label" for="metode_pembayaran">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="cash" {{ $reservasi->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ $reservasi->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="submit" class="btn btn-warning mr-3">Simpan Perubahan</button>
                <a href="{{ route('pelanggan.reservasi') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
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
