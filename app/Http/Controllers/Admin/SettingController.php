<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'default_application_fee' => Setting::get('default_application_fee', 150),
        ];
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'default_application_fee' => 'required|numeric|min:0',
        ]);

        Setting::set('default_application_fee', $request->default_application_fee);

        return back()->with('success', 'Settings saved.');
    }
}
