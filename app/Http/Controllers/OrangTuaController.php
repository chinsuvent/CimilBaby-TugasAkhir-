<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index()
    {
        $data = OrangTua::all();
        return view('orangtua.index', compact('data'));
    }

    public function create()
    {
        return view('orangtua.create');
    }

    public function store(Request $request)
    {
        OrangTua::create($request->all());
        return redirect()->route('orangtua.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(OrangTua $orangTua)
    {
        return view('orangtua.show', compact('orangTua'));
    }

    public function edit(OrangTua $orangTua)
    {
        return view('orangtua.edit', compact('orangTua'));
    }

    public function update(Request $request, OrangTua $orangTua)
    {
        $orangTua->update($request->all());
        return redirect()->route('orangtua.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(OrangTua $orangTua)
    {
        $orangTua->delete();
        return redirect()->route('orangtua.index')->with('success', 'Data berhasil dihapus.');
    }
}
