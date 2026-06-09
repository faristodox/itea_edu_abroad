@extends('auth.layout')
@section('title', 'Payment Confirmed')
@section('breadcrumb', 'Payment Confirmed')

@section('content')

<div style="max-width:700px;">

    {{-- Success banner --}}
    <div class="adm-card" style="text-align:center; padding:36px; margin-bottom:20px; border:2px solid #16a34a;">
        <div style="font-size:52px; margin-bottom:12px;">🎉</div>
        <div style="font-family:'Outfit',sans-serif; font-size:22px; font-weight:600; color:#1a1a2e; margin-bottom:6px;">
            Thank you, {{ Auth::user()->name }}.
        </div>
        <p style="font-size:15px; color:#8a94b0; margin:0;">
            Your payment has been received. Your application is now being processed.
        </p>
    </div>

    {{-- Payment summary --}}
    <div class="adm-card" style="padding:0; overflow:hidden; margin-bottom:20px;">
        <div style="background:#16a34a; padding:20px 28px; display:flex; align-items:center; justify-content:space-between;">
            <div>
                <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.6); margin-bottom:4px;">Payment successful</div>
                <div style="font-family:'Outfit',sans-serif; font-size:28px; font-weight:600; color:#fff;">
                    USD {{ number_format($application->payment_amount ?? 150, 2) }}
                </div>
            </div>
            <div style="text-align:right;">
                <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.6); margin-bottom:4px;">Date</div>
                <div style="font-size:14px; color:#fff;">{{ $application->paid_at?->format('d M Y, g:i A') ?? now()->format('d M Y, g:i A') }}</div>
            </div>
        </div>

        <div style="padding:24px 28px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:24px;">
                @foreach([
                    ['Application ID',  '#' . str_pad($application->id,5,'0',STR_PAD_LEFT)],
                    ['Transaction ID',  $application->stripe_payment_id ? Str::limit($application->stripe_payment_id, 30) : '—'],
                    ['Programme',       $application->program_name],
                    ['Destination',     $application->destination],
                    ['Level',           $application->level],
                    ['University',      $application->university ?: '—'],
                ] as [$k,$v])
                <div style="padding:12px 14px; background:#f8fafd; border-radius:8px;">
                    <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:#8a94b0; margin-bottom:3px;">{{ $k }}</div>
                    <div style="font-size:13px; color:#1a1a2e; font-weight:500;">{{ $v }}</div>
                </div>
                @endforeach
            </div>

            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="{{ route('portal.receipt', $application->id) }}" target="_blank" class="prt-btn-outline" style="border-radius:8px;">
                    ↓ Download Receipt
                </a>
                <a href="{{ route('portal.application', $application->id) }}" class="prt-btn" style="border-radius:8px;">
                    Go to My Application →
                </a>
            </div>
        </div>
    </div>

    {{-- What happens next --}}
    <div class="adm-card">
        <div class="adm-section-title">What Happens Next</div>
        <div style="display:flex; flex-direction:column; gap:14px;">
            @php $steps = [
                ['icon'=>'📧','title'=>'Confirmation email sent','desc'=>'A receipt has been sent to ' . Auth::user()->email],
                ['icon'=>'📋','title'=>'Your application is being reviewed','desc'=>'Our team will submit your application package to the university within 3–5 working days.'],
                ['icon'=>'📄','title'=>'Offer letter coming soon','desc'=>'Once confirmed by the university, your counsellor will upload your official offer letter to this portal.'],
                ['icon'=>'🛂','title'=>'Visa guidance','desc'=>'Your assigned counsellor will reach out to guide you through the student visa application process.'],
            ]; @endphp
            @foreach($steps as $i => $step)
            <div style="display:flex; gap:14px; align-items:flex-start; {{ $i < count($steps)-1 ? 'padding-bottom:14px; border-bottom:1px solid #f0f3f9;' : '' }}">
                <span style="font-size:22px; flex-shrink:0;">{{ $step['icon'] }}</span>
                <div>
                    <div style="font-size:14px; font-weight:500; color:#1a1a2e; margin-bottom:2px;">{{ $step['title'] }}</div>
                    <div style="font-size:13px; color:#8a94b0;">{{ $step['desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
