@extends('auth.layout')
@section('title', $existing ? 'Edit Application' : 'New Application')
@section('breadcrumb', $existing ? 'Edit Application' : 'New Application')

@section('content')

@if($errors->any())
<div class="adm-alert-error">
    <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ $existing ? route('portal.apply.update', $existing->id) : route('portal.apply.store') }}" method="POST" style="max-width:820px;">
    @csrf
    @if($existing) @method('PUT') @endif

    @php
    $programsJson = $programs->map(fn($p) => [
        'id'          => $p->id,
        'name'        => $p->name,
        'destination' => $p->destination,
        'level'       => $p->level,
        'university'  => $p->university,
        'intake'      => $p->intake,
    ])->values()->toJson();
    $existingProgram = old('program_name', $existing?->program_name);
    $existingDest    = old('destination',  $existing?->destination);
    $existingLevel   = old('level',        $existing?->level);
    @endphp

    {{-- Step 1: Programme --}}
    <div class="adm-card" style="margin-bottom:20px;"
        x-data="{
            programs: {{ $programsJson }},
            destination: '{{ $existingDest }}',
            programName: '{{ addslashes($existingProgram ?? '') }}',
            isOther: {{ $existingProgram && !$programs->pluck('name')->contains($existingProgram) ? 'true' : 'false' }},
            otherName: '{{ addslashes($existingProgram ?? '') }}',
            get filtered() {
                if (!this.destination) return this.programs;
                return this.programs.filter(p => p.destination === this.destination);
            },
            selectProgram(e) {
                if (e.target.value === '__other__') {
                    this.isOther = true; this.programName = '';
                } else if (e.target.value === '') {
                    this.isOther = false; this.programName = '';
                } else {
                    this.isOther = false; this.otherName = '';
                    const p = this.programs.find(x => String(x.id) === e.target.value);
                    if (p) {
                        this.programName = p.name;
                        this.destination = p.destination;
                        document.querySelector('[name=level]').value = p.level || '';
                        document.querySelector('[name=university]').value = p.university || '';
                        document.querySelector('[name=intake]').value = p.intake || '';
                    }
                }
            }
        }">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
            <span style="background:#fee2e2; color:#d81f1f; font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; padding:4px 10px; border-radius:6px;">Step 01</span>
            <h2 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:600; color:#1a1a2e; margin:0;">Select Programme</h2>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Destination *</label>
                <select name="destination" required x-model="destination">
                    <option value="">Select destination</option>
                    @foreach(['China','Malaysia','Indonesia'] as $dest)
                    <option value="{{ $dest }}">{{ $dest }}</option>
                    @endforeach
                </select>
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Level *</label>
                <select name="level" required>
                    <option value="">Select level</option>
                    @foreach(['Diploma','Undergraduate','Postgraduate','Mandarin Learning','Short-term'] as $level)
                    <option value="{{ $level }}" {{ $existingLevel === $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div class="adm-form-group" style="margin-bottom:0; grid-column:span 2;">
                <label>Programme Name *</label>
                @if($programs->isEmpty())
                    <input type="text" name="program_name" value="{{ $existingProgram }}" required placeholder="e.g. Bachelor of Computer Science">
                    <div style="font-size:11px; color:#8a94b0; margin-top:6px;">No programmes added by admin yet. Type your programme name.</div>
                @else
                    <select @change="selectProgram($event)">
                        <option value="">— Select a programme —</option>
                        <template x-for="p in filtered" :key="p.id">
                            <option :value="p.id" x-text="p.name + (p.university ? ' · ' + p.university : '')"></option>
                        </template>
                        <option value="__other__">Other — specify below</option>
                    </select>
                    <input type="hidden" name="program_name" :value="isOther ? otherName : programName">
                    <div x-show="isOther" style="margin-top:10px;">
                        <input type="text" x-model="otherName" @input="programName = otherName" placeholder="Type your programme name">
                    </div>
                    <div style="font-size:11px; color:#8a94b0; margin-top:6px;">
                        Showing <span x-text="filtered.length"></span> programme(s)<span x-show="destination"> for <span x-text="destination"></span></span>. Select destination to filter.
                    </div>
                @endif
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>University (auto-filled)</label>
                <input type="text" name="university" value="{{ old('university', $existing?->university) }}" placeholder="Auto-filled on selection">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Preferred Intake</label>
                <select name="intake">
                    <option value="">Select intake</option>
                    @foreach(['September 2025','February 2026','March 2026','September 2026','February 2027','March 2027'] as $intake)
                    <option value="{{ $intake }}" {{ old('intake', $existing?->intake) === $intake ? 'selected' : '' }}>{{ $intake }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Step 2: Personal Details --}}
    <div class="adm-card" style="margin-bottom:20px;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
            <span style="background:#fee2e2; color:#d81f1f; font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; padding:4px 10px; border-radius:6px;">Step 02</span>
            <h2 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:600; color:#1a1a2e; margin:0;">Personal Details</h2>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="adm-form-group" style="margin-bottom:0; grid-column:span 2;">
                <label>Full Name (as per passport) *</label>
                <input type="text" name="full_name" value="{{ old('full_name', $existing?->full_name ?? Auth::user()->name) }}" required>
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $existing?->date_of_birth?->format('Y-m-d') ?? Auth::user()->date_of_birth?->format('Y-m-d')) }}">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Nationality</label>
                <input type="text" name="nationality" value="{{ old('nationality', $existing?->nationality ?? Auth::user()->nationality) }}" placeholder="e.g. Malaysian">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Phone / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $existing?->phone ?? Auth::user()->phone) }}" placeholder="+60 12 345 6789">
            </div>
            <div class="adm-form-group" style="margin-bottom:0; grid-column:span 2;">
                <label>Address</label>
                <textarea name="address" rows="2" style="resize:vertical; font-family:inherit;">{{ old('address', $existing?->address ?? Auth::user()->address) }}</textarea>
            </div>
        </div>
    </div>

    {{-- Step 3: Education --}}
    <div class="adm-card" style="margin-bottom:28px;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
            <span style="background:#fee2e2; color:#d81f1f; font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; padding:4px 10px; border-radius:6px;">Step 03</span>
            <h2 style="font-family:'Outfit',sans-serif; font-size:16px; font-weight:600; color:#1a1a2e; margin:0;">Education Details</h2>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Current / Highest Level</label>
                <select name="current_education_level">
                    <option value="">Select level</option>
                    @foreach(['SPM / O-Level','STPM / A-Level','Diploma','Foundation','Undergraduate','Postgraduate'] as $level)
                    <option value="{{ $level }}" {{ old('current_education_level', $existing?->current_education_level ?? Auth::user()->education_level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Current / Last Institution</label>
                <input type="text" name="current_institution" value="{{ old('current_institution', $existing?->current_institution ?? Auth::user()->institution) }}" placeholder="School or university name">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Graduation Year</label>
                <input type="text" name="graduation_year" value="{{ old('graduation_year', $existing?->graduation_year ?? Auth::user()->graduation_year) }}" placeholder="e.g. 2024">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>GPA / CGPA</label>
                <input type="text" name="gpa" value="{{ old('gpa', $existing?->gpa ?? Auth::user()->gpa) }}" placeholder="e.g. 3.50 / 4.00">
            </div>
            <div class="adm-form-group" style="margin-bottom:0; grid-column:span 2;">
                <label>Personal Statement <span style="color:#b0bec5; font-size:9px;">(max 3,000 characters)</span></label>
                <textarea name="personal_statement" rows="5" maxlength="3000" placeholder="Tell us why you want to study abroad and what you hope to achieve..." style="resize:vertical; font-family:inherit;">{{ old('personal_statement', $existing?->personal_statement) }}</textarea>
            </div>
        </div>
    </div>

    <div style="display:flex; gap:12px; align-items:center;">
        <button type="submit" class="prt-btn">Save as draft →</button>
        <a href="{{ route('portal') }}" class="prt-btn-outline">Cancel</a>
        <span style="font-size:13px; color:#8a94b0; margin-left:4px;">You can submit after uploading your documents.</span>
    </div>
</form>

@endsection
