<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckinCheckout;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckinCheckoutController extends Controller
{
public function index()
{
    $today = Carbon::today();

    // Ambil reservasi yang aktif hari ini & status diterima
    $reservasis = Reservasi::whereDate('tgl_masuk', '<=', $today)
        ->whereDate('tgl_keluar', '>=', $today)
        ->where('status', 'Diterima') // ✅ hanya yang diterima
        ->with(['anak', 'layanan'])
        ->get();

    // Ambil semua data checkin-checkout HANYA untuk hari ini
    $checkinsToday = CheckinCheckout::whereDate('created_at', $today)
        ->get()
        ->keyBy('reservasis_id');

    return view('admin.checkin_checkout.index', compact('reservasis', 'checkinsToday'));
}




    public function checkin($id)
    {
        $exists = CheckinCheckout::where('reservasis_id', $id)->whereDate('created_at', Carbon::today())->first();

        if (!$exists) {
            CheckinCheckout::create([
                'reservasis_id' => $id,
                'waktu_checkin' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil melakukan check-in.');

    }

    public function checkout($id)
    {
        $check = CheckinCheckout::where('reservasis_id', $id)
            ->whereNull('waktu_checkout') // cukup pastikan belum checkout
            ->first();

        if ($check) {
            $check->update([
                'waktu_checkout' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil melakukan check-out.');

    }

    public function indexOrangtua()
{
    $user = Auth::user();

    $anakIds = \App\Models\Anak::whereHas('orangTua', function ($q) use ($user) {
        $q->where('users_id', $user->id);
    })->pluck('id');

    $reservasis = \App\Models\Reservasi::whereIn('anaks_id', $anakIds)
        ->where('status', 'Diterima') // ✅ hanya yang status diterima
        ->get();

    $checkinsToday = \App\Models\CheckinCheckout::whereDate('created_at', now()->toDateString())
        ->get()
        ->keyBy('reservasis_id');

    return view('pelanggan.kehadiran', compact('reservasis', 'checkinsToday'));
}



}
