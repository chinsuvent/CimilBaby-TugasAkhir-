<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Layanan;
use Illuminate\Support\Facades\Log;


class ReservasiPelangganController extends Controller
{
    public function index()
    {
        $orangTua = Auth::user()->orangTua;
        $anakUser = $orangTua->anak;

        $reservasi = \App\Models\Reservasi::whereIn('anaks_id', function ($query) use ($orangTua) {
            $query->select('id')
                ->from('anaks')
                ->where('orang_tua_id', $orangTua->id);
        })->orderBy('created_at', 'desc')->paginate(10);
        return view('pelanggan.riwayat_reservasi', compact('reservasi', 'anakUser'));
    }



   public function beranda()
    {
        $layanan = Layanan::all();

        $anakUser = null;
        if (Auth::check()) {
            $anakUser = Auth::user()->anak()->get();
        }

        return view('beranda', compact('layanan', 'anakUser'));
    }





    public function cancel($id)
    {
        $pelanggan = Auth::user();
        $reservasi = $pelanggan->reservasis()->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        $reservasi->update(['status' => 'Dibatalkan']);

        return redirect()->route('pelanggan.reservasi')->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function edit($id)
    {
        $pelanggan = Auth::user();
        $reservasi = $pelanggan->reservasis()->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->route('pelanggan.reservasi')
                ->with('error', 'Hanya reservasi dengan status Pending yang dapat diedit.');
        }

        return view('pelanggan.editReservasi', compact('reservasi'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Auth::user();
        $reservasi = $pelanggan->reservasis()->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->route('pelanggan.reservasi')
                ->with('error', 'Hanya reservasi dengan status Pending yang dapat diedit.');
        }

        $validated = $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:500',
            // tambahkan field lain sesuai kebutuhanmu
        ]);

        $reservasi->update($validated);

        return redirect()->route('pelanggan.reservasi')
            ->with('success', 'Reservasi berhasil diedit.');
    }

    protected function kirimWhatsappAdmin($message)
{
    $token = env('FONNTE_API_KEY');
    $adminPhone = env('ADMIN_PHONE');

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $adminPhone,
            'message' => $message,
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: $token"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    Log::info('Fonnte WA response:', ['response' => $response]);
}


    public function store(Request $request)
    {
         Log::info('User saat reservasi: ', ['user' => Auth::user()]);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'anaks_id' => 'required|exists:anaks,id',
            'jenis_layanan' => 'required|string|max:255',
            'tgl_masuk' => 'required|date|after_or_equal:today',
            'tgl_keluar' => 'required|date|after_or_equal:tgl_masuk',
            'biaya' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|in:cash,transfer',
        ]);

        $pelanggan = Auth::user();

        Reservasi::create([
            'name' => $validated['name'],
            'anaks_id' => $validated['anaks_id'],
            'layanans_id' => Layanan::where('jenis_layanan', $validated['jenis_layanan'])->first()->id,
            'jenis_layanan' => $validated['jenis_layanan'],
            'tgl_masuk' => $validated['tgl_masuk'],
            'tgl_keluar' => $validated['tgl_keluar'],
            'biaya' => $validated['biaya'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'status' => 'Pending', // status default reservasi baru
        ]);

        $pesan = "*Reservasi Baru Masuk!*\n\n"
           . "Nama: {$pelanggan->name}\n"
           . "Layanan: {$validated['jenis_layanan']}\n"
           . "Tanggal Masuk: {$validated['tgl_masuk']}\n"
           . "Tanggal Keluar: {$validated['tgl_keluar']}\n"
           . "Biaya: {$validated['biaya']}\n"
           . "Metode Bayar: {$validated['metode_pembayaran']}";

    // Kirim WA ke admin
    $this->kirimWhatsappAdmin($pesan);

        return redirect()->route('pelanggan.riwayat_reservasi')->with('success', 'Reservasi berhasil dikirim!');

    }


}
