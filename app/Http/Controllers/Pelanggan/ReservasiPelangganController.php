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




class ReservasiPelangganController extends Controller
{

    public function index()
    {
        $orangTua = Auth::user()->orangTua;

        if (!$orangTua) {
            return back()->with('error', 'Data orang tua tidak ditemukan. Silakan lengkapi profil terlebih dahulu.');
        }

        $anakUser = $orangTua->anaks;

        $reservasi = Reservasi::with('pengajuanPembatalan')->whereIn('anaks_id', function ($query) use ($orangTua) {
            $query->select('id')
                ->from('anaks')
                ->where('orang_tua_id', $orangTua->id);
        })->orderBy('created_at', 'desc')->get();

        $reservasi_diterima = Reservasi::with('pengajuanPembatalan')
        ->where('status', 'Diterima') 
        ->whereIn('anaks_id', function ($query) use ($orangTua) {
            $query->select('id')
                ->from('anaks')
                ->where('orang_tua_id', $orangTua->id);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        $today = Carbon::today();

        foreach ($reservasi_diterima as $rs) {
            if (
                $rs->status === 'Diterima' &&
                Carbon::parse($rs->tgl_masuk)->lt($today) &&
                Carbon::parse($rs->tgl_keluar)->lt($today)
            ) {
                $rs->status = 'Selesai';
                $rs->save();
            }
        }

        $paginator = Reservasi::with('pengajuanPembatalan')
        ->whereIn('anaks_id', function ($query) use ($orangTua) {
            $query->select('id')
                ->from('anaks')
                ->where('orang_tua_id', $orangTua->id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        // Ambil biaya layanan
        $layanans = Layanan::all()->keyBy('jenis_layanan');

        return view('pelanggan.riwayat_reservasi', [
            'reservasi' => $paginator,
            'anakUser' => $anakUser,
            'layanans' => $layanans
        ]);
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
        $layanan = $reservasi->layanan->jenis_layanan ?? 'Layanan';
        $tglMasuk = $reservasi->tgl_masuk ?? '-';
        $tglKeluar = $reservasi->tgl_keluar ?? '-';
        $alasan = $request->alasan;
        $namaAnak = $reservasi->anak->nama ?? '-';

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

        $reservasi = Reservasi::with(['anak', 'layanan'])
            ->whereIn('anaks_id', $anakIds)
            ->findOrFail($id);

        if ($reservasi->status !== 'Pending') {
            return redirect()->back()->with('error', 'Reservasi tidak dapat dibatalkan.');
        }

        $reservasi->update(['status' => 'Dibatalkan']);

        // Kirim WhatsApp ke admin
        $layananNama = $reservasi->layanan->jenis_layanan ?? 'Layanan Tidak Diketahui';
        $namaAnak = $reservasi->anak->nama ?? '-';

        $pesan = "*Reservasi Dibatalkan!*\n\n"
            . "Nama Anak: *{$namaAnak}*\n"
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
        $namaAnak = $reservasi->anak->nama ?? '-';

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
        $token = env('FONNTE_API_KEY');

        // Ambil nomor dari tabel settings
        $setting = \App\Models\Setting::where('key', 'admin_whatsapp')->first();
        $adminPhone = $setting?->value ?? null;

        if (!$adminPhone) {
            Log::error('Nomor admin tidak ditemukan di settings.');
            return;
        }

        // Format: ubah 08xxxx jadi 62xxxx
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
        curl_close($curl);

        Log::info('Fonnte WA response:', ['response' => $response]);
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'anaks_id' => 'required|exists:anaks,id',
        'jenis_layanan' => 'required|in:harian,bulanan,khusus',
        'tgl_masuk' => 'required|date',
        'tgl_keluar' => 'required_if:jenis_layanan,bulanan,harian|nullable|date|after_or_equal:tgl_masuk',
    ]);

    $user = Auth::user();
    $orangTua = OrangTua::where('user_id', $user->id)->firstOrFail();

    // Validasi tumpang tindih reservasi
    $reservasiAktif = false;

    if (in_array($validated['jenis_layanan'], ['harian', 'bulanan'])) {
        // Tidak boleh tumpang tindih dengan reservasi harian/bulanan lainnya
        $reservasiAktif = Reservasi::whereHas('anak', function ($query) use ($orangTua, $validated) {
                $query->where('orang_tua_id', $orangTua->id)
                      ->where('id', $validated['anaks_id']);
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('tgl_masuk', [$validated['tgl_masuk'], $validated['tgl_keluar']])
                      ->orWhereBetween('tgl_keluar', [$validated['tgl_masuk'], $validated['tgl_keluar']])
                      ->orWhere(function ($query) use ($validated) {
                          $query->where('tgl_masuk', '<=', $validated['tgl_masuk'])
                                ->where('tgl_keluar', '>=', $validated['tgl_keluar']);
                      });
            })
            ->whereIn('jenis_layanan', ['harian', 'bulanan'])
            ->exists();

        if ($reservasiAktif) {
            return redirect()->back()->with('error', 'Sudah ada reservasi harian/bulanan aktif di rentang tanggal tersebut.');
        }

        // Tambahan validasi harian hanya boleh satu di satu tanggal
        if ($validated['jenis_layanan'] === 'harian') {
            $duplicateHarian = Reservasi::whereHas('anak', function ($query) use ($orangTua, $validated) {
                    $query->where('orang_tua_id', $orangTua->id)
                          ->where('id', $validated['anaks_id']);
                })
                ->where('jenis_layanan', 'harian')
                ->whereDate('tgl_masuk', $validated['tgl_masuk'])
                ->exists();

            if ($duplicateHarian) {
                return redirect()->back()->with('error', 'Anda sudah memiliki reservasi harian pada tanggal tersebut.');
            }
        }

    } elseif ($validated['jenis_layanan'] === 'khusus') {
        // Khusus hanya boleh satu per tanggal
        $reservasiAktif = Reservasi::whereHas('anak', function ($query) use ($orangTua, $validated) {
                $query->where('orang_tua_id', $orangTua->id)
                      ->where('id', $validated['anaks_id']);
            })
            ->where('jenis_layanan', 'khusus')
            ->whereDate('tgl_masuk', $validated['tgl_masuk'])
            ->exists();

        if ($reservasiAktif) {
            return redirect()->back()->with('error', 'Anda sudah memiliki reservasi layanan khusus di tanggal tersebut.');
        }
    }

    // Simpan reservasi
    Reservasi::create([
        'anaks_id' => $validated['anaks_id'],
        'jenis_layanan' => $validated['jenis_layanan'],
        'tgl_masuk' => $validated['tgl_masuk'],
        'tgl_keluar' => $validated['jenis_layanan'] === 'khusus' ? $validated['tgl_masuk'] : $validated['tgl_keluar'],
        'status' => 'Menunggu Konfirmasi',
    ]);

    return redirect()->route('riwayat-reservasi.index')->with('success', 'Reservasi berhasil dibuat.');
}




}
