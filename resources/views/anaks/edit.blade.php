@extends('layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Pengguna</h1>
    <hr>
    <form action="{{ route('anaks.update', $anak->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama Anak</label>
                <input type="text" name="nama_anak" class="form-control" placeholder="Nama Anak" value="{{ $anak->nama_anak }}">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $anak->tempat_lahir }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ $anak->tanggal_lahir }}">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" {{ $anak->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" {{ $anak->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>
            <div class="col mb-3">
                <label class="form-label">Usia</label>
                <input type="number" name="usia" class="form-control" placeholder="Usia" value="{{ $anak->usia }}">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Alergi</label>
                <input type="text" name="alergi" class="form-control" placeholder="Alergi" value="{{ $anak->alergi }}">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning ml-3">Simpan</button>
            </div>
        </div>
    </form>
@endsection
