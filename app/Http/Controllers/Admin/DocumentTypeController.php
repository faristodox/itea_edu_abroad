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

        $order = (int)($request->sort_order ?? DocumentType::max('sort_order') + 1);

        // Shift existing items at or after this position down by 1
        DocumentType::where('sort_order', '>=', $order)->increment('sort_order');

        DocumentType::create([
            'name'       => strtolower(str_replace(' ', '_', $request->name)),
            'label'      => $request->label,
            'required'   => $request->boolean('required'),
            'active'     => true,
            'sort_order' => $order,
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

        $newOrder = (int)$request->sort_order;

        // If order changed, shift other items to make room
        if ($newOrder !== $documentType->sort_order) {
            DocumentType::where('id', '!=', $documentType->id)
                ->where('sort_order', '>=', $newOrder)
                ->increment('sort_order');
        }

        $documentType->update([
            'label'      => $request->label,
            'required'   => $request->boolean('required'),
            'active'     => $request->boolean('active'),
            'sort_order' => $newOrder,
        ]);

        return back()->with('success', 'Document type updated.');
    }

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        return back()->with('success', 'Document type deleted.');
    }
}
