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
            <div class="col">
                <select name="durasi" class="form-control" required>
                    <option value="" disabled selected>Pilih Durasi</option>
                    <option value="1 hari">1 Hari</option>
                    <option value="1 bulan">1 Bulan</option>
                </select>
            </div>
            <div class="col">
                <input type="number" name="biaya" class="form-control" placeholder="Biaya" required>
            </div>
        </div>


        {{-- Tombol Kirim --}}
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary ml-3">Kirim</button>
            </div>
        </div>
    </form>
@endsection
