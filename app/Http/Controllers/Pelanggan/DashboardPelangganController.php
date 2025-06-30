<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;
use App\Models\Reservasi; // pastikan model Reservasi sudah ada

class DashboardPelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Auth::user();

        // Ambil data anak milik pelanggan
        $anakList = Anak::where('users_id', $pelanggan->id)->paginate(10);

        // Hitung jumlah anak
        $jumlahAnak = Anak::where('users_id', $pelanggan->id)->count();

        // Hitung total reservasi yang sudah dilakukan
        $totalReservasi = Reservasi::where('users_id', $pelanggan->id)->count();

        return view('pelanggan.dashboard', compact('anakList', 'jumlahAnak', 'totalReservasi'));
    }
}
