<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(20);
        return view('admin.programs', compact('programs'));
    }

    public function create()
    {
        return view('admin.program-form', ['program' => null]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        Program::create($validated);
        return redirect()->route('admin.programs')->with('success', 'Programme added.');
    }

    public function edit(Program $program)
    {
        return view('admin.program-form', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $program->update($this->validated($request));
        return redirect()->route('admin.programs')->with('success', 'Programme updated.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Programme deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:200',
            'destination' => 'required|string|max:60',
            'level'       => 'required|string|max:60',
            'university'  => 'nullable|string|max:200',
            'city'        => 'nullable|string|max:100',
            'duration'    => 'nullable|string|max:60',
            'language'    => 'nullable|string|max:60',
            'intake'      => 'nullable|string|max:100',
            'tuition'     => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|in:active,inactive',
        ]);
    }
}
