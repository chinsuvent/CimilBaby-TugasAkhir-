<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalLayanan;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relasi anak, pengguna, layanan
        $reservasi = Reservasi::with(['anak', 'pengguna', 'layanan'])->orderBy('created_at', 'desc')->get();

        return view('reservasis.index', compact('reservasi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Cari jadwal layanan yang masih tersedia
            $jadwal = JadwalLayanan::where('tanggal', $request->tgl_masuk)
                        ->where('status', 'Tersedia')
                        ->whereColumn('terisi', '<', 'kapasitas')
                        ->orderBy('slot_number')
                        ->first();

            if (!$jadwal) {
                return back()->with('error', 'Jadwal pada tanggal tersebut sudah penuh.');
            }

            // Buat reservasi
            $reservasi = Reservasi::create([
                // ... isian data reservasi ...
                'jadwal_layanan_id' => $jadwal->id,
                'tgl_masuk' => $request->tgl_masuk,
                'tgl_keluar' => $request->tgl_keluar,
                'status' => 'Pending',
                // Tambahkan isian lain sesuai kebutuhan
            ]);

            // Update slot jadwal
            $jadwal->increment('terisi');
            if ($jadwal->terisi >= $jadwal->kapasitas) {
                $jadwal->status = 'Tidak Tersedia';
            }
            $jadwal->save();

            DB::commit();

            return redirect()->route('jadwal_layanans.index')->with('added', true);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasis.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasis.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update($request->all());

        return redirect()->route('reservasis')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('rese$reservasis')->with('deleted',true);
    }

    public function konfirmasi(Request $request, $id)
    {
        // Validasi status harus Diterima atau Ditolak
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        // Temukan data reservasi berdasarkan ID
        $reservasi = Reservasi::findOrFail($id);

        // Ubah status reservasi
        $reservasi->status = $request->status;
        $reservasi->save();

        // Redirect kembali ke halaman sebelumnya dengan notifikasi berhasil
        return redirect()->back()->with('edited', true);
    }


}
