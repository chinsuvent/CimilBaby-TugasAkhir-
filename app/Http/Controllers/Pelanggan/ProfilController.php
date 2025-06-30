<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $pelanggan = Auth::user();
        return view('pelanggan.profil', compact('pelanggan'));
    }

    public function editProfil()
    {
        $pelanggan = Auth::user();
        return view('pelanggan.editProfil', compact('pelanggan'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama_orang_tua' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $pelanggan = Auth::user();
        $pelanggan->name = $request->nama_orang_tua;
        $pelanggan->username = $request->username;
        $pelanggan->email = $request->email;
        $pelanggan->no_hp = $request->no_hp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui.');
    }

}
