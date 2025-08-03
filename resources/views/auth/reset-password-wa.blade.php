@extends('pelanggan.layouts.app')

@section('contents')
<div class="container">
    <h3>Ubah Password</h3>

    {{-- Tampilkan pesan sukses --}}
    @if (session('ubahPassword'))
        <div class="alert alert-success">
            {{ session('ubahPassword') }}
        </div>
    @endif

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ubah-password') }}">
        @csrf

        <div class="mb-3">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
