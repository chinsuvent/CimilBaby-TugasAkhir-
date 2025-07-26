@extends('admin.layouts.app')

@section('contents')
<div class="container mt-4">
    <h4>Ubah Nomor WhatsApp Admin</h4>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="number" class="form-label">Nomor WhatsApp</label>
            <input type="text" id="number" name="number" value="{{ $setting->value ?? '' }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('scripts')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
