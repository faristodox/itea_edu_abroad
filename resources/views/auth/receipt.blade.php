<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt — ITEA EduAbroad #{{ str_pad($application->id,5,'0',STR_PAD_LEFT) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Geist', sans-serif; background: #f5f5f0; color: #1a1a2e; padding: 40px 20px; }
        .receipt { max-width: 620px; margin: 0 auto; background: #fff; }

        .receipt-header { background: #1a1a2e; color: #fff; padding: 32px; display: flex; justify-content: space-between; align-items: flex-start; }
        .receipt-header .brand { font-family: 'Instrument Serif', serif; font-size: 22px; font-weight: 400; }
        .receipt-header .brand span { color: #c0392b; font-style: italic; }
        .receipt-header .receipt-label { font-family: 'JetBrains Mono', monospace; font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
        .receipt-header .receipt-num { font-family: 'Instrument Serif', serif; font-size: 20px; color: #fff; }

        .paid-bar { background: #16a34a; color: #fff; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; }
        .paid-bar .amount { font-family: 'Instrument Serif', serif; font-size: 36px; }
        .paid-bar .status { font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 999px; }

        .receipt-body { padding: 32px; }
        .section-title { font-family: 'JetBrains Mono', monospace; font-size: 9px; letter-spacing: 0.12em; text-transform: uppercase; color: #6b7280; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1px solid #e5e7eb; }
        .row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f3f4f6; font-size: 13px; }
        .row:last-child { border-bottom: none; }
        .row .label { color: #6b7280; }
        .row .value { font-weight: 500; color: #1a1a2e; text-align: right; max-width: 60%; }

        .total-row { display: flex; justify-content: space-between; padding: 14px 16px; background: #1a1a2e; color: #fff; margin-top: 16px; }
        .total-row .label { font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase; }
        .total-row .value { font-family: 'Instrument Serif', serif; font-size: 24px; }

        .receipt-footer { padding: 20px 32px; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
        .receipt-footer .note { font-size: 11px; color: #9ca3af; line-height: 1.5; }
        .receipt-footer .contact { font-size: 11px; color: #6b7280; text-align: right; }

        .print-btn { display: block; text-align: center; margin: 20px auto 0; padding: 12px 32px; background: #1a1a2e; color: #fff; border: none; font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; cursor: pointer; }
        @media print {
            body { background: #fff; padding: 0; }
            .print-btn { display: none; }
            .receipt { box-shadow: none; }
        }
    </style>
</head>
<body>

<div class="receipt">
    {{-- Header --}}
    <div class="receipt-header">
        <div>
            <div class="brand">ITEA <span>EduAbroad</span></div>
            <div style="font-size:11px; color:rgba(255,255,255,0.45); margin-top:4px;">Kuala Lumpur · Beijing · Jakarta</div>
            <div style="font-size:11px; color:rgba(255,255,255,0.45);">hello@iteaeduabroad.com</div>
        </div>
        <div style="text-align:right;">
            <div class="receipt-label">Payment Receipt</div>
            <div class="receipt-num">#{{ str_pad($application->id,5,'0',STR_PAD_LEFT) }}</div>
        </div>
    </div>

    {{-- Paid bar --}}
    <div class="paid-bar">
        <div class="amount">USD {{ number_format($application->payment_amount ?? 150, 2) }}</div>
        <div class="status">✓ Paid</div>
    </div>

    <div class="receipt-body">

        {{-- Payment details --}}
        <div style="margin-bottom:24px;">
            <div class="section-title">Payment Details</div>
            <div class="row"><span class="label">Date</span><span class="value">{{ $application->paid_at?->format('d M Y, g:i A') ?? now()->format('d M Y, g:i A') }}</span></div>
            <div class="row"><span class="label">Transaction ID</span><span class="value" style="font-family:'JetBrains Mono',monospace; font-size:11px;">{{ $application->stripe_payment_id ?? '—' }}</span></div>
            <div class="row"><span class="label">Payment method</span><span class="value">Card (Stripe)</span></div>
            <div class="row"><span class="label">Currency</span><span class="value">USD</span></div>
        </div>

        {{-- Applicant --}}
        <div style="margin-bottom:24px;">
            <div class="section-title">Applicant</div>
            <div class="row"><span class="label">Name</span><span class="value">{{ $application->full_name }}</span></div>
            <div class="row"><span class="label">Email</span><span class="value">{{ $application->user->email }}</span></div>
            <div class="row"><span class="label">Nationality</span><span class="value">{{ $application->nationality ?: '—' }}</span></div>
        </div>

        {{-- Programme --}}
        <div style="margin-bottom:24px;">
            <div class="section-title">Application Details</div>
            <div class="row"><span class="label">Application #</span><span class="value">{{ str_pad($application->id,5,'0',STR_PAD_LEFT) }}</span></div>
            <div class="row"><span class="label">Programme</span><span class="value">{{ $application->program_name }}</span></div>
            <div class="row"><span class="label">Destination</span><span class="value">{{ $application->destination }}</span></div>
            <div class="row"><span class="label">Level</span><span class="value">{{ $application->level }}</span></div>
            @if($application->university)
            <div class="row"><span class="label">University</span><span class="value">{{ $application->university }}</span></div>
            @endif
            @if($application->intake)
            <div class="row"><span class="label">Intake</span><span class="value">{{ $application->intake }}</span></div>
            @endif
        </div>

        {{-- Total --}}
        <div class="section-title">Summary</div>
        <div class="row"><span class="label">Application processing fee</span><span class="value">USD {{ number_format($application->payment_amount ?? 150, 2) }}</span></div>
        <div class="total-row">
            <span class="label">Total paid</span>
            <span class="value">USD {{ number_format($application->payment_amount ?? 150, 2) }}</span>
        </div>
    </div>

    {{-- Footer --}}
    <div class="receipt-footer">
        <div class="note">
            This is an official payment receipt from ITEA EduAbroad.<br>
            Please retain this document for your records.
        </div>
        <div class="contact">
            hello@iteaeduabroad.com<br>
            +603 7890 0000
        </div>
    </div>
</div>

<button class="print-btn" onclick="window.print()">↓ Save / Print Receipt</button>

</body>
</html>
