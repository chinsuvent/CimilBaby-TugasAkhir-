@extends('admin.layouts.app')

@section('contents')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Check-In & Check-Out Anak (Hari Ini)</h3>
        <a href="{{ route('laporan.checkinout.pdf') }}" target="_blank" class="btn btn-purple">
            <i class="fas fa-file-pdf"></i> Cetak PDF
        </a>
    </div>
    <hr />

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle shadow-sm">
            <thead class="table-primary">
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
                        <tr>
                            <td>{{ $reservasi->anak->nama_anak }}</td>
                            <td>{{ $tglMasuk->format('d M Y') }}</td>
                            <td>{{ $tglKeluar->format('d M Y') }}</td>
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
