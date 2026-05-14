const { useState, useEffect, useRef } = React;

// ---------- Data ----------
const SLIDES = [
  {
    kicker: "01 · Destinations",
    title: "Study in China —\nfrom Beijing to Hangzhou",
    body: "280+ partner universities. Diploma, degree, master, PhD and Mandarin programmes — fully supported from application to arrival.",
    cta: "Explore Chinese universities",
    image: "assets/uni-zust.png",
    phA: "#0a1f5e", phB: "#061240", label: "ZUST · HANGZHOU"
  },
  {
    kicker: "02 · Short-term",
    title: "Summer camps,\nstudy tours & sit-ins",
    body: "Two to eight week immersions across China and Malaysia. Customised cohorts for schools, universities and corporate groups.",
    cta: "Browse short programmes",
    image: "assets/slide-klcc.jpg",
    phA: "#c98a1d", phB: "#5e3f10", label: "KLCC · KUALA LUMPUR"
  },
  {
    kicker: "03 · Funding",
    title: "Scholarships covering\nup to 100% of tuition",
    body: "Chinese Government, Confucius Institute, Belt & Road and ITEA Merit Awards — matched to your profile within 48 hours.",
    cta: "Match me to a scholarship",
    phA: "#a51717", phB: "#4a0808", label: "SCHOLARSHIP · INTAKE 2026"
  },
];

const COUNTRIES = [
  {
    id: "china", name: "China", zh: "中国",
    blurb: "The largest higher-education system in the world. World-class research, generous scholarships and the fastest-growing alumni network in Asia.",
    stats: [["280+", "Partner universities"], ["1,200+", "Programmes"], ["¥0 – ¥0", "Tuition (full-ride)"], ["48 hrs", "Avg. response"]],
    phA: "#a51717", phB: "#3d0808", label: "BEIJING · 北京",
    cities: [
      { name: "Tsinghua University", city: "Beijing · QS #20" },
      { name: "Peking University", city: "Beijing · QS #14" },
      { name: "Fudan University", city: "Shanghai · QS #39" },
      { name: "Zhejiang University", city: "Hangzhou · QS #47" },
      { name: "Shanghai Jiao Tong", city: "Shanghai · QS #45" },
    ]
  },
  {
    id: "malaysia", name: "Malaysia", zh: "马来西亚",
    blurb: "English-medium instruction, multicultural campuses and tuition at a fraction of UK/AU costs. A natural bridge for ASEAN and South Asian students.",
    stats: [["45+", "Partner universities"], ["380+", "Programmes"], ["RM 18k", "From / year"], ["72 hrs", "Avg. response"]],
    phA: "#0a1f5e", phB: "#061240", label: "KUALA LUMPUR · KL",
    cities: [
      { name: "Universiti Malaya", city: "Kuala Lumpur · QS #60" },
      { name: "Universiti Putra Malaysia", city: "Selangor · QS #148" },
      { name: "Taylor's University", city: "Subang · QS #251" },
      { name: "Sunway University", city: "Bandar Sunway · QS #586" },
      { name: "Monash University Malaysia", city: "Bandar Sunway · QS Asia #44" },
    ]
  },
  {
    id: "indonesia", name: "Indonesia", zh: "印度尼西亚",
    blurb: "Newly opened destination with strong programmes in business, hospitality and Southeast Asian studies. Direct cohorts launching from 2026.",
    stats: [["32+", "Partner universities"], ["220+", "Programmes"], ["IDR 60M", "From / year"], ["96 hrs", "Avg. response"]],
    phA: "#c98a1d", phB: "#5e3f10", label: "JAKARTA · ID",
    cities: [
      { name: "Universitas Indonesia", city: "Depok · QS #237" },
      { name: "Institut Teknologi Bandung", city: "Bandung · QS #281" },
      { name: "Universitas Gadjah Mada", city: "Yogyakarta · QS #239" },
      { name: "Universitas Airlangga", city: "Surabaya · QS #345" },
      { name: "Bina Nusantara University", city: "Jakarta · QS #701" },
    ]
  },
  {
    id: "future", name: "Future Destinations", zh: "未来",
    blurb: "Coming soon — Singapore, Hong Kong, Thailand and Vietnam. Join the waitlist and be first to access pilot cohorts in 2027.",
    stats: [["4", "New destinations"], ["2027", "Pilot launch"], ["Free", "Waitlist"], ["—", "Coming soon"]],
    phA: "#3a3f56", phB: "#15182a", label: "EXPANDING · ASIA",
    cities: [
      { name: "Singapore", city: "Pilot · 2027" },
      { name: "Hong Kong SAR", city: "Pilot · 2027" },
      { name: "Thailand", city: "Pilot · 2027" },
      { name: "Vietnam", city: "Pilot · 2028" },
      { name: "Korea (under review)", city: "Pilot · 2028" },
    ]
  },
];

const UNIS = [
  { country: "CHINA", name: "Tsinghua University", city: "Beijing", rank: "QS #20", progs: 48, intake: "Sep / Mar", phA: "#a51717", phB: "#3d0808" },
  { country: "CHINA", name: "Peking University", city: "Beijing", rank: "QS #14", progs: 52, intake: "Sep / Mar", phA: "#891414", phB: "#330606" },
  { country: "CHINA", name: "Fudan University", city: "Shanghai", rank: "QS #39", progs: 36, intake: "Sep / Feb", phA: "#bb2424", phB: "#420c0c" },
  { country: "CHINA", name: "Zhejiang University", city: "Hangzhou", rank: "QS #47", progs: 42, intake: "Sep / Mar", phA: "#a01a1a", phB: "#3c0a0a" },
  { country: "MALAYSIA", name: "Universiti Malaya", city: "Kuala Lumpur", rank: "QS #60", progs: 31, intake: "Sep / Feb", phA: "#0a1f5e", phB: "#061240" },
  { country: "MALAYSIA", name: "Taylor's University", city: "Subang Jaya", rank: "QS #251", progs: 27, intake: "Aug / Jan / May", phA: "#142a6e", phB: "#08164a" },
  { country: "MALAYSIA", name: "Monash University", city: "Bandar Sunway", rank: "QS #44 Asia", progs: 22, intake: "Feb / Jul", phA: "#0c2670", phB: "#061240" },
  { country: "INDONESIA", name: "Universitas Indonesia", city: "Depok", rank: "QS #237", progs: 18, intake: "Sep / Feb", phA: "#c98a1d", phB: "#5e3f10" },
];

const SCHOLARSHIPS = [
  { tag: "GOVERNMENT · CHINA", name: "Chinese Government Scholarship (CSC)", body: "Full tuition, accommodation, monthly stipend and medical insurance — for undergraduate through PhD students.", amt: "Up to 100%", note: "Tuition + Stipend", deadline: "Apr 15" },
  { tag: "LANGUAGE · CHINA", name: "Confucius Institute Scholarship", body: "Mandarin learning scholarship covering language training, accommodation and a monthly living allowance.", amt: "RMB 2,500", note: "Per month", deadline: "May 30" },
  { tag: "MERIT · ITEA", name: "ITEA Merit Award 2026", body: "Awarded to top 5% of ITEA applicants by academic and leadership merit. Stackable with country scholarships.", amt: "USD 4,000", note: "One-time", deadline: "Rolling" },
];

const REASONS = [
  { num: "01", title: "End-to-end support", body: "From shortlist to airport pickup — a single counsellor across 7 stages of your journey." },
  { num: "02", title: "300+ partner institutions", body: "Direct MOUs with universities across China, Malaysia and Indonesia. No middlemen, no surprise fees." },
  { num: "03", title: "Scholarship matching", body: "Profile-matched to government, university and ITEA scholarships within 48 hours of enquiry." },
  { num: "04", title: "Mandarin from day one", body: "Free access to ITEA Learning — 12 weeks of online Mandarin before you fly. HSK-aligned." },
  { num: "05", title: "Career pathway", body: "ITEAJOBS connects you to internships and graduate placements across the ASEAN-China corridor." },
  { num: "06", title: "Alumni & community", body: "12,000+ students placed since 2009. Local WhatsApp groups in every city we serve." },
];

const STEPS = [
  { lbl: "Step 01", t: "Consultation", body: "Free 30-min counselling — online or at our KL office." },
  { lbl: "Step 02", t: "Shortlist", body: "We match you with 3-5 programmes that fit your profile and budget." },
  { lbl: "Step 03", t: "Application", body: "Submit one ITEA form — we forward to all your chosen universities." },
  { lbl: "Step 04", t: "Offer & Visa", body: "Receive offer letters and JW-202 / Visa Approval Letter through us." },
  { lbl: "Step 05", t: "Departure", body: "Pre-departure briefing, airport pickup, hostel setup — all handled." },
];

// ---------- Tweakable defaults ----------
const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
  "palette": "red",
  "heroVariant": "split",
  "showSchol": true,
  "showWhy": true,
  "showProc": true
}/*EDITMODE-END*/;

// ---------- Components ----------
function Placeholder({ phA, phB, label, style }) {
  return (
    <div className="img-ph" style={{ "--ph-a": phA, "--ph-b": phB, ...style }}>
      <div className="ph-lbl">{label}</div>
    </div>
  );
}

function HeroSlider() {
  const [i, setI] = useState(0);
  useEffect(() => {
    const t = setInterval(() => setI((v) => (v + 1) % SLIDES.length), 6500);
    return () => clearInterval(t);
  }, []);
  const prev = () => setI((v) => (v - 1 + SLIDES.length) % SLIDES.length);
  const next = () => setI((v) => (v + 1) % SLIDES.length);
  return (
    <div className="slider">
      {SLIDES.map((s, idx) => (
        <div key={idx} className={"slide " + (idx === i ? "on" : "")}>
          {s.image ? (
            <img src={s.image} alt={s.label} className="slide-img" />
          ) : (
            <Placeholder phA={s.phA} phB={s.phB} label={s.label} />
          )}
          <div className="scrim" />
          <div className="content">
            <div className="kicker">{s.kicker}</div>
            <h2>{s.title.split("\n").map((l, k) => <span key={k}>{l}<br/></span>)}</h2>
            <p>{s.body}</p>
            <a className="pill" href="#">{s.cta} <span style={{display:'inline-block', transform:'translateY(-1px)'}}>→</span></a>
          </div>
        </div>
      ))}
      <div className="slide-counter">{String(i + 1).padStart(2, "0")} / {String(SLIDES.length).padStart(2, "0")}</div>
      <div className="slider-controls">
        <button onClick={prev} aria-label="Previous">‹</button>
        <button onClick={next} aria-label="Next">›</button>
      </div>
      <div className="slider-dots">
        {SLIDES.map((_, idx) => (
          <button key={idx} className={idx === i ? "on" : ""} onClick={() => setI(idx)} />
        ))}
      </div>
    </div>
  );
}

function Hero() {
  return (
    <section className="hero">
      <div className="wrap hero-grid">
        <div>
          <div className="hero-label">
            <span className="bar"></span>
            <span className="mono">EST. 2009 · Kuala Lumpur</span>
          </div>
          <h1 className="serif hero-h">
            Your future,<br />
            <em>studied abroad</em><br />
            <span className="alt">in Asia.</span>
          </h1>
          <p className="hero-sub">
            ITEA EDU ABROAD places students from across Southeast Asia into top universities in China, Malaysia and Indonesia — with scholarship matching, visa support and a counsellor at every step.
          </p>
          <div className="hero-actions">
            <button className="btn">Start your application <span className="arr"></span></button>
            <a href="#" style={{textDecoration:'underline', textUnderlineOffset:'4px', fontSize:14}}>Or book a 30-min consultation</a>
          </div>
          <div className="stat-row">
            <div className="stat"><div className="num serif">12,400+</div><div className="lbl">Students placed since 2009</div></div>
            <div className="stat"><div className="num serif">300+</div><div className="lbl">Partner universities</div></div>
            <div className="stat"><div className="num serif">94%</div><div className="lbl">Scholarship match rate</div></div>
          </div>
        </div>
        <HeroSlider />
      </div>
    </section>
  );
}

function Countries() {
  const [tab, setTab] = useState(0);
  const c = COUNTRIES[tab];
  return (
    <section className="section">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>02 · Destinations</div>
            <h3>Featured <em>countries</em></h3>
          </div>
          <div className="right">
            <p>Three live destinations and a pipeline of four more launching from 2027. Each desk staffed by counsellors who studied or worked there.</p>
            <a href="#" style={{color:'var(--accent)', fontSize:14, display:'inline-flex', alignItems:'center', gap:8}}>See all destinations →</a>
          </div>
        </div>

        <div className="country-tabs">
          {COUNTRIES.map((co, i) => (
            <button key={co.id} className={"country-tab " + (i === tab ? "on" : "")} onClick={() => setTab(i)}>
              <span className="num">0{i+1}</span> {co.name} <span style={{opacity:0.5, marginLeft:6, fontFamily:"'Instrument Serif',serif", fontStyle:'italic'}}>{co.zh}</span>
            </button>
          ))}
        </div>

        <div className="country-panel">
          <div>
            <div className="mono" style={{color:'var(--accent)', marginBottom:14}}>{c.label}</div>
            <h4 className="country-headline">Why <em style={{fontStyle:'italic'}}>{c.name}</em>?</h4>
            <p className="country-blurb">{c.blurb}</p>
            <button className="btn ghost">Explore {c.name} <span className="arr"></span></button>
            <div className="country-stats">
              {c.stats.map(([n,l], i) => (
                <div key={i}>
                  <div className="num">{n}</div>
                  <div className="lbl">{l}</div>
                </div>
              ))}
            </div>
          </div>

          <div className="country-image">
            <Placeholder phA={c.phA} phB={c.phB} label={c.label} />
            <div className="tag" style={{position:'absolute', zIndex:2}}>
              <span>{c.label}</span>
              <span>{c.zh}</span>
            </div>
          </div>

          <div className="country-list">
            <div className="mono" style={{color:'var(--muted)', marginBottom:8}}>Top institutions</div>
            {c.cities.map((x, i) => (
              <div key={i} className="item">
                <span className="idx">{String(i+1).padStart(2,'0')}</span>
                <div>
                  <div className="name serif" style={{fontSize:18}}>{x.name}</div>
                  <div className="meta">{x.city}</div>
                </div>
                <span className="arrow">→</span>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

function Universities() {
  const [filter, setFilter] = useState("ALL");
  const list = filter === "ALL" ? UNIS : UNIS.filter(u => u.country === filter);
  return (
    <section className="section" style={{paddingTop: 32, background:'var(--paper)'}}>
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>03 · Featured</div>
            <h3>Hand-picked <em>universities</em></h3>
          </div>
          <div className="right" style={{alignItems:'flex-end'}}>
            <div style={{display:'flex', gap:6}}>
              {["ALL","CHINA","MALAYSIA","INDONESIA"].map(f => (
                <button key={f} onClick={() => setFilter(f)}
                  className="mono"
                  style={{padding:'8px 14px', borderRadius:999, border:'1px solid var(--rule-soft)',
                          background: filter===f ? 'var(--ink)' : 'transparent',
                          color: filter===f ? 'var(--paper)' : 'var(--ink-2)', cursor:'pointer'}}>
                  {f}
                </button>
              ))}
            </div>
          </div>
        </div>

        <div className="uni-grid">
          {list.map((u, i) => (
            <div key={i} className="uni-card">
              <div className="uni-img">
                <Placeholder phA={u.phA} phB={u.phB} label={u.city.toUpperCase()} />
                <span className="uni-rank">{u.rank}</span>
                <span className="uni-fav">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M19 14c1.5-1.5 3-3.4 3-5.5C22 5.4 19.6 3 16.5 3 14.7 3 13 4 12 5.5 11 4 9.3 3 7.5 3 4.4 3 2 5.4 2 8.5c0 2.1 1.5 4 3 5.5l7 7 7-7Z"/></svg>
                </span>
              </div>
              <div className="uni-body">
                <div className="country">{u.country}</div>
                <h4>{u.name}</h4>
                <div className="city">{u.city}</div>
                <div className="uni-meta">
                  <span><b>{u.progs}</b> programmes</span>
                  <span>Intake {u.intake}</span>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="uni-more">
          <button className="btn ghost">Browse all 300+ universities <span className="arr"></span></button>
        </div>
      </div>
    </section>
  );
}

function Scholarships() {
  return (
    <section className="schol section">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="mono">04 · Funding</div>
            <h3>Scholarship <em>opportunities</em></h3>
          </div>
          <div className="right">
            <p>Live, profile-matched scholarships from governments, universities and ITEA. Match runs nightly — your shortlist arrives within 48 hours.</p>
          </div>
        </div>

        <div className="schol-grid">
          {SCHOLARSHIPS.map((s, i) => (
            <div key={i} className="schol-card">
              <div className="tag">{s.tag}</div>
              <h4>{s.name}</h4>
              <p>{s.body}</p>
              <div className="meta">
                <div>
                  <div className="amt">{s.amt}<small>{s.note}</small></div>
                </div>
                <div style={{textAlign:'right'}}>
                  <div className="mono" style={{color:'rgba(236,231,216,0.5)', marginBottom:6}}>Deadline</div>
                  <div style={{fontFamily:"'Instrument Serif', serif", fontSize:22}}>{s.deadline}</div>
                </div>
              </div>
              <a href="#" className="apply" style={{marginTop:18}}>Check eligibility →</a>
            </div>
          ))}
        </div>

        <div className="schol-strip">
          <span>15 additional scholarships available across our network.</span>
          <a href="#" style={{color:'#e8b15a'}}>See all scholarships →</a>
        </div>
      </div>
    </section>
  );
}

function Why() {
  return (
    <section className="why section">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>05 · Why ITEA</div>
            <h3>Why <em>ITEA</em>?</h3>
          </div>
          <div className="right">
            <p>Sixteen years placing students from Malaysia, Indonesia and the Philippines into Asia's best universities. Here's what changes when you go through us.</p>
          </div>
        </div>
        <div className="why-grid">
          {REASONS.map((r, i) => (
            <div key={i} className="why-cell">
              <div className="num">{r.num}</div>
              <h4>{r.title}</h4>
              <p>{r.body}</p>
              <div className="glyph">
                <div className={"glyph g" + ((i % 6) + 1)}></div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Procedure() {
  return (
    <section className="section">
      <div className="wrap">
        <div className="section-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>06 · How it works</div>
            <h3>Application <em>procedure</em></h3>
          </div>
          <div className="right">
            <p>From first call to first day of class — most students complete the five-step journey in 8 to 14 weeks.</p>
          </div>
        </div>

        <div className="proc-grid">
          {STEPS.map((s, i) => (
            <div key={i} className={"proc-step " + (i === 0 ? "on" : "")}>
              <div className="proc-dot">{i+1}</div>
              <div className="lbl mono">{s.lbl}</div>
              <h5>{s.t}</h5>
              <p>{s.body}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function ApplyCTA() {
  return (
    <section className="apply-cta">
      <div className="wrap apply-grid">
        <div>
          <div className="mono">07 · Apply now</div>
          <h3>Begin your<br/><em>journey east.</em></h3>
          <p style={{maxWidth:480, marginTop:24, color:'rgba(251,248,241,0.85)', fontSize:16}}>
            One form. We take it from here — programme matching, scholarship shortlist and a counsellor's call within 48 hours.
          </p>
        </div>
        <div className="apply-form">
          <div className="row">
            <div>
              <label>Full name</label>
              <input placeholder="e.g. Aishah Rahman" />
            </div>
            <div>
              <label>Email</label>
              <input placeholder="you@example.com" />
            </div>
          </div>
          <div className="row">
            <div>
              <label>Destination</label>
              <select>
                <option>China</option><option>Malaysia</option><option>Indonesia</option><option>Undecided</option>
              </select>
            </div>
            <div>
              <label>Level</label>
              <select>
                <option>Diploma</option><option>Undergraduate</option><option>Postgraduate</option><option>Mandarin</option><option>Short-term</option>
              </select>
            </div>
          </div>
          <button className="submit">Send enquiry <span style={{fontSize:16}}>→</span></button>
          <p style={{margin:'14px 0 0', fontSize:12, opacity:0.75, textAlign:'center'}}>Or chat on WhatsApp · +60 12 345 6789</p>
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
          <div className="foot-brand">
            <div className="foot-logo-tile">
              <img src={(typeof window !== 'undefined' && window.__resources && window.__resources.footerLogo) || "assets/logo.jpeg"} alt="ITEA EduAbroad" />
            </div>
            <p className="foot-blurb">
              An education abroad consultancy placing Southeast Asian students into top universities across China, Malaysia and Indonesia since 2009.
            </p>
          </div>
          <div>
            <h6>Programmes</h6>
            <ul>
              <li><a href="#">Diploma</a></li>
              <li><a href="#">Undergraduate</a></li>
              <li><a href="#">Postgraduate</a></li>
              <li><a href="#">Mandarin Learning</a></li>
              <li><a href="#">Short-term & Camps</a></li>
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

// ---------- Tweaks ----------
function Tweaks() {
  const [t, setTweak] = useTweaks(TWEAK_DEFAULTS);
  useEffect(() => {
    document.body.setAttribute("data-palette", t.palette);
  }, [t.palette]);
  return (
    <TweaksPanel title="Tweaks">
      <TweakSection title="Brand palette">
        <TweakColor
          label="Accent theme"
          value={t.palette}
          options={[
            ['#d81f1f', '#0a1f5e', '#e8a93b'],
            ['#e8a93b', '#0a1f5e', '#d81f1f'],
            ['#0a1f5e', '#d81f1f', '#e8a93b'],
          ]}
          onChange={(v) => {
            const map = { '#d81f1f': 'red', '#e8a93b': 'gold', '#0a1f5e': 'navy' };
            setTweak('palette', map[v[0]] || 'red');
          }}
        />
        <div style={{display:'flex', gap:8, marginTop:8, fontSize:11, opacity:0.7}}>
          Red · Gold · Navy (all from logo)
        </div>
      </TweakSection>
    </TweaksPanel>
  );
}

// ---------- App ----------
function App() {
  return (
    <>
      <Hero />
      <Countries />
      <Universities />
      <Scholarships />
      <Why />
      <Procedure />
      <ApplyCTA />
      <Foot />
      <Tweaks />
    </>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
