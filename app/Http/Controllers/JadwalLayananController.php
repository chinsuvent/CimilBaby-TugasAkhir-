<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalLayanan;
use App\Models\Reservasi;
use Carbon\Carbon;

class JadwalLayananController extends Controller
{

    public function generateJadwal()
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(30);

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Lewati hari Sabtu (6) dan Minggu (0)
            if (in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                continue;
            }

            // Cek jika jadwal pada tanggal dan slot belum dibuat
            for ($slot = 1; $slot <= 3; $slot++) {
                $exists = JadwalLayanan::where('tanggal', $date->toDateString())
                            ->exists();
                if (!$exists) {
                    JadwalLayanan::create([
                        'tanggal' => $date->toDateString(),
                        'kapasitas' => 10,
                        'terisi' => 0,
                        'status' => 'Tersedia',
                    ]);
                }
            }
        }

        return redirect()->route('jadwal_layanans.index')->with('generated', true);

    }

    public function konfirmasi(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        // Jika diterima, update jadwal_layanan
        if ($request->status == 'Diterima') {
            $jadwal = JadwalLayanan::where('tanggal', $reservasi->tgl_masuk)->first();

            if ($jadwal) {
                $jadwal->terisi += 1;

                // Cek apakah slot sudah penuh
                if ($jadwal->terisi >= $jadwal->kapasitas) {
                    $jadwal->status = 'Penuh';
                }

                $jadwal->save();
            }
        }

        return redirect()->route('jadwal_layanans.index')->with('edited', true);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal_layanan = JadwalLayanan::orderBy('created_at','DESC')->get();

        return view('jadwal_layanans.index', compact('jadwal_layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal_layanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JadwalLayanan::create($request->all());

        return redirect()->route('jadwal_layanans')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        return view('jadwal_layanans.show', compact('jadwal_layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        return view('jadwal_layanans.edit', compact('jadwal_layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        $jadwal_layanan->update($request->all());

        return redirect()->route('jadwal_layanans')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        $jadwal_layanan->delete();

        return redirect()->route('jadwal_layanans')->with('deleted', true);
    }
}
