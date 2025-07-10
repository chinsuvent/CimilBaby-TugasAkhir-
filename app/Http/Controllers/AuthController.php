<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('/auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            // 'no_hp' => 'required',
            // 'alamat' => 'required',
            'password' => 'required'
        ])->validate();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // 'no_hp' => $request->no_hp,
            // 'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'level' => 'Pengguna'
        ]);

        return redirect()->route('login')->with('register','Silahkan Login Terlebih Dahulu!');
    }

    public function login()
    {
        return view('/auth/login');
    }

    public function loginAction(Request $request)
{
    Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required'
    ])->validate();

    if (!Auth::attempt($request->only('username','password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'username' => trans('auth.failed')
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // Jika level pengguna
    if ($user->level === 'Pengguna') {
        if (!$user->is_profile_complete) {
            // Belum isi data diri
            return redirect()->route('pelanggan.profil')->with('info', 'Silakan lengkapi data diri Anda terlebih dahulu.');
        }

        return redirect()->route('pelanggan.dashboard')->with('success', 'Selamat datang kembali!');
    }

    // Untuk admin atau level lain
    return redirect()->route('dashboard')->with('success', 'Selamat Anda Berhasil Login!');
}



    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect()->route('logout')->with('success', 'Anda Telah Logout');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda Telah Logout');
    }
}
