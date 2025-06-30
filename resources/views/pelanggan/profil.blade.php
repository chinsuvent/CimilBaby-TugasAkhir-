@extends('pelanggan.layouts.app')

@section('contents')
<div class="container mt-4">
    <h1 class="m-0 text-title text-md-left text-center text-md-h4 mb-3">Profil Pelanggan</h1>
    <form>
        <div class="mb-3 row align-items-center">
            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_lengkap" value="{{ $pelanggan->name ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" value="{{ $pelanggan->username ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="no_hp" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="no_hp" value="{{ $pelanggan->no_hp ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" value="{{ $pelanggan->email ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="alamat" rows="2" readonly>{{ $pelanggan->alamat ?? '-' }}</textarea>
            </div>
        </div>
    </form>
    <div class="mt-4">
        <a href="{{ route('pelanggan.editProfil') }}" class="btn btn-warning">Edit Profil</a>
    </div>

</div>
@endsection
