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
            'stripe_mode'             => Setting::get('stripe_mode', 'test'),
            'stripe_key'              => Setting::get('stripe_key', config('services.stripe.key')),
            'stripe_secret'           => Setting::get('stripe_secret', config('services.stripe.secret')),
        ];
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'default_application_fee' => 'required|numeric|min:0',
            'stripe_mode'             => 'required|in:test,live',
            'stripe_key'              => 'required|string',
            'stripe_secret'           => 'required|string',
        ]);

        Setting::set('default_application_fee', $request->default_application_fee);
        Setting::set('stripe_mode',   $request->stripe_mode);
        Setting::set('stripe_key',    $request->stripe_key);
        Setting::set('stripe_secret', $request->stripe_secret);

        return back()->with('success', 'Settings saved.');
    }
}
