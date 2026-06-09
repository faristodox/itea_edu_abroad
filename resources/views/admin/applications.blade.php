@extends('admin.layout')
@section('title', 'All Applications')
@section('breadcrumb', 'Applications')

@section('content')

<div class="adm-table-wrap">
    <div class="adm-table-header">
        <h2>All Applications <span style="font-family:'DM Sans',sans-serif; font-weight:400; font-size:13px; color:var(--muted); text-transform:none; letter-spacing:0;">({{ $applications->total() }})</span></h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Applicant</th>
                <th>Programme</th>
                <th>Destination</th>
                <th>Level</th>
                <th>Status</th>
                <th>Docs</th>
                <th>Submitted</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
            <tr>
                <td><span style="font-family:'DM Mono',monospace; font-size:11px; color:var(--muted);">{{ str_pad($app->id,5,'0',STR_PAD_LEFT) }}</span></td>
                <td>
                    <div style="font-weight:500;">{{ $app->user->name }}</div>
                    <div style="font-size:11px; color:var(--muted);">{{ $app->user->email }}</div>
                </td>
                <td style="max-width:180px;"><div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $app->program_name }}</div></td>
                <td>{{ $app->destination }}</td>
                <td><span style="font-size:12px; color:var(--muted);">{{ $app->level }}</span></td>
                <td>
                    @php $badge = match($app->status) { 'draft'=>'badge-draft','submitted'=>'badge-submitted','reviewing'=>'badge-reviewing','result'=>($app->result==='accepted'?'badge-accepted':'badge-rejected'),default=>'badge-draft'}; @endphp
                    <span class="badge {{ $badge }}">{{ $app->statusLabel() }}</span>
                </td>
                <td style="text-align:center; font-family:'DM Mono',monospace; font-size:12px;">{{ $app->documents->count() }}</td>
                <td style="font-size:12px; color:var(--muted); white-space:nowrap;">{{ $app->submitted_at?->format('d M Y') ?? '—' }}</td>
                <td><a href="{{ route('admin.application.show', $app->id) }}" class="adm-link">Review →</a></td>
            </tr>
            @empty
            <tr><td colspan="9" style="text-align:center; color:var(--muted); padding:40px; font-size:14px;">No applications yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:14px 20px; border-top:1px solid var(--rule-soft); background:#fafafa;">
        {{ $applications->links() }}
    </div>
</div>

@endsection

