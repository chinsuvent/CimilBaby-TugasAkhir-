@extends('pelanggan.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Reservasi</h1>
    <hr>

    <form action="{{ route('pelanggan.edit', $reservasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror"
                   value="{{ old('tgl_masuk', $reservasi->tgl_masuk) }}">
            @error('tgl_masuk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Keluar</label>
            <input type="date" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror"
                   value="{{ old('tgl_keluar', $reservasi->tgl_keluar) }}">
            @error('tgl_keluar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror">
                <option value="">Pilih Metode</option>
                <option value="transfer" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="tunai" {{ old('metode_pembayaran', $reservasi->metode_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                <!-- Tambahkan opsi lain jika ada -->
            </select>
            @error('metode_pembayaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            <a href="{{ route('pelanggan.reservasi') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
