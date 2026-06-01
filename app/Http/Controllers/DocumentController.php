<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\DocumentType;

class DocumentController extends Controller
{
    public function index(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        $documents     = $application->documents;
        $documentTypes = DocumentType::active()->get();
        return view('auth.documents', compact('application', 'documents', 'documentTypes'));
    }

    public function store(Request $request, Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);

        $request->validate([
            'document_type' => 'required|string',
            'file'          => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        $file      = $request->file('file');
        $extension = $file->getClientOriginalExtension() ?: 'pdf';
        $filename  = time() . '_' . uniqid() . '.' . strtolower($extension);
        $mimeType  = $file->getMimeType();
        $fileSize  = $file->getSize();
        $origName  = $file->getClientOriginalName();
        $dir       = storage_path('app/documents/user-' . Auth::id());
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);
        $path = 'documents/user-' . Auth::id() . '/' . $filename;

        ApplicationDocument::create([
            'application_id' => $application->id,
            'user_id'        => Auth::id(),
            'document_type'  => $request->document_type,
            'original_name'  => $origName,
            'file_path'      => $path,
            'mime_type'      => $mimeType,
            'file_size'      => $fileSize,
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function destroy(ApplicationDocument $document)
    {
        abort_unless($document->user_id === Auth::id(), 403);
        $fullPath = storage_path('app/' . $document->file_path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        $document->delete();
        return back()->with('success', 'Document removed.');
    }
}
