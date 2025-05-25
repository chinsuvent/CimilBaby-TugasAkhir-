<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $reservasi = Reservasi::orderBy('created_at','DESC')->get();

        return view('reservasis.index', compact('reservasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reservasi::create($request->all());

        return redirect()->route('reservasi')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasis.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasis.edit', compact('reservasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update($request->all());

        return redirect()->route('reservasis')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('rese$reservasis')->with('deleted',true);
    }

    public function konfirmasi(Request $request, $id)
    {
        // Validasi status harus Diterima atau Ditolak
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        // Temukan data reservasi berdasarkan ID
        $reservasi = Reservasi::findOrFail($id);

        // Ubah status reservasi
        $reservasi->status = $request->status;
        $reservasi->save();

        // Redirect kembali ke halaman sebelumnya dengan notifikasi berhasil
        return redirect()->back()->with('edited', true);
    }


}
