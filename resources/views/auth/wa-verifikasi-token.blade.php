@extends('layouts.auth')

@section('content')
<div class="container mt-5">
    <h3>Verifikasi Token WhatsApp</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('wa.verifikasi') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="token">Kode Token</label>
            <input type="text" name="token" class="form-control" required>
        </div>
        <button class="btn btn-success">Verifikasi</button>
    </form>
</div>
@endsection
