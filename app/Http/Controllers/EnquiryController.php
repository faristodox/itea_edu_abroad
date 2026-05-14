<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120',
            'email'       => 'required|email|max:200',
            'whatsapp'    => 'nullable|string|max:30',
            'destination' => 'nullable|string|max:60',
            'level'       => 'nullable|string|max:60',
            'intake'      => 'nullable|string|max:60',
            'message'     => 'nullable|string|max:2000',
        ]);

        Enquiry::create($validated);

        return back()
            ->with('enquiry_success', true)
            ->with('enquiry_name', $validated['name'])
            ->with('enquiry_destination', $validated['destination'] ?? 'your destination');
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:120',
            'email'    => 'required|email|max:200',
            'whatsapp' => 'nullable|string|max:30',
            'topic'    => 'nullable|string|max:80',
            'office'   => 'nullable|string|max:60',
            'message'  => 'required|string|max:3000',
        ]);

        // TODO: Save to DB / dispatch routed mail to the correct desk.

        return back()->with('contact_success', true);
    }
}
