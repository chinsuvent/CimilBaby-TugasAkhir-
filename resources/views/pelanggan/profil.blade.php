@extends('pelanggan.layouts.app')



@section('contents')

    @push('scripts')
    <script>

        @if (session('edited'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Profil Berhasil Diubah',
                icon: 'success'
            });
        @endif


        @if (session('ubah_password'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Password Berhasil Diubah',
                confirmButtonColor: '#9672F3',
            });
        @endif

        @if (session('cancel'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Reservasi Berhasil Dibatalkan',
                confirmButtonColor: '#9672F3',
            });
        @endif

        @if (session('batal'))
            Swal.fire({
                title: 'Sukses!',
                text: 'Pengajuan Pembatalan Berhasil Dikirim. Silahkan Menunggu Konfirmasi Admin',
                confirmButtonColor: '#9672F3',
            });
        @endif


        // Harus tetap dimuat selalu
        function hapus(button) {
            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
                text: 'Data Akan Benar Benar Terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });


        }
    </script>

    @endpush


<div class="container mt-4">
    <h1 class="m-0 text-title text-md-left text-center text-md-h4 mb-3">Profil Pelanggan</h1>
    <form>
        <div class="mb-3 row align-items-center">
            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_lengkap" value="{{ $user->name ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" value="{{ $user->username ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="no_hp" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="no_hp" value="{{ $pelanggan->no_hp ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" value="{{ $user->email ?? '-' }}" readonly>
            </div>
        </div>

        <div class="mb-3 row align-items-center">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="alamat" rows="2" readonly>{{ $pelanggan->alamat ?? '-' }}</textarea>
            </div>
        </div>
    </form>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('pelanggan.editProfil') }}" class="btn btn-warning mr-3">Edit Profil</a>

        {{-- Tombol ubah password --}}
        <a href="{{ url('/ubah-password') }}" class="btn btn-danger">Ubah Password</a>
    </div>
</div>
@endsection
