@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

{{-- Stat cards row 1 --}}
<div class="stat-grid" style="grid-template-columns:repeat(4,1fr);">
    <div class="stat-card">
        <div class="icon">📋</div>
        <div class="val">{{ $stats['total'] }}</div>
        <div class="lbl">Total applications</div>
    </div>
    <div class="stat-card blue">
        <div class="icon">📥</div>
        <div class="val">{{ $stats['submitted'] }}</div>
        <div class="lbl">Awaiting review</div>
    </div>
    <div class="stat-card amber">
        <div class="icon">🔍</div>
        <div class="val">{{ $stats['reviewing'] }}</div>
        <div class="lbl">Under review</div>
    </div>
    <div class="stat-card">
        <div class="icon">👤</div>
        <div class="val">{{ $stats['applicants'] }}</div>
        <div class="lbl">Registered applicants</div>
    </div>
</div>

{{-- Stat cards row 2 --}}
<div class="stat-grid" style="grid-template-columns:repeat(3,1fr); margin-bottom:28px;">
    <div class="stat-card" style="--accent:#6b7280;">
        <div class="icon">✏️</div>
        <div class="val" style="color:#6b7280;">{{ $stats['draft'] }}</div>
        <div class="lbl">Draft (unsent)</div>
    </div>
    <div class="stat-card green">
        <div class="icon">✅</div>
        <div class="val" style="color:#16a34a;">{{ $stats['result'] }}</div>
        <div class="lbl">Results issued</div>
    </div>
    <div class="stat-card purple">
        <div class="icon">📚</div>
        <div class="val" style="color:#7c3aed;">{{ $stats['programs'] }}</div>
        <div class="lbl">Programmes in DB</div>
    </div>
</div>

{{-- Recent applications table --}}
<div class="adm-table-wrap">
    <div class="adm-table-header">
        <h2>Recent applications</h2>
        <a href="{{ route('admin.applications') }}" class="adm-link">View all →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Applicant</th>
                <th>Programme</th>
                <th>Destination</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $app)
            <tr>
                <td>
                    <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted);">{{ str_pad($app->id,5,'0',STR_PAD_LEFT) }}</span>
                </td>
                <td>
                    <div style="font-weight:500; font-size:14px;">{{ $app->user->name }}</div>
                    <div style="font-size:11px; color:var(--muted);">{{ $app->user->email }}</div>
                </td>
                <td style="max-width:200px;">
                    <div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $app->program_name }}</div>
                </td>
                <td>{{ $app->destination }}</td>
                <td>
                    @php $badge = match($app->status) { 'draft'=>'badge-draft','submitted'=>'badge-submitted','reviewing'=>'badge-reviewing','result'=>($app->result==='accepted'?'badge-accepted':'badge-rejected'),default=>'badge-draft'}; @endphp
                    <span class="badge {{ $badge }}">{{ $app->statusLabel() }}</span>
                </td>
                <td style="color:var(--muted); font-size:12px; white-space:nowrap;">{{ $app->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('admin.application.show', $app->id) }}" class="adm-link">Review →</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:var(--muted); padding:40px; font-size:14px;">
                    No applications yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
