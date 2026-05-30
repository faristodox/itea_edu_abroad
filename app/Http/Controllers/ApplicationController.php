<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;
use App\Models\Program;
use App\Mail\ApplicationSubmitted;

class ApplicationController extends Controller
{
    public function create()
    {
        $programs = Program::where('status','active')->orderBy('destination')->orderBy('name')->get();
        return view('auth.apply', ['existing' => null, 'programs' => $programs]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateApplication($request);
        $validated['user_id'] = Auth::id();
        $validated['status']  = 'draft';
        $application = Application::create($validated);

        return redirect()->route('portal.application', $application->id)
            ->with('success', 'Application saved as draft.');
    }

    public function edit(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        abort_unless($application->status === 'draft', 403);
        $programs = Program::where('status','active')->orderBy('destination')->orderBy('name')->get();
        return view('auth.apply', ['existing' => $application, 'programs' => $programs]);
    }

    public function update(Request $request, Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        abort_unless($application->status === 'draft', 403);
        $validated = $this->validateApplication($request);
        $application->update($validated);

        return redirect()->route('portal.application', $application->id)
            ->with('success', 'Application updated.');
    }

    public function show(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        return view('auth.application-status', compact('application'));
    }

    public function submit(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        abort_unless($application->status === 'draft', 403);

        $application->update([
            'status'       => 'submitted',
            'submitted_at' => now(),
        ]);

        try {
            Mail::to(Auth::user()->email)->send(new ApplicationSubmitted($application));
        } catch (\Exception $e) {
            // Mail failure should not block submission
        }

        return redirect()->route('portal.application', $application->id)
            ->with('success', 'Application submitted! We will review it within 48 hours.');
    }

    private function validateApplication(Request $request): array
    {
        return $request->validate([
            'program_name'           => 'required|string|max:200',
            'destination'            => 'required|string|max:60',
            'level'                  => 'required|string|max:60',
            'university'             => 'nullable|string|max:200',
            'intake'                 => 'nullable|string|max:60',
            'full_name'              => 'required|string|max:120',
            'date_of_birth'          => 'nullable|date',
            'nationality'            => 'nullable|string|max:60',
            'phone'                  => 'nullable|string|max:30',
            'address'                => 'nullable|string|max:300',
            'current_education_level'=> 'nullable|string|max:60',
            'current_institution'    => 'nullable|string|max:200',
            'graduation_year'        => 'nullable|string|max:10',
            'gpa'                    => 'nullable|string|max:10',
            'personal_statement'     => 'nullable|string|max:3000',
        ]);
    }
}
