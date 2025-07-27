<?php

namespace App\Http\Controllers;

use App\Models\JadwalLayanan;
use Illuminate\Http\Request;

class JadwalLayananController extends Controller
{
    /**
     * Tampilkan semua jadwal layanan untuk admin.
     */
    public function index()
    {
        $jadwal = JadwalLayanan::paginate(10);
        return view('admin.jadwal_layanans.index', compact('jadwal'));
    }

    /**
     * Tampilkan semua jadwal layanan untuk publik.
     */
    public function showPublic()
    {
        $jadwal = JadwalLayanan::all();
        return view('jadwal_layanan', compact('jadwal'));
    }

    /**
     * Tampilkan form untuk menambah jadwal baru.
     */
    public function create()
    {
        return view('admin.jadwal_layanans.create');
    }

    /**
     * Simpan data jadwal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalLayanan::create([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal_layanans')->with('added', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit.
     */
    public function edit($id)
    {
        $jadwal = JadwalLayanan::findOrFail($id);
        return view('admin.jadwal_layanans.edit', compact('jadwal'));
    }

    /**
     * Simpan perubahan edit.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalLayanan::findOrFail($id);
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal_layanans')->with('edited', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Hapus data jadwal.
     */
    public function destroy($id)
    {
        $jadwal = JadwalLayanan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal_layanans')->with('deleted', 'Jadwal berhasil dihapus.');
    }
}
