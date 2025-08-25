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

        /* Style untuk kop surat */
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kop-surat img {
            width: 70px;
            height: auto;
            position: absolute;
            left: 40px;
            top: 20px;
        }
        .kop-surat h2,
        .kop-surat p {
            margin: 0;
        }
        .kop-surat h2 {
            font-size: 16px;
            font-weight: bold;
        }
        .kop-surat p {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <h2>JASA PENITIPAN ANAK CI'MIL BABY</h2>
        <p>Jl. Komodor Yos Sudarso Gg. Kenari 2, No. 23B</p>
        <p>Telp: 0896-9379-1742 | Email: cimilbaby@gmail.com</p>
    </div>

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
