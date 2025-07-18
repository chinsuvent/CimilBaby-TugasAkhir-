<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anak = Anak::with('orangTua.user')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);

        return view('admin.anaks.index', compact('anak'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anaks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Anak::create($request->all());

        return redirect()->route('anak')->with('added', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anak = Anak::findOrFail($id);

        return view('admin.anaks.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anak = Anak::findOrFail($id);

        return view('admin.anaks.edit', compact('anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anak = Anak::findOrFail($id);

        $anak->update($request->all());

        return redirect()->route('anaks')->with('edited', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anak = Anak::findOrFail($id);
        $anak->delete();
        return redirect()->route('anaks')->with('deleted',true);
    }

    // The getUsiaAttribute accessor should be placed in the Anak model, not in the controller.

}
