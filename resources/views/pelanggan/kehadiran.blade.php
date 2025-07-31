@extends('pelanggan.layouts.app') {{-- ganti sesuai layout pelanggan --}}

@section('contents')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Kehadiran Anak</h1>
    </div>

    <hr />

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-kehadiran text-center">
                <tr>
                    <th>Nama Anak</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Layanan</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasis as $reservasi)
                    @php
                        $today = \Carbon\Carbon::today();
                        $tglMasuk = \Carbon\Carbon::parse($reservasi->tgl_masuk);
                        $tglKeluar = \Carbon\Carbon::parse($reservasi->tgl_keluar);
                    @endphp

                    @if ($today->between($tglMasuk, $tglKeluar))
                        <tr class="text-center">
                            {{-- Nama Anak --}}
                            <td class="align-middle">{{ $reservasi->anak->nama_anak }}</td>
                            <td class="align-middle">{{ $tglMasuk->format('d M Y') }}</td>
                            <td class="align-middle">{{ $tglKeluar->format('d M Y') }}</td>
                            <td class="align-middle">{{ $reservasi->layanan->jenis_layanan }}</td>

                            {{-- Check-In --}}
                            <td>
                                @if (isset($checkinsToday[$reservasi->id]))
                                    <span class="badge bg-success text-white">
                                        {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkin)->format('H:i') }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum Check-In</span>
                                @endif
                            </td>

                            {{-- Check-Out --}}
                            <td>
                                @if (isset($checkinsToday[$reservasi->id]) && $checkinsToday[$reservasi->id]->waktu_checkout)
                                    <span class="badge bg-secondary text-white">
                                        {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkout)->format('H:i') }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum Check-Out</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="text-muted">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
