<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                // Handle file upload for images
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    if ($setting->value) {
                        Storage::delete('public/' . $setting->value);
                    }
                    $value = $request->file($key)->store('settings', 'public');
                }
                
                Setting::set($key, $value);
            }
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
