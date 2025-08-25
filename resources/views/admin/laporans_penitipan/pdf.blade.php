@php
    use Carbon\Carbon;
    $totalReservasi = $laporan->count();

    // Pakai createFromDate biar fix
    $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');
@endphp




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }

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
    <h2>Laporan Penitipan Anak Bulan {{ $namaBulan }} {{ $tahun }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Nama Anak</th>
                <th>Jenis Kelamin</th>
                <th>Layanan</th>
                <th>Tanggal Mulai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->anak->orangTua->user->name ?? '-' }}</td>
                    <td>{{ $item->anak->nama_anak ?? '-' }}</td>
                    <td>{{ $item->anak->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $item->layanan->jenis_layanan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align: right;">Total Reservasi</th>
                <th>{{ $totalReservasi }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
