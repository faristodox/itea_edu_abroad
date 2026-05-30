@extends('layouts.app')
@section('title', 'Documents — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:36px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:4px;">Application #{{ str_pad($application->id,5,'0',STR_PAD_LEFT) }}</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(20px,2.5vw,30px); font-weight:400; margin:0;">Upload Documents</h1>
        </div>
        <a href="{{ route('portal.application', $application->id) }}" style="color:rgba(255,255,255,0.6); font-size:13px; text-decoration:none;">← Back to application</a>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 360px; gap:24px; align-items:start;">

        <div style="display:flex; flex-direction:column; gap:2px;">

            @if(session('success'))
            <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:16px; font-size:13px; color:#166534;">{{ session('success') }}</div>
            @endif

            {{-- Upload form --}}
            <div class="card" style="padding:28px; margin-bottom:2px;">
                <div class="eyebrow" style="margin-bottom:16px;">Upload a document</div>
                <form action="{{ route('portal.documents.store', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                    <div style="background:#fff0f0; border:1px solid #fca5a5; padding:10px 14px; margin-bottom:16px; font-size:13px; color:#b91c1c;">
                        @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                    </div>
                    @endif
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                        <div>
                            <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Document Type *</label>
                            <select name="document_type" required style="width:100%; padding:10px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                                <option value="">Select type</option>
                                <option value="passport">Passport</option>
                                <option value="transcript">Academic Transcript</option>
                                <option value="photo">Passport Photo</option>
                                <option value="certificate">Qualification Certificate</option>
                                <option value="language_cert">Language Certificate (IELTS/HSK/TOEFL)</option>
                                <option value="medical">Medical Examination Report</option>
                                <option value="other">Other Document</option>
                            </select>
                        </div>
                        <div>
                            <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">File * (PDF, JPG, PNG · max 5MB)</label>
                            <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" style="width:100%; padding:9px 12px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box;">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary" style="margin-top:16px; padding:10px 28px;">Upload →</button>
                </form>
            </div>

            {{-- Uploaded documents list --}}
            <div class="card" style="padding:28px;">
                <div class="eyebrow" style="margin-bottom:16px;">Uploaded documents ({{ $documents->count() }})</div>
                @if($documents->isEmpty())
                <p style="font-size:14px; color:var(--muted); margin:0;">No documents uploaded yet. Start by uploading your passport.</p>
                @else
                <div style="display:flex; flex-direction:column; gap:2px;">
                    @foreach($documents as $doc)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 16px; background:var(--bg);">
                        <div>
                            <div style="font-size:14px; font-weight:500; color:var(--ink); margin-bottom:2px;">{{ $doc->typeLabel() }}</div>
                            <div style="font-size:12px; color:var(--muted);">{{ $doc->original_name }} · {{ round($doc->file_size/1024) }} KB · {{ $doc->created_at->format('d M Y') }}</div>
                        </div>
                        <form action="{{ route('portal.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Remove this document?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#dc2626; cursor:pointer; font-size:12px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-transform:uppercase;">Remove</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Sidebar: required docs checklist --}}
        <div class="card" style="padding:24px;">
            <div class="eyebrow" style="margin-bottom:14px;">Required documents</div>
            @php $required = [
                ['type'=>'passport',      'label'=>'Passport (valid 18+ months)','required'=>true],
                ['type'=>'transcript',    'label'=>'Academic transcripts','required'=>true],
                ['type'=>'photo',         'label'=>'Passport photo (2)','required'=>true],
                ['type'=>'certificate',   'label'=>'Qualification certificate','required'=>true],
                ['type'=>'language_cert', 'label'=>'Language certificate (IELTS/HSK)','required'=>false],
                ['type'=>'medical',       'label'=>'Medical examination report','required'=>false],
            ];
            $uploadedTypes = $documents->pluck('document_type')->toArray();
            @endphp
            <div style="display:flex; flex-direction:column; gap:8px;">
                @foreach($required as $r)
                @php $done = in_array($r['type'], $uploadedTypes); @endphp
                <div style="display:flex; align-items:center; gap:10px; font-size:13px;">
                    <span style="width:18px; height:18px; border-radius:50%; border:1.5px solid {{ $done ? 'var(--accent)' : 'var(--rule-soft)' }}; background:{{ $done ? 'var(--accent)' : 'transparent' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:10px; color:#fff;">{{ $done ? '✓' : '' }}</span>
                    <span style="color:{{ $done ? 'var(--ink)' : 'var(--muted)' }};">{{ $r['label'] }} {{ !$r['required'] ? '(optional)' : '' }}</span>
                </div>
                @endforeach
            </div>
            <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--rule-soft);">
                <a href="{{ route('portal.application', $application->id) }}" class="btn-primary" style="display:block; text-align:center; padding:10px;">Back to application →</a>
            </div>
        </div>

    </div>
</section>
@endsection
