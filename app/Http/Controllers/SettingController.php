<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('key', 'admin_whatsapp')->first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate(['number' => 'required|string']);
        Setting::updateOrCreate(
            ['key' => 'admin_whatsapp'],
            ['value' => $request->number]
        );
        return redirect()->back()->with('success', 'Nomor berhasil diperbarui.');
    }

    public function getFooterSetting()
    {
        $waSetting = Setting::where('key', 'admin_whatsapp')->first();
        return view('admin.layouts.footer', compact('waSetting'));
    }
}
