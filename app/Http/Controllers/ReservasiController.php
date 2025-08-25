<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\PengajuanPembatalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\WhatsappConfig;


class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Reservasi::query();
    $today = Carbon::today();

    // Update status Pending ke Ditolak jika tgl_masuk sudah lewat hari ini
    $expired = Reservasi::with('anak.orangTua')
        ->where('status', 'Pending')
        ->whereDate('tgl_masuk', '<', $today)
        ->get();

    foreach ($expired as $reservasi) {
        $reservasi->status = 'Ditolak';
        $reservasi->save();

        $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda';
        $noHp = $reservasi->anak?->orangTua?->no_hp;

        if ($noHp) {
            $message = "Reservasi dengan nama anak *$namaAnak* *DITOLAK* karena tidak dikonfirmasi sebelum tanggal masuk. Silakan ajukan reservasi baru jika masih diperlukan.";
            $this->kirimWhatsapp($noHp, $message);
        }
    }

    // Update status Diterima ke Selesai jika tgl_keluar sudah lewat hari ini
    Reservasi::where('status', 'Diterima')
        ->whereDate('tgl_keluar', '<', $today)
        ->update(['status' => 'Selesai']);

    $limit = $request->input('limit', 10);

    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->where(function ($q) use ($search) {
            $q->whereHas('anak', function ($q3) use ($search) {
                $q3->where('nama_anak', 'like', "%$search%");
            });
        });
    }

    $reservasi = $query->with(['anak.orangTua.user', 'pengguna', 'layanan', 'pengajuanPembatalan'])
        ->orderBy('created_at', 'desc')
        ->paginate($limit);

    $pembatalans = PengajuanPembatalan::with('reservasi.pengguna')->get();

    return view('admin.reservasis.index', compact('reservasi', 'pembatalans'));
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

protected function kirimWhatsapp($targetPhone, $message)
{
    $config = WhatsappConfig::first(); // ambil konfigurasi pertama

    if (!$config || !$config->api_key || !$config->number) {
        Log::error('Gagal kirim WA: Konfigurasi WhatsApp tidak lengkap.');
        return;
    }

    $token = $config->api_key;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $targetPhone,
            'message' => $message,
            'countryCode' => '62',
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: $token"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    Log::info("WA sent to $targetPhone | Message: $message | Response: $response");
}



   public function konfirmasi(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Diterima,Ditolak',
    ]);

    $reservasi = Reservasi::with('anak.orangTua')->findOrFail($id);
    $reservasi->status = $request->status;
    $reservasi->save();

    $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda';
    $jenisLayanan = $reservasi->layanan->jenis_layanan;
    $namaOrangTua = $reservasi->anak->orangTua->user->name;
    $tglMasuk = Carbon::parse($reservasi->tgl_masuk)->format('d-m-Y');
    $tglKeluar = Carbon::parse($reservasi->tgl_keluar)->format('d-m-Y');
    $status = $request->status;
    $noHp = $reservasi->anak?->orangTua?->no_hp;

    if ($noHp) {
        if ($status === 'Diterima') {
            $message = "Halo Bapak/Ibu *$namaOrangTua*,\n\n" .
                "Reservasi layanan penitipan anak dengan layanan *{$jenisLayanan}* untuk anak bernama *{$namaAnak}* " .
                "pada tanggal *{$tglMasuk}* sampai *{$tglKeluar}* telah *{$status}*.\n\n" .
                "Silakan datang sesuai dengan jadwal yang telah ditentukan. Jika ada pertanyaan lebih lanjut, " .
                "jangan ragu untuk menghubungi kami.\n\n" .
                "Terima kasih atas kepercayaan Anda menggunakan layanan *Ci’mil Baby*.\n\n" .
                "Hormat kami,\nCi’mil Baby";

        } else {
            $message = "Halo Bapak/Ibu *$namaOrangTua*,\n\n" .
           "Mohon maaf, reservasi layanan penitipan anak dengan layanan *{$jenisLayanan}* untuk anak bernama *{$namaAnak}* " .
           "pada tanggal *{$tglMasuk}* sampai *{$tglKeluar}* telah *Ditolak*.\n\n" .
           "Untuk informasi lebih lanjut, silakan hubungi pihak administrasi.\n\n" .
           "Terima kasih atas pengertian Anda.\n\n" .
           "Hormat kami,\nCi’mil Baby";

        }

        $this->kirimWhatsapp($noHp, $message);
    }

    return redirect()->back()->with('edited', 'Reservasi berhasil dikonfirmasi.');
}




    public function konfirmasiPembatalan(Request $request, $id)
    {

        $reservasi = Reservasi::with('anak.orangTua')->findOrFail($id);
        $pengajuan = $reservasi->pengajuanPembatalan;

        if (!$pengajuan) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda';
        $noHp = $reservasi->anak?->orangTua?->no_hp;

       $namaOrangTua = $reservasi->anak->orangTua->user->name;
        $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda';
        $layanan = $reservasi->layanan->jenis_layanan ?? '-';
        $tglMasuk = \Carbon\Carbon::parse($reservasi->tgl_masuk)->translatedFormat('d-m-Y');
        $tglKeluar = \Carbon\Carbon::parse($reservasi->tgl_keluar)->translatedFormat('d-m-Y');

        if ($request->konfirmasi === 'terima') {
            $reservasi->status = 'dibatalkan';
            $reservasi->save();
            $pengajuan->delete();

            if ($noHp) {
                $message = "Halo *$namaOrangTua*,\n\n" .
                        "Permohonan *pembatalan reservasi* untuk anak *$namaAnak* pada layanan *$layanan* " .
                        "dari tanggal *$tglMasuk* sampai *$tglKeluar* telah *DITERIMA*.\n\n" .
                        "Reservasi resmi dibatalkan. Terima kasih atas konfirmasi Anda.\n\n" .
                        "Hormat kami,\nManajemen Ci’mil Baby";
                $this->kirimWhatsapp($noHp, $message);
            }

            return back()->with('success', 'Reservasi berhasil dibatalkan.');
        }

        if ($request->konfirmasi === 'tolak') {
            $pengajuan->status = 'ditolak';
            $pengajuan->save();

            if ($noHp) {
                $message = "Halo Bapak/Ibu *$namaOrangTua*,\n\n" .
                        "Permohonan *pembatalan reservasi* untuk anak *$namaAnak* pada layanan *$layanan* " .
                        "dari tanggal *$tglMasuk* sampai *$tglKeluar* telah *DITOLAK*.\n\n" .
                        "Reservasi tetap berlaku sesuai jadwal. Untuk informasi lebih lanjut, silakan hubungi pihak administrasi.\n\n" .
                        "Hormat kami,\nManajemen Ci’mil Baby";
                $this->kirimWhatsapp($noHp, $message);
            }

            return back()->with('info', 'Pengajuan pembatalan ditolak.');
        }



        return back()->with('error', 'Aksi tidak valid.');
    }


    public function search(Request $request)
    {
        $keyword = $request->q;

        $reservasi = Reservasi::with(['anak.orangTua.user', 'pengguna', 'layanan', 'pengajuanPembatalan'])
            ->whereHas('anak', function ($q) use ($keyword) {
                $q->where('nama_anak', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Kembalikan partial view hanya isi <tbody>
        return view('admin.reservasis.partials.table_body', compact('reservasi'))->render();
    }




}
