<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckinCheckout;
use App\Models\Reservasi;
use Carbon\Carbon;

class CheckinCheckoutController extends Controller
{
    public function index()
{
    $today = Carbon::today();

    // Ambil semua checkin yang belum checkout
    $checkinsBelumCheckout = CheckinCheckout::whereNull('waktu_checkout')->pluck('reservasis_id')->toArray();

    // Ambil semua reservasi:
    // - yang tgl_masuk-nya hari ini, ATAU
    // - yang pernah check-in tapi belum check-out
    $today = Carbon::today();
    $reservasis = Reservasi::whereDate('tgl_masuk', '<=', $today)
    ->whereDate('tgl_keluar', '>=', $today)
    ->with(['anak', 'layanan', 'checkinCheckout'])
    ->get();

    // Ambil semua checkin hari ini dan sebelumnya
    $checkinsToday = CheckinCheckout::whereIn('reservasis_id', $reservasis->pluck('id'))->get()->keyBy('reservasis_id');

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

        return back()->with('success', 'Check-in berhasil!');
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

        return back()->with('success', 'Check-out berhasil!');
    }

}
