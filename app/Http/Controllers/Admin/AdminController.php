<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\Setting;
use App\Models\User;
use App\Models\Program;
use Illuminate\Http\Request;

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
        $defaultFee = Setting::get('default_application_fee', 150);
        return view('admin.application-show', compact('application','defaultFee'));
    }

    public function updateStatus(Application $application, Request $request)
    {
        $request->validate([
            'status'         => 'required|in:reviewing,result',
            'result'         => 'nullable|in:accepted,rejected,conditional',
            'admin_notes'    => 'nullable|string|max:1000',
            'payment_amount' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|in:unpaid,paid,waived',
        ]);

        $data = [
            'status'      => $request->status,
            'result'      => $request->result,
            'admin_notes' => $request->admin_notes,
        ];

        if ($request->filled('payment_amount')) {
            $data['payment_amount'] = $request->payment_amount;
        }
        if ($request->filled('payment_status')) {
            $data['payment_status'] = $request->payment_status;
            if ($request->payment_status === 'paid' && !$application->paid_at) {
                $data['paid_at'] = now();
            }
        }

        $application->update($data);

        return back()->with('success', 'Application updated.');
    }

    public function uploadOfferLetter(Application $application, Request $request)
    {
        $request->validate(['offer_letter' => 'required|file|mimes:pdf|max:10240']);

        $file      = $request->file('offer_letter');
        $filename  = 'offer_letter_' . $application->id . '_' . time() . '.pdf';
        $dir       = storage_path('app/offer-letters');
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $file->move($dir, $filename);

        $application->update(['offer_letter_path' => 'offer-letters/' . $filename]);

        return back()->with('success', 'Offer letter uploaded.');
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
