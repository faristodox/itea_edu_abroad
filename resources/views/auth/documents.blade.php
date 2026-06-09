@extends('auth.layout')
@section('title', 'Upload Documents')
@section('breadcrumb', 'Documents — #' . str_pad($application->id,5,'0',STR_PAD_LEFT))

@section('content')

@if(session('success'))
<div class="adm-alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 320px; gap:20px; align-items:start;">

    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Upload form --}}
        <div class="adm-card">
            <div class="adm-section-title">Upload a Document</div>
            <form action="{{ route('portal.documents.store', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                <div class="adm-alert-error">
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
                @endif
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="adm-form-group" style="margin-bottom:0;">
                        <label>Document Type *</label>
                        <select name="document_type" required>
                            <option value="">Select type</option>
                            @foreach($documentTypes as $type)
                            <option value="{{ $type->name }}">{{ $type->label }}{{ $type->required ? ' *' : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="adm-form-group" style="margin-bottom:0;">
                        <label>File * (PDF, JPG, PNG · max 5 MB)</label>
                        <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>
                <button type="submit" class="prt-btn" style="margin-top:16px;">Upload →</button>
            </form>
        </div>

        {{-- Uploaded list --}}
        <div class="adm-card">
            <div class="adm-section-title">Uploaded Documents ({{ $documents->count() }})</div>
            @if($documents->isEmpty())
            <p style="font-size:14px; color:#8a94b0; margin:0;">No documents uploaded yet. Start by uploading your passport.</p>
            @else
            <div style="display:flex; flex-direction:column; gap:4px;">
                @foreach($documents as $doc)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 14px; background:#f8fafd; border-radius:8px;">
                    <div>
                        <div style="font-size:14px; font-weight:500; color:#1a1a2e; margin-bottom:2px;">{{ $doc->typeLabel() }}</div>
                        <div style="font-size:12px; color:#8a94b0;">{{ $doc->original_name }} · {{ round($doc->file_size/1024) }} KB · {{ $doc->created_at->format('d M Y') }}</div>
                    </div>
                    <form action="{{ route('portal.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Remove this document?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:#dc2626; cursor:pointer; font-size:12px; font-family:'DM Mono',monospace; letter-spacing:0.06em; text-transform:uppercase; padding:4px 8px; border-radius:6px; transition:background 0.15s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='none'">Remove</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    {{-- Sidebar: required checklist --}}
    <div class="adm-card">
        <div class="adm-section-title">Required Documents</div>
        @php $uploadedTypes = $documents->pluck('document_type')->toArray(); @endphp
        <div style="display:flex; flex-direction:column; gap:10px;">
            @foreach($documentTypes as $type)
            @php $done = in_array($type->name, $uploadedTypes); @endphp
            <div style="display:flex; align-items:center; gap:10px; font-size:13px;">
                <span style="width:20px; height:20px; border-radius:50%; border:1.5px solid {{ $done ? '#16a34a' : '#e4e9f2' }}; background:{{ $done ? '#16a34a' : 'transparent' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:10px; color:#fff; transition:all 0.2s;">{{ $done ? '✓' : '' }}</span>
                <span style="color:{{ $done ? '#8a94b0' : '#1a1a2e' }}; {{ $done ? 'text-decoration:line-through; opacity:0.6;' : '' }}">
                    {{ $type->label }}
                    @if(!$type->required)<span style="font-size:11px; color:#b0bec5;"> (optional)</span>@endif
                </span>
            </div>
            @endforeach
        </div>
        <div style="margin-top:20px; padding-top:16px; border-top:1px solid #f0f3f9;">
            <a href="{{ route('portal.application', $application->id) }}" class="prt-btn" style="display:block; text-align:center; width:100%; border-radius:8px;">Back to application →</a>
        </div>
    </div>

</div>

@endsection
