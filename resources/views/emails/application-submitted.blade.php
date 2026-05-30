<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>body{font-family:sans-serif;color:#1a1a2e;margin:0;padding:0;background:#f5f5f0}.wrap{max-width:560px;margin:32px auto;background:#fff;padding:32px}.header{background:#1a1a2e;padding:24px 32px;color:#fff}.label{font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5)}.title{font-size:24px;margin:8px 0 0;font-weight:400}.row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee;font-size:14px}.muted{color:#666}.cta{display:inline-block;background:#c0392b;color:#fff;padding:12px 24px;text-decoration:none;font-size:13px;margin-top:24px}footer{font-size:11px;color:#999;margin-top:24px;padding-top:16px;border-top:1px solid #eee}</style>
</head>
<body>
<div class="header">
    <div class="label">ITEA EduAbroad</div>
    <div class="title">Application Submitted</div>
</div>
<div class="wrap">
    <p>Dear <strong>{{ $application->full_name }}</strong>,</p>
    <p>We have received your application. Our team will review it within <strong>48 hours</strong> and update you by email.</p>

    <div style="background:#f5f5f0;padding:20px;margin:20px 0;">
        <div class="row"><span class="muted">Programme</span><span>{{ $application->program_name }}</span></div>
        <div class="row"><span class="muted">Destination</span><span>{{ $application->destination }}</span></div>
        <div class="row"><span class="muted">Level</span><span>{{ $application->level }}</span></div>
        <div class="row"><span class="muted">Submitted</span><span>{{ $application->submitted_at->format('d M Y, g:i A') }}</span></div>
        <div style="padding:10px 0;font-size:14px;"><span class="muted">Application ID</span><span style="float:right;font-weight:500;">#{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}</span></div>
    </div>

    <p style="font-size:14px;color:#666;">Next step: Upload your required documents (passport, transcript) to your portal to speed up processing.</p>

    <footer>ITEA EduAbroad · Kuala Lumpur, Malaysia · hello@iteaeduabroad.com</footer>
</div>
</body>
</html>
