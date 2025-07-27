@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Fasilitas</h1>
    <hr>
    <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" class="form-control" placeholder="Nama Fasilitas" value="{{ $fasilitas->nama_fasilitas}}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="2" cols="132" placeholder="Tulis deskripsi di sini..." class="form-control">{{ $fasilitas->deskripsi }}</textarea>
            </div>
        </div>
        <div class="row">
        <div class="col mb-3">
            <label for="gambar" class="form-label">Gambar Fasilitas</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg,.png">

            @if ($fasilitas->gambar)
                <div class="mt-2">
                    <p class="mb-1">Gambar Saat Ini:</p>
                    <img src="{{ asset('uploads/fasilitas/' . $fasilitas->gambar) }}" alt="Gambar Fasilitas" style="max-width: 150px; border-radius: 8px;">
                </div>
            @endif
        </div>
    </div>


    

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning mr-3 ml-3">Simpan</button>
                <a href="{{ route('fasilitas') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>
    
@endsection