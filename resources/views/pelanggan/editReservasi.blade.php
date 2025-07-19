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
            <div class="mb-3">
                <label class="form-label" for="anak">Nama Anak</label>
                <input type="text" class="form-control" value="{{ $reservasi->anak->nama_anak }}" readonly>
            </div>

            <!-- Jenis Layanan -->
            <div class="mb-3">
                <label class="form-label" for="layanans_id">Jenis Layanan</label>
                <select name="layanans_id" class="form-select" required>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}" {{ $reservasi->layanans_id == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->jenis_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-3">
                <label class="form-label" for="tgl_masuk">Tanggal Masuk</label>
                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', $reservasi->tgl_masuk->format('Y-m-d')) }}" required>
            </div>

            <!-- Tanggal Keluar -->
            <div class="mb-3">
                <label class="form-label" for="tgl_keluar">Tanggal Keluar</label>
                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $reservasi->tgl_keluar->format('Y-m-d')) }}" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label class="form-label" for="metode_pembayaran">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="cash" {{ $reservasi->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ $reservasi->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-warning mr-3">Simpan Perubahan</button>
                <a href="{{ route('pelanggan.reservasi') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
