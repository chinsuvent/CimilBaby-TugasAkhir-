@extends('admin.layouts.app')

@section('contents')
<div class="row align-items-center">
    <div class="col-md-6 col-12">
        <h1 class="mb-3 text-title">Jadwal Layanan</h1>
    </div>
    <div class="col-md-6 col-12">
        <div class="d-flex justify-content-md-end justify-content-start mb-3">
            <a href="{{ route('jadwal_layanans.create') }}" class="btn btn-tambah ">
                Tambah Jadwal Layanan
            </a>
        </div>
    </div>
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

    @if (session('generated'))
        Swal.fire({
            title: 'Jadwal Berhasil Dibuat',
            text: 'Jadwal layanan berhasil digenerate',
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

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($jadwal->count() > 0)
                @foreach ($jadwal as $item)
                    <tr class="text-center">
                        <td class="align-middle">{{ $loop->iteration + ($jadwal->currentPage() - 1) * $jadwal->perPage() }}</td>
                        <td class="align-middle">{{ $item->hari }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                        <td class="align-middle">
                            <a href="{{ route('jadwal_layanans.edit', $item->id) }}" class="btn btn-sm btn-warning mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('jadwal_layanans.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="hapus(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Data Jadwal Layanan Tidak Ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3 mb-4">
    @if ($jadwal->hasPages())
        {{ $jadwal->links('pagination::bootstrap-5') }}
    @else
        <nav>
            <ul class="pagination">
                <li class="page-item active"><span class="page-link">1</span></li>
            </ul>
        </nav>
    @endif
</div>
@endsection
