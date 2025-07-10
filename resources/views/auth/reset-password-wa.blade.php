@extends('pelanggan.layouts.app')

@section('contents')
<div class="container">
    <h3>Ubah Password</h3>
    <form method="POST" action="/ubah-password">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
