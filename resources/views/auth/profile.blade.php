@extends('auth.layout')
@section('title', 'My Profile')
@section('breadcrumb', 'My Profile')

@section('content')

@if(session('success'))
<div class="adm-alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="adm-alert-error">
    <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('portal.profile.update') }}" method="POST" style="max-width:780px;">
    @csrf @method('PUT')

    {{-- Personal Info --}}
    <div class="adm-card" style="margin-bottom:20px;">
        <div class="adm-section-title">Personal Information</div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Phone / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+60 12 345 6789">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Nationality</label>
                <input type="text" name="nationality" value="{{ old('nationality', $user->nationality) }}" placeholder="e.g. Malaysian">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}">
            </div>
            <div class="adm-form-group" style="margin-bottom:0; grid-column:span 2;">
                <label>Address</label>
                <textarea name="address" rows="2" placeholder="Your current address" style="resize:vertical; font-family:inherit;">{{ old('address', $user->address) }}</textarea>
            </div>
        </div>
    </div>

    {{-- Education --}}
    <div class="adm-card" style="margin-bottom:24px;">
        <div class="adm-section-title">Education Background</div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Current / Highest Level</label>
                <select name="education_level">
                    <option value="">Select level</option>
                    @foreach(['SPM / O-Level','STPM / A-Level','Diploma','Foundation','Undergraduate','Postgraduate','PhD'] as $level)
                    <option value="{{ $level }}" {{ old('education_level', $user->education_level) === $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Institution</label>
                <input type="text" name="institution" value="{{ old('institution', $user->institution) }}" placeholder="School / University name">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>Graduation Year</label>
                <input type="text" name="graduation_year" value="{{ old('graduation_year', $user->graduation_year) }}" placeholder="e.g. 2024">
            </div>
            <div class="adm-form-group" style="margin-bottom:0;">
                <label>GPA / CGPA</label>
                <input type="text" name="gpa" value="{{ old('gpa', $user->gpa) }}" placeholder="e.g. 3.50">
            </div>
        </div>
    </div>

    <div style="display:flex; gap:12px; align-items:center;">
        <button type="submit" class="prt-btn">Save profile →</button>
        <a href="{{ route('portal') }}" class="prt-btn-outline">Back to Dashboard</a>
    </div>
</form>

@endsection
