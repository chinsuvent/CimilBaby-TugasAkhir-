<?php

namespace App\Http\Controllers;

use App\Models\JadwalLayanan;
use Illuminate\Http\Request;

class JadwalLayananController extends Controller
{
    /**
     * Tampilkan semua jadwal layanan.
     */
    public function index()
    {
        // Ambil semua jadwal dari database
        $jadwal = JadwalLayanan::paginate(10); // atau jumlah baris per halaman yang kamu mau


        // Kirim ke view jadwal/index.blade.php
        return view('admin.jadwal_layanans.index', compact('jadwal'));
    }
}
