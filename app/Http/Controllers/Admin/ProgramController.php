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
        $validated['image'] = $this->handleImageUpload($request, null);
        Program::create($validated);
        return redirect()->route('admin.programs')->with('success', 'Programme added.');
    }

    public function edit(Program $program)
    {
        return view('admin.program-form', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $this->validated($request);
        $validated['image'] = $this->handleImageUpload($request, $program);
        $program->update($validated);
        return redirect()->route('admin.programs')->with('success', 'Programme updated.');
    }

    public function destroy(Program $program)
    {
        if ($program->image && !in_array($program->image, ['uni-zust.png','sdut.jpg','jufe.jpg','hmu.jpg'])) {
            $path = public_path('assets/' . $program->image);
            if (file_exists($path)) unlink($path);
        }
        $program->delete();
        return back()->with('success', 'Programme deleted.');
    }

    private function handleImageUpload(Request $request, ?Program $program): ?string
    {
        // Remove image if checkbox ticked
        if ($request->boolean('remove_image')) {
            if ($program?->image) {
                $path = public_path('assets/' . $program->image);
                if (file_exists($path) && !in_array($program->image, ['uni-zust.png','sdut.jpg','jufe.jpg','hmu.jpg'])) {
                    unlink($path);
                }
            }
            return null;
        }

        // Upload new image
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $file      = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename  = 'prog_' . time() . '_' . uniqid() . '.' . strtolower($extension);
            $file->move(public_path('assets'), $filename);
            return $filename;
        }

        // Keep existing image
        return $program?->image;
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'            => 'required|string|max:200',
            'destination'     => 'required|string|max:60',
            'level'           => 'required|string|max:60',
            'university'      => 'nullable|string|max:200',
            'city'            => 'nullable|string|max:100',
            'duration'        => 'nullable|string|max:60',
            'language'        => 'nullable|string|max:60',
            'intake'          => 'nullable|string|max:100',
            'tuition'         => 'nullable|string|max:100',
            'description'     => 'nullable|string|max:1000',
            'status'          => 'required|in:active,inactive',
            'application_fee' => 'nullable|numeric|min:0',
            'image_file'      => 'nullable|image|max:5120',
        ]);
    }
}
