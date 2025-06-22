<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class JadwalLayananController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('cari'); 

    $query = Reservasi::query();

    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->whereHas('pengguna', function ($q2) use ($search) {
                $q2->where('name', 'like', "%$search%");
            })->orWhereHas('anak', function ($q3) use ($search) {
                $q3->where('nama_anak', 'like', "%$search%");
            });
        });
    }

    $reservasi = $query->orderBy('created_at', 'DESC')->paginate(10);

    return view('jadwal_layanans.index', compact('reservasi'));
}




    // Jika ingin filter berdasarkan status tertentu
    public function filterByStatus($status = null)
    {
        $query = Reservasi::with(['anak', 'layanan']);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $reservasi = $query->orderBy('tgl_masuk', 'desc')->get();

        return view('jadwal_layanans.index', compact('reservasi'));
    }

    // Jika ingin filter berdasarkan tanggal
    public function filterByDate(Request $request)
    {
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $query = Reservasi::with(['anak', 'layanan']);

        if ($tanggal_mulai) {
            $query->where('tgl_masuk', '>=', $tanggal_mulai);
        }

        if ($tanggal_akhir) {
            $query->where('tgl_masuk', '<=', $tanggal_akhir);
        }

        $reservasi = $query->orderBy('tgl_masuk', 'desc')->get();

        return view('jadwal_layanans.index', compact('reservasi'));
    }
}