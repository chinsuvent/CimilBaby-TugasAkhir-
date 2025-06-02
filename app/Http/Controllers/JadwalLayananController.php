<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalLayanan;


class JadwalLayananController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $jadwal_layanan = JadwalLayanan::orderBy('created_at','DESC')->get();
        $jadwal_layanan = JadwalLayanan::with(['anak', 'layanan', ])->get();

        return view('jadwal_layanans.index', compact('jadwal_layanan'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal_layanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JadwalLayanan::create($request->all());

        return redirect()->route('jadwal_layanans')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        return view('jadwal_layanans.show', compact('jadwal_layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        return view('jadwal_layanans.edit', compact('jadwal_layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        $jadwal_layanan->update($request->all());

        return redirect()->route('jadwal_layanans')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal_layanan = JadwalLayanan::findOrFail($id);

        $jadwal_layanan->delete();

        return redirect()->route('jadwal_layanans')->with('deleted', true);
    }
}
