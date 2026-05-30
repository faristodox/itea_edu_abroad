<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\ApplicationDocument;

class DocumentController extends Controller
{
    public function index(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        $documents = $application->documents;
        return view('auth.documents', compact('application', 'documents'));
    }

    public function store(Request $request, Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);

        $request->validate([
            'document_type' => 'required|string',
            'file'          => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        $file = $request->file('file');
        $path = $file->store("documents/user-" . Auth::id(), 'local');

        ApplicationDocument::create([
            'application_id' => $application->id,
            'user_id'        => Auth::id(),
            'document_type'  => $request->document_type,
            'original_name'  => $file->getClientOriginalName(),
            'file_path'      => $path,
            'mime_type'      => $file->getMimeType(),
            'file_size'      => $file->getSize(),
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function destroy(ApplicationDocument $document)
    {
        abort_unless($document->user_id === Auth::id(), 403);
        Storage::disk('local')->delete($document->file_path);
        $document->delete();
        return back()->with('success', 'Document removed.');
    }
}
