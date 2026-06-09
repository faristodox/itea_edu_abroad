@extends('auth.layout')
@section('title', 'Dashboard')

@section('content')

@if(session('success'))
<div class="adm-alert-success">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('success') }}
</div>
@endif

@php
$profileComplete = Auth::user()->phone && Auth::user()->nationality && Auth::user()->education_level;
$totalDocs = $applications->sum(fn($a) => $a->documents->count());
@endphp

{{-- Stat cards --}}
<div class="stat-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 28px;">
    <div class="stat-card">
        <div class="stat-card-top">
            <div>
                <div class="lbl">Total Applications</div>
                <div class="val">{{ $applications->count() }}</div>
            </div>
            <div class="stat-icon icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
            </div>
        </div>
        <a href="{{ route('portal.apply') }}" class="adm-link">+ Start new application</a>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div>
                <div class="lbl">Documents Uploaded</div>
                <div class="val">{{ $totalDocs }}</div>
            </div>
            <div class="stat-icon icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
        </div>
        <span style="font-size:12px; color:#8a94b0;">Across all applications</span>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div>
                <div class="lbl">Profile Status</div>
                <div class="val" style="font-size:22px; margin-top:4px;">{{ $profileComplete ? 'Complete' : 'Incomplete' }}</div>
            </div>
            <div class="stat-icon {{ $profileComplete ? 'icon-green' : 'icon-amber' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        </div>
        <a href="{{ route('portal.profile') }}" class="adm-link">{{ $profileComplete ? 'Update profile →' : 'Complete profile →' }}</a>
    </div>
</div>

{{-- Applications table --}}
<div class="adm-table-wrap" style="margin-bottom: 28px;">
    <div class="adm-table-header">
        <h2>My Applications</h2>
        <a href="{{ route('portal.apply') }}" class="prt-btn" style="font-size:12px; padding:8px 16px;">+ New Application</a>
    </div>

    @if($applications->isEmpty())
    <div style="text-align:center; padding:48px 24px; color:#8a94b0;">
        <div style="font-size:40px; margin-bottom:12px;">📋</div>
        <div style="font-family:'Outfit',sans-serif; font-size:18px; color:#1a1a2e; font-weight:500; margin-bottom:6px;">No applications yet</div>
        <div style="font-size:13px; margin-bottom:20px;">Start your first application to study abroad with ITEA.</div>
        <a href="{{ route('portal.apply') }}" class="prt-btn">Start application →</a>
    </div>
    @else
    <table>
        <thead>
            <tr>
                <th>Application</th>
                <th>Destination</th>
                <th>University</th>
                <th>Documents</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $app)
            @php
            $badgeClass = match($app->status) {
                'draft'     => 'badge-draft',
                'submitted' => 'badge-submitted',
                'reviewing' => 'badge-reviewing',
                'result'    => ($app->result === 'accepted' ? 'badge-accepted' : 'badge-rejected'),
                default     => 'badge-draft',
            };
            @endphp
            <tr>
                <td>
                    <div style="font-size:11px; color:#8a94b0; font-family:'DM Mono',monospace; margin-bottom:2px;">#{{ str_pad($app->id,5,'0',STR_PAD_LEFT) }}</div>
                    <div style="font-weight:500; color:#1a1a2e;">{{ Str::limit($app->program_name, 32) }}</div>
                </td>
                <td>{{ $app->destination }}</td>
                <td style="color:#8a94b0;">{{ $app->university ?: '—' }}</td>
                <td>{{ $app->documents->count() }} file{{ $app->documents->count() !== 1 ? 's' : '' }}</td>
                <td>
                    <span class="badge {{ $badgeClass }}">
                        {{ $app->statusLabel() }}{{ $app->result ? ' · '.ucfirst($app->result) : '' }}
                    </span>
                </td>
                <td style="color:#8a94b0; white-space:nowrap;">{{ $app->created_at->format('d M Y') }}</td>
                <td style="text-align:right; white-space:nowrap;">
                    <a href="{{ route('portal.application', $app->id) }}" class="adm-link" style="margin-right:10px;">View →</a>
                    @if($app->status === 'draft')
                    <a href="{{ route('portal.apply.edit', $app->id) }}" class="adm-link-muted">Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

{{-- Bottom row: account + quick actions --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
    <div class="adm-card">
        <div class="adm-section-title">Account Details</div>
        <div style="display:flex; flex-direction:column; gap:0;">
            @foreach([['Name', Auth::user()->name],['Email', Auth::user()->email],['Phone', Auth::user()->phone ?: '—'],['Nationality', Auth::user()->nationality ?: '—'],['Education', Auth::user()->education_level ?: '—'],['Member since', Auth::user()->created_at->format('d M Y')]] as [$k,$v])
            <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f0f3f9; font-size:13px;">
                <span style="color:#8a94b0;">{{ $k }}</span>
                <span style="color:#1a1a2e; font-weight:500;">{{ $v }}</span>
            </div>
            @endforeach
        </div>
        <div style="margin-top:16px;">
            <a href="{{ route('portal.profile') }}" class="prt-btn-outline" style="font-size:12px; padding:8px 16px;">Edit Profile</a>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-section-title">Quick Actions</div>
        @php $actions = [
            ['label'=>'Start new application','href'=>route('portal.apply'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'],
            ['label'=>'Browse programmes','href'=>route('programmes'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>'],
            ['label'=>'Check scholarships','href'=>route('scholarship'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>'],
            ['label'=>'Register for Virtual Fair','href'=>route('virtual-fair').'#register','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>'],
        ]; @endphp
        <div style="display:flex; flex-direction:column; gap:4px;">
            @foreach($actions as $a)
            <a href="{{ $a['href'] }}" style="display:flex; align-items:center; gap:12px; font-size:13px; color:#1a1a2e; text-decoration:none; padding:10px 12px; border-radius:10px; transition:background 0.15s;" onmouseover="this.style.background='#f8fafd'" onmouseout="this.style.background='transparent'">
                <span style="color:#8a94b0;">{!! $a['icon'] !!}</span>
                {{ $a['label'] }}
                <span style="margin-left:auto; color:#8a94b0; font-size:12px;">→</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection
