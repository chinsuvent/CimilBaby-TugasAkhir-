@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajukan Pembatalan Reservasi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pengajuan.store') }}" method="POST">
        @csrf

        <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Pembatalan</label>
            <textarea name="alasan" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger">Ajukan Pembatalan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
