@extends('admin.layout')
@section('title', 'Manage Programmes')
@section('breadcrumb', 'Programmes')

@section('topbar_actions')
<a href="{{ route('admin.programs.create') }}" class="btn-primary" style="padding:8px 20px; font-size:11px; letter-spacing:0.06em;">+ Add Programme</a>
@endsection

@section('content')

@if(session('success'))
<div class="adm-alert-success">{{ session('success') }}</div>
@endif

<div class="adm-table-wrap">
    <div class="adm-table-header">
        <h2>All Programmes <span style="font-family:'Geist',sans-serif; font-weight:400; font-size:13px; color:var(--muted); text-transform:none; letter-spacing:0;">({{ $programs->total() }})</span></h2>
    </div>
    <table>
        <thead>
            <tr><th>Programme</th><th>Destination</th><th>Level</th><th>University</th><th>Duration</th><th>Tuition</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($programs as $prog)
            <tr>
                <td style="font-weight:500; max-width:200px;">{{ $prog->name }}</td>
                <td>{{ $prog->destination }}</td>
                <td><span style="font-size:12px; color:var(--muted);">{{ $prog->level }}</span></td>
                <td style="font-size:12px; color:var(--muted);">{{ $prog->university ?: '—' }}</td>
                <td style="font-size:12px; color:var(--muted);">{{ $prog->duration ?: '—' }}</td>
                <td style="font-size:12px; color:var(--muted);">{{ $prog->tuition ?: '—' }}</td>
                <td><span class="badge badge-{{ $prog->status }}">{{ $prog->status }}</span></td>
                <td>
                    <div style="display:flex; gap:14px; align-items:center;">
                        <a href="{{ route('admin.programs.edit', $prog->id) }}" class="adm-link">Edit</a>
                        <form action="{{ route('admin.programs.destroy', $prog->id) }}" method="POST" onsubmit="return confirm('Delete this programme?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; font-size:12px; color:#dc2626; cursor:pointer; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; padding:0;">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center; color:var(--muted); padding:40px; font-size:14px;">No programmes yet. <a href="{{ route('admin.programs.create') }}" style="color:var(--accent);">Add one →</a></td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:14px 20px; border-top:1px solid var(--rule-soft); background:#fafafa;">
        {{ $programs->links() }}
    </div>
</div>

@endsection
