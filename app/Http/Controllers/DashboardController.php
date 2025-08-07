<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Anak;
use App\Models\CheckinCheckout;
use App\Models\WhatsappConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil reservasi yang lewat dari tanggal masuk dan masih pending
        $expiredReservations = Reservasi::with('anak.orangTua')
            ->where('status', 'Pending')
            ->whereDate('tgl_masuk', '<', now()->toDateString())
            ->get();

        foreach ($expiredReservations as $reservasi) {
            $reservasi->status = 'Ditolak';
            $reservasi->save();

            $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda';
            $noHp = $reservasi->anak?->orangTua?->no_hp;

            if ($noHp) {
                $pesan = "Reservasi dengan nama anak *$namaAnak* otomatis *DITOLAK* karena melebihi tanggal masuk dan belum dikonfirmasi.";
                $this->kirimWhatsapp($noHp, $pesan);
            }
        }

        // Hitung data dashboard
        $totalReservasiDiterima = Reservasi::where('status', 'Diterima')->count();
        $totalReservasiDitolak = Reservasi::where('status', 'Ditolak')->count();
        $totalReservasiPending = Reservasi::where('status', 'Pending')->count();

        $jumlahAnakHariIni = CheckinCheckout::whereNotNull('waktu_checkin')
            ->whereNull('waktu_checkout')
            ->count();

        $today = now()->toDateString();
        $totalCheckinHariIni = CheckinCheckout::whereDate('waktu_checkin', $today)->count();
        $totalCheckoutHariIni = CheckinCheckout::whereDate('waktu_checkout', $today)->count();

        $jumlahLaki = Anak::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = Anak::where('jenis_kelamin', 'Perempuan')->count();

        $reservasi = Reservasi::where('status', 'Pending')
                      ->orderBy('tgl_masuk', 'desc')
                      ->limit(5)
                      ->get();

        $reservasiPerBulan = Reservasi::select(
                DB::raw('MONTH(tgl_masuk) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tgl_masuk', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $dataReservasiPerBulan = array_fill(1, 12, 0);
        foreach ($reservasiPerBulan as $row) {
            $dataReservasiPerBulan[$row->bulan] = $row->total;
        }

        return view('admin.dashboard', compact(
            'totalReservasiDiterima',
            'totalReservasiDitolak',
            'totalReservasiPending',
            'jumlahAnakHariIni',
            'reservasi',
            'dataReservasiPerBulan',
            'jumlahLaki',
            'jumlahPerempuan',
            'totalCheckinHariIni',
            'totalCheckoutHariIni'
        ));
    }

    protected function kirimWhatsapp($targetPhone, $message)
    {
        $config = WhatsappConfig::first();

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
}
