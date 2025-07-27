<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\PengajuanPembatalan;
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
    public function index(Request $request)
{
    $query = Reservasi::query();
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
        $token = env('FONNTE_API_KEY');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $targetPhone,
                'message' => $message,
                'countryCode' => '62', // pastikan 62 untuk Indonesia
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
        $status = $request->status;
        $noHp = $reservasi->anak?->orangTua?->no_hp;

        if ($noHp) {
            $message = "Reservasi dengan nama anak *$namaAnak* telah *$status*. Terima kasih telah menggunakan layanan kami.";
            $this->kirimWhatsapp($noHp, $message);
        }

        return redirect()->back()->with('edited', 'Reservasi berhasil dikonfirmasi.');
    }



    public function konfirmasiPembatalan(Request $request, $id)
    {
        // Eager loading anak dan orangTua saja (tidak perlu pengguna)
        $reservasi = Reservasi::with('anak.orangTua')->findOrFail($id);
        $pengajuan = $reservasi->pengajuanPembatalan;

        if (!$pengajuan) {
            return back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $namaAnak = $reservasi->anak->nama_anak ?? 'Anak Anda'; // Pastikan nama kolom sesuai di DB
        $noHp = $reservasi->anak?->orangTua?->no_hp;

        if ($request->konfirmasi === 'terima') {
            $reservasi->status = 'dibatalkan';
            $reservasi->save();
            $pengajuan->delete();

            if ($noHp) {
                $message = "Permohonan pembatalan reservasi dengan nama anak *$namaAnak* telah *DITERIMA*. Reservasi dibatalkan.";
                $this->kirimWhatsapp($noHp, $message);
            }

            return back()->with('success', 'Reservasi berhasil dibatalkan.');
        }

        if ($request->konfirmasi === 'tolak') {
            $pengajuan->delete();

            if ($noHp) {
                $message = "Permohonan pembatalan reservasi untuk nama anak *$namaAnak* *DITOLAK*.";
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
