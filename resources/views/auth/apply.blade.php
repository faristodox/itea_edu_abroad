@extends('layouts.app')
@section('title', 'Application Form — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:36px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:4px;">Applicant Portal</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(20px,2.5vw,30px); font-weight:400; margin:0;">Application Form</h1>
        </div>
        <a href="{{ route('portal') }}" style="color:rgba(255,255,255,0.6); font-size:13px; text-decoration:none;">← Back to portal</a>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap" style="max-width:780px;">

        @if($errors->any())
        <div style="background:#fff0f0; border:1px solid #fca5a5; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#b91c1c;">
            <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('portal.apply.store') }}" method="POST">
            @csrf

            {{-- Section 1: Select Programme --}}
            <div class="card" style="padding:28px; margin-bottom:2px;">
                <div class="eyebrow" style="margin-bottom:4px; color:var(--accent);">Step 01</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 20px;">Select Programme</h2>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div style="grid-column:span 2;">
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Programme Name *</label>
                        <input type="text" name="program_name" value="{{ old('program_name', $existing?->program_name) }}" required placeholder="e.g. Bachelor of Computer Science" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Destination *</label>
                        <select name="destination" required style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                            <option value="">Select destination</option>
                            @foreach(['China','Malaysia','Indonesia'] as $dest)
                            <option value="{{ $dest }}" {{ old('destination', $existing?->destination) === $dest ? 'selected' : '' }}>{{ $dest }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Level *</label>
                        <select name="level" required style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                            <option value="">Select level</option>
                            @foreach(['Diploma','Undergraduate','Postgraduate','Mandarin Learning','Short-term'] as $level)
                            <option value="{{ $level }}" {{ old('level', $existing?->level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">University (optional)</label>
                        <input type="text" name="university" value="{{ old('university', $existing?->university) }}" placeholder="e.g. ZUST, Taylor's University" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Preferred Intake</label>
                        <select name="intake" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                            <option value="">Select intake</option>
                            @foreach(['September 2025','February 2026','March 2026','September 2026','February 2027','March 2027'] as $intake)
                            <option value="{{ $intake }}" {{ old('intake', $existing?->intake) === $intake ? 'selected' : '' }}>{{ $intake }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Section 2: Personal Details --}}
            <div class="card" style="padding:28px; margin-bottom:2px;">
                <div class="eyebrow" style="margin-bottom:4px; color:var(--accent);">Step 02</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 20px;">Personal Details</h2>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div style="grid-column:span 2;">
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Full Name (as per passport) *</label>
                        <input type="text" name="full_name" value="{{ old('full_name', $existing?->full_name ?? Auth::user()->name) }}" required style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $existing?->date_of_birth?->format('Y-m-d')) }}" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $existing?->nationality) }}" placeholder="e.g. Malaysian" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Phone / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $existing?->phone ?? Auth::user()->phone) }}" placeholder="+60 12 345 6789" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Address</label>
                        <textarea name="address" rows="2" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; resize:vertical; font-family:inherit;">{{ old('address', $existing?->address) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Section 3: Education Details --}}
            <div class="card" style="padding:28px; margin-bottom:24px;">
                <div class="eyebrow" style="margin-bottom:4px; color:var(--accent);">Step 03</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 20px;">Education Details</h2>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Current / Highest Level</label>
                        <select name="current_education_level" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                            <option value="">Select level</option>
                            @foreach(['SPM / O-Level','STPM / A-Level','Diploma','Foundation','Undergraduate','Postgraduate'] as $level)
                            <option value="{{ $level }}" {{ old('current_education_level', $existing?->current_education_level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Current / Last Institution</label>
                        <input type="text" name="current_institution" value="{{ old('current_institution', $existing?->current_institution) }}" placeholder="School or university name" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Graduation Year</label>
                        <input type="text" name="graduation_year" value="{{ old('graduation_year', $existing?->graduation_year) }}" placeholder="e.g. 2024" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">GPA / CGPA</label>
                        <input type="text" name="gpa" value="{{ old('gpa', $existing?->gpa) }}" placeholder="e.g. 3.50 / 4.00" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Personal Statement <span style="color:var(--muted); font-size:9px;">(max 3,000 characters)</span></label>
                        <textarea name="personal_statement" rows="5" maxlength="3000" placeholder="Tell us why you want to study abroad and what you hope to achieve..." style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; resize:vertical; font-family:inherit;">{{ old('personal_statement', $existing?->personal_statement) }}</textarea>
                    </div>
                </div>
            </div>

            <div style="display:flex; gap:12px; align-items:center;">
                <button type="submit" class="btn-primary" style="padding:12px 32px;">Save as draft →</button>
                <span style="font-size:13px; color:var(--muted);">You can submit after uploading your documents.</span>
            </div>
        </form>
    </div>
</section>
@endsection
