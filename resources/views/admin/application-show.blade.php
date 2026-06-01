@extends('admin.layout')
@section('title', 'Application #' . str_pad($application->id,5,'0',STR_PAD_LEFT))
@section('breadcrumb', 'Application Review')

@section('topbar_actions')
<a href="{{ route('admin.applications') }}" class="adm-link-muted" style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">← Back</a>
@endsection

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

<div style="display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start;">

    {{-- Left --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Status tracker --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:20px;">Application Progress</div>
            @php
            $steps = [['key'=>'draft','label'=>'Draft'],['key'=>'submitted','label'=>'Submitted'],['key'=>'reviewing','label'=>'Reviewing'],['key'=>'result','label'=>'Result']];
            $order = ['draft'=>0,'submitted'=>1,'reviewing'=>2,'result'=>3];
            $current = $order[$application->status] ?? 0;
            @endphp
            <div style="display:flex; gap:0; position:relative;">
                <div style="position:absolute; top:12px; left:0; right:0; height:2px; background:var(--rule-soft);"></div>
                <div style="position:absolute; top:12px; left:0; height:2px; background:var(--accent); width:{{ min(100, ($current / (count($steps)-1)) * 100) }}%; transition:width 0.3s;"></div>
                @foreach($steps as $i => $step)
                <div style="flex:1; text-align:center; position:relative;">
                    <div style="width:24px; height:24px; border-radius:50%; margin:0 auto 8px; display:flex; align-items:center; justify-content:center; font-size:10px; background:{{ $i <= $current ? 'var(--accent)' : '#fff' }}; border:2px solid {{ $i <= $current ? 'var(--accent)' : 'var(--rule-soft)' }}; color:#fff; position:relative; z-index:1; transition:all 0.2s;">
                        {{ $i < $current ? '✓' : ($i === $current ? '●' : '') }}
                    </div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $i === $current ? 'var(--accent)' : 'var(--muted)' }};">{{ $step['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Programme --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Programme Selected</div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
                @foreach([['Programme',$application->program_name],['Destination',$application->destination],['Level',$application->level],['University',$application->university ?: '—'],['Intake',$application->intake ?: '—'],['Submitted',$application->submitted_at?->format('d M Y, g:i A') ?? '—']] as [$k,$v])
                <div style="padding:12px 14px; background:var(--bg);">
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:3px;">{{ $k }}</div>
                    <div style="font-size:13px; color:var(--ink); font-weight:500;">{{ $v }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Applicant details --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Applicant Details</div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
                @foreach([['Full name',$application->full_name],['Email',$application->user->email],['Phone',$application->phone ?: '—'],['Nationality',$application->nationality ?: '—'],['Date of birth',$application->date_of_birth?->format('d M Y') ?? '—'],['Address',$application->address ?: '—'],['Education level',$application->current_education_level ?: '—'],['Institution',$application->current_institution ?: '—'],['Graduation year',$application->graduation_year ?: '—'],['GPA / CGPA',$application->gpa ?: '—']] as [$k,$v])
                <div style="padding:12px 14px; background:var(--bg);">
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:3px;">{{ $k }}</div>
                    <div style="font-size:13px; color:var(--ink);">{{ $v }}</div>
                </div>
                @endforeach
            </div>
            @if($application->personal_statement)
            <div style="margin-top:2px; padding:14px 16px; background:var(--bg);">
                <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Personal Statement</div>
                <div style="font-size:14px; color:var(--ink); line-height:1.7;">{{ $application->personal_statement }}</div>
            </div>
            @endif
        </div>

        {{-- Documents --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">
                Documents ({{ $application->documents->count() }})
            </div>
            @if($application->documents->isEmpty())
            <div style="font-size:14px; color:var(--muted); padding:16px 0;">No documents uploaded yet.</div>
            @else
            <div style="display:flex; flex-direction:column; gap:2px;">
                @foreach($application->documents as $doc)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 14px; background:var(--bg);">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:18px; opacity:0.5;">📄</span>
                        <div>
                            <div style="font-size:13px; font-weight:500; color:var(--ink);">{{ $doc->typeLabel() }}</div>
                            <div style="font-size:11px; color:var(--muted);">{{ $doc->original_name }}</div>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:16px;">
                        <div style="text-align:right; font-size:11px; color:var(--muted);">
                            <div>{{ round($doc->file_size/1024) }} KB</div>
                            <div>{{ $doc->created_at->format('d M Y') }}</div>
                        </div>
                        <a href="{{ route('admin.document.download', $doc->id) }}"
                           style="font-size:11px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-transform:uppercase; color:var(--accent); text-decoration:none; white-space:nowrap; border:1px solid var(--accent); padding:4px 10px;">
                            ↓ Download
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- Right sidebar --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Status badge --}}
        <div class="adm-card" style="text-align:center; padding:20px;">
            @php $badge = match($application->status) { 'draft'=>'badge-draft','submitted'=>'badge-submitted','reviewing'=>'badge-reviewing','result'=>($application->result==='accepted'?'badge-accepted':'badge-rejected'),default=>'badge-draft'}; @endphp
            <div style="font-family:'Instrument Serif',serif; font-size:28px; color:var(--ink); margin-bottom:8px;">
                {{ $application->result ? ucfirst($application->result) : $application->statusLabel() }}
            </div>
            <span class="badge {{ $badge }}" style="font-size:10px;">{{ $application->statusLabel() }}</span>
        </div>

        {{-- Update status form --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Update Status</div>
            <form action="{{ route('admin.application.status', $application->id) }}" method="POST" style="display:flex; flex-direction:column; gap:14px;">
                @csrf @method('PATCH')
                <div class="adm-form-group" style="margin:0;">
                    <label>Status</label>
                    <select name="status">
                        <option value="reviewing" {{ $application->status === 'reviewing' ? 'selected' : '' }}>Under Review</option>
                        <option value="result"    {{ $application->status === 'result'    ? 'selected' : '' }}>Result Ready</option>
                    </select>
                </div>
                <div class="adm-form-group" style="margin:0;">
                    <label>Result</label>
                    <select name="result">
                        <option value="">— Not yet —</option>
                        <option value="accepted"    {{ $application->result === 'accepted'    ? 'selected' : '' }}>Accepted</option>
                        <option value="conditional" {{ $application->result === 'conditional' ? 'selected' : '' }}>Conditional</option>
                        <option value="rejected"    {{ $application->result === 'rejected'    ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="adm-form-group" style="margin:0;">
                    <label>Notes to applicant</label>
                    <textarea name="admin_notes" rows="3" placeholder="Optional message to the applicant...">{{ $application->admin_notes }}</textarea>
                </div>
                <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:10px; font-size:12px;">Update →</button>
            </form>
        </div>

        {{-- Payment --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Payment</div>
            <form action="{{ route('admin.application.status', $application->id) }}" method="POST" style="display:flex; flex-direction:column; gap:12px;">
                @csrf @method('PATCH')
                <input type="hidden" name="status"  value="{{ $application->status }}">
                <input type="hidden" name="result"  value="{{ $application->result }}">
                <div class="adm-form-group" style="margin:0;">
                    <label>Application fee (USD)</label>
                    <input type="number" name="payment_amount" step="0.01" min="0"
                        value="{{ $application->payment_amount ?? $defaultFee }}"
                        placeholder="{{ $defaultFee }}">
                    <div style="font-size:11px; color:var(--muted); margin-top:4px;">Default: USD {{ $defaultFee }}</div>
                </div>
                <div class="adm-form-group" style="margin:0;">
                    <label>Payment status</label>
                    <select name="payment_status">
                        <option value="unpaid" {{ $application->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid"   {{ $application->payment_status === 'paid'   ? 'selected' : '' }}>Paid</option>
                        <option value="waived" {{ $application->payment_status === 'waived' ? 'selected' : '' }}>Waived</option>
                    </select>
                </div>
                @if($application->paid_at)
                <div style="font-size:12px; color:#16a34a;">✓ Paid on {{ $application->paid_at->format('d M Y, g:i A') }}</div>
                @if($application->stripe_payment_id)
                <div style="font-size:11px; color:var(--muted);">Stripe ID: {{ $application->stripe_payment_id }}</div>
                @endif
                @endif
                <button type="submit" style="border:1px solid var(--rule-soft); background:var(--paper); padding:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; cursor:pointer;">Update payment →</button>
            </form>
        </div>

        {{-- Offer letter --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">Offer Letter</div>
            @if($application->offer_letter_path)
            <div style="background:#f0fdf4; border:1px solid #86efac; padding:10px 14px; margin-bottom:12px; font-size:13px; color:#166534; display:flex; justify-content:space-between; align-items:center;">
                <span>✓ Uploaded</span>
                <a href="{{ route('admin.offer-letter.download', $application->id) }}" style="font-size:11px; color:#16a34a; text-decoration:none;">Download</a>
            </div>
            @endif
            <form action="{{ route('admin.offer-letter.upload', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="adm-form-group" style="margin:0 0 10px;">
                    <label>Upload offer letter (PDF)</label>
                    <input type="file" name="offer_letter" accept=".pdf">
                </div>
                <button type="submit" style="border:1px solid var(--rule-soft); background:var(--paper); padding:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; cursor:pointer; width:100%;">Upload →</button>
            </form>
        </div>

        {{-- Account info --}}
        <div class="adm-card">
            <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:12px;">Account</div>
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                <div style="width:36px; height:36px; background:var(--ink-deep); border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:'Instrument Serif',serif; color:#fff; font-size:16px; flex-shrink:0;">{{ strtoupper(substr($application->user->name,0,1)) }}</div>
                <div>
                    <div style="font-size:14px; font-weight:500; color:var(--ink);">{{ $application->user->name }}</div>
                    <div style="font-size:12px; color:var(--muted);">{{ $application->user->email }}</div>
                </div>
            </div>
            <div style="font-size:12px; color:var(--muted);">Registered {{ $application->user->created_at->format('d M Y') }}</div>
        </div>

    </div>
</div>

@endsection
