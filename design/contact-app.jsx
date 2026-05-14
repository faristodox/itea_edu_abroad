const { useState } = React;

const CHANNELS = [
  { id: "whatsapp", title: "WhatsApp", zh: "微信", count: "<1 hr reply", glyph: "g5", body: "Fastest. Real human, business hours" },
  { id: "email", title: "Email", zh: "电邮", count: "<24 hr reply", glyph: "g1", body: "hello@iteaeduabroad.com" },
  { id: "phone", title: "Phone", zh: "电话", count: "9am – 7pm MYT", glyph: "g2", body: "+603 7890 0000 · Mon–Fri" },
  { id: "office", title: "Office Visit", zh: "办公室", count: "3 cities", glyph: "g3", body: "Walk-ins welcomed, appointment preferred" },
  { id: "book", title: "Book a Call", zh: "预约", count: "30-min slots", glyph: "g4", body: "Zoom consultation with a counsellor" },
  { id: "chat", title: "Live Chat", zh: "在线", count: "On-site widget", glyph: "g6", body: "Quick questions, no commitment" },
];

const OFFICES = [
  {
    id: "kl", badge: "HQ", city: "Kuala Lumpur", country: "Malaysia",
    map: { x: 50, y: 60 },
    addr: "Suite 12-A, Menara KLH, Jalan Sultan Ismail, 50250 Kuala Lumpur, Wilayah Persekutuan",
    rows: [
      { k: "Hours", v: "Mon – Fri · 9 AM – 7 PM MYT" },
      { k: "Phone", v: "+603 7890 0000" },
      { k: "WhatsApp", v: "+60 12 345 6789" },
      { k: "Email", v: "kl@iteaeduabroad.com" },
    ],
  },
  {
    id: "bj", badge: "ASIA HUB", city: "Beijing", country: "China",
    map: { x: 70, y: 35 },
    addr: "Room 808, Tower B, China World Trade Center, Jianguomenwai Avenue, Chaoyang District, Beijing 100004",
    rows: [
      { k: "Hours", v: "Mon – Fri · 9 AM – 6 PM CST" },
      { k: "Phone", v: "+86 10 8888 0000" },
      { k: "WeChat", v: "ITEA-EduAbroad" },
      { k: "Email", v: "beijing@iteaeduabroad.com" },
    ],
  },
  {
    id: "jkt", badge: "SE ASIA", city: "Jakarta", country: "Indonesia",
    map: { x: 45, y: 70 },
    addr: "Floor 18, World Trade Center 5, Jl. Jenderal Sudirman Kav. 29–31, RT.8/RW.3, Jakarta 12920",
    rows: [
      { k: "Hours", v: "Mon – Fri · 9 AM – 6 PM WIB" },
      { k: "Phone", v: "+62 21 5555 0000" },
      { k: "WhatsApp", v: "+62 812 3456 7890" },
      { k: "Email", v: "jakarta@iteaeduabroad.com" },
    ],
  },
];

const DIRECTORY = [
  { desk: "Admissions Desk", code: "General · 综合", email: "admissions@iteaeduabroad.com", lang: "EN · 中文 · BM", sla: "Reply · 24h" },
  { desk: "China Desk", code: "China · 中国", email: "china@iteaeduabroad.com", lang: "EN · 中文 · Cantonese", sla: "Reply · 12h" },
  { desk: "Malaysia Desk", code: "Malaysia · 马来西亚", email: "malaysia@iteaeduabroad.com", lang: "EN · BM · 中文", sla: "Reply · 12h" },
  { desk: "Scholarship Desk", code: "Funding · 奖学金", email: "scholarships@iteaeduabroad.com", lang: "EN · 中文 · BM", sla: "Reply · 24h" },
  { desk: "Visa Desk", code: "Visa · 签证", email: "visa@iteaeduabroad.com", lang: "EN · 中文", sla: "Reply · 24h" },
  { desk: "Partners & Agents", code: "B2B · 合作伙伴", email: "partners@iteaeduabroad.com", lang: "EN · 中文 · BM", sla: "Reply · 48h" },
  { desk: "Media & PR", code: "Press · 媒体", email: "press@iteaeduabroad.com", lang: "EN · 中文", sla: "Reply · 48h" },
];

const FAQS = [
  { q: "What's the fastest way to reach you?", a: "WhatsApp. Our team monitors +60 12 345 6789 during business hours (9 AM – 7 PM MYT, Mon–Fri) with under-one-hour average response. For after-hours or weekends, send an email and we'll get back to you on the next business day — or sooner if our on-call counsellor is around." },
  { q: "Do I need to make an appointment to visit?", a: "Walk-ins are welcome, but a quick WhatsApp ahead means your destination-specific counsellor is in office and ready. Each KL appointment is a 60-minute slot with a private consultation room, complimentary tea, and a written summary emailed afterwards." },
  { q: "I'm overseas — can I still consult ITEA?", a: "Yes. Hundreds of our students never set foot in our offices. We run Zoom and Google Meet consultations in English, Mandarin and Bahasa Melayu. Documents flow through our secure portal; signatures are electronic. The only in-person touchpoint is the visa biometrics at your local embassy." },
  { q: "Is the initial consultation really free?", a: "Yes. Discovery calls, programme matching, scholarship shortlisting and the first round of document review are all free of charge. ITEA's service fee only kicks in once you sign the formal service agreement and we begin submitting applications on your behalf." },
  { q: "What languages do you support?", a: "Counselling is delivered in English, Mandarin (普通话 and 广东话), and Bahasa Melayu by default. Our China desk additionally supports Hokkien; our Jakarta office supports Bahasa Indonesia. For other languages, we use professional interpreters at no charge to you." },
  { q: "Can I just call to ask one quick question?", a: "Absolutely — +603 7890 0000 reaches our front desk and they'll route you to whoever can answer fastest. Most quick questions (eligibility, fees, deadlines) are answered in under five minutes. Longer scholarship or programme-matching conversations are booked as a separate slot." },
];

function Hero() {
  return (
    <section className="cn-hero ct-hero">
      <div className="wrap">
        <div className="crumb">
          <a href="Home.html">Home</a>
          <span className="sep">/</span>
          <span className="here">Contact</span>
        </div>
        <div className="cn-hero-grid">
          <div>
            <div className="label"><span className="bar"></span> Talk to ITEA · 3 offices, 5 languages</div>
            <h1>Let's talk.<span className="zh">联系我们</span></h1>
            <p>WhatsApp the desk, email the team, or walk into one of our offices in Kuala Lumpur, Beijing or Jakarta. Real humans, replying in under an hour during business hours.</p>
            <div className="h-actions">
              <a href="https://wa.me/60123456789" target="_blank" rel="noopener" className="btn">WhatsApp us now <span className="arr"></span></a>
              <a href="#form" className="link">Or send a message ↓</a>
            </div>
          </div>
          <div className="cn-fact">
            <h4>Contact at a glance</h4>
            <div className="stat"><span className="k">WhatsApp response</span><span className="v">&lt;1<small>hr avg</small></span></div>
            <div className="stat"><span className="k">Email response</span><span className="v">&lt;24<small>hr</small></span></div>
            <div className="stat"><span className="k">Phone hours</span><span className="v">9 – 7<small> MYT</small></span></div>
            <div className="stat"><span className="k">Offices</span><span className="v">3<small> cities</small></span></div>
            <div className="stat"><span className="k">Languages</span><span className="v">5</span></div>
            <div className="stat"><span className="k">Counselling</span><span className="v">Free</span></div>
          </div>
        </div>
      </div>
    </section>
  );
}

function Channels() {
  return (
    <section className="prog-types">
      <div className="wrap">
        <div className="types-head">
          <div>
            <div className="mono" style={{color:'var(--muted)'}}>Choose your channel</div>
            <h2>Six ways <em>to reach us.</em></h2>
          </div>
          <p>WhatsApp is fastest. Email is best for formal documents. Phone is open during MYT business hours. Office visits welcome by appointment.</p>
        </div>
        <div className="types-grid">
          {CHANNELS.map((t) => (
            <a key={t.id} href={t.id === "office" ? "#offices" : t.id === "book" ? "#form" : "#" + t.id} className="type-card">
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

function Offices() {
  return (
    <section className="offices-section" id="offices">
      <div className="wrap">
        <div className="offices-head">
          <div>
            <div className="mono" style={{color:'var(--muted)', fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.16em", textTransform:"uppercase"}}>Offices · 办公室</div>
            <h2>Three cities, <em>one team.</em></h2>
          </div>
          <p>Drop by any of our offices for a face-to-face consultation. Counsellors at every location speak English, Mandarin and the local language.</p>
        </div>
        <div className="offices-grid">
          {OFFICES.map((o) => (
            <div key={o.id} className="office-card">
              <div className="map">
                <div className="grid-overlay"></div>
                <div className="pin" style={{ left: o.map.x + "%", top: o.map.y + "%" }}>
                  <div className="dot"></div>
                  <div className="stem"></div>
                </div>
                <span className="badge">{o.badge}</span>
                <div className="city">{o.city}<small>{o.country}</small></div>
              </div>
              <div className="office-body">
                <div className="addr">{o.addr}</div>
                <div className="rows">
                  {o.rows.map((r, i) => (
                    <div key={i} className="ln">
                      <span className="k">{r.k}</span>
                      <span>{r.v}</span>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Directory() {
  return (
    <section className="dir-section">
      <div className="wrap">
        <div className="dir-head">
          <div className="mono" style={{color:'var(--muted)', fontFamily:"'JetBrains Mono', monospace", fontSize:11, letterSpacing:"0.16em", textTransform:"uppercase"}}>Department directory · 部门索引</div>
          <h2>Email <em>the right desk.</em></h2>
          <p>Routing to a specific desk gets you a faster, more specialised reply. Not sure where to start? Admissions handles intake and forwards anywhere it needs to go.</p>
        </div>
        <div className="dir-table">
          <div className="dir-row head">
            <div>Desk</div><div>Email</div><div>Languages</div>
          </div>
          {DIRECTORY.map((d, i) => (
            <div key={i} className="dir-row">
              <div className="desk">{d.desk}<small>{d.code}</small></div>
              <a href={`mailto:${d.email}`} className="e">{d.email}</a>
              <div className="lang">{d.lang}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function ContactForm() {
  const [state, setState] = useState({
    name: "", email: "", whatsapp: "",
    topic: "General enquiry", office: "Kuala Lumpur", message: ""
  });
  const [submitted, setSubmitted] = useState(false);
  const update = (k) => (e) => setState({ ...state, [k]: e.target.value });
  const submit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <section className="applyf-section" id="form">
      <div className="wrap applyf-grid">
        <div className="applyf-lhs">
          <div className="mono">Send a message · 留言</div>
          <h2>Drop us <em>a line.</em></h2>
          <p>Anything you'd like to ask — programme advice, scholarship eligibility, fees, visa, partnership — write it in here and the right desk picks it up.</p>
          <div className="promise">
            <div className="row"><span className="dot"></span><span><b>Routed automatically.</b> Your topic flags the right desk — China, Malaysia, scholarship, visa or partner.</span></div>
            <div className="row"><span className="dot"></span><span><b>Reply within 24 hours.</b> Or under one hour during MYT business hours if marked urgent.</span></div>
            <div className="row"><span className="dot"></span><span><b>Your data stays here.</b> Used only to reply. Never sold, never shared with third parties.</span></div>
          </div>
        </div>
        <div className="applyf-card">
          {!submitted ? (
            <form onSubmit={submit}>
              <div className="form-head">
                <span className="mono">General message form</span>
                <span className="badge">REPLY · 24 HRS</span>
              </div>
              <div className="applyf-row">
                <div className="applyf-field">
                  <label>Full name</label>
                  <input required value={state.name} onChange={update("name")} placeholder="Your name" />
                </div>
                <div className="applyf-field">
                  <label>Email</label>
                  <input required type="email" value={state.email} onChange={update("email")} placeholder="you@example.com" />
                </div>
              </div>
              <div className="applyf-row">
                <div className="applyf-field">
                  <label>WhatsApp (optional)</label>
                  <input value={state.whatsapp} onChange={update("whatsapp")} placeholder="+60 12 345 6789" />
                </div>
                <div className="applyf-field">
                  <label>Topic</label>
                  <select value={state.topic} onChange={update("topic")}>
                    <option>General enquiry</option>
                    <option>Study in China</option>
                    <option>Study in Malaysia</option>
                    <option>Scholarships</option>
                    <option>Application / Visa</option>
                    <option>Partnership / B2B</option>
                    <option>Media / Press</option>
                  </select>
                </div>
              </div>
              <div className="applyf-row full">
                <div className="applyf-field">
                  <label>Preferred office</label>
                  <select value={state.office} onChange={update("office")}>
                    <option>Kuala Lumpur</option>
                    <option>Beijing</option>
                    <option>Jakarta</option>
                    <option>No preference</option>
                  </select>
                </div>
              </div>
              <div className="applyf-row full">
                <div className="applyf-field">
                  <label>Your message</label>
                  <textarea required value={state.message} onChange={update("message")} placeholder="Tell us what's on your mind…" />
                </div>
              </div>
              <div className="applyf-submit">
                <div className="term">By sending this form, you agree to be contacted by ITEA EduAbroad. We never share your details with anyone outside our offices.</div>
                <button className="btn" type="submit">Send message <span className="arr"></span></button>
              </div>
            </form>
          ) : (
            <div className="applyf-success">
              <div className="mono">Received · 收到</div>
              <h3>Got it, <em>thanks for writing.</em></h3>
              <p>Your message has been routed to the <b>{state.topic}</b> desk at our <b>{state.office}</b> office. We'll reply on <b>{state.email}</b>{state.whatsapp ? <> or WhatsApp <b>{state.whatsapp}</b></> : null} within 24 hours.</p>
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
            <h2 style={{fontFamily:"'Instrument Serif',serif", fontWeight:400, fontSize:48, margin:'12px 0 18px', lineHeight:1}}>Quick <em style={{fontStyle:'italic', color:'var(--accent)'}}>answers.</em></h2>
            <p>Six of the most-asked contact questions. If yours isn't here, WhatsApp the team — they're real humans and they answer fast.</p>
            <a href="https://wa.me/60123456789" target="_blank" rel="noopener" className="btn">Open WhatsApp <span className="arr"></span></a>
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
              <li><a href="Contact.html">Contact us</a></li>
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
      <Channels />
      <Offices />
      <Directory />
      <ContactForm />
      <Foot />
    </>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
