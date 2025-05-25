@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-title">Data Layanan</h1>
        <a href="{{ route('layanans.create') }}" class="btn btn-primary">Tambah Layanan</a>
    </div>
    <hr />

    @push('scripts')
    <script>
        @if (session('added'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Ditambahkan',
                icon: 'success'
            });
        @endif

        @if (session('edited'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Diubah',
                icon: 'success'
            });
        @endif

        @if (session('deleted'))
            Swal.fire({
                title: 'Hapus',
                text: 'Data Berhasil Dihapus',
                icon: 'success'
            });
        @endif

        // Harus tetap dimuat selalu
        function hapus(button) {
            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
                text: 'Data Akan Benar Benar Terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
    @endpush


    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Jenis Layanan</th>
                <th>Durasi</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($layanan->count() > 0)
                @foreach ($layanan as $la)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $la->jenis_layanan }}</td>
                        <td class="align-middle">{{ $la->durasi }}</td>
                        <td class="align-middle">{{ $la->biaya }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('layanans.edit', $la->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('layanans.destroy', $la->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="hapus(this)" class="btn btn-danger m-0">Hapus</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        <td class="text-center" colspan="8">Data Tidak Ditemukan</td>
                    </tr>
            @endif
        </tbody>
    </table>
@endsection