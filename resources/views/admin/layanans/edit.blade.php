@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Layanan</h1>
    <hr>
    <form action="{{ route('layanans.update', $layanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label">Jenis Layanan</label>
                <input type="text" name="jenis_layanan" class="form-control" placeholder="Jenis Layanan" value="{{ $layanan->jenis_layanan }}">
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label">Biaya</label>
                <input type="text" name="biaya" class="form-control" placeholder="Biaya" value="{{ $layanan->biaya }}">
            </div>
        </div>

        {{-- Pilih Fasilitas --}}
        <div class="mb-3">
            <label class="form-label">Pilih Fasilitas</label>
            <div class="row">
                @foreach($fasilitas as $f)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                name="fasilitas[]"
                                value="{{ $f->id }}"
                                class="form-check-input"
                                id="fasilitas{{ $f->id }}"
                                {{ $layanan->fasilitas->contains($f->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="fasilitas{{ $f->id }}">{{ $f->nama_fasilitas }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning mr-3 ml-3">Simpan</button>
                    <a href="{{ route('layanans') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
@endsection
