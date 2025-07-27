@extends('admin.layouts.app')

@section('contents')
<div class="container mt-4">
    <h2>Tambah Jadwal Layanan</h2>
    <form action="{{ route('jadwal_layanans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <input type="text" class="form-control" name="hari" id="hari" required>
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required>
        </div>
        <button type="submit" class="btn btn-warning mr-3">Simpan</button>
        <a href="{{ route('jadwal_layanans') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
