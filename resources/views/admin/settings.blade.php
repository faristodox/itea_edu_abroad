@extends('admin.layout')
@section('title', 'Settings')
@section('breadcrumb', 'Settings')

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

<div style="max-width:560px;">
    <div class="adm-card" style="margin-bottom:16px;">
        <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Payment Settings</div>
        <form action="{{ route('admin.settings.update') }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            <div class="adm-form-group" style="margin:0;">
                <label>Default Application Fee (USD)</label>
                <input type="number" name="default_application_fee" step="0.01" min="0"
                    value="{{ $settings['default_application_fee'] }}" required>
                <div style="font-size:12px; color:var(--muted); margin-top:6px;">
                    This fee applies to all applications unless a programme-specific fee is set.
                </div>
            </div>
            <button type="submit" class="btn-primary" style="padding:10px 28px;">Save settings →</button>
        </form>
    </div>

    <div class="adm-card">
        <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:12px;">Stripe Configuration</div>
        <div style="display:flex; flex-direction:column; gap:10px;">
            <div style="display:flex; justify-content:space-between; padding:10px 14px; background:var(--bg); font-size:13px;">
                <span style="color:var(--muted);">Mode</span>
                <span style="color:{{ str_contains(config('services.stripe.key',''), 'test') ? '#d97706' : '#16a34a' }}; font-weight:500;">
                    {{ str_contains(config('services.stripe.key',''), 'test') ? '⚠ Test mode' : '✓ Live mode' }}
                </span>
            </div>
            <div style="display:flex; justify-content:space-between; padding:10px 14px; background:var(--bg); font-size:13px;">
                <span style="color:var(--muted);">Currency</span>
                <span style="font-weight:500; text-transform:uppercase;">{{ config('services.stripe.currency','usd') }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; padding:10px 14px; background:var(--bg); font-size:13px;">
                <span style="color:var(--muted);">Publishable key</span>
                <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted);">{{ substr(config('services.stripe.key','—'),0,20) }}...</span>
            </div>
        </div>
        <div style="margin-top:12px; font-size:12px; color:var(--muted);">
            To change Stripe keys, update <code>STRIPE_KEY</code> and <code>STRIPE_SECRET</code> in your <code>.env</code> file.
        </div>
    </div>
</div>

@endsection
