<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relasi anak, pengguna, layanan
        $reservasi = Reservasi::with(['anak', 'pengguna', 'layanan'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.reservasis.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.reservasis.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     Reservasi::create([
    //         'anaks_id' => $request->anaks_id,
    //         'penggunas_id' => Auth::id(),
    //         'tgl_masuk' => $request->tgl_masuk,
    //         'tgl_keluar' => $request->tgl_keluar,
    //         'total' => $request->total,
    //         'metode_pembayaran' => $request->metode_pembayaran,
    //         'status' => 'Pending',
    //     ]);

    //     return redirect()->route('reservasis.index')->with('success', 'Reservasi berhasil dibuat');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('admin.reservasis.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('admin.reservasis.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());

        return redirect()->route('reservasis.index')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->route('reservasis.index')->with('deleted', true);
    }

    /**
     * Konfirmasi reservasi dan kirim notifikasi WhatsApp.
     */
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        $reservasi = Reservasi::with(['pengguna', 'anak'])->findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        $rawNoTelp = $reservasi->pengguna->no_hp ?? null;

        if ($rawNoTelp && preg_match('/^08\d{8,12}$/', $rawNoTelp)) {
            $noTelp = preg_replace('/^08/', '628', $rawNoTelp);
            $nama = $reservasi->pengguna->name;
            $namaAnak = $reservasi->anak->nama_anak ?? 'anak Anda';
            $tglMasuk = Carbon::parse($reservasi->tgl_masuk)->translatedFormat('d F Y');
            $tglKeluar = Carbon::parse($reservasi->tgl_keluar)->translatedFormat('d F Y');

            $pesan = $reservasi->status === 'Diterima'
                ? "Halo {$nama},\n\nReservasi Anda di Cimil Baby telah DITERIMA.\n\nDetail:\nNama Anak: {$namaAnak}\nTanggal Masuk: {$tglMasuk}\nTanggal Keluar: {$tglKeluar}\n\nKami siap menyambut buah hati Anda.\n\nSalam,\nCimil Baby"
                : "Halo {$nama},\n\nMohon Maaf, reservasi Anda DITOLAK.\n\nKemungkinan:\n- Jadwal penuh\n- Data belum lengkap\n\nSilakan reservasi ulang atau hubungi admin.\n\nTerima kasih.\n\nCimil Baby";

            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_API_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $noTelp,
                'message' => $pesan,
            ]);

            $responseData = $response->json();
            if (!$responseData['status']) {
                Log::error('Gagal kirim WA ke ' . $noTelp . ': ' . $responseData['message']);
            }
        } else {
            Log::warning('Nomor HP tidak valid atau kosong: ' . ($rawNoTelp ?? 'null'));
        }

        return redirect()->back()->with('edited', true);
    }
}
