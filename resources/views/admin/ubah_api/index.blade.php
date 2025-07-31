@extends('admin.layouts.app')

@section('contents')
<div class="container mt-4">
    <h4>Ubah Pengaturan WhatsApp</h4>

    <form action="{{ route('admin.whatsapp.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="number" class="form-label">Nomor WhatsApp</label>
            <input type="text" id="number" name="number" value="{{ $config->display_number ?? '' }}" class="form-control" required>

        </div>

        <div class="mb-3">
            <label for="api_key" class="form-label">API Key Fonnte</label>
            <input type="text" id="api_key" name="api_key" value="{{ $config->api_key ?? '' }}" class="form-control" required>
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
