@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Pengajuan Pembatalan Reservasi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Anak</th>
                <th>Tanggal Reservasi</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuan as $item)
                <tr>
                    <td>{{ $item->reservasi->nama_anak ?? '-' }}</td>
                    <td>{{ $item->reservasi->tanggal ?? '-' }}</td>
                    <td>{{ $item->alasan }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'Menunggu' ? 'warning' : ($item->status == 'Disetujui' ? 'success' : 'danger') }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if($item->status == 'Menunggu')
                            <form action="{{ route('pengajuan.update', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                            </form>

                            <form action="{{ route('pengajuan.update', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        @else
                            <em>Sudah diproses</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada pengajuan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
