@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Tambah Fasilitas</h1>
    <hr>
    <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tempat dan Tanggal Lahir --}}
        <div class="row mb-3">
            <div class="col-6">
                <input type="text" name="nama_fasilitas" class="form-control" placeholder="Nama Fasilitas">
            </div>

        </div>


        <div class="row mb-3">
            <div class="col-6">
                <textarea id="deskripsi" name="deskripsi" rows="4" cols="132" placeholder="Tulis deskripsi di sini..." class="form-control"></textarea>
            </div>
        </div>

       <div class="row mb-3">
            <div class="col">
                <label for="gambar" class="form-label">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            </div>
       </div>



        {{-- Tombol Kirim --}}
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-tambah ml-3">Kirim</button>
            </div>
        </div>
    </form>
@endsection
