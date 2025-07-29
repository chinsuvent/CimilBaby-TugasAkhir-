@extends('layouts.app')

@section('contents')
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    @foreach ($fasilitas as $item)
    <div class="row align-items-center mb-5">
      @if ($loop->iteration % 2 == 0)
        {{-- Genap: gambar kanan, teks kiri --}}
        <div class="col-lg-6 d-flex align-items-center justify-content-center flex-column text-center">
            <h1 class="hero-title mb-4 text-white">{{ $item->nama_fasilitas }}</h1>
            <p class="description mb-4 text-white">{{ $item->deskripsi }}</p>
        </div>
         {{-- Gambar Fasilitas --}}

        <div class="col-lg-6">
          <div class="hero-image">
            <img src="{{ asset('uploads/fasilitas/' . $item->gambar) }}" alt="Gambar Fasilitas" class="img-fluid" loading="lazy">
          </div>
        </div>
      @else
        {{-- Ganjil: gambar kiri, teks kanan --}}
        <div class="col-lg-6">
          <div class="hero-image">
            <img src="{{ asset('uploads/fasilitas/' . $item->gambar) }}" alt="Gambar Fasilitas" class="img-fluid" loading="lazy">
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-center flex-column text-center">
            <h1 class="hero-title mb-4 text-white">{{ $item->nama_fasilitas }}</h1>
            <p class="description mb-4 text-white">{{ $item->deskripsi }}</p>
        </div>

      @endif
    </div>
    @endforeach
  </div>
@endsection
