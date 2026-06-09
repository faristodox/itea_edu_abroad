@extends('auth.layout')
@section('title', 'Application #' . str_pad($application->id,5,'0',STR_PAD_LEFT))
@section('breadcrumb', 'Application #' . str_pad($application->id,5,'0',STR_PAD_LEFT))

@section('content')

@if(session('success'))
<div class="adm-alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

    {{-- Left column --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Status tracker --}}
        <div class="adm-card">
            <div class="adm-section-title">Application Status</div>
            @php
            $steps = [
                ['key'=>'draft',     'label'=>'Draft',        'desc'=>'Saved, not yet submitted'],
                ['key'=>'submitted', 'label'=>'Submitted',    'desc'=>'Received by ITEA team'],
                ['key'=>'reviewing', 'label'=>'Under Review', 'desc'=>'Being reviewed by counsellor'],
                ['key'=>'result',    'label'=>'Result',       'desc'=>'Decision ready'],
            ];
            $order = ['draft'=>0,'submitted'=>1,'reviewing'=>2,'result'=>3];
            $current = $order[$application->status] ?? 0;
            @endphp
            <div style="display:flex; align-items:flex-start;">
                @foreach($steps as $i => $step)
                <div style="flex:1; position:relative; text-align:center;">
                    @if($i < count($steps)-1)
                    <div style="position:absolute; top:14px; left:50%; right:-50%; height:2px; background:{{ $i < $current ? '#d81f1f' : '#e4e9f2' }};"></div>
                    @endif
                    <div style="width:28px; height:28px; border-radius:50%; border:2px solid {{ $i <= $current ? '#d81f1f' : '#e4e9f2' }}; background:{{ $i < $current ? '#d81f1f' : ($i === $current ? '#fff' : '#f8fafd') }}; display:flex; align-items:center; justify-content:center; margin:0 auto 8px; position:relative; z-index:1;">
                        @if($i < $current)
                        <span style="color:#fff; font-size:12px;">✓</span>
                        @elseif($i === $current)
                        <span style="width:10px; height:10px; border-radius:50%; background:#d81f1f; display:block;"></span>
                        @endif
                    </div>
                    <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.06em; text-transform:uppercase; color:{{ $i === $current ? '#d81f1f' : '#8a94b0' }}; margin-bottom:2px;">{{ $step['label'] }}</div>
                    <div style="font-size:11px; color:#8a94b0;">{{ $step['desc'] }}</div>
                </div>
                @endforeach
            </div>

            @if($application->status === 'result' && $application->result)
            <div style="margin-top:24px; padding:16px 20px; background:{{ $application->result === 'accepted' ? '#f0fdf4' : '#fff0f0' }}; border-left:3px solid {{ $application->result === 'accepted' ? '#16a34a' : '#dc2626' }}; border-radius:0 8px 8px 0;">
                <div style="font-weight:600; font-size:14px; color:{{ $application->result === 'accepted' ? '#16a34a' : '#dc2626' }}; margin-bottom:4px;">
                    {{ $application->result === 'accepted' ? '🎉 Congratulations — Application Accepted!' : 'Application Unsuccessful' }}
                </div>
                @if($application->admin_notes)
                <div style="font-size:13px; color:#6b7280;">{{ $application->admin_notes }}</div>
                @endif
            </div>
            @endif
        </div>

        {{-- Programme details --}}
        <div class="adm-card">
            <div class="adm-section-title">Programme Selected</div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
                @foreach([['Programme',$application->program_name],['Destination',$application->destination],['Level',$application->level],['University',$application->university ?: '—'],['Intake',$application->intake ?: '—'],['Submitted',$application->submitted_at?->format('d M Y') ?: '—']] as [$k,$v])
                <div style="padding:12px 14px; background:#f8fafd; border-radius:4px;">
                    <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:#8a94b0; margin-bottom:3px;">{{ $k }}</div>
                    <div style="font-size:14px; color:#1a1a2e;">{{ $v }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Documents --}}
        <div class="adm-card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <div class="adm-section-title" style="margin-bottom:0;">Documents ({{ $application->documents->count() }})</div>
                <a href="{{ route('portal.documents', $application->id) }}" class="adm-link">Manage documents →</a>
            </div>
            @if($application->documents->isEmpty())
            <div style="font-size:14px; color:#8a94b0; padding:16px 0;">
                No documents uploaded yet. <a href="{{ route('portal.documents', $application->id) }}" class="adm-link">Upload now →</a>
            </div>
            @else
            <div style="display:flex; flex-direction:column; gap:2px;">
                @foreach($application->documents as $doc)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 14px; background:#f8fafd; border-radius:6px; font-size:13px;">
                    <div>
                        <span style="font-weight:500; color:#1a1a2e;">{{ $doc->typeLabel() }}</span>
                        <span style="color:#8a94b0; margin-left:8px;">{{ $doc->original_name }}</span>
                    </div>
                    <span style="font-size:11px; color:#8a94b0;">{{ round($doc->file_size/1024) }} KB</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    {{-- Right column --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Action card --}}
        @if($application->status === 'draft')
        @php
            $requiredDocs  = \App\Models\DocumentType::required()->get();
            $uploadedTypes = $application->documents->pluck('document_type')->toArray();
            $missingDocs   = $requiredDocs->filter(fn($t) => !in_array($t->name, $uploadedTypes));
            $canSubmit     = $missingDocs->isEmpty();
        @endphp
        <div class="adm-card">
            <div class="adm-section-title">Ready to Submit?</div>

            @if($errors->has('documents'))
            <div class="adm-alert-error" style="margin-bottom:14px;">{{ $errors->first('documents') }}</div>
            @endif

            @if(!$canSubmit)
            <div style="margin-bottom:16px;">
                <div style="font-size:12px; color:#8a94b0; margin-bottom:10px;">Upload these required documents first:</div>
                <div style="display:flex; flex-direction:column; gap:8px;">
                    @foreach($requiredDocs as $docType)
                    @php $done = in_array($docType->name, $uploadedTypes); @endphp
                    <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:{{ $done ? '#8a94b0' : '#1a1a2e' }};">
                        <span style="width:16px; height:16px; border-radius:50%; border:1.5px solid {{ $done ? '#16a34a' : '#e4e9f2' }}; background:{{ $done ? '#16a34a' : 'transparent' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:9px; color:#fff;">{{ $done ? '✓' : '' }}</span>
                        <span style="{{ $done ? 'text-decoration:line-through; opacity:0.5;' : '' }}">{{ $docType->label }}</span>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('portal.documents', $application->id) }}" class="adm-link" style="display:inline-block; margin-top:12px;">Upload documents →</a>
            </div>
            @endif

            <form action="{{ route('portal.application.submit', $application->id) }}" method="POST">
                @csrf
                <button type="submit"
                    {{ !$canSubmit ? 'disabled' : '' }}
                    style="width:100%; justify-content:center; border-radius:8px; padding:11px; font-size:13px; {{ $canSubmit ? '' : 'opacity:0.4; cursor:not-allowed;' }}"
                    class="prt-btn"
                    {{ $canSubmit ? 'onclick="return confirm(\'Submit your application? You cannot edit it after submission.\')"' : '' }}>
                    Submit Application →
                </button>
            </form>
            <a href="{{ route('portal.apply.edit', $application->id) }}" style="display:block; text-align:center; margin-top:10px; font-size:12px; color:#8a94b0; text-decoration:none;">Edit application ↗</a>
        </div>

        @elseif($application->requiresPayment())
        <div class="adm-card" style="border:2px solid #d81f1f; text-align:center;">
            <div style="font-size:36px; margin-bottom:10px;">🎉</div>
            <div style="font-family:'Outfit',sans-serif; font-size:18px; font-weight:600; color:#1a1a2e; margin-bottom:4px;">Congratulations!</div>
            <div style="font-size:13px; color:#8a94b0; margin-bottom:16px;">Your application has been accepted.</div>
            <div style="background:#f8fafd; border-radius:10px; padding:14px; margin-bottom:16px;">
                <div style="font-size:12px; color:#8a94b0; margin-bottom:4px;">Application fee</div>
                <div style="font-family:'Outfit',sans-serif; font-size:32px; font-weight:600; color:#1a1a2e;">
                    USD {{ number_format($application->payment_amount ?? 150, 2) }}
                </div>
            </div>
            <a href="{{ route('payment.checkout', $application->id) }}" class="prt-btn" style="width:100%; justify-content:center; border-radius:8px; padding:13px;">Pay Now →</a>
            <p style="font-size:11px; color:#8a94b0; margin:10px 0 0;">Secure payment via Stripe. Card / FPX accepted.</p>
        </div>

        @elseif($application->isPaid())
        <div class="adm-card" style="text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">✅</div>
            <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:#16a34a; margin-bottom:4px;">Payment Confirmed</div>
            <div style="font-size:12px; color:#8a94b0; margin-bottom:16px;">{{ $application->paid_at?->format('d M Y') }}</div>
            @if($application->offer_letter_path)
            <a href="{{ route('portal.offer-letter', $application->id) }}"
               class="prt-btn" style="display:block; width:100%; justify-content:center; border-radius:8px; padding:11px; margin-bottom:8px;">
                ↓ Download Offer Letter
            </a>
            @else
            <div style="font-size:13px; color:#8a94b0;">Offer letter will be uploaded shortly by your counsellor.</div>
            @endif
        </div>

        @else
        <div class="adm-card" style="text-align:center; padding:28px;">
            <div style="font-size:28px; margin-bottom:8px;">{{ $application->status === 'result' && $application->result === 'accepted' ? '🎉' : '📋' }}</div>
            <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:#d81f1f;">{{ $application->statusLabel() }}</div>
        </div>
        @endif

        {{-- Applicant summary --}}
        <div class="adm-card">
            <div class="adm-section-title">Applicant</div>
            @foreach([['Name',$application->full_name],['Nationality',$application->nationality ?: '—'],['Education',$application->current_education_level ?: '—'],['Institution',$application->current_institution ?: '—'],['GPA',$application->gpa ?: '—']] as [$k,$v])
            <div style="display:flex; justify-content:space-between; padding:9px 0; border-bottom:1px solid #f0f3f9; font-size:13px;">
                <span style="color:#8a94b0;">{{ $k }}</span>
                <span style="color:#1a1a2e; font-weight:500; text-align:right; max-width:60%;">{{ $v }}</span>
            </div>
            @endforeach
        </div>

        {{-- Help --}}
        <div class="adm-card" style="background:#061240; color:#fff; border-color:#091a52;">
            <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.14em; text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:8px;">Need help?</div>
            <p style="font-size:13px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0 0 14px;">Your counsellor responds within 48 hours. You can also WhatsApp us directly.</p>
            <a href="{{ route('contact') }}" class="adm-link" style="color:rgba(216,31,31,0.85);">Contact counsellor →</a>
        </div>

    </div>
</div>

@endsection
