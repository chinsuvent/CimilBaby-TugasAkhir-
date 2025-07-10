<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah sudah punya data orang tua
        if (!$user->orangTua) {
            $user->orangTua()->create([
                'no_hp' => null,
                'alamat' => null,
                'users_id' => $user->id,
            ]);
        }

        $pelanggan = $user->orangTua;

        return view('pelanggan.profil', compact('pelanggan', 'user'));
    }

    public function editProfil()
    {
        $user = Auth::user();
        $orangTua = $user->orangTua;

        return view('pelanggan.editProfil', compact('orangTua', 'user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $orangTua = $user->orangTua;

        // Jika belum ada data orang tua, buat baru
        if (!$orangTua) {
            $orangTua = new OrangTua();
            $orangTua->users_id = $user->id;
        }

        $orangTua->no_hp = $request->no_hp;
        $orangTua->alamat = $request->alamat;
        $orangTua->save();

        // Optional: update is_profile_complete di tabel users
        $user->is_profile_complete = true;
        $user->save();

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui.');
    }



    public function formPassword() {
        return view('pelanggan.ubah_password');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('pelanggan.profil')->with('success', 'Password berhasil diubah.');
    }

}
