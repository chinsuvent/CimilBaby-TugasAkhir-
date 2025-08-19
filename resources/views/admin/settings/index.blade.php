@extends('admin.layouts.app')

@section('contents')
<div class="container mt-4">
    <h4>Ubah Nomor WhatsApp Admin</h4>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <div class="col-6 mb-3">
            <label for="number" class="form-label">Nomor WhatsApp</label>
            <input type="text" id="number" name="number" value="{{ $setting->value ?? '' }}" class="form-control" required>
        </div>

        <div class="col-6">
            <button type="submit" class="btn btn-simpan" style="background-color: #8e7dbe; color: white;">Simpan</button>
        </div>
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
