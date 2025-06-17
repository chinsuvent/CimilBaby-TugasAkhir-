@extends('layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Tambah Layanan</h1>
    <hr>
    <form action="{{ route('layanans.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tempat dan Tanggal Lahir --}}
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="jenis_layanan" class="form-control" placeholder="Jenis Layanan">
            </div>
            
        </div>


        <div class="row mb-3">
            {{-- <div class="col">
                <select name="durasi" class="form-control" required>
                    <option value="" disabled selected>Pilih Durasi</option>
                    <option value="1 hari">1 Hari</option>
                    <option value="1 bulan">1 Bulan</option>
                </select>
            </div> --}}
            <div class="col">
                <input type="number" name="biaya" class="form-control" placeholder="Biaya" required>
            </div>
        </div>

        {{-- Pilih Fasilitas --}}
        <div class="mb-3">
            <label class="form-label">Pilih Fasilitas</label>
            <div class="row">
                @foreach($fasilitas as $f)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}" class="form-check-input" id="fasilitas{{ $f->id }}">
                            <label class="form-check-label" for="fasilitas{{ $f->id }}">{{ $f->nama_fasilitas }}</label>
                        </div>
                    </div>
                @endforeach
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
