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
        $reservasi = Reservasi::with(['anak', 'pengguna', 'layanan'])->orderBy('created_at', 'desc')->paginate(10);

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


    // buat reservasi
    Reservasi::create([
        'anaks_id' => $request->anaks_id,
        'penggunas_id' => Auth::id(),
        'tgl_masuk' => $request->tgl_masuk,
        'tgl_keluar' => $request->tgl_keluar,
        'total' => $request->total,
        'metode_pembayaran' => $request->metode_pembayaran,
        'status' => 'Pending',
    ]);

    return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibuat');
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
        // Validasi status input
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        // Ambil data reservasi dengan relasi pengguna dan anak
        $reservasi = Reservasi::with(['pengguna', 'anak'])->findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        // Kirim WhatsApp ke pelanggan
        $rawNoTelp = $reservasi->pengguna->no_hp ?? null;

        if ($rawNoTelp && preg_match('/^08\d{8,12}$/', $rawNoTelp)) {
            // Ubah ke format 62
            $noTelp = preg_replace('/^08/', '628', $rawNoTelp);

            // Ambil data untuk pesan
            $nama = $reservasi->pengguna->name;
            $namaAnak = $reservasi->anak->nama_anak ?? 'anak Anda';
            $tglMasuk = Carbon::parse($reservasi->tgl_masuk)->translatedFormat('d F Y');
            $tglKeluar = Carbon::parse($reservasi->tgl_keluar)->translatedFormat('d F Y');

            // Tentukan isi pesan berdasarkan status
            if ($reservasi->status === 'Diterima') {
                $pesan = "Halo {$nama},\n\n" .
                        "Reservasi Anda di Cimil Baby telah DITERIMA.\n\n" .
                        "Berikut detail reservasinya:\n" .
                        "Nama Anak: {$namaAnak}\n" .
                        "Tanggal Masuk: {$tglMasuk}\n" .
                        "Tanggal Keluar: {$tglKeluar}\n\n" .
                        "Kami siap menyambut buah hati Anda dengan pelayanan terbaik dari Cimil Baby.\n\n" .
                        "Salam hangat,\nCimil Baby";
            } else {
                $pesan = "Halo {$nama},\n\n" .
                        "Mohon maaf, reservasi Anda di Cimil Baby tidak dapat kami proses dan saat ini DITOLAK.\n\n" .
                        "Kemungkinan penyebabnya:\n" .
                        "- Jadwal penitipan sudah penuh\n" .
                        "- Informasi yang diberikan belum lengkap\n\n" .
                        "Silakan lakukan reservasi ulang atau hubungi admin untuk bantuan lebih lanjut.\n\n" .
                        "Terima kasih atas pengertiannya.\n\n" .
                        "Cimil Baby";
            }

            // Kirim ke API Fonnte
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_API_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $noTelp,
                'message' => $pesan,
            ]);

            // Cek hasil pengiriman
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
