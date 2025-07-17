@extends('layouts.auth')

@section('content')
<div class="container mt-5">
    <h3>Lupa Password (Verifikasi WhatsApp)</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('wa.kirim.token') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="no_hp">Nomor WhatsApp</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
        </div>
        <button class="btn btn-primary">Kirim Token ke WhatsApp</button>
    </form>
</div>
@endsection
