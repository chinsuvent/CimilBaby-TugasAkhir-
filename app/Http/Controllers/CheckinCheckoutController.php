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

        // Ambil semua reservasi hari ini
        $reservasis = Reservasi::whereDate('tgl_masuk', $today)->with(['anak', 'layanan'])->get();

        // Ambil data checkin yang sudah dilakukan hari ini
        $checkinsToday = CheckinCheckout::whereDate('created_at', $today)->get()->keyBy('reservasis_id');

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
        $check = CheckinCheckout::where('reservasis_id', $id)->whereDate('created_at', Carbon::today())->first();

        if ($check && !$check->waktu_checkout) {
            $check->update([
                'waktu_checkout' => now()
            ]);
        }

        return back()->with('success', 'Check-out berhasil!');
    }
}
