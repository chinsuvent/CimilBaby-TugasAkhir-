@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Data Pengguna</h1>
        <a href="{{ route('penggunas.create') }}" class="btn btn-primary">Tambah Pengguna</a>
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
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat</th>
                {{-- <th>Jumlah Anak</th> --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($pengguna->count() > 0)
                @foreach ($pengguna as $pg)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $pg->nama_orang_tua }}</td>
                        <td class="align-middle">{{ $pg->username }}</td>
                        <td class="align-middle">{{ $pg->password }}</td>
                        <td class="align-middle">{{ $pg->email }}</td>
                        <td class="align-middle">{{ $pg->no_hp }}</td>
                        <td class="align-middle">{{ $pg->alamat }}</td>
                        {{-- <td class="align-middle">{{ $pg->anak->count() }}</td> --}}
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('penggunas.show', $pg->id) }}" type="button" class="btn btn-secondary">Lihat</a>
                                <a href="{{ route('penggunas.edit', $pg->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('penggunas.destroy', $pg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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
                        <td class="text-center" colspan="5">Pengguna Tidak Ditemukan</td>
                    </tr>
            @endif
        </tbody>
    </table>
@endsection