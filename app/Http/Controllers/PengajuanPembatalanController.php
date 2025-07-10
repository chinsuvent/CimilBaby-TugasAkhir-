<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPembatalan;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class PengajuanPembatalanController extends Controller
{
    // User submit pengajuan
    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required|exists:reservasi,id',
            'alasan' => 'required|string',
        ]);

        $reservasi = Reservasi::findOrFail($request->reservasi_id);

        if ($reservasi->status != 'Diterima') {
            return back()->with('error', 'Reservasi belum diterima tidak bisa diajukan pembatalan.');
        }

        PengajuanPembatalan::create([
            'reservasi_id' => $request->reservasi_id,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
        ]);

        // opsional update status reservasi ke "Menunggu Pembatalan"
        $reservasi->status = 'Menunggu Pembatalan';
        $reservasi->save();

        return back()->with('success', 'Pengajuan pembatalan berhasil diajukan.');
    }

    // Admin lihat semua pengajuan
    public function index()
    {
        $pengajuan = PengajuanPembatalan::with('reservasi')->latest()->get();
        return view('admin.pembatalan.index', compact('pengajuan'));
    }

    // Admin setujui atau tolak
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        $pengajuan = PengajuanPembatalan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->admin_id = Auth::id();
        $pengajuan->save();

        $reservasi = $pengajuan->reservasi;

        if ($request->status == 'Disetujui') {
            $reservasi->status = 'Dibatalkan';
        } else {
            $reservasi->status = 'Diterima'; // atau tetap seperti sebelumnya
        }

        $reservasi->save();

        return back()->with('success', 'Status pengajuan diperbarui.');
    }
}
