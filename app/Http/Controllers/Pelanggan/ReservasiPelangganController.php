<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\PengajuanPembatalan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;



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

    // Fungsi ajukan pembatalan
    public function ajukanPembatalan(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string',
        ]);

        $reservasi = Reservasi::with(['anak', 'layanan'])->where('id', $id)
            ->where('status', 'Diterima')
            ->firstOrFail();

        // Cegah duplikat
        if ($reservasi->pembatalan) {
            return redirect()->back()->with('error', 'Pembatalan sudah diajukan.');
        }

        PengajuanPembatalan::create([
            'reservasis_id' => $reservasi->id,
            'alasan' => $request->alasan,
            'status' => 'Menunggu',
            'tanggal_pengajuan' => Carbon::now(),
        ]);

        // Kirim WhatsApp ke admin
        $user = Auth::user();
        $namaOrtu = $user->name ?? 'Orang Tua';
        $namaAnak = $reservasi->anak->nama_anak ?? 'Anak';
        $layanan = $reservasi->layanan->jenis_layanan ?? 'Layanan';
        $tglMasuk = $reservasi->tgl_masuk ?? '-';
        $tglKeluar = $reservasi->tgl_keluar ?? '-';
        $alasan = $request->alasan;

        $pesan = "*Permohonan Pembatalan Masuk!*\n\n"
            . "👤 Orang Tua: *{$namaOrtu}*\n"
            . "👶 Anak: *{$namaAnak}*\n"
            . "🧾 Layanan: *{$layanan}*\n"
            . "📅 Masuk: {$tglMasuk}\n"
            . "📅 Keluar: {$tglKeluar}\n"
            . "❗ *Alasan*: _{$alasan}_\n\n"
            . "Mohon segera dikonfirmasi di dashboard admin.";

        $this->kirimWhatsappAdmin($pesan);

        return redirect()->back()->with('batal', 'Pengajuan pembatalan berhasil dikirim. Menunggu konfirmasi admin.');
    }


public function show($id)
{
    return redirect()->route('pelanggan.reservasi')->with('info', 'Halaman tidak tersedia.');
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
        $orangTua = Auth::user()->orangTua;
        $anakIds = $orangTua->anaks->pluck('id');

        $reservasi = Reservasi::with(['anak', 'layanan']) // pastikan relasi diload
            ->whereIn('anaks_id', $anakIds)
            ->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        $reservasi->update(['status' => 'Dibatalkan']);

        // Kirim WhatsApp ke admin
        $user = Auth::user();
        $namaAnak = $reservasi->anaks->nama ?? 'Anak';
        $layananNama = $reservasi->layanan->jenis_layanan ?? 'Layanan Tidak Diketahui';

        $pesan = "*Reservasi Dibatalkan!*\n\n"
            . "Nama Orang Tua: {$user->name}\n"
            . "Nama Anak: {$namaAnak}\n"
            . "Layanan: {$layananNama}\n"
            . "Tanggal Masuk: {$reservasi->tgl_masuk}\n"
            . "Tanggal Keluar: {$reservasi->tgl_keluar}\n"
            . "Status: *DIBATALKAN*";

        $this->kirimWhatsappAdmin($pesan);

        return redirect()->route('pelanggan.reservasi')->with('cancel', 'Reservasi berhasil dibatalkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $orangTua = $user->orangTua;

        // if (!$orangTua || !$orangTua->anaks || $orangTua->anaks->isEmpty()) {
        //     return redirect()->route('pelanggan.reservasi')->with('error', 'Data anak tidak ditemukan.');
        // }

        $anakIds = $orangTua->anaks->pluck('id');

        // ✅ Load relasi anak & layanan
        $reservasi = Reservasi::with(['anak', 'layanan'])
            ->whereIn('anaks_id', $anakIds)
            ->findOrFail($id);

        $layanans = Layanan::all();

        return view('pelanggan.editReservasi', compact('reservasi', 'layanans'));
    }





    public function update(Request $request, $id)
    {
        $request->validate([
            'layanans_id' => 'required|exists:layanans,id',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date|after_or_equal:tgl_masuk',
            'metode_pembayaran' => 'required|string',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $reservasi->layanans_id = $request->input('layanans_id');
        $reservasi->tgl_masuk = $request->input('tgl_masuk');
        $reservasi->tgl_keluar = $request->input('tgl_keluar');
        $reservasi->metode_pembayaran = $request->input('metode_pembayaran');
        $reservasi->save();

        // Kirim WhatsApp ke admin setelah berhasil update
        $user = Auth::user();
        $layananNama = $reservasi->layanan->jenis_layanan ?? 'Tidak diketahui';

        $pesan = "*Reservasi Diperbarui!*\n\n"
            . "Nama: {$user->name}\n"
            . "Layanan: {$layananNama}\n"
            . "Tanggal Masuk: {$reservasi->tgl_masuk}\n"
            . "Tanggal Keluar: {$reservasi->tgl_keluar}\n"
            . "Metode Bayar: {$reservasi->metode_pembayaran}";

        $this->kirimWhatsappAdmin($pesan);

        return redirect()->route('pelanggan.riwayat_reservasi')
            ->with('edited', 'Reservasi berhasil diperbarui.');
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
