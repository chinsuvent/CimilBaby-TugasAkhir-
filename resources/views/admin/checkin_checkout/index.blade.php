@extends('admin.layouts.app')

@section('contents')
<div class="container-fluid">
    <h3 class="mb-4">Check-In & Check-Out Anak (Hari Ini)</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Nama Anak</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasis as $reservasi)
                    <tr>
                        <td>{{ $reservasi->anak->nama_anak }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservasi->tgl_masuk)->format('d M Y') }}</td>
                        <td>{{ $reservasi->layanan->jenis_layanan }}</td>

                        {{-- Check-In --}}
                        <td>
                            @if (isset($checkinsToday[$reservasi->id]))
                                <span class="badge bg-success text-white">
                                    {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkin)->format('H:i') }}
                                </span>

                            @else
                                <form method="POST" action="{{ route('checkin', $reservasi->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Check-In</button>
                                </form>
                            @endif
                        </td>

                        {{-- Check-Out --}}
                        <td>
                            @if (isset($checkinsToday[$reservasi->id]) && $checkinsToday[$reservasi->id]->waktu_checkout)
                                <span class="badge bg-secondary text-white">
                                {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkout)->format('H:i') }}
                            </span>


                            @elseif (isset($checkinsToday[$reservasi->id]))
                                <form method="POST" action="{{ route('checkout', $reservasi->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Check-Out</button>
                                </form>
                            @else
                                <span class="text-muted">Belum Check-In</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
