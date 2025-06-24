@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Tambah Anak</h1>
    <hr>
    <form action="{{ route('anaks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Anak --}}
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nama_anak" class="form-control" placeholder="Nama Anak">
            </div>
        </div>

        {{-- Tempat dan Tanggal Lahir --}}
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
            </div>
            <div class="col">
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
            </div>
        </div>

        {{-- Jenis Kelamin dan Usia --}}
        <div class="row mb-3">
            <div class="col">
                <label class="form-label d-block">Jenis Kelamin</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki">
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="col">
                <input type="number" name="usia" class="form-control" placeholder="Usia">
            </div>
        </div>

        {{-- Alergi dan Alamat --}}
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="alergi" class="form-control" placeholder="Alergi">
            </div>
        </div>

        {{-- Tombol Kirim --}}
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary ml-3">Kirim</button>
            </div>
        </div>
    </form>
@endsection
