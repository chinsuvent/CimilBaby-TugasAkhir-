@extends('pelanggan.layouts.app')

@section('contents')
<div class="container mt-5">
    <h3>Masukkan Token Reset Password</h3>

    @if(session('success'))
        <script>
            Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
        </script>
    @endif

    <form action="{{ url('/verifikasi-token-cari') }}" method="GET">
        <div class="mb-3">
            <label for="token" class="form-label">Token</label>
            <input type="text" name="token" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Verifikasi</button>
    </form>
</div>
@endsection
