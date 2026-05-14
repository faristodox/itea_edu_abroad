const { useState, useMemo } = React;

const LEVELS = [
  { id: "DIPLOMA", short: "Diploma", title: "Diploma", count: "220+ programmes", body: "1–3 year vocational and pre-university qualifications. A practical entry point — especially strong in Malaysia.", glyph: "g2" },
  { id: "UG", short: "Undergraduate", title: "Undergraduate", count: "480+ programmes", body: "Bachelor's degrees, 3–4 years. The largest catalogue across our network — engineering to liberal arts.", glyph: "g1" },
  { id: "PG", short: "Postgraduate", title: "Postgraduate", count: "380+ programmes", body: "Master's and PhD programmes, taught in English or Mandarin. Strong research scholarships available.", glyph: "g3" },
  { id: "MANDARIN", short: "Mandarin Learning", title: "Mandarin Learning", count: "Online + 6 cities", body: "Free online HSK-aligned course, or full immersion at top language universities in China.", glyph: "g4" },
  { id: "SHORT", short: "Short-term", title: "Short-term & Camps", count: "40+ cohorts / year", body: "Two to eight week summer camps, customised sit-ins and study tours across China and Malaysia.", glyph: "g5" },
];

const COUNTRIES = ["China", "Malaysia", "Indonesia"];

const PROGRAMMES = [
  { level: "UG", country: "CHINA", title: "B.Sc. in Computer Science & Technology", uni: "Tsinghua University", city: "Beijing", duration: "4 years", lang: "English / 中文", intake: "September", tuition: "RMB 30,000 / yr", video: true, phA: "#0a1f5e", phB: "#061240", phLabel: "BEIJING · 北京" },
  { level: "PG", country: "CHINA", title: "M.A. in International Relations", uni: "Peking University", city: "Beijing", duration: "2 years", lang: "English", intake: "September", tuition: "RMB 38,000 / yr", video: true, phA: "#a51717", phB: "#3d0808", phLabel: "PEKING · 北大" },
  { level: "DIPLOMA", country: "MALAYSIA", title: "Diploma in Hospitality Management", uni: "Taylor's University", city: "Subang Jaya", duration: "2.5 years", lang: "English", intake: "Jan / May / Aug", tuition: "RM 38,000 total", video: false, phA: "#142a6e", phB: "#08164a", phLabel: "TAYLOR'S · SUBANG" },
  { level: "UG", country: "MALAYSIA", title: "B.B.A. in International Business", uni: "Universiti Malaya", city: "Kuala Lumpur", duration: "4 years", lang: "English", intake: "September", tuition: "RM 21,000 / yr", video: true, phA: "#0a1f5e", phB: "#061240", phLabel: "UM · KUALA LUMPUR" },
  { level: "PG", country: "CHINA", title: "Master of Civil Engineering", uni: "Zhejiang University", city: "Hangzhou", duration: "3 years", lang: "English", intake: "September", tuition: "RMB 32,000 / yr", video: false, phA: "#a01a1a", phB: "#3c0a0a", phLabel: "ZJU · 杭州" },
  { level: "MANDARIN", country: "CHINA", title: "Chinese Language Programme — HSK 1 to 6", uni: "Beijing Language and Culture University", city: "Beijing", duration: "1 semester +", lang: "中文", intake: "Mar / Sep", tuition: "RMB 11,600 / sem", video: true, phA: "#c98a1d", phB: "#5e3f10", phLabel: "BLCU · 北京" },
  { level: "UG", country: "CHINA", title: "B.Eng. in Mechanical Engineering", uni: "Shanghai Jiao Tong University", city: "Shanghai", duration: "4 years", lang: "English", intake: "September", tuition: "RMB 28,000 / yr", video: false, phA: "#891414", phB: "#330606", phLabel: "SJTU · 上海" },
  { level: "PG", country: "CHINA", title: "Ph.D. in Artificial Intelligence", uni: "Fudan University", city: "Shanghai", duration: "4 years", lang: "English", intake: "September", tuition: "Full scholarship", video: true, phA: "#bb2424", phB: "#420c0c", phLabel: "FUDAN · 上海" },
  { level: "UG", country: "MALAYSIA", title: "Bachelor of Architecture", uni: "Universiti Putra Malaysia", city: "Selangor", duration: "4 years", lang: "English", intake: "September", tuition: "RM 18,200 / yr", video: false, phA: "#0c2670", phB: "#061240", phLabel: "UPM · SELANGOR" },
  { level: "SHORT", country: "CHINA", title: "4-week Summer Cultural Camp", uni: "Tsinghua + Beijing Tours", city: "Beijing", duration: "4 weeks", lang: "English / 中文", intake: "July / Aug", tuition: "USD 2,400", video: true, phA: "#e8a93b", phB: "#7a5a16", phLabel: "SUMMER CAMP · BEIJING" },
  { level: "MANDARIN", country: "CHINA", title: "Intensive 8-Week Mandarin Immersion", uni: "Shanghai Jiao Tong University", city: "Shanghai", duration: "8 weeks", lang: "中文", intake: "Rolling", tuition: "USD 1,800", video: false, phA: "#d18a2a", phB: "#5e3f10", phLabel: "SJTU MANDARIN" },
  { level: "SHORT", country: "MALAYSIA", title: "2-week Customised University Sit-in", uni: "Sunway / Monash / Taylor's", city: "Selangor", duration: "2 weeks", lang: "English", intake: "Custom", tuition: "On request", video: false, phA: "#1d4e3f", phB: "#0a2520", phLabel: "SIT-IN · MY" },
  { level: "DIPLOMA", country: "INDONESIA", title: "Diploma in Tourism & Hospitality", uni: "Bina Nusantara University", city: "Jakarta", duration: "3 years", lang: "English / Bahasa", intake: "Aug / Feb", tuition: "IDR 60M / yr", video: false, phA: "#c98a1d", phB: "#5e3f10", phLabel: "BINUS · JAKARTA" },
  { level: "UG", country: "INDONESIA", title: "B.Sc. in Petroleum Engineering", uni: "Institut Teknologi Bandung", city: "Bandung", duration: "4 years", lang: "English", intake: "September", tuition: "IDR 75M / yr", video: true, phA: "#b07d2a", phB: "#5e3f10", phLabel: "ITB · BANDUNG" },
  { level: "PG", country: "MALAYSIA", title: "M.B.A. — Global Asian Business", uni: "Monash University Malaysia", city: "Bandar Sunway", duration: "1.5 years", lang: "English", intake: "Feb / Jul", tuition: "RM 88,000 total", video: true, phA: "#142a6e", phB: "#06133e", phLabel: "MONASH · MY" },
];

const HSK = [
  { lvl: "HSK 1", name: "Beginner", sub: "150 words · Survival Chinese", dur: "20 hrs", fill: 16 },
  { lvl: "HSK 2", name: "Elementary", sub: "300 words · Everyday topics", dur: "30 hrs", fill: 32 },
  { lvl: "HSK 3", name: "Intermediate", sub: "600 words · Study / work", dur: "45 hrs", fill: 48 },
  { lvl: "HSK 4", name: "Upper-intermediate", sub: "1,200 words · Discussion", dur: "60 hrs", fill: 64 },
  { lvl: "HSK 5", name: "Advanced", sub: "2,500 words · Media literate", dur: "80 hrs", fill: 80 },
  { lvl: "HSK 6", name: "Fluent", sub: "5,000+ words · Native-near", dur: "100 hrs", fill: 100 },
];

// ---------- Components ----------
function Placeholder({ phA, phB, label }) {
  return (
    <div className="img-ph" style={{ "--ph-a": phA, "--ph-b": phB }}>
      <div className="ph-lbl">{label}</div>
    </div>
  );
}

const TRENDING = [
  { title: "B.Sc. Computer Science", uni: "Tsinghua University", applicants: "+312 this week", phA: "#0a1f5e", phB: "#061240" },
  { title: "MBA — Global Asian Business", uni: "Monash University Malaysia", applicants: "+248 this week", phA: "#142a6e", phB: "#06133e" },
  { title: "Summer Cultural Camp · 4-week", uni: "Tsinghua + Beijing Tours", applicants: "+186 this week", phA: "#e8a93b", phB: "#7a5a16" },
];

function Hero() {
  return (
    <section className="p-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <span style={{color:'var(--ink)'}}>Programmes</span>
        </div>
        <div className="p-hero-grid" style={{marginTop: 24}}>
          <div>
            <div className="mono">02 · Programme directory</div>
            <h1>Programmes for <em>every step</em> of your journey.</h1>
            <p>From a 4-week summer camp in Beijing to a PhD in artificial intelligence — every ITEA programme is direct-listed by the host university and supported end-to-end by your counsellor.</p>
          </div>
          <div className="p-hero-right">
            <div className="trending">
              <div className="head">
                <span className="mono">Trending now</span>
                <span className="live"><span className="dot"></span> Live · May 2026</span>
              </div>
              {TRENDING.map((t, i) => (
                <div key={i} className="trend-row">
                  <span className="rank">{String(i+1).padStart(2,'0')}</span>
                  <div className="thumb"><Placeholder phA={t.phA} phB={t.phB} label="" /></div>
                  <div className="info">
                    <div className="trend-title">{t.title}</div>
                    <div className="trend-meta">{t.uni} · {t.applicants}</div>
                  </div>
                  <span className="trend-arr">→</span>
                </div>
              ))}
              <div className="foot-link">
                <span>Updated hourly · ranked by enquiries</span>
                <a href="#">See top 25 →</a>
              </div>
            </div>
            <div className="p-hero-meta">
              <div>
                <div className="lbl">Programmes</div>
                <div className="num">1,520+</div>
                <div className="lbl2">across 5 levels</div>
              </div>
              <div>
                <div className="lbl">Universities</div>
                <div className="num">300+</div>
                <div className="lbl2">direct partners</div>
              </div>
              <div>
                <div className="lbl">Countries</div>
                <div className="num">3</div>
                <div className="lbl2">live destinations</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

function LevelOverview({ onPick }) {
  return (
    <section className="levels">
      <div className="wrap">
        <div className="mono" style={{color:'var(--muted)'}}>Browse by level</div>
        <div className="levels-grid" style={{marginTop:20}}>
          {LEVELS.map((l, i) => (
            <div key={l.id} className="level-card" onClick={() => onPick(l.id)}>
              <div className={"glyph " + l.glyph}></div>
              <div className="idx">0{i+1}</div>
              <h3>{l.title}</h3>
              <div className="cnt">{l.count}</div>
              <p>{l.body}</p>
              <span className="go">Browse {l.short} →</span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Filters({ level, setLevel, country, setCountry, count }) {
  return (
    <div className="filter-bar">
      <div className="wrap filter-row">
        <span className="lbl">Level</span>
        <button className={"chip " + (level === "ALL" ? "on" : "")} onClick={() => setLevel("ALL")}>All</button>
        {LEVELS.map(l => (
          <button key={l.id} className={"chip " + (level === l.id ? "on" : "")} onClick={() => setLevel(l.id)}>{l.short}</button>
        ))}
        <span className="chip-divider" />
        <span className="lbl">Country</span>
        <button className={"chip " + (country === "ALL" ? "on" : "")} onClick={() => setCountry("ALL")}>All</button>
        {COUNTRIES.map(c => (
          <button key={c} className={"chip " + (country === c.toUpperCase() ? "on" : "")} onClick={() => setCountry(c.toUpperCase())}>{c}</button>
        ))}
        <span className="results-meta"><b>{count}</b> programmes · sorted by relevance</span>
      </div>
    </div>
  );
}

function ProgrammeCard({ p }) {
  const levelLabel = LEVELS.find(l => l.id === p.level)?.short || p.level;
  return (
    <div className="prog-card">
      <div className="prog-img">
        <Placeholder phA={p.phA} phB={p.phB} label={p.phLabel} />
        <span className="level-badge">{levelLabel}</span>
        {p.video && (
          <span className="video-pill"><span className="play"></span> Video</span>
        )}
      </div>
      <div className="prog-body">
        <div className="country">{p.country}</div>
        <h4>{p.title}</h4>
        <div className="uni">{p.uni} · {p.city}</div>
        <div className="prog-meta">
          <div><div className="k">Duration</div><div className="v">{p.duration}</div></div>
          <div><div className="k">Language</div><div className="v">{p.lang}</div></div>
          <div><div className="k">Intake</div><div className="v">{p.intake}</div></div>
          <div><div className="k">Tuition</div><div className="v">{p.tuition}</div></div>
        </div>
        <div className="prog-actions">
          <div className="icons">
            <span className="icon" title="Video"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
            <span className="icon" title="Booklet"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M4 4h16v16H4z M9 4v16"/></svg></span>
            <span className="icon" title="Save"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M5 3v18l7-5 7 5V3z"/></svg></span>
          </div>
          <a href="#" className="view">View details →</a>
        </div>
      </div>
    </div>
  );
}

function ProgrammeList({ level, country }) {
  const filtered = useMemo(() => {
    return PROGRAMMES.filter(p => {
      if (level !== "ALL" && p.level !== level) return false;
      if (country !== "ALL" && p.country !== country) return false;
      return true;
    });
  }, [level, country]);

  return (
    <section className="prog-section">
      <div className="wrap">
        <div className="prog-grid">
          {filtered.map((p, i) => <ProgrammeCard key={i} p={p} />)}
        </div>
        {filtered.length === 0 && (
          <div style={{textAlign:'center', padding:'60px 0', color:'var(--muted)'}}>
            <div className="serif" style={{fontSize: 36}}>No matches yet.</div>
            <p style={{marginTop:12}}>Reset filters or talk to a counsellor — we may have unlisted partner programmes.</p>
          </div>
        )}
        {filtered.length > 0 && (
          <div className="prog-pager">
            <button className="pager-btn">← Prev</button>
            <button className="pager-btn on">1</button>
            <button className="pager-btn">2</button>
            <button className="pager-btn">3</button>
            <button className="pager-btn">…</button>
            <button className="pager-btn">12</button>
            <button className="pager-btn">Next →</button>
          </div>
        )}
      </div>
    </section>
  );
}

function IteaLearning() {
  return (
    <section className="itea-learning">
      <div className="wrap il-grid">
        <div>
          <div className="mono">04 · ITEA Learning</div>
          <h3>Start Mandarin <em>before you fly.</em></h3>
          <p>Twelve free, HSK-aligned online levels — built by ITEA's own instructors and the Beijing Language & Culture University. Continue in-country at any of our six partner language schools.</p>
          <div className="il-stats">
            <div><div className="num">12</div><div className="lbl">HSK-aligned levels</div></div>
            <div><div className="num">240+</div><div className="lbl">Video lessons</div></div>
            <div><div className="num">Free</div><div className="lbl">For ITEA students</div></div>
          </div>
          <div className="il-actions">
            <button className="btn" style={{background:'var(--gold)', color:'var(--ink)'}}>Start free trial <span className="arr"></span></button>
            <button className="btn ghost-d">Study Mandarin in China →</button>
          </div>
        </div>
        <div className="hsk-card">
          <div className="mono" style={{color:'rgba(230,233,242,0.6)', marginBottom:12}}>Online curriculum · Pre-departure</div>
          {HSK.map((h, i) => (
            <div key={i} className="hsk-row">
              <div className="hsk">{h.lvl}</div>
              <div className="name">{h.name}<small>{h.sub}</small></div>
              <div className="bar"><i style={{width: h.fill + '%'}} /></div>
              <div className="dur">{h.dur}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function CTA() {
  return (
    <section className="cta-band">
      <div className="wrap cta-grid">
        <div className="cta-card">
          <div className="mono">Not sure which programme?</div>
          <h3>Book a 30-minute consultation.</h3>
          <p>One free call with a counsellor — usually scheduled within 48 hours. We'll shortlist 3–5 programmes that fit your profile and budget.</p>
          <div className="row">
            <button className="btn">Book consultation <span className="arr"></span></button>
            <a href="#" style={{textDecoration:'underline', textUnderlineOffset:'4px', fontSize:14, color:'var(--ink-2)'}}>Or WhatsApp us</a>
          </div>
        </div>
        <div className="cta-card dark">
          <div className="mono">Ready to apply?</div>
          <h3>One form, every university.</h3>
          <p>Submit a single ITEA application and we forward it to all your chosen universities — diploma to PhD. Track everything from your dashboard.</p>
          <div className="row">
            <a href="#" className="btn">Start application <span className="arr"></span></a>
            <a href="#" style={{textDecoration:'underline', textUnderlineOffset:'4px', fontSize:14, color:'rgba(230,233,242,0.85)'}}>How it works →</a>
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
              <li><a href="#">Study in China</a></li>
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
  const [level, setLevel] = useState("ALL");
  const [country, setCountry] = useState("ALL");

  const filteredCount = useMemo(() => {
    return PROGRAMMES.filter(p => {
      if (level !== "ALL" && p.level !== level) return false;
      if (country !== "ALL" && p.country !== country) return false;
      return true;
    }).length;
  }, [level, country]);

  return (
    <>
      <Hero />
      <LevelOverview onPick={(id) => {
        setLevel(id);
        const fb = document.querySelector('.filter-bar');
        if (fb) {
          const y = fb.getBoundingClientRect().top + window.scrollY - 72;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      }} />
      <Filters level={level} setLevel={setLevel} country={country} setCountry={setCountry} count={filteredCount} />
      <ProgrammeList level={level} country={country} />
      <IteaLearning />
      <CTA />
      <Foot />
    </>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
