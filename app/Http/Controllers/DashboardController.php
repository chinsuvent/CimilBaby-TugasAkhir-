<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Anak;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Hitung reservasi hari ini
    $totalReservasiHariIni = Reservasi::whereDate('tgl_masuk', today())->count();

    // Hitung reservasi pending
    $totalReservasiPending = Reservasi::where('status', 'Pending')->count();

    // Hitung jumlah anak yang reservasi hari ini
    $jumlahAnakHariIni = Reservasi::whereDate('tgl_masuk', today())
                         ->distinct('anaks_id')
                         ->count('anaks_id');

    // Jumlah anak laki-laki
    $jumlahLaki = Anak::where('jenis_kelamin', 'Laki-laki')->count();

    // Jumlah anak perempuan
    $jumlahPerempuan = Anak::where('jenis_kelamin', 'Perempuan')->count();

    // Ambil 5 data reservasi dengan status pending
    $reservasi = Reservasi::where('status', 'Pending')
                  ->orderBy('tgl_masuk', 'desc')
                  ->limit(5)
                  ->get();

    // Hitung jumlah reservasi per bulan untuk diagram
    $reservasiPerBulan = Reservasi::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('tgl_masuk', date('Y'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // Buat array default 12 bulan dengan nilai 0
    $dataReservasiPerBulan = array_fill(1, 12, 0);

    // Isi array dengan data hasil query
    foreach ($reservasiPerBulan as $row) {
        $dataReservasiPerBulan[$row->bulan] = $row->total;
    }

    return view('dashboard', compact(
        'totalReservasiHariIni',
        'totalReservasiPending',
        'jumlahAnakHariIni',
        'reservasi',
        'dataReservasiPerBulan',
        'jumlahLaki',
        'jumlahPerempuan' 
    ));
}




   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
