const { useState } = React;

const QUICK_NAV = [
  { id: "how", title: "How to Apply", zh: "申请流程", count: "6 steps", glyph: "g1", body: "Step-by-step process" },
  { id: "fees", title: "Fees", zh: "费用", count: "Refundable", glyph: "g2", body: "Service fees & refund policy" },
  { id: "docs", title: "Documents", zh: "文件", count: "By level", glyph: "g3", body: "Checklist for every programme" },
  { id: "visa", title: "Visa Guidance", zh: "签证", count: "3 destinations", glyph: "g4", body: "End-to-end visa support" },
  { id: "depart", title: "Pre-Departure", zh: "行前", count: "10 essentials", glyph: "g5", body: "Briefing before you travel" },
  { id: "apply", title: "Apply Now", zh: "立即申请", count: "5-min form", glyph: "g6", body: "Start your application today" },
];

const STEPS = [
  { mo: "WEEK 1", t: "Discovery", body: "Free 30-min consultation. We map your record, budget and ambition to programmes that fit." },
  { mo: "WEEK 2", t: "Shortlist", body: "Up to 5 programmes + matching scholarships shortlisted across all destinations." },
  { mo: "WEEK 3 – 4", t: "Prepare", body: "Documents, transcripts, essays, references and language tests pulled together." },
  { mo: "WEEK 5 – 6", t: "Submit", body: "Parallel submission to all shortlisted universities via ITEA's partner portal." },
  { mo: "WEEK 7 – 10", t: "Accept", body: "Offer review, deposit payment, contract signing — we negotiate scholarships where possible." },
  { mo: "WEEK 11 – 12", t: "Depart", body: "Visa filed, EMGS or X1/X2 processed, pre-departure briefing, you board the plane." },
];

const FEES = [
  { idx: "01", name: "ITEA Service Fee", desc: "End-to-end application management — counselling, document prep, submission, tracking and offer negotiation.", price: "RM 1,500 – 3,500", note: "One-time" },
  { idx: "02", name: "University Application Fees", desc: "Charged directly by each university for processing your application. Some universities waive this for ITEA partners.", price: "RM 200 – 800", note: "Per institution" },
  { idx: "03", name: "Visa & Health Check", desc: "Embassy fees, EMGS processing, medical examination, biometrics. Varies by destination and visa type.", price: "RM 600 – 1,200", note: "Destination-dependent" },
  { idx: "04", name: "Scholarship Support", desc: "Scholarship matching, essay coaching, parallel submission and interview prep across 42 active scholarships.", price: "Free", note: "Always", free: true },
  { idx: "05", name: "Pre-Departure Briefing", desc: "Two-hour group or one-on-one briefing covering arrival logistics, banking, SIM, housing and emergency contacts.", price: "Included", note: "With service", free: true },
];

const REFUND = [
  { pct: "100%", text: "Full refund of ITEA service fee if no offer is secured within 90 days of submission." },
  { pct: "50%", text: "Half refund of ITEA service fee if you voluntarily withdraw before submission to any university." },
  { pct: "0%", text: "No refund of service fee once visa application has been filed on your behalf." },
  { pct: "N/A", text: "University application fees are non-refundable per each institution's own policy and outside ITEA's control." },
];

const DOC_REQS = [
  { lvl: "Foundation", items: "Passport · SPM / O-Level / UEC transcripts · 2 passport photos · Personal statement (short)", note: "From RM 30,000/yr · Aug intake" },
  { lvl: "Diploma", items: "Passport · SPM / O-Level (3 credits min.) · 2 passport photos · Personal statement", note: "2 years · 4 intakes/yr" },
  { lvl: "Undergraduate", items: "Passport · STPM / A-Level / UEC / Foundation · IELTS 5.5+ · SOP · 2 photos · Health declaration", note: "3 yrs · Feb / Aug intake" },
  { lvl: "Master", items: "Passport · Bachelor's degree (CGPA 2.75+) · IELTS 6.0+ · 2 academic references · SOP · CV", note: "1–2 yrs · Sep intake" },
  { lvl: "PhD", items: "Passport · Master's degree · IELTS 6.5+ · Research proposal (1,500+ words) · 2 academic refs · Publications", note: "3–5 yrs · Rolling intake" },
  { lvl: "Mandarin / English", items: "Passport · Senior high-school certificate · Health declaration · 2 photos · Bank statement", note: "1 sem+ · Mar / Sep intake" },
];

const VISAS = [
  {
    code: "cn", country: "China", flag: "中", type: "X1 (Long-stay) / X2 (Short-stay) Student Visa",
    process: "2 – 3 weeks", fee: "RM 480 – 780",
    items: ["JW202 admission notice", "Foreigner Physical Examination Form", "Bank statement (USD 5,000+)", "Visa interview at Chinese embassy"],
  },
  {
    code: "my", country: "Malaysia", flag: "马", type: "Student Pass · via EMGS portal",
    process: "4 – 6 weeks", fee: "RM 1,060 – 2,500",
    items: ["EMGS application + medical screening", "eVAL approval letter", "Single-entry visa at arrival", "Renewal handled by ITEA each year"],
  },
  {
    code: "id", country: "Indonesia", flag: "印", type: "VITAS · Limited Stay Visa",
    process: "4 – 6 weeks", fee: "USD 200 – 400",
    items: ["Available 2026", "Available 2026", "Available 2026", "Available 2026"],
    soon: true,
  },
];

const PREDEP = [
  { num: "01", t: "Visa & insurance pickup", body: "Verified visa stamps, comprehensive medical insurance card, emergency repatriation cover." },
  { num: "02", t: "Flight booking advice", body: "Best routes, baggage allowances, layover guidance and group-discount options on Malaysia & China Airlines." },
  { num: "03", t: "Currency & banking", body: "How to open a local bank account, transfer caps, Alipay/WeChat (China) or Touch 'n Go (Malaysia) setup." },
  { num: "04", t: "SIM card & comms", body: "Pre-arranged eSIM activation, university wi-fi onboarding, family contact plan." },
  { num: "05", t: "Housing registration", body: "On-campus dormitory booking or off-campus rental shortlist, deposit handling and key collection." },
  { num: "06", t: "Airport pickup", body: "ITEA local team or partner-university driver meets you at arrivals — direct transfer to housing." },
  { num: "07", t: "Orientation week", body: "Programme registration, student-card collection, first-day class schedule, faculty introductions." },
  { num: "08", t: "Emergency contacts", body: "24/7 ITEA hotline card, embassy contacts, partner-uni international office, medical hotlines." },
  { num: "09", t: "Cultural briefing", body: "Social etiquette, food culture, public transport navigation, weather and packing essentials." },
  { num: "10", t: "First-month checkpoint", body: "Scheduled video call 30 days after arrival to debrief, fix issues and celebrate the start." },
];

const FAQS = [
  { q: "How long does the entire application take?", a: "From the first consultation to landing on campus, expect 10–14 weeks for most students. Foundation and Diploma intakes move fastest (8 weeks); PhD applications with research proposals can take 16+ weeks. Scholarship-funded applications follow the scholarship's own deadline calendar." },
  { q: "Do I need to be in Malaysia to apply?", a: "No. The entire ITEA process is remote-friendly — consultation by Zoom, document exchange via our secure portal, electronic signatures, and WhatsApp support throughout. Hundreds of our students apply from Indonesia, China, Vietnam and the Philippines without ever visiting our KL office." },
  { q: "Can I apply to multiple universities at the same time?", a: "Yes — and we strongly recommend it. Our standard service includes parallel submission to up to 5 universities. You compare offers when they arrive and accept the best one. No extra fees for additional applications within the same service tier." },
  { q: "What happens if I get rejected by all my universities?", a: "ITEA re-submits you to a second wave of universities at no additional service fee. If after 90 days no offer has been secured, our service fee is fully refundable. To date, that has happened to 8 out of 4,200+ students — a 99.8% placement rate." },
  { q: "Does ITEA handle the visa application itself?", a: "Yes. For China X1/X2, Malaysia EMGS Student Pass and Indonesia VITAS, we prepare and submit every form on your behalf, schedule embassy or medical appointments, and run a 99.4% visa success rate across the last three years. You only show up for biometrics." },
  { q: "What if I want to switch programmes after I've started?", a: "Within the first semester, ITEA helps re-place you free of charge to another partner university (subject to admissions seat availability). After the first semester, transfer is at the discretion of the receiving university and any partial-tuition recovery depends on the original institution's policy." },
];

function Hero() {
  return (
    <section className="cn-hero app-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <span className="here">Application</span>
        </div>
        <div className="cn-hero-grid">
          <div>
            <div className="label"><span className="bar"></span> Service desk · 6-step process</div>
            <h1>Application.<span className="zh">申请</span></h1>
            <p>From shortlist to acceptance in twelve weeks. One service, every destination. ITEA handles programme matching, document prep, submission, scholarship parallel-tracking, visa applications and pre-departure briefing — start to plane.</p>
            <div className="h-actions">
              <a href="#apply" className="btn">Start my application <span className="arr"></span></a>
              <a href="#" className="link">Download application guide (PDF) ↓</a>
            </div>
          </div>
          <div className="cn-fact">
            <h4>Application desk at a glance</h4>
            <div className="stat"><span className="k">Applications managed (lifetime)</span><span className="v">4,200<small>+</small></span></div>
            <div className="stat"><span className="k">Acceptance rate</span><span className="v">99.8<small>%</small></span></div>
            <div className="stat"><span className="k">Avg time to offer</span><span className="v">6<small> wks</small></span></div>
            <div className="stat"><span className="k">Visa success rate</span><span className="v">99.4<small>%</small></span></div>
            <div className="stat"><span className="k">Destinations supported</span><span className="v">3<small> + 2 soon</small></span></div>
            <div className="stat"><span className="k">Service fee from</span><span className="v">RM 1.5<small>k</small></span></div>
          </div>
        </div>
      </div>
    </section>
  );
}

function QuickNav() {
  return (
    <section className="prog-types">
      <div className="wrap">
        <div className="types-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>Jump to a section</div>
            <h2>Apply <em>your way.</em></h2>
          </div>
          <p>Six things you'll need to know to file a complete, scholarship-ready application. Tap any to jump there directly.</p>
        </div>
        <div className="types-grid">
          {QUICK_NAV.map((t) => (
            <a key={t.id} href={`#${t.id}`} className="type-card">
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

function HowToApply() {
  return (
    <section className="timeline-section" id="how" style={{paddingTop:80}}>
      <div className="wrap">
        <div className="timeline-card">
          <div className="mono">How ITEA runs your application</div>
          <h2>From form to flight in <em>twelve weeks.</em></h2>
          <div className="timeline-grid">
            {STEPS.map((s, i) => (
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

function Fees() {
  return (
    <section className="fees-section" id="fees">
      <div className="wrap">
        <div className="fees-head">
          <div className="lhs">
            <div className="mono" style={{color:'var(--muted)', fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.16em", textTransform:"uppercase"}}>Fees · 费用</div>
            <h2>Transparent <em>pricing.</em></h2>
            <p>One quoted service fee. No hidden add-ons. Scholarship support and pre-departure briefing always included, free of charge.</p>
          </div>
          <div className="rhs">
            <div className="total">RM 1,500</div>
            <small>STARTING SERVICE FEE · UPDATED MAY 2026</small>
          </div>
        </div>
        <div className="fees-grid">
          <div className="fees-table">
            <div className="fees-row head">
              <div></div>
              <div>Service</div>
              <div>Description</div>
              <div style={{textAlign:"right"}}>Price</div>
            </div>
            {FEES.map((f, i) => (
              <div key={i} className="fees-row">
                <div className="idx">{f.idx}</div>
                <div className="name">{f.name}<small>{f.note}</small></div>
                <div className="desc">{f.desc}</div>
                <div className={"price " + (f.free ? "free" : "")}>{f.price}</div>
              </div>
            ))}
          </div>
          <div className="refund-card">
            <div className="mono">Refund Policy</div>
            <h3>Your money <em>back, fairly.</em></h3>
            <ul>
              {REFUND.map((r, i) => (
                <li key={i}>
                  <span className="pct">{r.pct}</span>
                  <span>{r.text}</span>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>
    </section>
  );
}

function Documents() {
  return (
    <section className="req-section" id="docs">
      <div className="wrap">
        <div className="req-head">
          <div className="mono" style={{color:'var(--muted)'}}>Required documents · 所需文件</div>
          <h2>What you need <em>by programme level.</em></h2>
          <p>The base checklist. Top universities and scholarship-funded routes layer additional items (research proposals, leadership essays, certified translations). Your counsellor confirms the exact list during the profile review.</p>
        </div>
        <div className="req-table">
          <div className="req-row head" style={{gridTemplateColumns:"180px 1fr 220px"}}>
            <div>Level</div><div>Required Documents</div><div>Notes</div>
          </div>
          {DOC_REQS.map((r, i) => (
            <div key={i} className="req-row" style={{gridTemplateColumns:"180px 1fr 220px"}}>
              <div className="lvl">{r.lvl}</div>
              <div className="v">{r.items}</div>
              <div className="v" style={{fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.1em", color:"var(--muted)", textTransform:"uppercase"}}>{r.note}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function VisaGuidance() {
  return (
    <section className="visa-section" id="visa">
      <div className="wrap">
        <div className="visa-head">
          <div>
            <div className="mono" style={{color:'var(--muted)', fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.16em", textTransform:"uppercase"}}>Visa guidance · 签证</div>
            <h2>End-to-end <em>visa support.</em></h2>
          </div>
          <p>99.4% visa-success rate across China, Malaysia and Indonesia. We prepare the forms, schedule appointments, and stand with you at the embassy interview.</p>
        </div>
        <div className="visa-grid">
          {VISAS.map((v) => (
            <div key={v.code} className={"visa-card " + v.code + (v.soon ? " soon" : "")}>
              <span className="flag">{v.flag}</span>
              <div className="dest">Destination · {v.country}</div>
              <h4>{v.country} <em>visa</em></h4>
              <div className="visa-type">{v.type}</div>
              <ul>
                {v.items.map((it, i) => <li key={i}><span>{it}</span></li>)}
              </ul>
              <div className="v-meta">
                <div><div className="k">Processing</div><div className="v">{v.process}</div></div>
                <div><div className="k">Embassy fee</div><div className="v">{v.fee}</div></div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function PreDeparture() {
  return (
    <section className="predep-section" id="depart">
      <div className="wrap predep-grid">
        <div className="predep-lhs">
          <div className="mono" style={{color:'var(--muted)', fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.16em", textTransform:"uppercase"}}>Pre-departure · 行前</div>
          <h2>Ten things <em>handled</em> before you board.</h2>
          <p>The two-hour briefing every ITEA student attends in the month before departure. Group session at our KL office, plus a 1-on-1 with your destination desk.</p>
          <div className="stamp">
            <div className="mono">INCLUDED FREE</div>
            <p>Every student receives the pre-departure briefing, an emergency-contact card, and a 30-day post-arrival check-in call.</p>
          </div>
        </div>
        <div className="predep-list">
          {PREDEP.map((p, i) => (
            <div key={i} className="predep-item">
              <div className="num">{p.num}</div>
              <div>
                <h5>{p.t}</h5>
                <p>{p.body}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function ApplyForm() {
  const [state, setState] = useState({
    name: "", email: "", whatsapp: "",
    destination: "China", level: "Undergraduate", intake: "Sep 2026", message: ""
  });
  const [submitted, setSubmitted] = useState(false);
  const update = (k) => (e) => setState({ ...state, [k]: e.target.value });
  const submit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <section className="applyf-section" id="apply">
      <div className="wrap applyf-grid">
        <div className="applyf-lhs">
          <div className="mono">Apply now · 立即申请</div>
          <h2>Start your <em>application.</em></h2>
          <p>Five minutes is all it takes. A destination-desk counsellor calls you within 48 hours with a personalised shortlist and a clear next step.</p>
          <div className="promise">
            <div className="row"><span className="dot"></span><span><b>Free initial consultation.</b> Zero commitment, zero cost until you sign the service agreement.</span></div>
            <div className="row"><span className="dot"></span><span><b>Reply within 48 hours.</b> Counsellor on WhatsApp, English / 中文 / BM — your choice.</span></div>
            <div className="row"><span className="dot"></span><span><b>Your data is private.</b> Used only for your application. Never sold, never shared.</span></div>
          </div>
        </div>
        <div className="applyf-card">
          {!submitted ? (
            <form onSubmit={submit}>
              <div className="form-head">
                <span className="mono">Enquiry / Application form</span>
                <span className="badge">REPLY · 48 HRS</span>
              </div>
              <div className="applyf-row">
                <div className="applyf-field">
                  <label>Full name</label>
                  <input required value={state.name} onChange={update("name")} placeholder="As shown on passport" />
                </div>
                <div className="applyf-field">
                  <label>Email</label>
                  <input required type="email" value={state.email} onChange={update("email")} placeholder="you@example.com" />
                </div>
              </div>
              <div className="applyf-row">
                <div className="applyf-field">
                  <label>WhatsApp</label>
                  <input required value={state.whatsapp} onChange={update("whatsapp")} placeholder="+60 12 345 6789" />
                </div>
                <div className="applyf-field">
                  <label>Destination of interest</label>
                  <select value={state.destination} onChange={update("destination")}>
                    <option>China</option>
                    <option>Malaysia</option>
                    <option>Indonesia (waitlist)</option>
                    <option>Open to suggestions</option>
                  </select>
                </div>
              </div>
              <div className="applyf-row">
                <div className="applyf-field">
                  <label>Programme level</label>
                  <select value={state.level} onChange={update("level")}>
                    <option>Foundation</option>
                    <option>Diploma</option>
                    <option>Undergraduate</option>
                    <option>Master</option>
                    <option>PhD</option>
                    <option>Mandarin / English</option>
                  </select>
                </div>
                <div className="applyf-field">
                  <label>Intended intake</label>
                  <select value={state.intake} onChange={update("intake")}>
                    <option>Aug / Sep 2026</option>
                    <option>Feb / Mar 2027</option>
                    <option>Aug / Sep 2027</option>
                    <option>I'm not sure yet</option>
                  </select>
                </div>
              </div>
              <div className="applyf-row full">
                <div className="applyf-field">
                  <label>Anything we should know?</label>
                  <textarea value={state.message} onChange={update("message")} placeholder="Scholarship goals, preferred universities, family budget, language proficiency…" />
                </div>
              </div>
              <div className="applyf-submit">
                <div className="term">By submitting this form, you agree to be contacted by ITEA EduAbroad. We never share your details.</div>
                <button className="btn" type="submit">Send enquiry <span className="arr"></span></button>
              </div>
            </form>
          ) : (
            <div className="applyf-success">
              <div className="mono">Received · 收到</div>
              <h3>Thanks, <em>we'll be in touch.</em></h3>
              <p>A {state.destination} desk counsellor will WhatsApp you on <b>{state.whatsapp || "your number"}</b> within 48 hours. Keep an eye out for a message from <b>+60 3 7890 0000</b>.</p>
            </div>
          )}
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
            <p>Six of the most-asked. If yours isn't here, our application desk responds on WhatsApp within an hour.</p>
            <button className="btn">Chat with application desk <span className="arr"></span></button>
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

function Foot() {
  return (
    <footer className="foot">
      <div className="wrap">
        <div className="foot-top">
          <div>
            <div className="foot-logo-tile">
              <img src="assets/logo.jpeg" alt="ITEA EduAbroad" />
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
            <h6>Application</h6>
            <ul>
              <li><a href="Application.html#how">How to apply</a></li>
              <li><a href="Application.html#fees">Fees & refund</a></li>
              <li><a href="Application.html#docs">Required documents</a></li>
              <li><a href="Application.html#visa">Visa guidance</a></li>
              <li><a href="Application.html#depart">Pre-departure briefing</a></li>
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
      <QuickNav />
      <HowToApply />
      <Fees />
      <Documents />
      <VisaGuidance />
      <PreDeparture />
      <ApplyForm />
      <FAQ />
      <Foot />
    </>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
