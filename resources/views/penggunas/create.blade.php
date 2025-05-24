@extends('layouts.app')

@section('contents')
    <h1 class="mb-0">Tambah Pengguna</h1>
    <hr>
    <form action="{{ route('penggunas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nama_orang_tua" class="form-control" placeholder="Nama Lengkap">
            </div>
            <div class="col">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="col">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="no_hp" class="form-control" placeholder="No. HP">
            </div>
            <div class="col">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary ml-3">Kirim</button>
            </div>
        </div>
    </form>
@endsection