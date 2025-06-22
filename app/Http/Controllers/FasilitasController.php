<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       $fasilitas = Fasilitas::orderBy('created_at','DESC')->paginate(10);

        return view('fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dulu
        $request->validate([
            'nama_fasilitas' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Siapkan data
        $data = $request->only(['nama_fasilitas', 'deskripsi']);

        // Jika ada gambar, simpan
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/fasilitas'), $filename);
            $data['gambar'] = $filename;
        }

        // Simpan ke DB
        Fasilitas::create($data);

        // Redirect
        return redirect()->route('fasilitas')->with('added', true);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('fasilitas.show', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $data = $request->only(['nama_fasilitas', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,jpg,png|max:2048',
            ]);

            // Hapus gambar lama (jika ada)
            if ($fasilitas->gambar && file_exists(public_path('uploads/fasilitas/' . $fasilitas->gambar))) {
                unlink(public_path('uploads/fasilitas/' . $fasilitas->gambar));
            }

            // Simpan gambar baru
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/fasilitas'), $namaGambar);

            $data['gambar'] = $namaGambar;
        }

        $fasilitas->update($data);

        return redirect()->route('fasilitas')->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->delete();

        return redirect()->route('fasilitas')->with('deleted', true);
    }

}
