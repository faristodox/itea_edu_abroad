@extends('layouts.app')
@section('title', 'Application #' . str_pad($application->id,5,'0',STR_PAD_LEFT) . ' — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:36px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:4px;">Application #{{ str_pad($application->id,5,'0',STR_PAD_LEFT) }}</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(20px,2.5vw,30px); font-weight:400; margin:0;">{{ $application->program_name }}</h1>
        </div>
        <a href="{{ route('portal') }}" style="color:rgba(255,255,255,0.6); font-size:13px; text-decoration:none;">← Back to portal</a>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap">

        @if(session('success'))
        <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#166534;">
            {{ session('success') }}
        </div>
        @endif

        <div style="display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start;">

            {{-- Main content --}}
            <div style="display:flex; flex-direction:column; gap:2px;">

                {{-- Status tracker --}}
                <div class="card" style="padding:28px;">
                    <div class="eyebrow" style="margin-bottom:20px;">Application Status</div>
                    @php $steps = [
                        ['key'=>'draft',     'label'=>'Draft',        'desc'=>'Saved, not yet submitted'],
                        ['key'=>'submitted', 'label'=>'Submitted',    'desc'=>'Received by ITEA team'],
                        ['key'=>'reviewing', 'label'=>'Under Review', 'desc'=>'Being reviewed by counsellor'],
                        ['key'=>'result',    'label'=>'Result',       'desc'=>'Decision ready'],
                    ];
                    $order = ['draft'=>0,'submitted'=>1,'reviewing'=>2,'result'=>3];
                    $current = $order[$application->status] ?? 0;
                    @endphp
                    <div style="display:flex; gap:0; align-items:flex-start;">
                        @foreach($steps as $i => $step)
                        <div style="flex:1; position:relative; text-align:center;">
                            @if($i < count($steps)-1)
                            <div style="position:absolute; top:14px; left:50%; right:-50%; height:2px; background:{{ $i < $current ? 'var(--accent)' : 'var(--rule-soft)' }};"></div>
                            @endif
                            <div style="width:28px; height:28px; border-radius:50%; border:2px solid {{ $i <= $current ? 'var(--accent)' : 'var(--rule-soft)' }}; background:{{ $i < $current ? 'var(--accent)' : ($i === $current ? 'var(--paper)' : 'var(--bg)') }}; display:flex; align-items:center; justify-content:center; margin:0 auto 8px; position:relative; z-index:1;">
                                @if($i < $current)
                                <span style="color:#fff; font-size:12px;">✓</span>
                                @elseif($i === $current)
                                <span style="width:10px; height:10px; border-radius:50%; background:var(--accent); display:block;"></span>
                                @endif
                            </div>
                            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.06em; text-transform:uppercase; color:{{ $i === $current ? 'var(--accent)' : 'var(--muted)' }}; margin-bottom:2px;">{{ $step['label'] }}</div>
                            <div style="font-size:11px; color:var(--muted);">{{ $step['desc'] }}</div>
                        </div>
                        @endforeach
                    </div>

                    @if($application->status === 'result' && $application->result)
                    <div style="margin-top:24px; padding:16px 20px; background:{{ $application->result === 'accepted' ? '#f0fdf4' : '#fff0f0' }}; border-left:3px solid {{ $application->result === 'accepted' ? '#16a34a' : '#dc2626' }};">
                        <div style="font-weight:500; font-size:15px; color:{{ $application->result === 'accepted' ? '#16a34a' : '#dc2626' }}; margin-bottom:4px;">
                            {{ $application->result === 'accepted' ? '🎉 Congratulations — Application Accepted!' : 'Application Unsuccessful' }}
                        </div>
                        @if($application->admin_notes)
                        <div style="font-size:13px; color:var(--muted);">{{ $application->admin_notes }}</div>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- Programme details --}}
                <div class="card" style="padding:28px;">
                    <div class="eyebrow" style="margin-bottom:16px;">Programme selected</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
                        @foreach([['Programme',$application->program_name],['Destination',$application->destination],['Level',$application->level],['University',$application->university ?: '—'],['Intake',$application->intake ?: '—'],['Submitted',$application->submitted_at?->format('d M Y') ?: '—']] as [$k,$v])
                        <div style="padding:12px 14px; background:var(--bg);">
                            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:3px;">{{ $k }}</div>
                            <div style="font-size:14px; color:var(--ink);">{{ $v }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Documents --}}
                <div class="card" style="padding:28px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                        <div class="eyebrow">Documents uploaded ({{ $application->documents->count() }})</div>
                        <a href="{{ route('portal.documents', $application->id) }}" style="font-size:13px; color:var(--accent); text-decoration:none;">Manage documents →</a>
                    </div>
                    @if($application->documents->isEmpty())
                    <div style="font-size:14px; color:var(--muted); padding:16px 0;">No documents uploaded yet. <a href="{{ route('portal.documents', $application->id) }}" style="color:var(--accent);">Upload now →</a></div>
                    @else
                    <div style="display:flex; flex-direction:column; gap:2px;">
                        @foreach($application->documents as $doc)
                        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 14px; background:var(--bg); font-size:13px;">
                            <div>
                                <span style="font-weight:500; color:var(--ink);">{{ $doc->typeLabel() }}</span>
                                <span style="color:var(--muted); margin-left:8px;">{{ $doc->original_name }}</span>
                            </div>
                            <span style="font-size:11px; color:var(--muted);">{{ round($doc->file_size/1024) }} KB</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            {{-- Sidebar --}}
            <div style="display:flex; flex-direction:column; gap:2px;">

                {{-- Submit action --}}
                @if($application->status === 'draft')
                @php
                    $requiredDocs  = ['passport'=>'Passport','transcript'=>'Academic Transcript','photo'=>'Passport Photo','certificate'=>'Qualification Certificate'];
                    $uploadedTypes = $application->documents->pluck('document_type')->toArray();
                    $missingDocs   = array_filter($requiredDocs, fn($v, $k) => !in_array($k, $uploadedTypes), ARRAY_FILTER_USE_BOTH);
                    $canSubmit     = empty($missingDocs);
                @endphp
                <div class="card" style="padding:24px;">
                    <div class="eyebrow" style="margin-bottom:10px;">Ready to submit?</div>

                    @if($errors->has('documents'))
                    <div style="background:#fff0f0; border:1px solid #fca5a5; padding:10px 14px; margin-bottom:14px; font-size:13px; color:#b91c1c; line-height:1.5;">
                        {{ $errors->first('documents') }}
                    </div>
                    @endif

                    @if(!$canSubmit)
                    <div style="margin-bottom:14px;">
                        <div style="font-size:12px; color:var(--muted); margin-bottom:8px;">Upload these required documents first:</div>
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            @foreach($requiredDocs as $type => $label)
                            @php $done = in_array($type, $uploadedTypes); @endphp
                            <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:{{ $done ? 'var(--muted)' : 'var(--ink)' }};">
                                <span style="width:16px; height:16px; border-radius:50%; border:1.5px solid {{ $done ? '#16a34a' : '#dc2626' }}; background:{{ $done ? '#16a34a' : 'transparent' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:9px; color:#fff;">{{ $done ? '✓' : '' }}</span>
                                <span style="{{ $done ? 'text-decoration:line-through; opacity:0.5;' : '' }}">{{ $label }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('portal.documents', $application->id) }}" style="display:block; margin-top:12px; font-size:12px; color:var(--accent); text-decoration:none;">Upload documents →</a>
                    </div>
                    @endif

                    <form action="{{ route('portal.application.submit', $application->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            {{ !$canSubmit ? 'disabled' : '' }}
                            style="width:100%; justify-content:center; padding:11px; {{ $canSubmit ? '' : 'opacity:0.4; cursor:not-allowed;' }}"
                            class="btn-primary"
                            {{ $canSubmit ? 'onclick="return confirm(\'Submit your application? You cannot edit it after submission.\')"' : '' }}>
                            Submit Application →
                        </button>
                    </form>
                    <a href="{{ route('portal.apply.edit', $application->id) }}" style="display:block; text-align:center; margin-top:10px; font-size:12px; color:var(--muted); text-decoration:none;">Edit application ↗</a>
                </div>
                @elseif($application->requiresPayment())
                {{-- Payment required --}}
                <div class="card" style="padding:24px; border:2px solid var(--accent);">
                    <div style="text-align:center; margin-bottom:16px;">
                        <div style="font-size:32px; margin-bottom:8px;">🎉</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:20px; color:var(--ink); margin-bottom:4px;">Congratulations!</div>
                        <div style="font-size:13px; color:var(--muted);">Your application has been accepted.</div>
                    </div>
                    <div style="background:var(--bg); padding:14px; margin-bottom:16px; text-align:center;">
                        <div style="font-size:12px; color:var(--muted); margin-bottom:4px;">Application fee</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:32px; color:var(--ink);">
                            USD {{ number_format($application->payment_amount ?? 150, 2) }}
                        </div>
                    </div>
                    <a href="{{ route('payment.checkout', $application->id) }}" class="btn-primary" style="display:block; text-align:center; padding:13px; width:100%; box-sizing:border-box;">
                        Pay Now →
                    </a>
                    <p style="font-size:11px; color:var(--muted); text-align:center; margin:10px 0 0;">Secure payment via Stripe. Card / FPX accepted.</p>
                </div>

                @elseif($application->isPaid())
                {{-- Paid — show offer letter --}}
                <div class="card" style="padding:24px; text-align:center;">
                    <div style="font-size:28px; margin-bottom:8px;">✅</div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:#16a34a; margin-bottom:4px;">Payment Confirmed</div>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:16px;">{{ $application->paid_at?->format('d M Y') }}</div>
                    @if($application->offer_letter_path)
                    <a href="{{ route('portal.offer-letter', $application->id) }}"
                       style="display:block; background:var(--ink-deep); color:#fff; padding:11px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; text-decoration:none; margin-bottom:8px;">
                        ↓ Download Offer Letter
                    </a>
                    @else
                    <div style="font-size:13px; color:var(--muted);">Offer letter will be uploaded shortly by your counsellor.</div>
                    @endif
                </div>

                @else
                <div class="card" style="padding:24px; text-align:center;">
                    <div style="font-size:24px; margin-bottom:8px;">{{ $application->status === 'result' && $application->result === 'accepted' ? '🎉' : '📋' }}</div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--accent);">{{ $application->statusLabel() }}</div>
                </div>
                @endif

                {{-- Personal details summary --}}
                <div class="card" style="padding:24px;">
                    <div class="eyebrow" style="margin-bottom:14px;">Applicant</div>
                    @foreach([['Name',$application->full_name],['Nationality',$application->nationality ?: '—'],['Education',$application->current_education_level ?: '—'],['Institution',$application->current_institution ?: '—'],['GPA',$application->gpa ?: '—']] as [$k,$v])
                    <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid var(--rule-soft); font-size:13px;">
                        <span style="color:var(--muted);">{{ $k }}</span>
                        <span style="color:var(--ink); font-weight:500; text-align:right; max-width:60%;">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Need help --}}
                <div class="card" style="padding:24px; background:var(--ink-deep); color:#fff;">
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">Need help?</div>
                    <p style="font-size:13px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0 0 14px;">Your counsellor responds within 48 hours. You can also WhatsApp us directly.</p>
                    <a href="{{ route('contact') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">Contact counsellor →</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
