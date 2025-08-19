<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPenitipanController extends Controller
{
    public function index(Request $request)
{
    $query = Reservasi::query();

    // Hanya yang diterima atau selesai
    $query->whereIn('status', ['Diterima', 'Selesai']);

    $limit = $request->input('limit', 10);

    // Filter per bulan & tahun
    if ($request->filled('bulan') && $request->filled('tahun')) {
        $query->whereMonth('tgl_masuk', $request->bulan)
              ->whereYear('tgl_masuk', $request->tahun);
    }

    // Filter tanggal range
    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_masuk', [$request->tgl_awal, $request->tgl_akhir]);
    }

    // Filter nama anak
    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->whereHas('anak', function ($q) use ($search) {
            $q->where('nama_anak', 'like', "%$search%");
        });
    }

    // Filter gender
    if ($request->filled('gender')) {
        $query->whereHas('anak', function ($q) use ($request) {
            $q->where('jenis_kelamin', $request->gender);
        });
    }

    // Filter layanan
    if ($request->filled('service')) {
        $query->whereHas('layanan', function ($q) use ($request) {
            $q->where('jenis_layanan', $request->service);
        });
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $laporan = $query->orderBy('tgl_masuk', 'desc')->paginate($limit);

    return view('admin.laporans_penitipan.index', compact('laporan'));
}

public function cetak(Request $request)
{
    $query = Reservasi::query();
    $query->whereIn('status', ['Diterima', 'Selesai']);

   $bulan = $request->bulan ?? date('m'); // default bulan sekarang
    $tahun = $request->tahun ?? date('Y'); // default tahun sekarang

    if ($bulan && $tahun) {
        $query->whereMonth('tgl_masuk', $bulan)
              ->whereYear('tgl_masuk', $tahun);
    }

    $laporan = $query->orderBy('tgl_masuk', 'desc')->get();
    $totalReservasi = $laporan->count();
    
    Carbon::setLocale('id');
    $namaBulan = null;
    if ($bulan && $tahun) {
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');
    }


    $pdf = Pdf::loadView('admin.laporans_penitipan.pdf', compact(
        'laporan',
        'totalReservasi',
        'bulan',
        'tahun',
        'namaBulan'
    ))->setPaper('A4', 'landscape');

    return $pdf->download('Laporan_Penitipan_' . ($namaBulan ?? 'Semua') . '.pdf');
}


public function laporanBulanan(Request $request)
{
    // Ambil bulan & tahun dari request, kalau kosong pakai bulan sekarang
    $bulan = $request->input('bulan', Carbon::now()->month);
    $tahun = $request->input('tahun', Carbon::now()->year);

    // Ambil data sesuai bulan & tahun
    $laporan = Reservasi::whereMonth('tgl_masuk', $bulan)
                ->whereYear('tgl_masuk', $tahun)
                ->get();

    return view('laporan_pdf', compact('laporan', 'bulan', 'tahun'));
}



}
