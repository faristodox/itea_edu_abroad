@extends('layouts.app')
@section('title', 'Create Account — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="min-height:calc(100vh - 120px); background:var(--bg); display:flex; align-items:center; padding:60px 0;">
    <div class="wrap" style="display:flex; justify-content:center;">
        <div style="width:100%; max-width:480px;">

            {{-- Header --}}
            <div style="text-align:center; margin-bottom:36px;">
                <div class="eyebrow" style="margin-bottom:10px;">Applicant Portal</div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,40px); font-weight:400; margin:0 0 8px;">Create your <em style="color:var(--accent);">account.</em></h1>
                <p style="font-size:14px; color:var(--muted); margin:0;">Track your application, upload documents and stay in touch with your counsellor — all in one place.</p>
            </div>

            {{-- Card --}}
            <div class="card" style="padding:36px;">

                @if($errors->any())
                <div style="background:#fff0f0; border:1px solid #fca5a5; padding:12px 16px; margin-bottom:20px; font-size:13px; color:#b91c1c;">
                    <ul style="margin:0; padding-left:16px;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST" style="display:flex; flex-direction:column; gap:18px;">
                    @csrf

                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Your full name"
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@email.com"
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Password</label>
                        <input type="password" name="password" required placeholder="Minimum 8 characters"
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:6px;">Confirm Password</label>
                        <input type="password" name="password_confirmation" required placeholder="Repeat password"
                            style="width:100%; padding:11px 14px; border:1px solid var(--rule-soft); background:var(--paper); color:var(--ink); font-size:14px; box-sizing:border-box; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:13px;">
                        Create account →
                    </button>

                    <p style="font-size:11px; color:var(--muted); text-align:center; margin:0;">
                        By registering you agree to our terms of use and privacy policy.
                    </p>
                </form>

                <div style="margin-top:24px; padding-top:24px; border-top:1px solid var(--rule-soft); text-align:center; font-size:13px; color:var(--muted);">
                    Already have an account?
                    <a href="{{ route('login') }}" style="color:var(--accent); text-decoration:none; font-weight:500;">Log in →</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
