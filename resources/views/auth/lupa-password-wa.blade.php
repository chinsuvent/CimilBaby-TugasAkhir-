@extends('pelanggan.layouts.app')

@section('contents')
<div class="container mt-5">
    <h3>Ubah Password</h3>

    <form action="{{ url('/kirim-token') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor WhatsApp</label>
            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Token</button>
    </form>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
