@extends('pelanggan.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Pengguna</h1>
    <hr>
    <form action="{{ route('pelanggan.updateProfil', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_orang_tua" class="form-control" placeholder="Nama Lengkap" value="{{ $user->name }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="No. HP" value="{{ $orangTua->no_hp }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $orangTua->alamat }}">
            </div>
        </div>


        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end px-3">
                <button type="submit" class="btn btn-warning  mr-3">Simpan</button>
            <a href="{{ route('pelanggan.profil') }}" class="btn btn-danger">Batal</a>

            </div>
        </div>
    </form>

@endsection
