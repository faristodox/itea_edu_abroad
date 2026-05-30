<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:120',
            'phone'             => 'nullable|string|max:30',
            'nationality'       => 'nullable|string|max:60',
            'date_of_birth'     => 'nullable|date',
            'address'           => 'nullable|string|max:300',
            'education_level'   => 'nullable|string|max:60',
            'institution'       => 'nullable|string|max:200',
            'graduation_year'   => 'nullable|string|max:10',
            'gpa'               => 'nullable|string|max:10',
        ]);

        Auth::user()->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}
