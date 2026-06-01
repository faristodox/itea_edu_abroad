@extends('admin.layout')
@section('title', 'Settings')
@section('breadcrumb', 'Settings')

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="adm-alert-error">
    <ul style="margin:0; padding-left:16px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div style="max-width:600px;">
    <form action="{{ route('admin.settings.update') }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
        @csrf

        {{-- Payment settings --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Payment Settings</div>
            <div class="adm-form-group" style="margin:0;">
                <label>Default Application Fee (USD)</label>
                <input type="number" name="default_application_fee" step="0.01" min="0"
                    value="{{ old('default_application_fee', $settings['default_application_fee']) }}" required>
                <div style="font-size:12px; color:var(--muted); margin-top:6px;">
                    Applies to all applications unless a programme-specific fee is set.
                </div>
            </div>
        </div>

        {{-- Stripe configuration --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Stripe Configuration</div>

            <div class="adm-form-group">
                <label>Mode</label>
                <select name="stripe_mode">
                    <option value="test" {{ old('stripe_mode', $settings['stripe_mode']) === 'test' ? 'selected' : '' }}>
                        Test Mode (sandbox)
                    </option>
                    <option value="live" {{ old('stripe_mode', $settings['stripe_mode']) === 'live' ? 'selected' : '' }}>
                        Live Mode (production)
                    </option>
                </select>
                <div style="font-size:12px; color:{{ $settings['stripe_mode'] === 'live' ? '#16a34a' : '#d97706' }}; margin-top:6px;">
                    Currently: <strong>{{ $settings['stripe_mode'] === 'live' ? '✓ Live mode — real payments active' : '⚠ Test mode — no real charges' }}</strong>
                </div>
            </div>

            <div class="adm-form-group">
                <label>Publishable Key</label>
                <input type="text" name="stripe_key"
                    value="{{ old('stripe_key', $settings['stripe_key']) }}"
                    placeholder="pk_test_... or pk_live_..." required>
                <div style="font-size:11px; color:var(--muted); margin-top:4px;">Starts with <code>pk_test_</code> (test) or <code>pk_live_</code> (live)</div>
            </div>

            <div class="adm-form-group" style="margin:0;">
                <label>Secret Key</label>
                <input type="password" name="stripe_secret"
                    value="{{ old('stripe_secret', $settings['stripe_secret']) }}"
                    placeholder="sk_test_... or sk_live_..." required>
                <div style="font-size:11px; color:var(--muted); margin-top:4px;">Starts with <code>sk_test_</code> (test) or <code>sk_live_</code> (live). Keep this secret.</div>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="padding:12px 32px; align-self:flex-start;">Save all settings →</button>
    </form>
</div>

@endsection
