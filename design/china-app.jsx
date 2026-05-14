const { useState } = React;

const TYPES = [
  { id: "diploma", title: "Diploma", zh: "大专", count: "85 programmes", glyph: "g1", body: "2–3 year vocational entry" },
  { id: "degree", title: "Degree", zh: "本科", count: "320 programmes", glyph: "g2", body: "Bachelor, 4 years" },
  { id: "master", title: "Master", zh: "硕士", count: "240 programmes", glyph: "g3", body: "Master's, 2–3 years" },
  { id: "phd", title: "PhD", zh: "博士", count: "120 programmes", glyph: "g4", body: "Doctorate, 3–4 years" },
  { id: "mandarin", title: "Mandarin", zh: "汉语", count: "Online + 6 cities", glyph: "g5", body: "HSK 1 to 6, immersion" },
  { id: "exchange", title: "Exchange", zh: "交流", count: "1 sem · 1 yr", glyph: "g6", body: "Student exchange · visiting" },
];

const WHYS = [
  { num: "01", t: "World-class institutions", body: "11 universities in QS Top 100. Tsinghua and Peking sit at #20 and #14 globally — ahead of most US Ivies." },
  { num: "02", t: "Generous scholarships", body: "Chinese Government Scholarship (CSC) covers full tuition, hostel, monthly stipend and insurance." },
  { num: "03", t: "English-taught options", body: "Over 1,200 programmes taught entirely in English. Mandarin is optional, not required." },
  { num: "04", t: "Tier-1 city living", body: "Beijing, Shanghai, Shenzhen — global cities at a fraction of London or Sydney prices." },
];

const PARTNERS = [
  {
    abbr: "ZUST",
    uni: "Zhejiang University of Science and Technology",
    zh: "浙江科技大学",
    crest: "浙",
    type: "Public",
    location: "Hangzhou · Zhejiang",
    founded: "1980",
    students: "22k",
    intl: "1,600",
    popular: "Computer Science · Robotics · Artificial Intelligence · Civil Engineering",
    tuition: "CNY 18 – 25k",
    tag: "Sino-German",
    website: "https://www.zust.edu.cn/",
    domain: "zust.edu.cn",
    logo: "assets/uni-zust.png",
    phA: "#1c3d5a", phB: "#0a1f3a",
  },
  {
    abbr: "SDUT",
    uni: "Shandong University of Technology",
    zh: "山东理工大学",
    crest: "山理",
    type: "Public",
    location: "Zibo · Shandong",
    founded: "1956",
    students: "34k",
    intl: "1,000",
    popular: "Mechanical Engineering · Electrical · Computer Science · Chemical Engineering",
    tuition: "USD 2.5 – 4.5k",
    tag: "Engineering",
    website: "https://www.sdut.edu.cn/",
    domain: "sdut.edu.cn",
    logo: null,
    phA: "#34526e", phB: "#1a2a3e",
  },
  {
    abbr: "JUFE",
    uni: "Jiangxi University of Finance and Economics",
    zh: "江西财经大学",
    crest: "江财",
    type: "Public",
    location: "Nanchang · Jiangxi",
    founded: "1923",
    students: "40k",
    intl: "1,500",
    popular: "Finance · Accounting · International Business · Economics",
    tuition: "USD 3 – 6k",
    tag: "Finance · Business",
    website: "https://www.jxufe.edu.cn/",
    domain: "jxufe.edu.cn",
    logo: null,
    phA: "#a51717", phB: "#3d0808",
  },
  {
    abbr: "HMU",
    uni: "Hainan Medical University",
    zh: "海南医科大学",
    crest: "海医",
    type: "Public",
    location: "Haikou · Hainan",
    founded: "1947",
    students: "15k",
    intl: "1,200",
    popular: "MBBS (English) · Clinical Medicine · Nursing · Pharmacy",
    tuition: "USD 3 – 6k",
    tag: "Medical · MBBS",
    website: "https://www.hainmc.edu.cn/",
    domain: "hainmc.edu.cn",
    logo: null,
    phA: "#2a8a6a", phB: "#0e3527",
  },
];

const REQS = [
  { lvl: "Diploma", age: "16+", edu: "Senior High School · SPM / O-Level / equivalent", lang: "HSK 3 or IELTS 5.0", docs: "Transcript · Passport · Health" },
  { lvl: "Degree", age: "18+", edu: "Senior High School · STPM / A-Level / UEC", lang: "HSK 4 or IELTS 5.5–6.0", docs: "Transcript · Passport · Health · 2 photos" },
  { lvl: "Master", age: "Under 40", edu: "Recognised Bachelor's degree (CGPA 2.75+)", lang: "HSK 5 or IELTS 6.5", docs: "Degree · Transcript · 2 references · SOP" },
  { lvl: "PhD", age: "Under 45", edu: "Recognised Master's degree", lang: "HSK 6 or IELTS 7.0", docs: "Research proposal · 2 academic refs · Publications" },
  { lvl: "Mandarin", age: "16+", edu: "Senior High School", lang: "None required", docs: "Passport · Health · Photos" },
];

const TIMELINE = [
  { mo: "OCT – DEC", t: "Shortlist", body: "Consultation, programme matching and pre-application advice." },
  { mo: "JAN – FEB", t: "Apply", body: "Submit applications via ITEA. Most universities accept rolling applications." },
  { mo: "MAR – APR", t: "Offers", body: "Conditional and unconditional offer letters released by host universities." },
  { mo: "MAY – JUN", t: "Visa", body: "JW-202 form issued. Apply for X1/X2 student visa at Chinese embassy." },
  { mo: "JUL – AUG", t: "Pre-Depart", body: "Pre-departure briefing, hostel booking, airport pickup arranged." },
  { mo: "SEPTEMBER", t: "Arrival", body: "On-campus registration, orientation and the start of the academic year." },
];

const DOCS = [
  { name: "Passport (valid 18+ months)", req: "Required" },
  { name: "High school transcripts & certificate", req: "Required" },
  { name: "Bachelor's certificate & transcripts", req: "For Master/PhD" },
  { name: "Master's certificate & transcripts", req: "For PhD only" },
  { name: "Recommendation letters (2)", req: "For Master/PhD" },
  { name: "Personal statement / Study plan", req: "Required" },
  { name: "Research proposal (1,500+ words)", req: "For PhD only" },
  { name: "HSK / IELTS / TOEFL certificate", req: "If applicable" },
  { name: "Physical examination form (JW202)", req: "Required" },
  { name: "Bank statement (USD 5,000+)", req: "For visa" },
];

const EVENTS = [
  { d: "22", m: "May", title: "Tsinghua University · Online Open Day", meta: "Live · 8 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "05", m: "Jun", title: "Study in China · KL Roadshow", meta: "In-person · ITEA HQ, KL", type: "roadshow", label: "Roadshow" },
  { d: "12", m: "Jun", title: "CSC Scholarship · Application Workshop", meta: "Live · 7:30 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
  { d: "28", m: "Jun", title: "Peking University · Alumni Q&A", meta: "Live · 8 PM (MYT) · Zoom", type: "webinar", label: "Webinar" },
];

const FAQS = [
  { q: "Do I need to speak Mandarin to study in China?", a: "No. Over 1,200 programmes across all levels are taught entirely in English — from undergraduate engineering to PhD in AI. Many students arrive with zero Mandarin and pick it up casually over their degree. If you want, ITEA Learning gives you 12 free HSK-aligned online levels before you fly." },
  { q: "How much does it cost to study in China?", a: "Tuition ranges from RMB 18,000–45,000 per year (roughly RM 11,000–28,000), depending on the programme and university. On-campus accommodation is RMB 800–2,500/month. Living costs in Tier-1 cities like Beijing or Shanghai average RMB 2,500/month. Scholarships can bring this to zero." },
  { q: "What is the Chinese Government Scholarship (CSC)?", a: "CSC is a full-ride scholarship from the Ministry of Education: tuition + on-campus accommodation + monthly stipend (RMB 2,500–3,500) + comprehensive medical insurance. It is open to undergraduate, Master and PhD students. ITEA helps prepare and submit your CSC application." },
  { q: "When should I start my application?", a: "Aim to start 9–12 months before your intended intake. For the September intake, ideal start is October–December of the previous year. Many universities accept applications until March–April but scholarships have earlier deadlines (typically February)." },
  { q: "Can I work part-time as a student in China?", a: "On-campus part-time work and approved internships are permitted with university authorisation. Off-campus paid work is restricted under student visa regulations. Many students take research-assistant or teaching-assistant roles within their faculty." },
  { q: "Will my degree be recognised back home?", a: "Yes. Most Chinese 'Double First-Class' universities are recognised by the Malaysian Qualifications Agency (MQA), Indonesian DIKTI and most ASEAN regulators. ITEA confirms recognition for your specific programme before you apply." },
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
    <section className="cn-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <a href="#">Destinations</a>
          <span className="sep">/</span>
          <span className="here">Study in China</span>
        </div>
        <div className="cn-hero-grid">
          <div>
            <div className="label"><span className="bar"></span> Destination · 01 of 03</div>
            <h1>Study in <em>China.</em><span className="zh">中国留学</span></h1>
            <p>The largest higher-education system in the world. World-class research, the most generous scholarships in Asia, and a graduate-employment network spanning 280+ partner universities.</p>
            <div className="h-actions">
              <button className="btn">Match me to a programme <span className="arr"></span></button>
              <a href="#" className="link">Download China guide (PDF) ↓</a>
            </div>
          </div>
          <div className="cn-fact">
            <h4>China at a glance</h4>
            <div className="stat"><span className="k">Partner universities</span><span className="v">280<small>+</small></span></div>
            <div className="stat"><span className="k">Programmes available</span><span className="v">1,200<small>+</small></span></div>
            <div className="stat"><span className="k">QS Top 100 institutions</span><span className="v">11</span></div>
            <div className="stat"><span className="k">English-taught programmes</span><span className="v">1,200<small>+</small></span></div>
            <div className="stat"><span className="k">Average tuition (Master)</span><span className="v">¥32<small>k / yr</small></span></div>
            <div className="stat"><span className="k">Scholarship match rate</span><span className="v">94<small>%</small></span></div>
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
          <p>Six routes into the Chinese higher-education system. Click any to jump into the matching programmes.</p>
        </div>
        <div className="types-grid">
          {TYPES.map((t, i) => (
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

function WhyChina() {
  return (
    <section className="why-cn">
      <div className="wrap why-grid">
        <div className="lhs">
          <div className="mono" style={{color:'var(--muted)'}}>Why China</div>
          <h2>The most ambitious place <em>to study</em> in Asia.</h2>
          <p>Forty years ago, China had three globally-ranked universities. Today it has eleven in the QS Top 100 and a research output that surpasses the United States. For a Malaysian or Indonesian student, no other destination combines this scale of opportunity with this level of scholarship support.</p>
          <div className="seal">
            <div className="zh">学</div>
            <div className="en">
              <b>Xué — to study, to learn</b>
              The seal of the scholar; the first character every student of China learns.
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

function Partners() {
  return (
    <section className="trend-section">
      <div className="wrap">
        <div className="trend-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>Our China partner universities</div>
            <h2>Four universities <em>placing our students.</em></h2>
          </div>
          <a href="Programmes.html" className="btn ghost">See all China programmes <span className="arr"></span></a>
        </div>
        <div className="unis-grid">
          {PARTNERS.map((u) => (
            <a key={u.abbr} href={u.website} target="_blank" rel="noopener" className="uni-card" style={{ "--ph-a": u.phA, "--ph-b": u.phB }}>
              <div className={"uni-logo" + (u.logo ? " has-logo" : "")}>
                <span className="badge">{u.tag}</span>
                <div className="crest">
                  {u.logo ? (
                    <img className="logo-img" src={u.logo} alt={u.uni + ' campus'} />
                  ) : (
                    <span className="zh-big">{u.crest}</span>
                  )}
                </div>
                <span className="abbr-pill">{u.abbr} · 中国</span>
              </div>
              <div className="uni-body">
                <div className="top">
                  <span className="abbr">{u.abbr}</span>
                  <span className="type">{u.type}</span>
                </div>
                <h4>{u.uni}</h4>
                <div className="zh-name">{u.zh}</div>
                <div className="loc">{u.location} · Founded {u.founded}</div>
                <div className="stats">
                  <div className="stat-cell"><div className="k">Students</div><div className="v">{u.students}</div></div>
                  <div className="stat-cell"><div className="k">International</div><div className="v">{u.intl}</div></div>
                  <div className="stat-cell"><div className="k">Founded</div><div className="v">{u.founded}</div></div>
                </div>
                <div className="popular">
                  <b>Popular majors</b>
                  {u.popular}
                </div>
                <div className="cta">
                  <div className="tuition">{u.tuition}<small>/ year</small></div>
                  <span className="view">View university →</span>
                </div>
              </div>
            </a>
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
          <p>Indicative baseline. Top universities (Tsinghua, Peking, Fudan, Zhejiang) often require above-baseline scores. Your counsellor will confirm exact thresholds for the programmes you shortlist.</p>
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
              <div className="v">{r.lang}<small>HSK or English alternative</small></div>
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
          <h2>A typical timeline <em>for the September intake.</em></h2>
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
            <p>Six of the most-asked. If yours isn't here, our China desk responds on WhatsApp within an hour.</p>
            <button className="btn">Chat with China desk <span className="arr"></span></button>
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
          <h2>Your future,<br/><em>studied in China.</em></h2>
        </div>
        <div>
          <p>One form gets you matched to up to five programmes and screened against six scholarships. A China desk counsellor calls you within 48 hours.</p>
          <div className="acts" style={{marginTop:24}}>
            <button className="btn">Start China application <span className="arr"></span></button>
            <a href="#" className="link">Or download the China guide ↓</a>
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
              <li><a href="Programmes.html">Diploma</a></li>
              <li><a href="Programmes.html">Undergraduate</a></li>
              <li><a href="Programmes.html">Postgraduate</a></li>
              <li><a href="Programmes.html">Mandarin Learning</a></li>
              <li><a href="Programmes.html">Short-term & Camps</a></li>
            </ul>
          </div>
          <div>
            <h6>Destinations</h6>
            <ul>
              <li><a href="Study-in-China.html">Study in China</a></li>
              <li><a href="#">Study in Malaysia</a></li>
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
      <WhyChina />
      <Partners />
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
