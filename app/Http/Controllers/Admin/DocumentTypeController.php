<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $types = DocumentType::orderBy('sort_order')->get();
        return view('admin.document-types', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:60|unique:document_types,name',
            'label'      => 'required|string|max:120',
            'required'   => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        DocumentType::create([
            'name'       => strtolower(str_replace(' ', '_', $request->name)),
            'label'      => $request->label,
            'required'   => $request->boolean('required'),
            'active'     => true,
            'sort_order' => $request->sort_order ?? DocumentType::max('sort_order') + 1,
        ]);

        return back()->with('success', 'Document type added.');
    }

    public function update(Request $request, DocumentType $documentType)
    {
        $request->validate([
            'label'      => 'required|string|max:120',
            'required'   => 'boolean',
            'active'     => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $documentType->update([
            'label'      => $request->label,
            'required'   => $request->boolean('required'),
            'active'     => $request->boolean('active'),
            'sort_order' => $request->sort_order,
        ]);

        return back()->with('success', 'Document type updated.');
    }

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        return back()->with('success', 'Document type deleted.');
    }
}
