@extends('layouts.auth')

@section('content')
<div class="container mt-5">
    <h3>Reset Password Baru</h3>

    <form action="{{ route('wa.reset.password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan Password</button>
    </form>
</div>
@endsection
