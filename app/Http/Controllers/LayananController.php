<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $layanan = Layanan::orderBy('created_at','DESC')->paginate(10);

        return view('admin.layanans.index', compact('layanan'));

    }

    public function beranda()
{
    $layanan = Layanan::orderBy('created_at','DESC')->take(3)->get();
    return view('beranda', compact('layanan'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fasilitas = Fasilitas::all(); // ambil semua fasilitas
        return view('admin.layanans.create', compact('fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'biaya' => 'required|numeric',
            'fasilitas' => 'array|nullable'
        ]);

        $layanan = Layanan::create([
            'jenis_layanan' => $request->jenis_layanan,
            'biaya' => $request->biaya
        ]);

        if ($request->has('fasilitas')) {
            $layanan->fasilitas()->attach($request->fasilitas);
        }

        return redirect()->route('layanans')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $layanan = Layanan::with('fasilitas')->findOrFail($id);
        return view('admin.layanans.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('admin.layanans.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->update($request->all());

        return redirect()->route('layanans')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->delete();

        return redirect()->route('layanans')->with('deleted', true);
    }

}
