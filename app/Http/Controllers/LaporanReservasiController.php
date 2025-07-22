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

        // Default
        $limit = $request->input('limit', 10);

        // Filter tanggal
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tgl_masuk', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Pencarian nama
        if ($request->filled('cari')) {
            $search = $request->cari;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pengguna', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                })->orWhereHas('anak', function ($q3) use ($search) {
                    $q3->where('nama_anak', 'like', "%$search%");
                });
            });
        }

        // Filter jenis kelamin dari relasi anak
        if ($request->filled('gender')) {
            $query->whereHas('anak', function ($q) use ($request) {
                $q->where('jenis_kelamin', $request->gender);
            });
        }

        // Filter jenis layanan
        if ($request->filled('service')) {
            $query->whereHas('layanan', function ($q) use ($request) {
                $q->where('jenis_layanan', $request->service);
            });
        }

        $laporan = $query->orderBy('tgl_masuk', 'desc')->paginate($limit);

        return view('admin.laporans_reservasi.index', compact('laporan'));
    }

    public function cetak(Request $request)
{
    $query = Reservasi::query();

    if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
        $query->whereBetween('tgl_masuk', [$request->tgl_awal, $request->tgl_akhir]);
    }

    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->where(function ($q) use ($search) {
            $q->whereHas('pengguna', function ($q2) use ($search) {
                $q2->where('name', 'like', "%$search%");
            })->orWhereHas('anak', function ($q3) use ($search) {
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

    $laporan = $query->orderBy('tgl_masuk', 'desc')->get();
    $totalReservasi = $laporan->count();

    $pdf = Pdf::loadView('admin.laporans_reservasi.pdf', compact('laporan', 'totalReservasi'))->setPaper('A4', 'landscape');
    return $pdf->download('admin.laporans_reservasi.pdf');
}


}
