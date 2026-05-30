@extends('layouts.app')
@section('title', 'My Profile — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:36px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:4px;">Applicant Portal</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(20px,2.5vw,30px); font-weight:400; margin:0;">Profile Setup</h1>
        </div>
        <a href="{{ route('portal') }}" style="color:rgba(255,255,255,0.6); font-size:13px; text-decoration:none;">← Back to portal</a>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap" style="max-width:720px;">

        @if(session('success'))
        <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#166534;">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div style="background:#fff0f0; border:1px solid #fca5a5; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#b91c1c;">
            <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('portal.profile.update') }}" method="POST">
            @csrf @method('PUT')

            {{-- Personal Info --}}
            <div class="card" style="padding:28px; margin-bottom:2px;">
                <div class="eyebrow" style="margin-bottom:20px;">Personal information</div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Phone / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+60 12 345 6789" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $user->nationality) }}" placeholder="e.g. Malaysian" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div style="grid-column:span 2;">
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Address</label>
                        <textarea name="address" rows="2" placeholder="Your current address" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; resize:vertical; font-family:inherit;">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Education --}}
            <div class="card" style="padding:28px; margin-bottom:24px;">
                <div class="eyebrow" style="margin-bottom:20px;">Education background</div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Current / Highest Level</label>
                        <select name="education_level" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                            <option value="">Select level</option>
                            @foreach(['SPM / O-Level','STPM / A-Level','Diploma','Foundation','Undergraduate','Postgraduate','PhD'] as $level)
                            <option value="{{ $level }}" {{ old('education_level', $user->education_level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Institution</label>
                        <input type="text" name="institution" value="{{ old('institution', $user->institution) }}" placeholder="School / University name" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Graduation Year</label>
                        <input type="text" name="graduation_year" value="{{ old('graduation_year', $user->graduation_year) }}" placeholder="e.g. 2024" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">GPA / CGPA</label>
                        <input type="text" name="gpa" value="{{ old('gpa', $user->gpa) }}" placeholder="e.g. 3.50" style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="padding:12px 32px;">Save profile →</button>
        </form>
    </div>
</section>
@endsection
