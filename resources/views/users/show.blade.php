@extends('layouts.app')

@section('contents')
    <h1 class="mb-0">Detail Pengguna</h1>
    <hr>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_orang_tua" class="form-control" placeholder="Nama Lengkap" value="{{ $pengguna->nama_orang_tua }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $pengguna->username }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $pengguna->password }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="Email" class="form-control" placeholder="Email" value="{{ $pengguna->email }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="No. HP" value="{{ $pengguna->no_hp }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $pengguna->alamat }}" readonly>
        </div>
    </div>
@endsection