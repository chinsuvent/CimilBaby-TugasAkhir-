@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Pengguna</h1>
    <hr>
    <form action="{{ route('users.update', $pengguna->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_orang_tua" class="form-control" placeholder="Nama Lengkap" value="{{ $pengguna->nama_orang_tua }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $pengguna->username }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $pengguna->password }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $pengguna->email }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="No. HP" value="{{ $pengguna->no_hp }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $pengguna->alamat }}">
            </div>
        </div>
    

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning ml-3">Simpan</button>
            </div>
        </div>
    </form>
    
@endsection