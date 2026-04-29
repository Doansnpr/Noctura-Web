<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Login</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --navy:        #0d1b35;
  --navy-mid:    #152345;
  --navy-light:  #1e3264;
  --white:       #ffffff;
  --off-white:   #f5f7fa;
  --muted:       #8094b4;
  --accent:      #4a8ef5;
  --accent-soft: rgba(74,142,245,0.12);
  --border:      rgba(13,27,53,0.1);
  --border-dark: rgba(255,255,255,0.1);
}

body {
  font-family: 'DM Sans', sans-serif;
  min-height: 100vh;
  display: flex;
  background: var(--off-white);
}

/* ── LEFT PANEL ── */
.left {
  width: 420px;
  flex-shrink: 0;
  background: var(--navy);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 60px 48px;
  position: relative;
  overflow: hidden;
}
.left::before {
  content: '';
  position: absolute;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(74,142,245,0.15) 0%, transparent 70%);
  top: -100px; left: -120px;
  pointer-events: none;
}
.left::after {
  content: '';
  position: absolute;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(74,142,245,0.1) 0%, transparent 70%);
  bottom: -50px; right: -80px;
  pointer-events: none;
}
canvas {
  position: absolute;
  inset: 0;
  pointer-events: none;
  opacity: 0.6;
}
.brand {
  position: relative;
  z-index: 1;
  text-align: center;
}
.moon-wrap {
  width: 72px; height: 72px;
  margin: 0 auto 28px;
  background: rgba(255,255,255,0.05);
  border: 1.5px solid rgba(255,255,255,0.12);
  border-radius: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(8px);
  box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.1);
  transition: transform 0.3s;
}
.moon-wrap:hover { transform: scale(1.05); }
.moon-wrap svg {
  width: 38px; height: 38px;
  filter: drop-shadow(0 0 10px rgba(255,255,255,0.4));
}
.brand-name {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 700;
  color: var(--white);
  letter-spacing: 0.12em;
  text-transform: uppercase;
}
.brand-tag {
  font-size: 11px;
  font-weight: 400;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--accent);
  margin-top: 8px;
  opacity: 0.9;
}
.divider-h {
  width: 40px; height: 1.5px;
  background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
  margin: 32px auto;
}
.left-copy {
  font-size: 13.5px;
  color: rgba(255,255,255,0.4);
  line-height: 1.7;
  text-align: center;
  max-width: 220px;
  letter-spacing: 0.01em;
}

/* ── DIVIDER ── */
.vline {
  width: 1px;
  background: var(--border);
  align-self: stretch;
  flex-shrink: 0;
}

/* ── RIGHT PANEL ── */
.right {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 50px 52px;
  background: var(--white);
}
.form-box {
  width: 100%;
  max-width: 560px;
}
.form-header {
  margin-bottom: 30px;
  padding-bottom: 26px;
  position: relative;
}
.form-header::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0;
  width: 44px; height: 3px;
  background: linear-gradient(to right, var(--navy), var(--accent));
  border-radius: 2px;
}
.title {
  font-family: 'Playfair Display', serif;
  font-size: 42px;
  font-weight: 700;
  color: var(--navy);
  line-height: 1.12;
  margin-bottom: 10px;
  letter-spacing: -0.01em;
}
.subtitle {
  font-size: 14.5px;
  color: #7a8fa8;
  font-weight: 400;
  line-height: 1.5;
}

/* ── ALERT ── */
.alert-error {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fff5f5;
  border: 1.5px solid #fecaca;
  color: #c0392b;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 13px;
  margin-bottom: 20px;
  animation: slideIn 0.3s ease;
}
.alert-success {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #f0fff4;
  border: 1.5px solid #b2f5c8;
  color: #1a7a3f;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 13px;
  margin-bottom: 20px;
  animation: slideIn 0.3s ease;
}
@keyframes slideIn {
  from { opacity: 0; transform: translateY(-6px); }
  to   { opacity: 1; transform: translateY(0); }
}
.alert-icon { flex-shrink: 0; }

/* ── FIELDS ── */
.fields-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px 20px;
  margin-bottom: 16px;
}
.field label {
  display: block;
  font-size: 11.5px;
  font-weight: 600;
  color: var(--navy);
  letter-spacing: 0.07em;
  text-transform: uppercase;
  margin-bottom: 9px;
}
.input-wrap {
  position: relative;
  display: flex;
  align-items: center;
}
.input-icon {
  position: absolute;
  left: 14px;
  color: #9fb3cc;
  display: flex;
  align-items: center;
  pointer-events: none;
  transition: color 0.2s;
}
.input-wrap:focus-within .input-icon { color: var(--accent); }

input[type="text"],
input[type="password"],
input[type="email"] {
  width: 100%;
  padding: 13px 42px 13px 42px;
  border: 1.5px solid #dde4ef;
  border-radius: 10px;
  background: #f8fafd;
  color: var(--navy);
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  -webkit-appearance: none;
}
input.is-error {
  border-color: #fca5a5 !important;
  background: #fff5f5 !important;
}
input::placeholder { color: #b8c6d9; font-size: 13.5px; }
input:focus {
  border-color: var(--accent);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(74,142,245,0.1);
}
.field-error {
  font-size: 11.5px;
  color: #e53e3e;
  margin-top: 6px;
  display: flex;
  align-items: center;
  gap: 4px;
}

.eye-btn {
  position: absolute;
  right: 12px;
  background: none;
  border: none;
  cursor: pointer;
  color: #9fb3cc;
  display: flex;
  align-items: center;
  padding: 4px;
  transition: color 0.2s;
}
.eye-btn:hover { color: var(--navy); }

/* Options row */
.opts {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}
.chk-label {
  display: flex;
  align-items: center;
  gap: 9px;
  cursor: pointer;
  user-select: none;
}
.chk-label input { display: none; }
.chk-box {
  width: 18px; height: 18px;
  border: 1.5px solid #d1dae7;
  border-radius: 5px;
  background: #fff;
  display: flex; align-items: center; justify-content: center;
  transition: all 0.2s;
  flex-shrink: 0;
}
.chk-label input:checked ~ .chk-box {
  background: var(--accent);
  border-color: var(--accent);
}
.chk-text { font-size: 13px; color: #6b7a99; }
.forgot {
  font-size: 13px;
  color: var(--accent);
  text-decoration: none;
  font-weight: 600;
  transition: opacity 0.2s;
}
.forgot:hover { opacity: 0.7; }

/* Button */
.btn-submit {
  width: 100%;
  padding: 15px;
  background: var(--navy);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13.5px;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
  box-shadow: 0 4px 22px rgba(13,27,53,0.28);
  position: relative; overflow: hidden;
}
.btn-submit::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(120deg, rgba(255,255,255,0.08) 0%, transparent 55%);
  pointer-events: none;
}
.btn-submit:hover { background: #1a2e55; transform: translateY(-1px); box-shadow: 0 8px 30px rgba(13,27,53,0.32); }
.btn-submit:active { transform: translateY(0); }

/* ── RESPONSIVE ── */
@media (max-width: 960px) {
  .fields-grid { grid-template-columns: 1fr; }
}
@media (max-width: 820px) {
  .left, .vline { display: none; }
  .right { background: var(--off-white); padding: 40px 24px; }
  .form-box { max-width: 100%; }
  body { background: var(--off-white); }
  .title { font-size: 32px; }
}
</style>
</head>
<body>

{{-- LEFT PANEL --}}
<div class="left">
  <canvas id="c"></canvas>
  <div class="brand">
    <div class="moon-wrap">
      <svg viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M22 6C17.6 6.9 14.3 10.8 14.3 15.5C14.3 20.9 18.6 25.2 24 25.2C26.2 25.2 28.2 24.5 29.8 23.3C28.3 27.9 24 31.2 19 31.2C12.4 31.2 7 25.8 7 19.2C7 12.6 12.4 7.2 19 7.2C20 7.2 21 7.3 22 6Z" fill="white"/>
        <circle cx="27" cy="9" r="1.2" fill="white" opacity="0.7"/>
        <circle cx="31" cy="15" r="0.8" fill="white" opacity="0.5"/>
        <circle cx="25" cy="5" r="0.7" fill="white" opacity="0.5"/>
      </svg>
    </div>
    <div class="brand-name">Noctura</div>
    <div class="brand-tag">Sleep Intelligence</div>
    <div class="divider-h"></div>
    <div class="left-copy">Platform pemantauan kualitas tidur berbasis kecerdasan buatan</div>
  </div>
</div>

<div class="vline"></div>

{{-- RIGHT PANEL --}}
<div class="right">
  <div class="form-box">

    <div class="form-header">
      <div class="title">Selamat Datang<br>Kembali</div>
      <div class="subtitle">Masuk untuk melanjutkan sesi Anda</div>
    </div>

    {{-- Alert dari session --}}
    @if (session('error'))
      <div class="alert-error">
        <span class="alert-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        </span>
        {{ session('error') }}
      </div>
    @endif

    @if (session('success'))
      <div class="alert-success">
        <span class="alert-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </span>
        {{ session('success') }}
      </div>
    @endif

    {{-- Form Login --}}
    <form action="{{ route('login.post') }}" method="POST" novalidate>
      @csrf

      <div class="fields-grid">

        {{-- Email / Username --}}
        <div class="field">
          <label for="email">Email / Nama Pengguna</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </span>
            <input
              type="text"
              id="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="nama@email.com atau username"
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

        {{-- Password --}}
        <div class="field">
          <label for="pw">Kata Sandi</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
            <input
              type="password"
              id="pw"
              name="password"
              placeholder="Masukkan kata sandi"
              class="{{ $errors->has('password') ? 'is-error' : '' }}"
              autocomplete="new-password"
            >
            <button class="eye-btn" onclick="togglePw()" type="button" aria-label="Tampilkan kata sandi">
              <svg id="eyeOpen" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg id="eyeClosed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
          @error('password')
            <div class="field-error">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              {{ $message }}
            </div>
          @enderror
        </div>

      </div>{{-- end fields-grid --}}

      {{-- Options --}}
      <div class="opts">
        <label class="chk-label">
          <input type="checkbox" id="rem" name="remember">
          <span class="chk-box">
            <svg id="ck" width="10" height="10" viewBox="0 0 10 10" fill="none" style="display:none">
              <path d="M2 5l2.5 2.5L8 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="chk-text">Ingat Saya</span>
        </label>
        <a href="{{ route('forgot-password') }}" class="forgot">Lupa Kata Sandi?</a>
      </div>

      {{-- Submit --}}
      <button class="btn-submit" type="submit">Masuk</button>

    </form>

  </div>
</div>

<script>
/* Stars */
(function(){
  const c = document.getElementById('c');
  if(!c) return;
  const ctx = c.getContext('2d');
  let S = [];
  function resize(){ c.width = c.offsetWidth; c.height = c.offsetHeight; }
  function init(){
    resize();
    S = Array.from({length:90}, () => ({
      x: Math.random() * c.width,
      y: Math.random() * c.height,
      r: Math.random() * 1.2 + 0.2,
      a: Math.random() * 0.7 + 0.1,
      da: (Math.random() - 0.5) * 0.003
    }));
  }
  function draw(){
    ctx.clearRect(0, 0, c.width, c.height);
    S.forEach(s => {
      s.a += s.da;
      if(s.a < 0.05 || s.a > 0.8) s.da *= -1;
      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI*2);
      ctx.fillStyle = `rgba(255,255,255,${s.a})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  window.addEventListener('resize', init);
  init(); draw();
})();

/* Password toggle */
function togglePw(){
  const pw = document.getElementById('pw');
  const open = document.getElementById('eyeOpen');
  const closed = document.getElementById('eyeClosed');
  if(pw.type === 'password'){
    pw.type = 'text';
    open.style.display = 'none';
    closed.style.display = '';
  } else {
    pw.type = 'password';
    open.style.display = '';
    closed.style.display = 'none';
  }
}

/* Checkbox */
document.getElementById('rem').addEventListener('change', function(){
  const ck = document.getElementById('ck');
  const box = this.nextElementSibling;
  ck.style.display = this.checked ? '' : 'none';
  box.style.background = this.checked ? '#4a8ef5' : '';
  box.style.borderColor = this.checked ? '#4a8ef5' : '';
});
</script>
</body>
</html>