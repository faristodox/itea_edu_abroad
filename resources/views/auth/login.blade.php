@extends('layouts.app')
@section('title', 'Student Login — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="min-height:calc(100vh - 120px); background:var(--bg); display:flex; align-items:center; padding:60px 0;">
    <div class="wrap" style="display:flex; justify-content:center;">
        <div style="width:100%; max-width:440px;">

            {{-- Header --}}
            <div style="text-align:center; margin-bottom:36px;">
                <div class="eyebrow" style="margin-bottom:10px;">Applicant Portal</div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,40px); font-weight:400; margin:0 0 8px;">Welcome <em style="color:var(--accent);">back.</em></h1>
                <p style="font-size:14px; color:var(--muted); margin:0;">Log in to track your application and upload any required documents.</p>
            </div>

            {{-- Card --}}
            <div class="card" style="padding:36px;">

                @if($errors->any())
                <div style="background:#fff0f0; border:1px solid #fca5a5; padding:12px 16px; margin-bottom:20px; font-size:13px; color:#b91c1c;">
                    {{ $errors->first() }}
                </div>
                @endif

                @if(session('status'))
                <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:20px; font-size:13px; color:#166534;">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST" style="display:flex; flex-direction:column; gap:18px;">
                    @csrf

                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                            <label style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted);">Password</label>
                        </div>
                        <input type="password" name="password" required
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <div style="display:flex; align-items:center; gap:8px;">
                        <input type="checkbox" name="remember" id="remember" style="width:15px; height:15px; accent-color:var(--accent);">
                        <label for="remember" style="font-size:13px; color:var(--muted); cursor:pointer;">Remember me</label>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:13px;">
                        Log in →
                    </button>
                </form>

                <div style="margin-top:24px; padding-top:24px; border-top:1px solid var(--rule-soft); text-align:center; font-size:13px; color:var(--muted);">
                    Don't have an account?
                    <a href="{{ route('register') }}" style="color:var(--accent); text-decoration:none; font-weight:500;">Register free →</a>
                </div>
            </div>

            <p style="text-align:center; margin-top:20px; font-size:12px; color:var(--muted);">
                Need help? <a href="{{ route('contact') }}" style="color:var(--accent); text-decoration:none;">Contact us</a>
            </p>
        </div>
    </div>
</section>
@endsection
