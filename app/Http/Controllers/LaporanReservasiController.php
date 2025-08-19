<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;




class LaporanReservasiController extends Controller
{
public function index(Request $request)
{
    $query = Reservasi::query();
    $limit = $request->input('limit', 10);

    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_masuk', [$request->tgl_awal, $request->tgl_akhir]);
    }

    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->where(function ($q) use ($search) {
            $q->whereHas('anak', function ($q3) use ($search) {
                $q3->where('nama_anak', 'like', "%$search%");
            });
        });
    }

    if ($request->filled('gender')) {
        $query->whereHas('anak', function ($q) use ($request) {
            $q->where('jenis_kelamin', $request->gender);
        });
    }

    if ($request->filled('service')) {
        $query->whereHas('layanan', function ($q) use ($request) {
            $q->where('jenis_layanan', $request->service);
        });
    }

        if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $laporan = $query->orderBy('tgl_masuk', 'desc')->paginate($limit);

    // ⬇️ Tambahkan bagian ini untuk menangani AJAX
    if ($request->ajax()) {
        return view('admin.laporans_reservasi.index', compact('laporan'))->render();
    }

    return view('admin.laporans_reservasi.index', compact('laporan'));
}



public function cetak(Request $request)
{
    $query = Reservasi::query();

    // Filter per bulan & tahun
    $bulan = $request->input('bulan', date('m'));
    $tahun = $request->input('tahun', date('Y'));

    if ($request->filled('bulan') && $request->filled('tahun')) {
        $query->whereMonth('tgl_masuk', $bulan)
              ->whereYear('tgl_masuk', $tahun);
    }

    // Filter tanggal range
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_masuk', [$request->tgl_awal, $request->tgl_akhir]);
    }

    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->whereHas('anak', function ($q) use ($search) {
            $q->where('nama_anak', 'like', "%$search%");
        });
    }

    if ($request->filled('gender')) {
        $query->whereHas('anak', function ($q) use ($request) {
            $q->where('jenis_kelamin', $request->gender);
        });
    }

    if ($request->filled('service')) {
        $query->whereHas('layanan', function ($q) use ($request) {
            $q->where('jenis_layanan', $request->service);
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $laporan = $query->orderBy('tgl_masuk', 'desc')->get();
    $totalReservasi = $laporan->count();

    // Nama bulan (Bahasa Indonesia)
    $namaBulan = null;
    if ($request->filled('bulan') && $request->filled('tahun')) {
        $namaBulan = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F');
    }

    $pdf = Pdf::loadView('admin.laporans_reservasi.pdf', compact(
        'laporan',
        'totalReservasi',
        'bulan',
        'tahun',
        'namaBulan'
    ))->setPaper('A4', 'landscape');

    return $pdf->download('Laporan_Reservasi_' . ($namaBulan ?? 'Semua') . '.pdf');
}


}
