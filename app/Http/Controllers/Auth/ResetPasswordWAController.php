<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class ResetPasswordWAController extends Controller
{
    public function showForm()
    {
        return view('auth.lupa-password-wa');
    }

    public function sendToken(Request $request)
{
    $request->validate([
        'no_hp' => 'required',
    ]);

    // Format ke 62xxxxxxxx
    $no_hp = preg_replace('/^0/', '62', $request->no_hp);

    // Cari user berdasarkan no_hp di tabel orang_tua
    $user = \App\Models\User::whereHas('orangTua', function ($query) use ($request, $no_hp) {
        $query->where('no_hp', $request->no_hp)
              ->orWhere('no_hp', $no_hp);
    })->first();

    if (!$user) {
        return back()->withErrors(['no_hp' => 'Nomor tidak ditemukan']);
    }

    $token = Str::random(6);
    $user->reset_token = $token;
    $user->save();

    // Kirim ke WA
    $pesan = "Kode reset password Anda: *{$token}*.\nGunakan kode ini untuk mengatur ulang password Anda.";
    $this->sendFonnte($no_hp, $pesan);

    return redirect()->route('form.verifikasi.token')->with('success', 'Token berhasil dikirim ke WhatsApp Anda.');

}


    public function verifyForm($token)
    {
        $user = User::where('reset_token', $token)->first();
        if (!$user) {
            return abort(404, 'Token tidak valid');
        }

        return view('auth.reset-password-wa', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');

    }

    private function sendFonnte($to, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'xrb29R157HH8WQe7YgXS', // Ganti dengan tokenmu
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $to,
            'message' => $message,
            'delay' => 1,
        ]);

        // Log responsenya agar bisa dicek jika tidak berhasil
        logger('Fonnte response: ' . $response->body());
    }

    public function showInputTokenForm()
{
    return view('auth.input-token-wa'); // Buat view ini nanti
}

}
