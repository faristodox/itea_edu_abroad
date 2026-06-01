@extends('admin.layout')
@section('title', 'Document Types')
@section('breadcrumb', 'Document Types')

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="adm-alert-error">
    <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

    {{-- Document types list --}}
    <div class="adm-table-wrap">
        <div class="adm-table-header">
            <h2>Document Types ({{ $types->count() }})</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Type Name</th>
                    <th>Label</th>
                    <th>Required</th>
                    <th>Active</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                <tr>
                    <form action="{{ route('admin.document-types.update', $type->id) }}" method="POST">
                        @csrf @method('PUT')
                        <td>
                            <input type="number" name="sort_order" value="{{ $type->sort_order }}" min="0"
                                style="width:60px; padding:5px 8px; border:1px solid var(--rule-soft); font-size:13px; text-align:center;">
                        </td>
                        <td>
                            <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted);">{{ $type->name }}</span>
                        </td>
                        <td>
                            <input type="text" name="label" value="{{ $type->label }}"
                                style="width:100%; padding:6px 10px; border:1px solid var(--rule-soft); font-size:13px; min-width:200px;">
                        </td>
                        <td style="text-align:center;">
                            <input type="checkbox" name="required" value="1" {{ $type->required ? 'checked' : '' }}
                                style="width:16px; height:16px; accent-color:var(--accent);">
                        </td>
                        <td style="text-align:center;">
                            <input type="checkbox" name="active" value="1" {{ $type->active ? 'checked' : '' }}
                                style="width:16px; height:16px; accent-color:#16a34a;">
                        </td>
                        <td>
                            <div style="display:flex; gap:10px; align-items:center;">
                                <button type="submit" style="background:none; border:none; font-size:12px; color:var(--accent); cursor:pointer; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; padding:0;">Save</button>
                            </div>
                        </td>
                    </form>
                    <form action="{{ route('admin.document-types.destroy', $type->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('Delete this document type?')">
                        @csrf @method('DELETE')
                        <td style="padding-left:0;">
                            <button type="submit" style="background:none; border:none; font-size:12px; color:#dc2626; cursor:pointer; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; padding:0;">Delete</button>
                        </td>
                    </form>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--muted); padding:32px;">No document types yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 16px; background:#fafafa; border-top:1px solid var(--rule-soft); font-size:12px; color:var(--muted);">
            <strong>Required</strong> — applicant must upload before submitting. &nbsp;
            <strong>Active</strong> — shown in the upload form.
        </div>
    </div>

    {{-- Add new type --}}
    <div class="adm-card">
        <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Add Document Type</div>
        <form action="{{ route('admin.document-types.store') }}" method="POST" style="display:flex; flex-direction:column; gap:14px;">
            @csrf
            <div class="adm-form-group" style="margin:0;">
                <label>Type Name (slug)</label>
                <input type="text" name="name" placeholder="e.g. bank_statement" value="{{ old('name') }}" required>
                <div style="font-size:11px; color:var(--muted); margin-top:4px;">Lowercase, underscores only. Used internally.</div>
            </div>
            <div class="adm-form-group" style="margin:0;">
                <label>Display Label</label>
                <input type="text" name="label" placeholder="e.g. Bank Statement" value="{{ old('label') }}" required>
            </div>
            <div style="display:flex; gap:20px; align-items:center;">
                <label style="display:flex; align-items:center; gap:8px; font-size:13px; cursor:pointer;">
                    <input type="checkbox" name="required" value="1" {{ old('required') ? 'checked' : '' }}
                        style="width:15px; height:15px; accent-color:var(--accent);">
                    Required
                </label>
            </div>
            <div class="adm-form-group" style="margin:0;">
                <label>Sort Order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $types->max('sort_order') + 1) }}">
            </div>
            <button type="submit" class="btn-primary" style="padding:10px; justify-content:center; width:100%;">Add type →</button>
        </form>
    </div>

</div>

@endsection
