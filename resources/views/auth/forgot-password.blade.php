<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Lupa Kata Sandi</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --navy:        #0d1b35;
  --navy-mid:    #152345;
  --navy-light:  #1e3264;
  --navy-xlight: #243a73;
  --white:       #ffffff;
  --off-white:   #f4f6fb;
  --muted:       #8094b4;
  --accent:      #4a8ef5;
  --accent-glow: rgba(74,142,245,0.25);
  --accent-soft: rgba(74,142,245,0.10);
  --border:      rgba(13,27,53,0.09);
  --border-dark: rgba(255,255,255,0.10);
  --text-body:   #334155;
  --text-muted:  #7a8fa8;
}

html, body {
  height: 100%;
  font-family: 'Sora', sans-serif;
  background: var(--off-white);
}

body {
  display: flex;
  min-height: 100vh;
  overflow-x: hidden;
}

/* ═══════════════════════════════
   LEFT — Atmospheric Panel
═══════════════════════════════ */
.left {
  width: 44%;
  flex-shrink: 0;
  background: var(--navy);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 52px 52px 48px;
}

.left-bg {
  position: absolute;
  inset: 0;
  pointer-events: none;
}
.left-bg::before {
  content: '';
  position: absolute;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(74,142,245,0.18) 0%, transparent 65%);
  top: -180px; left: -160px;
}
.left-bg::after {
  content: '';
  position: absolute;
  width: 400px; height: 400px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(30,50,100,0.6) 0%, transparent 70%);
  bottom: -80px; right: -80px;
}
.left-blob {
  position: absolute;
  width: 280px; height: 280px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(74,142,245,0.12) 0%, transparent 70%);
  bottom: 120px; left: -60px;
  pointer-events: none;
}

canvas#c {
  position: absolute;
  inset: 0;
  pointer-events: none;
  opacity: 0.55;
}

.left-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.022) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.022) 1px, transparent 1px);
  background-size: 40px 40px;
  pointer-events: none;
}

/* Brand */
.brand {
  position: relative;
  z-index: 2;
}
.brand-logo {
  display: flex;
  align-items: center;
  gap: 14px;
}
.moon-icon {
  width: 48px; height: 48px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.14);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(12px);
  box-shadow: 0 4px 20px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.1);
}
.moon-icon svg {
  filter: drop-shadow(0 0 8px rgba(255,255,255,0.35));
}
.brand-text .name {
  font-family: 'Fraunces', serif;
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  line-height: 1;
}
.brand-text .tagline {
  font-size: 10px;
  font-weight: 400;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: var(--accent);
  margin-top: 5px;
  opacity: 0.85;
}

/* Center hero copy */
.left-hero {
  position: relative;
  z-index: 2;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 48px 0 32px;
}
.left-eyebrow {
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.28em;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.left-eyebrow::before {
  content: '';
  display: block;
  width: 24px; height: 1.5px;
  background: var(--accent);
  opacity: 0.7;
}
.left-headline {
  font-family: 'Fraunces', serif;
  font-size: clamp(36px, 3.2vw, 50px);
  font-weight: 700;
  color: #fff;
  line-height: 1.12;
  margin-bottom: 22px;
  letter-spacing: -0.01em;
}
.left-headline em {
  font-style: italic;
  color: rgba(255,255,255,0.55);
}
.left-body {
  font-size: 13.5px;
  color: rgba(255,255,255,0.38);
  line-height: 1.8;
  max-width: 300px;
  font-weight: 300;
}

/* Bottom step indicator */
.left-steps {
  position: relative;
  z-index: 2;
  border-top: 1px solid rgba(255,255,255,0.07);
  padding-top: 28px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.step-item {
  display: flex;
  align-items: center;
  gap: 14px;
}
.step-num {
  width: 28px; height: 28px;
  border-radius: 50%;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 700;
  color: rgba(255,255,255,0.4);
  flex-shrink: 0;
}
.step-item.active .step-num {
  background: var(--accent);
  border-color: var(--accent);
  color: #fff;
  box-shadow: 0 0 12px rgba(74,142,245,0.4);
}
.step-lbl {
  font-size: 12px;
  color: rgba(255,255,255,0.3);
  font-weight: 400;
}
.step-item.active .step-lbl {
  color: rgba(255,255,255,0.75);
  font-weight: 500;
}

/* ═══════════════════════════════
   RIGHT — Form Panel
═══════════════════════════════ */
.right {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 48px 40px;
  background: var(--white);
  position: relative;
}

.right::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(rgba(74,142,245,0.045) 1px, transparent 1px);
  background-size: 28px 28px;
  pointer-events: none;
}

.form-wrap {
  width: 100%;
  max-width: 420px;
  position: relative;
  z-index: 1;
}

/* Form header */
.form-top {
  margin-bottom: 36px;
}
.form-pretitle {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: var(--accent-soft);
  border: 1px solid rgba(74,142,245,0.18);
  color: var(--accent);
  font-size: 10.5px;
  font-weight: 600;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  padding: 5px 12px;
  border-radius: 30px;
  margin-bottom: 18px;
}
.form-pretitle-icon {
  width: 16px; height: 16px;
  display: flex; align-items: center; justify-content: center;
}
.form-title {
  font-family: 'Fraunces', serif;
  font-size: 38px;
  font-weight: 700;
  color: var(--navy);
  line-height: 1.1;
  margin-bottom: 10px;
  letter-spacing: -0.02em;
}
.form-title span {
  color: var(--accent);
  font-style: italic;
}
.form-sub {
  font-size: 13.5px;
  color: var(--text-muted);
  line-height: 1.6;
  font-weight: 400;
}

/* Alerts */
.alert-error, .alert-success {
  display: flex;
  align-items: center;
  gap: 10px;
  border-radius: 12px;
  padding: 13px 16px;
  font-size: 13px;
  margin-bottom: 22px;
  font-weight: 500;
  animation: slideDown 0.3s cubic-bezier(.4,0,.2,1);
}
.alert-error {
  background: #fff5f5;
  border: 1.5px solid #fecaca;
  color: #b91c1c;
}
.alert-success {
  background: #f0fdf4;
  border: 1.5px solid #bbf7d0;
  color: #166534;
}
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-10px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Fields */
.field-group {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-bottom: 24px;
}
.field {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.field label {
  font-size: 11px;
  font-weight: 600;
  color: var(--navy);
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
.input-wrap {
  position: relative;
  display: flex;
  align-items: center;
}
.input-icon {
  position: absolute;
  left: 15px;
  color: #b0c0d8;
  display: flex;
  align-items: center;
  pointer-events: none;
  transition: color .2s;
}
.input-wrap:focus-within .input-icon { color: var(--accent); }

input[type="email"] {
  width: 100%;
  padding: 14px 16px 14px 44px;
  border: 1.5px solid #e2e8f3;
  border-radius: 12px;
  background: #f8fafd;
  color: var(--navy);
  font-family: 'Sora', sans-serif;
  font-size: 14px;
  font-weight: 400;
  outline: none;
  transition: border-color .2s, box-shadow .2s, background .2s;
}
input::placeholder { color: #b8c6d9; font-size: 13px; }
input:focus {
  border-color: var(--accent);
  background: #fff;
  box-shadow: 0 0 0 4px rgba(74,142,245,0.09);
}
input.is-error {
  border-color: #fca5a5 !important;
  background: #fff5f5 !important;
}
.field-error {
  font-size: 11.5px;
  color: #e53e3e;
  display: flex;
  align-items: center;
  gap: 5px;
}

/* Submit button */
.btn-submit {
  width: 100%;
  padding: 15px 24px;
  background: var(--navy);
  color: #fff;
  border: none;
  border-radius: 12px;
  font-family: 'Sora', sans-serif;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  cursor: pointer;
  transition: background .2s, transform .15s, box-shadow .2s;
  box-shadow: 0 4px 24px rgba(13,27,53,0.22);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-bottom: 20px;
}
.btn-submit::before {
  content: '';
  position: absolute;
  top: 0; left: -100%;
  width: 100%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
  transition: left .5s;
}
.btn-submit:hover {
  background: #1a2e58;
  transform: translateY(-1px);
  box-shadow: 0 8px 32px rgba(13,27,53,0.30);
}
.btn-submit:hover::before { left: 100%; }
.btn-submit:active { transform: translateY(0); }

/* Back link */
.form-note {
  text-align: center;
  font-size: 12px;
  color: #b0bec9;
  line-height: 1.6;
}
.form-note a {
  color: var(--accent);
  text-decoration: none;
  font-weight: 600;
}
.form-note a:hover { opacity: 0.7; }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
  .left { width: 38%; padding: 40px 36px; }
}
@media (max-width: 720px) {
  .left { display: none; }
  .right { background: var(--off-white); }
  body { background: var(--off-white); }
  .form-wrap { max-width: 100%; }
}

/* Entrance animations */
.form-wrap > * {
  opacity: 0;
  transform: translateY(16px);
  animation: fadeUp 0.5s cubic-bezier(.4,0,.2,1) forwards;
}
.form-wrap > *:nth-child(1) { animation-delay: .05s; }
.form-wrap > *:nth-child(2) { animation-delay: .12s; }
.form-wrap > *:nth-child(3) { animation-delay: .18s; }
.form-wrap > *:nth-child(4) { animation-delay: .24s; }
.form-wrap > *:nth-child(5) { animation-delay: .30s; }

@keyframes fadeUp {
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

{{-- ── LEFT PANEL ── --}}
<div class="left">
  <div class="left-bg"></div>
  <div class="left-grid"></div>
  <div class="left-blob"></div>
  <canvas id="c"></canvas>

  {{-- Brand top --}}
  <div class="brand">
    <div class="brand-logo">
      <div class="moon-icon">
        <svg width="26" height="26" viewBox="0 0 38 38" fill="none">
          <path d="M22 6C17.6 6.9 14.3 10.8 14.3 15.5C14.3 20.9 18.6 25.2 24 25.2C26.2 25.2 28.2 24.5 29.8 23.3C28.3 27.9 24 31.2 19 31.2C12.4 31.2 7 25.8 7 19.2C7 12.6 12.4 7.2 19 7.2C20 7.2 21 7.3 22 6Z" fill="white"/>
          <circle cx="27" cy="9" r="1.2" fill="white" opacity="0.7"/>
          <circle cx="31" cy="15" r="0.8" fill="white" opacity="0.5"/>
          <circle cx="25" cy="5" r="0.7" fill="white" opacity="0.5"/>
        </svg>
      </div>
      <div class="brand-text">
        <div class="name">Noctura</div>
        <div class="tagline">Deteksi Gangguan Tidur</div>
      </div>
    </div>
  </div>

  {{-- Hero copy --}}
  <div class="left-hero">
    <div class="left-eyebrow">Pemulihan Akses</div>
    <h2 class="left-headline">
      Kami Bantu<br>
      <em>Pulihkan</em><br>
      Akses Anda.
    </h2>
    <p class="left-body">
      Masukkan email terdaftar Anda. Kami akan mengirimkan kode OTP untuk memverifikasi identitas dan mereset kata sandi.
    </p>
  </div>

  {{-- Step indicator --}}
  <div class="left-steps">
    <div class="step-item active">
      <div class="step-num">1</div>
      <div class="step-lbl">Masukkan email terdaftar</div>
    </div>
    <div class="step-item">
      <div class="step-num">2</div>
      <div class="step-lbl">Verifikasi kode OTP</div>
    </div>
    <div class="step-item">
      <div class="step-num">3</div>
      <div class="step-lbl">Buat kata sandi baru</div>
    </div>
  </div>
</div>

{{-- ── RIGHT PANEL ── --}}
<div class="right">
  <div class="form-wrap">

    {{-- Header --}}
    <div class="form-top">
      <div class="form-pretitle">
        <span class="form-pretitle-icon">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
          </svg>
        </span>
        Lupa Kata Sandi
      </div>
      <h1 class="form-title">Verifikasi<br><span>Email</span> Anda</h1>
      <p class="form-sub">Masukkan email terdaftar dan kami akan mengirimkan kode OTP untuk verifikasi.</p>
    </div>

    {{-- Alerts --}}
    @if (session('error'))
      <div class="alert-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        {{ session('error') }}
      </div>
    @endif
    @if (session('success'))
      <div class="alert-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        {{ session('success') }}
      </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('forgot-password.send') }}" method="POST" novalidate autocomplete="off">
      @csrf

      <div class="field-group">
        <div class="field">
          <label for="email">Alamat Email</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
              </svg>
            </span>
            <input
              type="email"
              id="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="nama@email.com"
              class="{{ $errors->has('email') ? 'is-error' : '' }}"
              autocomplete="new-password"
            >
          </div>
          @error('email')
            <div class="field-error">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <button class="btn-submit" type="submit">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
        </svg>
        Kirim Kode OTP
      </button>
    </form>

    <div class="form-note">
      Ingat kata sandi? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>

  </div>
</div>

<script>
/* ── Stars canvas ── */
(function(){
  const c = document.getElementById('c');
  if(!c) return;
  const ctx = c.getContext('2d');
  let S = [];
  function resize(){ c.width = c.offsetWidth; c.height = c.offsetHeight; }
  function init(){
    resize();
    S = Array.from({length: 110}, () => ({
      x: Math.random() * c.width,
      y: Math.random() * c.height,
      r: Math.random() * 1.3 + 0.15,
      a: Math.random() * 0.65 + 0.08,
      da: (Math.random() - 0.5) * 0.0025,
      vx: (Math.random() - 0.5) * 0.08,
      vy: (Math.random() - 0.5) * 0.08
    }));
  }
  function draw(){
    ctx.clearRect(0, 0, c.width, c.height);
    S.forEach(s => {
      s.a += s.da;
      s.x += s.vx; s.y += s.vy;
      if(s.a < 0.04 || s.a > 0.75) s.da *= -1;
      if(s.x < 0) s.x = c.width;
      if(s.x > c.width) s.x = 0;
      if(s.y < 0) s.y = c.height;
      if(s.y > c.height) s.y = 0;
      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255,255,255,${s.a})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  window.addEventListener('resize', init);
  init(); draw();
})();
</script>
</body>
</html>