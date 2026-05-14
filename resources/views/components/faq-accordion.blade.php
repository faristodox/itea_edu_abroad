@props([
    'faqs'       => [],
    'sideTitle'  => 'Common <em>questions.</em>',
    'sideBody'   => 'If your question isn\'t here, our team responds on WhatsApp within an hour.',
    'sideCta'    => 'Chat on WhatsApp',
    'sideCtaHref'=> 'https://wa.me/60123456789',
])

<section class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:340px 1fr; gap:60px; align-items:start;">
            {{-- Side --}}
            <div>
                <div class="eyebrow" style="margin-bottom:12px;">Q &amp; A</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4vw,52px); font-weight:400; line-height:1; margin:0 0 16px;">{!! $sideTitle !!}</h2>
                <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0 0 24px;">{{ $sideBody }}</p>
                <a href="{{ $sideCtaHref }}" target="_blank" rel="noopener" class="btn-primary">{{ $sideCta }} →</a>
            </div>

            {{-- Accordion --}}
            <div x-data="{ open: 0 }">
                @foreach($faqs as $i => $faq)
                <div style="border-bottom:1px solid var(--rule-soft);">
                    <button
                        @click="open = open === {{ $i }} ? -1 : {{ $i }}"
                        style="width:100%; display:flex; justify-content:space-between; align-items:center; gap:16px; padding:18px 0; background:none; border:none; cursor:pointer; text-align:left;">
                        <span style="font-size:16px; color:var(--ink); font-weight:500; line-height:1.4;">{{ $faq['q'] }}</span>
                        <span style="flex-shrink:0; font-size:20px; color:var(--accent); font-weight:300; transition:transform 0.2s ease;"
                              :style="open === {{ $i }} ? 'transform:rotate(45deg)' : ''">+</span>
                    </button>
                    <div x-show="open === {{ $i }}" x-collapse>
                        <p style="font-size:15px; line-height:1.65; color:var(--muted); padding:0 0 18px; margin:0;">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
