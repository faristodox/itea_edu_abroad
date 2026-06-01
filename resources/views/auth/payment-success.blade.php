@extends('layouts.app')
@section('title', 'Payment Confirmed — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:48px 0;">
    <div class="wrap" style="text-align:center;">
        <div style="font-size:56px; margin-bottom:16px;">🎉</div>
        <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:10px;">Payment Confirmed</div>
        <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,48px); font-weight:400; margin:0 0 12px;">
            Thank you, <em style="color:var(--accent);">{{ Auth::user()->name }}.</em>
        </h1>
        <p style="font-size:16px; color:rgba(255,255,255,0.65); margin:0;">
            Your payment has been received. Your application is now being processed.
        </p>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap" style="max-width:700px;">

        {{-- Payment summary card --}}
        <div class="card" style="padding:0; overflow:hidden; margin-bottom:20px;">

            {{-- Green header bar --}}
            <div style="background:#16a34a; padding:20px 28px; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.6); margin-bottom:4px;">Payment successful</div>
                    <div style="font-family:'Instrument Serif',serif; font-size:28px; color:#fff;">
                        USD {{ number_format($application->payment_amount ?? 150, 2) }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.6); margin-bottom:4px;">Date</div>
                    <div style="font-size:14px; color:#fff;">{{ $application->paid_at?->format('d M Y, g:i A') ?? now()->format('d M Y, g:i A') }}</div>
                </div>
            </div>

            {{-- Details --}}
            <div style="padding:24px 28px;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px; margin-bottom:20px;">
                    @foreach([
                        ['Application ID',  '#' . str_pad($application->id,5,'0',STR_PAD_LEFT)],
                        ['Transaction ID',  $application->stripe_payment_id ? Str::limit($application->stripe_payment_id, 30) : '—'],
                        ['Programme',       $application->program_name],
                        ['Destination',     $application->destination],
                        ['Level',           $application->level],
                        ['University',      $application->university ?: '—'],
                    ] as [$k,$v])
                    <div style="padding:12px 14px; background:var(--bg);">
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:3px;">{{ $k }}</div>
                        <div style="font-size:13px; color:var(--ink); font-weight:500;">{{ $v }}</div>
                    </div>
                    @endforeach
                </div>

                {{-- Action buttons --}}
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('portal.receipt', $application->id) }}" target="_blank"
                       style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border:1px solid var(--ink); font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; text-decoration:none; color:var(--ink); transition:all 0.15s;"
                       onmouseover="this.style.background='var(--ink)';this.style.color='var(--paper)'"
                       onmouseout="this.style.background='transparent';this.style.color='var(--ink)'">
                        ↓ Download Receipt
                    </a>
                    <a href="{{ route('portal.application', $application->id) }}" class="btn-primary" style="padding:10px 24px;">
                        Go to My Application →
                    </a>
                </div>
            </div>
        </div>

        {{-- What happens next --}}
        <div class="card" style="padding:28px;">
            <div class="eyebrow" style="margin-bottom:16px;">What happens next</div>
            <div style="display:flex; flex-direction:column; gap:14px;">
                @php $steps = [
                    ['icon'=>'📧','title'=>'Confirmation email sent','desc'=>'A receipt has been sent to ' . Auth::user()->email],
                    ['icon'=>'📋','title'=>'Your application is being reviewed','desc'=>'Our team will submit your application package to the university within 3–5 working days.'],
                    ['icon'=>'📄','title'=>'Offer letter coming soon','desc'=>'Once confirmed by the university, your counsellor will upload your official offer letter to this portal.'],
                    ['icon'=>'🛂','title'=>'Visa guidance','desc'=>'Your assigned counsellor will reach out to guide you through the student visa application process.'],
                ]; @endphp
                @foreach($steps as $i => $step)
                <div style="display:flex; gap:14px; align-items:flex-start; {{ $i < count($steps)-1 ? 'padding-bottom:14px; border-bottom:1px solid var(--rule-soft);' : '' }}">
                    <span style="font-size:22px; flex-shrink:0;">{{ $step['icon'] }}</span>
                    <div>
                        <div style="font-size:14px; font-weight:500; color:var(--ink); margin-bottom:2px;">{{ $step['title'] }}</div>
                        <div style="font-size:13px; color:var(--muted);">{{ $step['desc'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="text-align:center; margin-top:20px;">
            <a href="{{ route('portal') }}" style="font-size:13px; color:var(--muted); text-decoration:none;">← Back to My Portal</a>
        </div>
    </div>
</section>
@endsection
