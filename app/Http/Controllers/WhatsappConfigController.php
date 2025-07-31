<?php

namespace App\Http\Controllers;

use App\Models\WhatsappConfig;
use Illuminate\Http\Request;

class WhatsappConfigController extends Controller
{
    public function index()
    {
        $config = WhatsappConfig::first();
        return view('admin.ubah_api.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'api_key' => 'required',
        ]);

        $number = $request->number;

        // Konversi 08xxxxxxx ke 62xxxxxxxx
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika sudah 62, biarkan
        // Jika sudah menyimpan dan ingin update, gunakan firstOrNew
        $config = WhatsappConfig::first() ?? new WhatsappConfig();

        $config->number = $number;
        $config->api_key = $request->api_key;
        $config->save();

        return redirect()->back()->with('success', 'Konfigurasi WhatsApp berhasil disimpan.');
    }
}
