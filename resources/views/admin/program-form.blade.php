@extends('admin.layout')
@section('title', $program ? 'Edit Programme' : 'Add Programme')
@section('breadcrumb', $program ? 'Edit Programme' : 'Add Programme')

@section('topbar_actions')
<a href="{{ route('admin.programs') }}" class="adm-link-muted" style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">← Back</a>
@endsection

@section('content')

@if($errors->any())
<div class="adm-alert-error">
    <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div style="max-width:760px;">
    <form action="{{ $program ? route('admin.programs.update', $program->id) : route('admin.programs.store') }}" method="POST">
        @csrf
        @if($program) @method('PUT') @endif

        <div class="adm-card" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

            <div style="grid-column:span 2;" class="adm-form-group">
                <label>Programme Name *</label>
                <input type="text" name="name" value="{{ old('name', $program?->name) }}" required placeholder="e.g. Bachelor of Computer Science">
            </div>

            <div class="adm-form-group">
                <label>Destination *</label>
                <select name="destination" required>
                    <option value="">Select destination</option>
                    @foreach(['China','Malaysia','Indonesia'] as $d)
                    <option value="{{ $d }}" {{ old('destination', $program?->destination) === $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <div class="adm-form-group">
                <label>Level *</label>
                <select name="level" required>
                    <option value="">Select level</option>
                    @foreach(['Diploma','Undergraduate','Postgraduate','Mandarin Learning','Short-term'] as $l)
                    <option value="{{ $l }}" {{ old('level', $program?->level) === $l ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>

            <div class="adm-form-group">
                <label>University</label>
                <input type="text" name="university" value="{{ old('university', $program?->university) }}" placeholder="e.g. ZUST">
            </div>

            <div class="adm-form-group">
                <label>City</label>
                <input type="text" name="city" value="{{ old('city', $program?->city) }}" placeholder="e.g. Hangzhou">
            </div>

            <div class="adm-form-group">
                <label>Duration</label>
                <input type="text" name="duration" value="{{ old('duration', $program?->duration) }}" placeholder="e.g. 4 years">
            </div>

            <div class="adm-form-group">
                <label>Language of Instruction</label>
                <input type="text" name="language" value="{{ old('language', $program?->language) }}" placeholder="e.g. English">
            </div>

            <div class="adm-form-group">
                <label>Intake</label>
                <input type="text" name="intake" value="{{ old('intake', $program?->intake) }}" placeholder="e.g. September / March">
            </div>

            <div class="adm-form-group">
                <label>Tuition</label>
                <input type="text" name="tuition" value="{{ old('tuition', $program?->tuition) }}" placeholder="e.g. RMB 25,000 / yr">
            </div>

            <div class="adm-form-group">
                <label>Programme-specific application fee (USD) — leave blank to use default</label>
                <input type="number" name="application_fee" step="0.01" min="0"
                    value="{{ old('application_fee', $program?->application_fee) }}"
                    placeholder="e.g. 200 — overrides default fee if set">
            </div>

            <div class="adm-form-group">
                <label>Status *</label>
                <select name="status" required>
                    <option value="active"   {{ old('status', $program?->status ?? 'active') === 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $program?->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div style="grid-column:span 2;" class="adm-form-group">
                <label>Description</label>
                <textarea name="description" rows="3" placeholder="Short description...">{{ old('description', $program?->description) }}</textarea>
            </div>

            <div style="grid-column:span 2; display:flex; gap:12px; align-items:center; padding-top:4px;">
                <button type="submit" class="btn-primary" style="padding:11px 32px;">{{ $program ? 'Update →' : 'Add Programme →' }}</button>
                <a href="{{ route('admin.programs') }}" style="font-size:13px; color:var(--muted); text-decoration:none;">Cancel</a>
            </div>
        </div>
    </form>
</div>

@endsection
