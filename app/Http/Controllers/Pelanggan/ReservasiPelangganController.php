<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\OrangTua;
use App\Models\PengajuanPembatalan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class ReservasiPelangganController extends Controller
{



public function index(Request $request)
{
    $limit = $request->input('limit', 10);
    $userId = Auth::id();

    // Cek dan update status otomatis
    Reservasi::where('status', 'Pending')
        ->whereDate('tgl_masuk', '<', now()->toDateString())
        ->update(['status' => 'Ditolak']);

    // Query hanya reservasi milik anak dari user yang login
    $query = Reservasi::whereHas('anak.orangTua.user', function ($q) use ($userId) {
        $q->where('id', $userId);
    });

    // Filter pencarian
    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->whereHas('anak', function ($q3) use ($search) {
            $q3->where('nama_anak', 'like', "%$search%");
        });
    }

    // Ambil data reservasi
    $reservasi = $query->with([
        'anak.orangTua.user',
        'pengguna',
        'layanan',
        'pengajuanPembatalan'
    ])
    ->orderBy('created_at', 'desc')
    ->paginate($limit);

    $pembatalans = PengajuanPembatalan::with('reservasi.pengguna')->get();

    // Ambil semua layanan dan simpan dalam array asosiatif berdasarkan nama layanan
    $layanans = Layanan::all()->keyBy('jenis_layanan');
    $anakUser = Anak::whereHas('orangTua.user', function ($q) {
    $q->where('id', Auth::id());
})->get();



    return view('pelanggan.riwayat_reservasi', compact('reservasi', 'pembatalans', 'layanans','anakUser'));
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

    $sudahAdaPengajuan = PengajuanPembatalan::where('reservasis_id', $reservasi->id)->exists();

    if ($sudahAdaPengajuan) {
        return redirect()->back()->with('error', 'Anda sudah pernah mengajukan pembatalan untuk reservasi ini.');
    }

    PengajuanPembatalan::create([
        'reservasis_id' => $reservasi->id,
        'alasan' => $request->alasan,
        'status' => 'Menunggu',
        'tanggal_pengajuan' => Carbon::now(),
    ]);

    // Kirim WhatsApp ke admin
    $user = Auth::user();
    $layanan = $reservasi->layanan->jenis_layanan ?? 'Layanan';
    $tglMasuk = $reservasi->tgl_masuk ?? '-';
    $tglKeluar = $reservasi->tgl_keluar ?? '-';
    $alasan = $request->alasan;
    $namaAnak = $reservasi->anak->nama_anak ?? '-';

    $pesan = "*Permohonan Pembatalan Masuk!*\n\n"
        . "Nama Anak: *{$namaAnak}*\n"
        . "Layanan: *{$layanan}*\n"
        . "Tanggal Masuk: {$tglMasuk}\n"
        . "Tanggal Keluar: {$tglKeluar}\n"
        . "*Alasan*: _{$alasan}_\n\n"
        . "Mohon segera dikonfirmasi!";

    $this->kirimWhatsappAdmin($pesan);

    return redirect()->back()->with('batal', 'Pengajuan pembatalan berhasil dikirim. Menunggu konfirmasi admin.');
}

 public function cancel($id)
    {
        $orangTua = Auth::user()->orangTua;
        $anakIds = $orangTua->anaks->pluck('id');

        $reservasi = Reservasi::with(['anak', 'layanan'])
            ->whereIn('anaks_id', $anakIds)
            ->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        $reservasi->update(['status' => 'Dibatalkan']);

        // Kirim WhatsApp ke admin
        $layananNama = $reservasi->layanan->jenis_layanan ?? 'Layanan Tidak Diketahui';
        $namaAnak = $reservasi->anak->nama_anak ?? '-';

        $pesan = "*Reservasi Dibatalkan!*\n\n"
            . "Nama Anak: *{$namaAnak}*\n"
            . "Layanan: {$layananNama}\n"
            . "Tanggal Masuk: {$reservasi->tgl_masuk}\n"
            . "Tanggal Keluar: {$reservasi->tgl_keluar}\n"
            . "Status: *DIBATALKAN*";

        $this->kirimWhatsappAdmin($pesan);

        return redirect()->route('pelanggan.reservasi')->with('cancel', 'Reservasi berhasil dibatalkan.');
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
        $namaAnak = $reservasi->anak->nama_anak ?? '-';

        $pesan = "*Reservasi Diperbarui!*\n\n"
            . "Nama Anak: *{$namaAnak}*\n"
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
    try {

        $adminPhone = DB::table('settings')->where('key', 'admin_whatsapp')->value('value');
        Log::info('Nomor admin dari settings:', ['adminPhone' => $adminPhone]);


        $token = \App\Models\WhatsappConfig::first()?->api_key;
        Log::info('Token dari whatsapp_configs:', ['token' => $token]);

        if (!$adminPhone || !$token) {
            Log::error('Nomor admin atau token WhatsApp tidak ditemukan.');
            return;
        }

        if (str_starts_with($adminPhone, '08')) {
            $adminPhone = '62' . substr($adminPhone, 1);
        }

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

        if (curl_errno($curl)) {
            Log::error('Curl error:', ['error' => curl_error($curl)]);
        }

        curl_close($curl);

        Log::info('Fonnte WA response:', ['response' => $response]);

    } catch (\Exception $e) {
        Log::error('Gagal kirim WA:', ['error' => $e->getMessage()]);
    }
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

    $masukDate = Carbon::parse($validated['tgl_masuk']);
    $layanan = strtolower($validated['jenis_layanan']);
    $day = $masukDate->dayOfWeek;

    if (in_array($layanan, ['harian', 'bulanan']) && ($day === Carbon::SATURDAY || $day === Carbon::SUNDAY)) {
        return redirect()->back()->with('error', 'Reservasi layanan harian atau bulanan tidak tersedia pada hari Sabtu atau Minggu.');
    }

    if($request->jenis_layanan == "Khusus") {

    } else {
        $overlap = Reservasi::where('anaks_id', $validated['anaks_id'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('tgl_masuk', [$validated['tgl_masuk'], $validated['tgl_keluar']])
                    ->orWhereBetween('tgl_keluar', [$validated['tgl_masuk'], $validated['tgl_keluar']])
                    ->orWhere(function ($query2) use ($validated) {
                        $query2->where('tgl_masuk', '<=', $validated['tgl_masuk'])
                                ->where('tgl_keluar', '>=', $validated['tgl_keluar']);
                    });
            })
            ->first();

        if ($overlap) {
            return redirect()->back()->with('gagal', 'Sudah ada reservasi untuk anak ini di rentang tanggal tersebut.');
        }
    }

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
        'status' => 'Pending',
    ]);

    $pesan = "*Reservasi Baru Masuk!*\n\n"
        . "Layanan: {$validated['jenis_layanan']}\n"
        . "Tanggal Masuk: {$validated['tgl_masuk']}\n"
        . "Tanggal Keluar: {$validated['tgl_keluar']}\n"
        . "Biaya: {$validated['biaya']}\n"
        . "Metode Bayar: {$validated['metode_pembayaran']}";

    $this->kirimWhatsappAdmin($pesan);

    return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
}

}
