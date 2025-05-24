@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Data Anak</h1>
        <a href="{{ route('anaks.create') }}" class="btn btn-primary">Tambah Anak</a>
    </div>
    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>   
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                {{-- <th>Nama Orang Tua</th> --}}
                {{-- <th>No. HP</th> --}}
                <th>Alergi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($anak->count() > 0)
                @foreach ($anak as $an)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $an->nama_anak }}</td>
                        <td class="align-middle">{{ $an->tempat_lahir }}</td>
                        <td class="align-middle">{{ $an->tanggal_lahir }}</td>
                        <td class="align-middle">{{ $an->jenis_kelamin }}</td>
                        <td class="align-middle">{{ $an->usia }}</td>
                        {{-- <td class="align-middle">{{ $an->pengguna->nama ?? '-' }}</td> 
                        <td class="align-middle">{{ $an->pengguna->nomor_hp ?? '-' }}</td>  --}}
                        <td class="align-middle">{{ $an->alergi }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('anaks.edit', $an->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('anaks.destroy', $an->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        <td class="text-center" colspan="8">Pengguna Tidak Ditemukan</td>
                    </tr>
            @endif
        </tbody>
    </table>
@endsection