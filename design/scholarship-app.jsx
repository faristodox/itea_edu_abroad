const { useState } = React;

const TYPES = [
  { id: "full", title: "Full-Ride", zh: "全额", count: "12 programmes", glyph: "g1", body: "Tuition + housing + stipend" },
  { id: "waiver", title: "Tuition Waiver", zh: "学费减免", count: "85 universities", glyph: "g2", body: "Partial or full fee discount" },
  { id: "merit", title: "Merit", zh: "优秀", count: "Most universities", glyph: "g3", body: "Awarded by academic excellence" },
  { id: "need", title: "Need-Based", zh: "助学金", count: "Federal + university", glyph: "g4", body: "Awarded by financial circumstance" },
  { id: "research", title: "Research", zh: "科研", count: "All disciplines", glyph: "g5", body: "Master & PhD researchers" },
  { id: "industry", title: "Industry", zh: "企业", count: "Partner-funded", glyph: "g6", body: "Corporate-sponsored awards" },
];

const WHYS = [
  { num: "01", t: "Free application support", body: "ITEA is paid by partner universities. No consultation, application or success fees on the scholarship desk — ever." },
  { num: "02", t: "Parallel submission", body: "We submit you for every award you qualify for in a single cycle. Most students apply to 4–6 scholarships at once." },
  { num: "03", t: "73% success rate", body: "73% of our 2024–25 candidates received at least one funded offer. Average award: 60% of total programme cost." },
  { num: "04", t: "Local advisors", body: "Our China desk and Malaysia desk write essays, prep interviews and lobby admissions in-language — not from a script." },
];

const TRENDING = [
  { lvl: "FULL-RIDE", uni: "China Scholarship Council", title: "CSC · Chinese Government Scholarship", meta: "All levels · Sep deadline · 5,000+ awarded", phA: "#a51717", phB: "#3d0808" },
  { lvl: "FULL-RIDE", uni: "Government of Malaysia", title: "MIS · Malaysia International Scholarship", meta: "Master / PhD · Mar & Aug · Federal funded", phA: "#c98a1d", phB: "#5e3f10" },
  { lvl: "TUITION", uni: "Jeffrey Cheah Foundation", title: "Sunway Group · Foundation Award", meta: "Undergraduate · Feb intake · Up to 100%", phA: "#1c3d5a", phB: "#0a1f3a" },
  { lvl: "FULL-RIDE", uni: "Tsinghua University", title: "Schwarzman Scholars Programme", meta: "1-yr Master · Sep deadline · 200 places", phA: "#3a7a5a", phB: "#1a3d2c" },
];

const REQS = [
  { lvl: "Full-Ride", age: "Under 35 (MA) · 40 (PhD)", edu: "Top 10% academic · CGPA 3.5+", lang: "IELTS 6.5+ / HSK 5+", docs: "Transcript · 2 academic refs · SOP" },
  { lvl: "Tuition Waiver", age: "All levels", edu: "Top 30% · CGPA 3.3+", lang: "IELTS 6.0+ / MUET 4", docs: "Transcript · SOP · Interview" },
  { lvl: "Merit", age: "All levels", edu: "Programme-required + above", lang: "Programme-required", docs: "Transcript · CV" },
  { lvl: "Need-Based", age: "All levels", edu: "Programme-required (CGPA 2.75+)", lang: "Programme-required", docs: "Financial declaration · Income docs" },
  { lvl: "Research", age: "Master & PhD", edu: "Recognised previous degree", lang: "IELTS 6.5+", docs: "Research proposal · Publications · 2 refs" },
];

const TIMELINE = [
  { mo: "WEEK 1", t: "Profile Review", body: "1-on-1 review of your academic record, goals and budget." },
  { mo: "WEEK 2", t: "Shortlist", body: "We map every scholarship you qualify for across all destinations." },
  { mo: "WEEK 3 – 4", t: "Prep", body: "Essay drafting, reference outreach, supporting-document review." },
  { mo: "WEEK 5 – 6", t: "Submit", body: "Parallel submission of 4–6 applications via ITEA's portal." },
  { mo: "WEEK 7 – 12", t: "Interview", body: "Mock interviews, panel prep, and live coaching in-language." },
  { mo: "WEEK 13+", t: "Onboarding", body: "Acceptance, contract review, pre-departure briefing." },
];

const DOCS = [
  { name: "Passport (valid 18+ months)", req: "Required" },
  { name: "Academic transcripts (all levels)", req: "Required" },
  { name: "Degree / diploma certificates", req: "Required" },
  { name: "Language test (IELTS / HSK / MUET / TOEFL)", req: "Required" },
  { name: "Recommendation letters (2)", req: "For Merit / Research" },
  { name: "Personal statement / scholarship essay", req: "Required" },
  { name: "CV / resume", req: "Required" },
  { name: "Research proposal (1,500+ words)", req: "For Research / PhD" },
  { name: "Financial declaration & income docs", req: "For Need-Based" },
  { name: "Recent passport photos (2)", req: "Required" },
  { name: "Citizenship / residency proof", req: "Required" },
];

const EVENTS = [
  { d: "20", m: "May", title: "CSC Application Workshop · Step-by-step", meta: "Live · 7:30 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "30", m: "May", title: "Scholarship Essay Bootcamp · Live edits", meta: "In-person · ITEA HQ, KL", type: "roadshow", label: "Bootcamp" },
  { d: "12", m: "Jun", title: "MIS Application Q&A with past recipient", meta: "Live · 8 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "28", m: "Jun", title: "Jeffrey Cheah Foundation · Info Session", meta: "In-person · Sunway University", type: "roadshow", label: "Info Session" },
];

const FAQS = [
  { q: "How many scholarships can I apply to at once?", a: "As many as you qualify for. ITEA runs parallel submissions, and most students apply to 4–6 scholarships in a single cycle. There's no penalty for applying widely; in fact, it's how we get to our 73% success rate." },
  { q: "Is ITEA's scholarship support really free?", a: "Yes. ITEA is paid by our partner universities, not by you. There are no consultation fees, no application fees, and no success fees on the scholarship desk. The only money you ever spend is what the scholarship issuer charges directly (e.g. CSC's small registration fee)." },
  { q: "What is the realistic success rate?", a: "Across the 2024–25 intake, 73% of ITEA scholarship candidates received at least one funded offer. Average award value was 60% of total programme cost — 28% of candidates received full-ride awards covering tuition, housing and a monthly stipend." },
  { q: "When should I start my scholarship application?", a: "Aim 9–12 months before your intended intake. CSC opens January and closes April for September intake. MIS opens January and closes February. University-specific awards run on their own calendars — your counsellor will build a personalised timeline." },
  { q: "Can I apply for scholarships in multiple countries at the same time?", a: "Yes — and we recommend it. Many students secure both a China-side scholarship (e.g. CSC) and a Malaysia branch-campus award, then choose the best offer. There's no exclusivity clause unless you formally accept and sign." },
  { q: "Do scholarships cover flights, visa and insurance?", a: "Full-ride awards (CSC, MIS, Schwarzman) include tuition, accommodation, a monthly stipend and comprehensive medical insurance. Flight is usually not included — budget RM 1,200–2,500 for a one-way ticket. ITEA covers your visa-stage logistics free of charge." },
];

function Placeholder({ phA, phB, label }) {
  return (
    <div className="img-ph" style={{ "--ph-a": phA, "--ph-b": phB }}>
      {label && <div className="ph-lbl">{label}</div>}
    </div>
  );
}

function Hero() {
  return (
    <section className="cn-hero sch-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <span className="here">Scholarships</span>
        </div>
        <div className="cn-hero-grid">
          <div>
            <div className="label"><span className="bar"></span> Funding desk · 42 active awards</div>
            <h1>Scholarships.<span className="zh">奖学金</span></h1>
            <p>One conversation, every scholarship you qualify for. ITEA has placed 1,400+ Southeast Asian students into RM&nbsp;65M of funded study since 2009 — across federal, university and industry awards.</p>
            <div className="h-actions">
              <button className="btn">Find scholarships for me <span className="arr"></span></button>
              <a href="#" className="link">Download scholarship guide (PDF) ↓</a>
            </div>
          </div>
          <div className="cn-fact">
            <h4>Scholarships at a glance</h4>
            <div className="stat"><span className="k">Active programmes</span><span className="v">42<small>+</small></span></div>
            <div className="stat"><span className="k">Full-ride options</span><span className="v">12</span></div>
            <div className="stat"><span className="k">Avg matches per student</span><span className="v">4.2</span></div>
            <div className="stat"><span className="k">Funding placed (lifetime)</span><span className="v">RM65<small>M</small></span></div>
            <div className="stat"><span className="k">Success rate (24/25)</span><span className="v">73<small>%</small></span></div>
            <div className="stat"><span className="k">Application support</span><span className="v">Free</span></div>
          </div>
        </div>
      </div>
    </section>
  );
}

function ProgrammeTypes() {
  return (
    <section className="prog-types">
      <div className="wrap">
        <div className="types-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>Browse by scholarship type</div>
            <h2>What kind of <em>award?</em></h2>
          </div>
          <p>Six categories of funding. Click any to surface every scholarship in that bracket — across China, Malaysia and our growing destinations.</p>
        </div>
        <div className="types-grid">
          {TYPES.map((t) => (
            <a key={t.id} href={`Scholarship.html?type=${t.id}`} className="type-card">
              <div className={"glyph " + t.glyph}></div>
              <div>
                <div className="cn">{t.zh}</div>
                <h4>{t.title}</h4>
                <div className="cnt" style={{marginTop:4}}>{t.count}</div>
              </div>
              <div className="go">{t.body} →</div>
            </a>
          ))}
        </div>
      </div>
    </section>
  );
}

function WhyScholarship() {
  return (
    <section className="why-cn">
      <div className="wrap why-grid">
        <div className="lhs">
          <div className="mono" style={{color:'var(--muted)'}}>Why ITEA's scholarship desk</div>
          <h2>The fastest route between <em>your record</em> and an offer letter.</h2>
          <p>Other agents charge for scholarship work; ITEA is paid by the universities. Our job is to map your record against every award, write the strongest applications you'll ever file, and stand behind you in panel interviews — in Mandarin, Bahasa or English, whichever lands the offer.</p>
          <div className="seal">
            <div className="zh">奖</div>
            <div className="en">
              <b>Jiǎng — award, recognition</b>
              The character on every Chinese scholarship certificate. The reward for academic ambition matched with the right application.
            </div>
          </div>
        </div>
        <div className="why-cards">
          {WHYS.map((w, i) => (
            <div key={i} className="why-cell">
              <div className="num">{w.num}</div>
              <h4>{w.t}</h4>
              <p>{w.body}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Trending() {
  return (
    <section className="trend-section">
      <div className="wrap">
        <div className="trend-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>Featured awards</div>
            <h2>Scholarships <em>open right now.</em></h2>
          </div>
          <a href="#" className="btn ghost">See all 42 scholarships <span className="arr"></span></a>
        </div>
        <div className="trend-grid">
          {TRENDING.map((p, i) => (
            <div key={i} className="trend-card">
              <div className="trend-img">
                <Placeholder phA={p.phA} phB={p.phB} label={p.uni.toUpperCase()} />
                <span className="lvl">{p.lvl}</span>
              </div>
              <div className="trend-body">
                <div className="uni">{p.uni}</div>
                <h4>{p.title}</h4>
                <div className="meta">{p.meta}</div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Requirements() {
  return (
    <section className="req-section">
      <div className="wrap">
        <div className="req-head">
          <div className="mono" style={{color:'var(--muted)'}}>Eligibility</div>
          <h2>Who can <em>apply.</em></h2>
          <p>Indicative baseline by scholarship type. Top awards (CSC, MIS, Schwarzman) layer additional language, leadership or research criteria. Your counsellor confirms exact thresholds during the profile review.</p>
        </div>
        <div className="req-table">
          <div className="req-row head">
            <div>Type</div><div>Level / Age</div><div>Academic</div><div>Language</div><div>Other</div>
          </div>
          {REQS.map((r, i) => (
            <div key={i} className="req-row">
              <div className="lvl">{r.lvl}</div>
              <div className="v">{r.age}</div>
              <div className="v">{r.edu}</div>
              <div className="v">{r.lang}<small>Or programme-equivalent</small></div>
              <div className="v">{r.docs}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Timeline() {
  return (
    <section className="timeline-section">
      <div className="wrap">
        <div className="timeline-card">
          <div className="mono">How ITEA runs your application</div>
          <h2>From profile to offer in <em>under 13 weeks.</em></h2>
          <div className="timeline-grid">
            {TIMELINE.map((s, i) => (
              <div key={i} className={"tl-step " + (i < 2 ? "on" : "")}>
                <div className="tl-dot">{i+1}</div>
                <div className="mo">{s.mo}</div>
                <h5>{s.t}</h5>
                <p>{s.body}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

function DocsEvents() {
  return (
    <section className="docs-events">
      <div className="wrap docs-events-grid">
        <div className="docs-card">
          <div className="mono" style={{color:'var(--muted)'}}>What you'll need</div>
          <h3>Documents <em>checklist.</em></h3>
          <div className="docs-list">
            {DOCS.map((d, i) => (
              <div key={i} className="docs-item">
                <div className="docs-check">✓</div>
                <div>{d.name}</div>
                <div className="req">{d.req}</div>
              </div>
            ))}
          </div>
        </div>
        <div className="events-card">
          <div className="mono" style={{color:'var(--muted)'}}>Events & activities</div>
          <h3>Upcoming <em>workshops & bootcamps.</em></h3>
          <div>
            {EVENTS.map((e, i) => (
              <div key={i} className="event-item">
                <div className="event-date">
                  <div className="d">{e.d}</div>
                  <div className="m">{e.m}</div>
                </div>
                <div className="info">
                  <h5>{e.title}</h5>
                  <div className="meta">{e.meta}</div>
                </div>
                <div className={"type " + (e.type === "webinar" ? "webinar" : "")}>{e.label}</div>
              </div>
            ))}
          </div>
          <a href="#" style={{marginTop: 20, display:'inline-flex', alignItems:'center', gap:8, color:'var(--accent)', fontSize:14, fontWeight:500}}>View full events calendar →</a>
        </div>
      </div>
    </section>
  );
}

function FAQ() {
  const [open, setOpen] = useState(0);
  return (
    <section className="faq-section">
      <div className="wrap">
        <div className="faq-grid">
          <div className="faq-side">
            <div className="mono">Q & A</div>
            <h2 style={{fontFamily:"'Instrument Serif',serif", fontWeight:400, fontSize:48, margin:'12px 0 18px', lineHeight:1}}>Common <em style={{fontStyle:'italic', color:'var(--accent)'}}>questions.</em></h2>
            <p>Six of the most-asked. If yours isn't here, our scholarship desk responds on WhatsApp within an hour.</p>
            <button className="btn">Chat with scholarship desk <span className="arr"></span></button>
          </div>
          <div className="faq-list">
            {FAQS.map((f, i) => (
              <div key={i} className={"faq-row " + (i === open ? "on" : "")}>
                <button className="faq-q" onClick={() => setOpen(open === i ? -1 : i)}>
                  <span>{f.q}</span>
                  <span className="plus"></span>
                </button>
                <div className="faq-a">
                  <p>{f.a}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

function CTA() {
  return (
    <section className="cn-cta">
      <div className="wrap cn-cta-grid">
        <div>
          <div className="mono">Ready when you are</div>
          <h2>Your future,<br/><em>funded.</em></h2>
        </div>
        <div>
          <p>One form gets you screened against 42 active scholarships. A funding-desk advisor calls you within 48 hours with a personalised shortlist — and walks you through every application, free of charge.</p>
          <div className="acts" style={{marginTop:24}}>
            <button className="btn">Start scholarship match <span className="arr"></span></button>
            <a href="#" className="link">Or download the scholarship guide ↓</a>
          </div>
        </div>
      </div>
    </section>
  );
}

function Foot() {
  return (
    <footer className="foot">
      <div className="wrap">
        <div className="foot-top">
          <div>
            <div className="foot-logo-tile">
              <img src={(typeof window !== 'undefined' && window.__resources && window.__resources.footerLogo) || "assets/logo.jpeg"} alt="ITEA EduAbroad" />
            </div>
            <p className="foot-blurb">An education abroad consultancy placing Southeast Asian students into top universities across China, Malaysia and Indonesia since 2009.</p>
          </div>
          <div>
            <h6>Programmes</h6>
            <ul>
              <li><a href="Programmes.html">Foundation</a></li>
              <li><a href="Programmes.html">Diploma</a></li>
              <li><a href="Programmes.html">Undergraduate</a></li>
              <li><a href="Programmes.html">Postgraduate</a></li>
              <li><a href="Programmes.html">Language Programmes</a></li>
            </ul>
          </div>
          <div>
            <h6>Destinations</h6>
            <ul>
              <li><a href="Study-in-China.html">Study in China</a></li>
              <li><a href="Study-in-Malaysia.html">Study in Malaysia</a></li>
              <li><a href="#">Study in Indonesia</a></li>
              <li><a href="#">Future destinations</a></li>
            </ul>
          </div>
          <div>
            <h6>Scholarships</h6>
            <ul>
              <li><a href="Scholarship.html">All scholarships</a></li>
              <li><a href="Scholarship.html?type=full">Full-ride</a></li>
              <li><a href="Scholarship.html?type=merit">Merit awards</a></li>
              <li><a href="Scholarship.html?type=need">Need-based</a></li>
              <li><a href="Scholarship.html?type=research">Research grants</a></li>
            </ul>
          </div>
          <div>
            <h6>Company</h6>
            <ul>
              <li><a href="#">About ITEA</a></li>
              <li><a href="#">Partners</a></li>
              <li><a href="#">University partners</a></li>
              <li><a href="https://iteajobs.com/" target="_blank" rel="noopener">Career pathway</a></li>
              <li><a href="#">Contact us</a></li>
            </ul>
          </div>
        </div>
        <div className="foot-bottom">
          <div>© 2026 ITEA Education Sdn Bhd. All rights reserved.</div>
          <div className="right">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Cookies</a>
            <a href="#">EN / 中文 / BM</a>
          </div>
        </div>
      </div>
    </footer>
  );
}

function App() {
  return (
    <>
      <Hero />
      <ProgrammeTypes />
      <WhyScholarship />
      <Trending />
      <Requirements />
      <Timeline />
      <DocsEvents />
      <FAQ />
      <CTA />
      <Foot />
    </>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
