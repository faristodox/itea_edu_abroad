<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\User;
use App\Models\Program;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total'      => Application::count(),
            'draft'      => Application::where('status','draft')->count(),
            'submitted'  => Application::where('status','submitted')->count(),
            'reviewing'  => Application::where('status','reviewing')->count(),
            'result'     => Application::where('status','result')->count(),
            'applicants' => User::where('is_admin',false)->count(),
            'programs'   => Program::count(),
        ];
        $recent = Application::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats','recent'));
    }

    public function applications()
    {
        $applications = Application::with('user')->latest()->paginate(20);
        return view('admin.applications', compact('applications'));
    }

    public function showApplication(Application $application)
    {
        $application->load('user','documents');
        return view('admin.application-show', compact('application'));
    }

    public function updateStatus(Application $application, \Illuminate\Http\Request $request)
    {
        $request->validate([
            'status' => 'required|in:reviewing,result',
            'result' => 'nullable|in:accepted,rejected,conditional',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status'      => $request->status,
            'result'      => $request->result,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Application status updated.');
    }

    public function downloadDocument(ApplicationDocument $document)
    {
        $fullPath = storage_path('app/' . $document->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return response()->download($fullPath, $document->original_name);
    }
}
