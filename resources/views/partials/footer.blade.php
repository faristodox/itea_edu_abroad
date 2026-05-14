<footer style="background:var(--ink-deep); color:rgba(251,249,242,0.75);">
    <div class="wrap" style="padding-top:56px; padding-bottom:0;">
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr 1fr; gap:40px; padding-bottom:48px; border-bottom:1px solid rgba(255,255,255,0.1);">

            <!-- Brand -->
            <div>
                <div style="background:var(--bg); display:inline-block; padding:10px 14px; margin-bottom:18px;">
                    <img src="{{ asset('assets/logo.png') }}" alt="ITEA EduAbroad" style="height:36px; width:auto;">
                </div>
                <p style="font-size:14px; line-height:1.6; max-width:280px; margin:0;">
                    An education abroad consultancy placing Southeast Asian students into top universities across China, Malaysia and Indonesia since 2009.
                </p>
            </div>

            <!-- Programmes -->
            <div>
                <h6 style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin:0 0 14px;">Programmes</h6>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                    @foreach(['Diploma','Undergraduate','Postgraduate','Mandarin Learning','Short-term & Camps'] as $item)
                    <li><a href="{{ route('programmes') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px; transition:color 0.15s;">{{ $item }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Destinations -->
            <div>
                <h6 style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin:0 0 14px;">Destinations</h6>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="{{ route('china') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Study in China</a></li>
                    <li><a href="{{ route('malaysia') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Study in Malaysia</a></li>
                    <li><a href="#" style="color:rgba(251,249,242,0.4); text-decoration:none; font-size:14px;">Study in Indonesia</a></li>
                    <li><a href="#" style="color:rgba(251,249,242,0.4); text-decoration:none; font-size:14px;">Future destinations</a></li>
                </ul>
            </div>

            <!-- Application / Scholarships -->
            <div>
                <h6 style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin:0 0 14px;">
                    @if(request()->routeIs('scholarship'))Scholarships@else Application @endif
                </h6>
                @if(request()->routeIs('scholarship'))
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="{{ route('scholarship') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">All scholarships</a></li>
                    <li><a href="{{ route('scholarship') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Full-ride awards</a></li>
                    <li><a href="{{ route('scholarship') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Merit awards</a></li>
                    <li><a href="{{ route('scholarship') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Need-based</a></li>
                    <li><a href="{{ route('scholarship') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Research grants</a></li>
                </ul>
                @else
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="{{ route('application') }}#how" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">How to apply</a></li>
                    <li><a href="{{ route('application') }}#fees" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Fees &amp; refund</a></li>
                    <li><a href="{{ route('application') }}#docs" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Required documents</a></li>
                    <li><a href="{{ route('application') }}#visa" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Visa guidance</a></li>
                    <li><a href="{{ route('application') }}#depart" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Pre-departure briefing</a></li>
                </ul>
                @endif
            </div>

            <!-- Company -->
            <div>
                <h6 style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin:0 0 14px;">Company</h6>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="#" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">About ITEA</a></li>
                    <li><a href="#" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Partners</a></li>
                    <li><a href="#" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">University partners</a></li>
                    <li><a href="https://iteajobs.com/" target="_blank" rel="noopener" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Career pathway ↗</a></li>
                    <li><a href="{{ route('contact') }}" style="color:rgba(251,249,242,0.7); text-decoration:none; font-size:14px;">Contact us</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div style="display:flex; justify-content:space-between; align-items:center; padding:18px 0; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.06em; color:rgba(255,255,255,0.35);">
            <div>© 2026 ITEA Education Sdn Bhd. All rights reserved.</div>
            <div style="display:flex; gap:20px;">
                @foreach(['Privacy','Terms','Cookies'] as $link)
                <a href="#" style="color:rgba(255,255,255,0.35); text-decoration:none;">{{ $link }}</a>
                @endforeach
                <span>EN / 中文 / BM</span>
            </div>
        </div>
    </div>
</footer>
