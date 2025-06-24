@extends('admin.layouts.app')

@section('contents')
    <h1 class="mb-0 text-title">Edit Reservasi</h1>
    <hr>
    <form action="{{ route('layanans.update', $layanan->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Jenis Layanan</label>
                <input type="text" name="jenis_layanan" class="form-control" placeholder="Jenis Layanan" value="{{ $layanan->jenis_layanan }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Durasi</label>
                <select name="durasi" class="form-control">
                    <option value="1 hari" {{ $layanan->durasi == '1 hari' ? 'selected' : '' }}>1 Hari</option>
                    <option value="1 bulan" {{ $layanan->durasi == '1 bulan' ? 'selected' : '' }}>1 Bulan</option>
                </select>
            </div>
            <div class="col mb-3">
                <label class="form-label">Biaya</label>
                <input type="text" name="biaya" class="form-control" placeholder="Biaya" value="{{ $layanan->biaya }}">
            </div>
        </div>

    

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning ml-3">Simpan</button>
            </div>
        </div>
    </form>
    
@endsection