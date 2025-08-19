<!DOCTYPE html>
<html>
<head>
    <title>Laporan Check-In & Check-Out Anak</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; margin: 0; }
    </style>
</head>
<body>
    <h3>Laporan Check-In & Check-Out Anak - {{ $today->format('d M Y') }}</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Anak</th>
                <th>Layanan</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservasis as $reservasi)
                <tr>
                    <td>{{ $reservasi->anak->nama_anak }}</td>
                    <td>{{ $reservasi->layanan->jenis_layanan }}</td>
                    <td>
                        @if (isset($checkinsToday[$reservasi->id]))
                            {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkin)->format('H:i') }}
                        @else
                            Belum Check-In
                        @endif
                    </td>
                    <td>
                        @if (isset($checkinsToday[$reservasi->id]) && $checkinsToday[$reservasi->id]->waktu_checkout)
                            {{ \Carbon\Carbon::parse($checkinsToday[$reservasi->id]->waktu_checkout)->format('H:i') }}
                        @else
                            Belum Check-Out
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
