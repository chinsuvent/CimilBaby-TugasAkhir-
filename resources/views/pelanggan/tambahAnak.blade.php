@extends('pelanggan.layouts.app')

@section('contents')
    @push('scripts')
    <script>
        @if(session('error'))
            Swal.fire({
                title: 'Gagal',
                text: 'Usia anak harus antara 3 bulan hingga 5 tahun. Silakan periksa kembali tanggal lahir yang dimasukkan.',
                icon: 'error',
            });
        @endif
    </script>
    @endpush

    <h1 class="mb-0 text-title">Tambah Anak</h1>
    <hr>
    <form action="{{ route('anak.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Anak --}}
        <div class="row mb-3">
            <div class="col-6">
                <input type="text" name="nama_anak" class="form-control" placeholder="Nama Anak">
            </div>
        </div>

        {{-- Tempat dan Tanggal Lahir --}}
        <div class="row mb-3">
            <div class="col-3">
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
            </div>
            <div class="col-3">
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="row mb-3">
            <!-- Jenis Kelamin -->
            <div class="col-3">
                <label class="form-label d-block">Jenis Kelamin</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki">
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>

            <!-- Alergi -->
            <div class="col-3">
                <label class="form-label d-block">Alergi</label>
                <input type="text" name="alergi" class="form-control" placeholder="Alergi">
            </div>
        </div>

        {{-- Foto Anak --}}


        {{-- Tombol Kirim --}}
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="submit" class="btn btn-warning mr-3 ml-3">Simpan</button>
                <a href="{{ route('pelanggan.anak') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
@endsection
