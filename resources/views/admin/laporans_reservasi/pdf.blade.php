@php
    $totalReservasi = $laporan->count();
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
    </style>
</head>
<body>
    <h2>Laporan Reservasi</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Nama Anak</th>
                <th>Jenis Kelamin</th>
                <th>Layanan</th>
                <th>Tanggal Masuk</th>
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
