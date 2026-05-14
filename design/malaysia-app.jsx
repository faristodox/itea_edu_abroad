const { useState } = React;

const TYPES = [
  { id: "foundation", title: "Foundation", zh: "基础", count: "60 programmes", glyph: "g1", body: "1-year pre-degree pathway" },
  { id: "diploma", title: "Diploma", zh: "大专", count: "110 programmes", glyph: "g2", body: "2 years · vocational entry" },
  { id: "degree", title: "Degree", zh: "本科", count: "380 programmes", glyph: "g3", body: "Bachelor, 3 years" },
  { id: "master", title: "Master", zh: "硕士", count: "210 programmes", glyph: "g4", body: "Master's, 1–2 years" },
  { id: "phd", title: "PhD", zh: "博士", count: "90 programmes", glyph: "g4", body: "Doctorate, 3–5 years" },
  { id: "english", title: "English", zh: "英语", count: "Online + 4 cities", glyph: "g5", body: "Intensive English · MUET prep" },
];

const WHYS = [
  { num: "01", t: "Global branch campuses", body: "Monash, Nottingham, Heriot-Watt, Curtin, Reading and Newcastle — earn an identical UK or Australian degree at home-campus parity." },
  { num: "02", t: "Taught entirely in English", body: "Every internationally-open programme runs fully in English. No Bahasa requirement — IELTS or MUET accepted." },
  { num: "03", t: "Half the cost of the UK or AU", body: "Tuition and living combined run at 40–50% of the parent-campus price for the same degree, same syllabus, same parchment." },
  { num: "04", t: "Multicultural & home-like", body: "Malay, Chinese, Indian and international students share campuses across KL, Penang and Johor — feels like home from day one." },
];

const TRENDING = [
  { lvl: "DEGREE", uni: "Monash University Malaysia", title: "B.Eng. Software Engineering", meta: "3 yrs · English · Feb / Jul intake", phA: "#1c3d5a", phB: "#0a1f3a" },
  { lvl: "MASTER", uni: "University of Malaya", title: "M.Sc. Data Science & Analytics", meta: "1.5 yrs · English · Sep intake", phA: "#3a7a5a", phB: "#1a3d2c" },
  { lvl: "DEGREE", uni: "Taylor's University", title: "B.A. Hospitality & Tourism Management", meta: "3 yrs · English · Aug intake", phA: "#c98a1d", phB: "#5e3f10" },
  { lvl: "FOUNDATION", uni: "Sunway College", title: "Foundation in Business Studies", meta: "1 yr · English · 4 intakes / yr", phA: "#a51717", phB: "#3d0808" },
];

const REQS = [
  { lvl: "Foundation", age: "16+", edu: "SPM / O-Level / UEC", lang: "IELTS 5.0 or MUET Band 3", docs: "Transcript · Passport · Health" },
  { lvl: "Diploma", age: "17+", edu: "SPM / O-Level (3 credits min.)", lang: "IELTS 5.0 or MUET Band 3", docs: "Transcript · Passport · Health" },
  { lvl: "Degree", age: "18+", edu: "STPM / A-Level / UEC / Foundation", lang: "IELTS 5.5–6.0 or MUET Band 4", docs: "Transcript · SOP · Health · 2 photos" },
  { lvl: "Master", age: "21+", edu: "Recognised Bachelor's (CGPA 2.75+)", lang: "IELTS 6.0–6.5", docs: "Degree · Transcript · 2 refs · SOP" },
  { lvl: "PhD", age: "23+", edu: "Recognised Master's degree", lang: "IELTS 6.5", docs: "Research proposal · 2 refs · Publications" },
];

const TIMELINE = [
  { mo: "OCT – DEC", t: "Shortlist", body: "Consultation, programme matching and pre-application advice." },
  { mo: "JAN – FEB", t: "Apply", body: "Submit through ITEA. Most universities run rolling admissions." },
  { mo: "MAR – APR", t: "Offers", body: "Conditional and unconditional offer letters released." },
  { mo: "MAY – JUN", t: "Visa", body: "EMGS Student Pass application — medical, biometrics, eVAL." },
  { mo: "JULY", t: "Pre-Depart", body: "Pre-arrival briefing, housing booking, airport pickup." },
  { mo: "AUGUST", t: "Arrival", body: "On-campus registration, orientation week and term start." },
];

const DOCS = [
  { name: "Passport (valid 18+ months)", req: "Required" },
  { name: "SPM / O-Level / UEC certificate", req: "For Foundation / Diploma" },
  { name: "STPM / A-Level / Foundation certificate", req: "For Degree" },
  { name: "Bachelor's certificate & transcripts", req: "For Master / PhD" },
  { name: "Master's certificate & transcripts", req: "For PhD only" },
  { name: "Recommendation letters (2)", req: "For Master / PhD" },
  { name: "Personal statement / Study plan", req: "Required" },
  { name: "Research proposal (1,500+ words)", req: "For PhD only" },
  { name: "IELTS / MUET / TOEFL certificate", req: "Required" },
  { name: "EMGS medical examination form", req: "For Student Pass" },
  { name: "Bank statement (USD 4,000+)", req: "For visa" },
];

const EVENTS = [
  { d: "18", m: "May", title: "Monash University Malaysia · Virtual Open Day", meta: "Live · 7:30 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "02", m: "Jun", title: "Study in Malaysia · KL Roadshow", meta: "In-person · ITEA HQ, KL", type: "roadshow", label: "Roadshow" },
  { d: "14", m: "Jun", title: "UM & USM · Application Workshop", meta: "Live · 8 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "26", m: "Jun", title: "Taylor's University · Alumni Q&A", meta: "Live · 7:30 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
];

const FAQS = [
  { q: "Do I need to speak Bahasa Melayu to study in Malaysia?", a: "No. English is the official medium of instruction at every Malaysian university open to international students. Bahasa Melayu is a single elective course, not a graduation requirement, and you'll pick up enough day-to-day to thrive in KL or Penang within a month." },
  { q: "How much does it cost to study in Malaysia?", a: "Tuition runs RM 30,000–65,000 per year. Local universities (UM, USM, UKM) and Taylor's / Sunway sit at the lower end; branch campuses (Monash, Nottingham, Heriot-Watt) at the higher. Living costs in KL average RM 1,500–2,000 per month for shared accommodation, food and transport." },
  { q: "What scholarships are available for Malaysia?", a: "The Malaysia International Scholarship (MIS) is the federal full-ride for Master and PhD. Most private universities — Taylor's, Sunway, Monash, Nottingham — offer 10–50% merit scholarships of their own. ITEA shortlists every scholarship you qualify for in one pass." },
  { q: "When should I start my application?", a: "Aim 6–9 months before your intended intake. Malaysia runs three main intakes — February, July and September — and most universities accept rolling applications, but scholarship deadlines fall earlier (typically January–February for September)." },
  { q: "Can I work part-time on a Student Pass?", a: "Yes. The Student Pass permits up to 20 hours/week of part-time work during the semester and full-time during semester breaks, in approved sectors: restaurants, petrol kiosks, mini-markets and hotels. On-campus assistantships are also widely available." },
  { q: "Will my Malaysian degree be recognised back home?", a: "Yes. MQA-accredited programmes are recognised across ASEAN, by China's CSDGE, and globally. Twinning / 3+0 degrees from Monash, Nottingham, Heriot-Watt and others award the home-campus parchment — identical to graduating in Melbourne or Nottingham." },
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
    <section className="cn-hero my-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <a href="#">Destinations</a>
          <span className="sep">/</span>
          <span className="here">Study in Malaysia</span>
        </div>
        <div className="cn-hero-grid">
          <div>
            <div className="label"><span className="bar"></span> Destination · 02 of 03</div>
            <h1>Study in <em>Malaysia.</em><span className="zh">马来西亚</span></h1>
            <p>ASEAN's most international education hub. UK and Australian branch campuses, English-medium teaching, and the most affordable route to a globally-recognised degree in tropical Southeast Asia.</p>
            <div className="h-actions">
              <button className="btn">Match me to a programme <span className="arr"></span></button>
              <a href="#" className="link">Download Malaysia guide (PDF) ↓</a>
            </div>
          </div>
          <div className="cn-fact">
            <h4>Malaysia at a glance</h4>
            <div className="stat"><span className="k">Partner universities</span><span className="v">90<small>+</small></span></div>
            <div className="stat"><span className="k">Programmes available</span><span className="v">850<small>+</small></span></div>
            <div className="stat"><span className="k">QS Top 200 institutions</span><span className="v">5</span></div>
            <div className="stat"><span className="k">English-taught programmes</span><span className="v">All</span></div>
            <div className="stat"><span className="k">Average tuition (Master)</span><span className="v">RM38<small>k / yr</small></span></div>
            <div className="stat"><span className="k">Scholarship match rate</span><span className="v">88<small>%</small></span></div>
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
            <div className="mono" style={{color:'var(--muted)'}}>Browse by programme type</div>
            <h2>What level <em>are you?</em></h2>
          </div>
          <p>Six routes into the Malaysian higher-education system — from foundation programmes to research doctorates. Click any to jump into matching programmes.</p>
        </div>
        <div className="types-grid">
          {TYPES.map((t) => (
            <a key={t.id} href={`Programmes.html?level=${t.id}`} className="type-card">
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

function WhyMalaysia() {
  return (
    <section className="why-cn">
      <div className="wrap why-grid">
        <div className="lhs">
          <div className="mono" style={{color:'var(--muted)'}}>Why Malaysia</div>
          <h2>The smartest <em>shortcut</em> into a UK or Australian degree.</h2>
          <p>Malaysia is the world's largest transnational-education host. Five UK universities, four Australian, and a layer of strong local institutions all operate full branch campuses in KL, Selangor, Penang and Sarawak. For a Malaysian, Indonesian or Chinese student, no destination offers more degree value per ringgit.</p>
          <div className="seal">
            <div className="zh">学</div>
            <div className="en">
              <b>Ilmu — knowledge, learning</b>
              The Malay word for learning. The motto of every Malaysian university and the foundation of the nation's education vision.
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
            <div className="mono" style={{color:'var(--muted)'}}>Top trending in Malaysia</div>
            <h2>Programmes <em>students are picking</em> this month.</h2>
          </div>
          <a href="Programmes.html" className="btn ghost">See all Malaysia programmes <span className="arr"></span></a>
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
          <div className="mono" style={{color:'var(--muted)'}}>Entry requirements</div>
          <h2>Who can <em>apply.</em></h2>
          <p>Indicative baseline. Branch campuses (Monash, Nottingham, Heriot-Watt) and top local universities (UM, USM, UKM, UPM) often require above-baseline scores. Your counsellor will confirm exact thresholds.</p>
        </div>
        <div className="req-table">
          <div className="req-row head">
            <div>Level</div><div>Age</div><div>Education</div><div>Language</div><div>Documents</div>
          </div>
          {REQS.map((r, i) => (
            <div key={i} className="req-row">
              <div className="lvl">{r.lvl}</div>
              <div className="v">{r.age}</div>
              <div className="v">{r.edu}</div>
              <div className="v">{r.lang}<small>MUET or English alternative</small></div>
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
          <div className="mono">When to apply</div>
          <h2>A typical timeline <em>for the August intake.</em></h2>
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
          <h3>Upcoming <em>webinars & roadshows.</em></h3>
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
            <p>Six of the most-asked. If yours isn't here, our Malaysia desk responds on WhatsApp within an hour.</p>
            <button className="btn">Chat with Malaysia desk <span className="arr"></span></button>
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
          <h2>Your future,<br/><em>studied in Malaysia.</em></h2>
        </div>
        <div>
          <p>One form gets you matched to up to five programmes and screened against six scholarships. A Malaysia desk counsellor calls you within 48 hours.</p>
          <div className="acts" style={{marginTop:24}}>
            <button className="btn">Start Malaysia application <span className="arr"></span></button>
            <a href="#" className="link">Or download the Malaysia guide ↓</a>
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
              <li><a href="Programmes.html">English Programmes</a></li>
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
            <h6>Apply</h6>
            <ul>
              <li><a href="#">How to apply</a></li>
              <li><a href="#">Fees & refund</a></li>
              <li><a href="#">Required documents</a></li>
              <li><a href="#">Visa guidance</a></li>
              <li><a href="#">Pre-departure briefing</a></li>
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
      <WhyMalaysia />
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
