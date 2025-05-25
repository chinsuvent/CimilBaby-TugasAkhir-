<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $layanan = Layanan::orderBy('created_at','DESC')->get();

        return view('layanans.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Layanan::create($request->all());

        return redirect()->route('layanans')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('layanans.show', compact('layanans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('layanans.edit', compact('layanan'));
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
