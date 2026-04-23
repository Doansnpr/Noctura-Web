<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Daftar</title>
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
  --success:     #10b981;
  --warn:        #f59e0b;
  --danger:      #ef4444;
}

body {
  font-family: 'DM Sans', sans-serif;
  min-height: 100vh;
  display: flex;
  background: var(--off-white);
}

/* ── LEFT PANEL (identical to login) ── */
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
  position: absolute; inset: 0;
  pointer-events: none; opacity: 0.6;
}

.brand { position: relative; z-index: 1; text-align: center; }

.moon-wrap {
  width: 72px; height: 72px;
  margin: 0 auto 28px;
  background: rgba(255,255,255,0.05);
  border: 1.5px solid rgba(255,255,255,0.12);
  border-radius: 22px;
  display: flex; align-items: center; justify-content: center;
  backdrop-filter: blur(8px);
  box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.1);
  transition: transform 0.3s;
}
.moon-wrap:hover { transform: scale(1.05); }
.moon-wrap svg { width: 38px; height: 38px; filter: drop-shadow(0 0 10px rgba(255,255,255,0.4)); }

.brand-name {
  font-family: 'Playfair Display', serif;
  font-size: 32px; font-weight: 700;
  color: var(--white);
  letter-spacing: 0.12em; text-transform: uppercase;
}
.brand-tag {
  font-size: 11px; font-weight: 400;
  letter-spacing: 0.3em; text-transform: uppercase;
  color: var(--accent); margin-top: 8px; opacity: 0.9;
}
.divider-h {
  width: 40px; height: 1.5px;
  background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
  margin: 32px auto;
}
.left-copy {
  font-size: 13.5px; color: rgba(255,255,255,0.4);
  line-height: 1.7; text-align: center;
  max-width: 220px; letter-spacing: 0.01em;
}

/* ── DIVIDER ── */
.vline {
  width: 1px;
  background: var(--border);
  align-self: stretch; flex-shrink: 0;
}

/* ── RIGHT PANEL ── */
.right {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 44px 52px;
  background: var(--white);
  overflow-y: auto;
}

.form-box {
  width: 100%;
  max-width: 560px;
}

/* Header */
.form-header {
  margin-bottom: 26px;
  padding-bottom: 24px;
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

.eyebrow {
  display: inline-flex; align-items: center; gap: 7px;
  font-size: 10.5px; font-weight: 600;
  letter-spacing: 0.22em; text-transform: uppercase;
  color: var(--accent); margin-bottom: 14px;
}
.eyebrow-dot {
  width: 5px; height: 5px; border-radius: 50%;
  background: var(--accent); opacity: 0.55;
}

.title {
  font-family: 'Playfair Display', serif;
  font-size: 38px; font-weight: 700;
  color: var(--navy); line-height: 1.12;
  margin-bottom: 8px; letter-spacing: -0.01em;
}
.subtitle {
  font-size: 14px; color: #7a8fa8;
  font-weight: 400; line-height: 1.5;
}

/* Fields grid */
.fields-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 13px 20px;
  margin-bottom: 13px;
}
.field-full { grid-column: 1 / -1; }

.field label {
  display: block;
  font-size: 11.5px; font-weight: 600;
  color: var(--navy);
  letter-spacing: 0.07em; text-transform: uppercase;
  margin-bottom: 8px;
}

.input-wrap {
  position: relative; display: flex; align-items: center;
}
.input-icon {
  position: absolute; left: 14px;
  color: #9fb3cc; display: flex; align-items: center;
  pointer-events: none; transition: color 0.2s;
}
.input-wrap:focus-within .input-icon { color: var(--accent); }

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"] {
  width: 100%;
  padding: 12px 42px 12px 42px;
  border: 1.5px solid #dde4ef;
  border-radius: 10px;
  background: #f8fafd;
  color: var(--navy);
  font-family: 'DM Sans', sans-serif;
  font-size: 14px; outline: none;
  transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  -webkit-appearance: none;
}
input[type="tel"] { padding-left: 14px; }
input::placeholder { color: #b8c6d9; font-size: 13.5px; }
input:focus {
  border-color: var(--accent);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(74,142,245,0.1);
}
input.valid   { border-color: var(--success); }
input.invalid { border-color: var(--danger); }
input.valid:focus   { box-shadow: 0 0 0 3px rgba(16,185,129,0.1); }
input.invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

.eye-btn {
  position: absolute; right: 12px;
  background: none; border: none;
  cursor: pointer; color: #9fb3cc;
  display: flex; align-items: center;
  padding: 4px; transition: color 0.2s;
}
.eye-btn:hover { color: var(--navy); }

/* Validation icon inside input */
.val-icon {
  position: absolute; right: 12px;
  display: none; pointer-events: none;
}
.val-icon.show { display: flex; }

/* Password strength */
.pw-strength {
  margin-top: 7px;
  display: none;
}
.pw-strength.show { display: block; }
.strength-bars {
  display: flex; gap: 4px; margin-bottom: 4px;
}
.bar {
  flex: 1; height: 3px; border-radius: 2px;
  background: #e8edf4;
  transition: background 0.3s;
}
.bar.weak   { background: var(--danger); }
.bar.medium { background: var(--warn); }
.bar.strong { background: var(--success); }
.strength-label {
  font-size: 11px; font-weight: 500; color: #9fb3cc;
  transition: color 0.3s;
}
.strength-label.weak   { color: var(--danger); }
.strength-label.medium { color: var(--warn); }
.strength-label.strong { color: var(--success); }

/* Terms */
.terms-row {
  display: flex; align-items: flex-start;
  gap: 9px; margin-bottom: 20px;
  cursor: pointer; user-select: none;
}
.terms-row input { display: none; }
.chk-box {
  width: 18px; height: 18px; flex-shrink: 0;
  border: 1.5px solid #d1dae7;
  border-radius: 5px; background: #fff;
  display: flex; align-items: center; justify-content: center;
  transition: all 0.2s; margin-top: 1px;
}
.terms-row input:checked ~ .chk-box {
  background: var(--accent); border-color: var(--accent);
}
.terms-text {
  font-size: 13px; color: #6b7a99; line-height: 1.5;
}
.terms-text a {
  color: var(--navy); font-weight: 600;
  text-decoration: none;
  border-bottom: 1.5px solid var(--accent);
}
.terms-text a:hover { opacity: 0.7; }

/* Button */
.btn-submit {
  width: 100%; padding: 15px;
  background: var(--navy); color: #fff;
  border: none; border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13.5px; font-weight: 700;
  letter-spacing: 0.12em; text-transform: uppercase;
  cursor: pointer;
  transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
  box-shadow: 0 4px 22px rgba(13,27,53,0.28);
  position: relative; overflow: hidden;
}
.btn-submit::after {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(120deg, rgba(255,255,255,0.08) 0%, transparent 55%);
  pointer-events: none;
}
.btn-submit:hover { background: #1a2e55; transform: translateY(-1px); box-shadow: 0 8px 30px rgba(13,27,53,0.32); }
.btn-submit:active { transform: translateY(0); }

/* OR */
.or-row { display: flex; align-items: center; gap: 14px; margin: 18px 0; }
.or-line { flex: 1; height: 1px; background: #eaeff7; }
.or-text { font-size: 11px; color: #b8c6d9; letter-spacing: 0.12em; white-space: nowrap; font-weight: 500; }

/* Social */
.socials {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 10px; margin-bottom: 20px;
}
.soc-btn {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 12px 8px;
  border: 1.5px solid #dde4ef; border-radius: 9px;
  background: #fafbfd; color: #4a5568;
  font-size: 12.5px; font-weight: 500;
  text-decoration: none; cursor: pointer;
  transition: all 0.2s;
}
.soc-btn:hover {
  border-color: #c0cfe4; background: #fff;
  transform: translateY(-1px);
  box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}
.soc-btn svg { width: 16px; height: 16px; flex-shrink: 0; }

/* Footer */
.form-footer { text-align: center; font-size: 13.5px; color: #8094b4; }
.form-footer a {
  color: var(--navy); font-weight: 700; text-decoration: none;
  border-bottom: 2px solid var(--accent); padding-bottom: 1px;
  transition: opacity 0.2s;
}
.form-footer a:hover { opacity: 0.65; }

/* ── RESPONSIVE ── */
@media (max-width: 960px) {
  .fields-grid { grid-template-columns: 1fr; }
  .field-full { grid-column: 1; }
}
@media (max-width: 820px) {
  .left, .vline { display: none; }
  .right { background: var(--off-white); padding: 40px 24px; }
  .form-box { max-width: 100%; }
  body { background: var(--off-white); }
  .title { font-size: 30px; }
}
</style>
</head>
<body>

<!-- LEFT (identical to login) -->
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

<!-- RIGHT -->
<div class="right">
  <div class="form-box">

    <div class="form-header">
      <div class="eyebrow"><span class="eyebrow-dot"></span> Sleep Intelligence Platform</div>
      <div class="title">Buat Akun<br>Baru</div>
      <div class="subtitle">Bergabung dan mulai pantau kualitas tidur Anda</div>
    </div>

    <div class="fields-grid">

      <!-- Nama Lengkap -->
      <div class="field">
        <label>Nama Lengkap</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </span>
          <input type="text" id="fullname" placeholder="Nama lengkap Anda">
        </div>
      </div>

      <!-- Username -->
      <div class="field">
        <label>Username</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <path d="M12 3a4 4 0 0 1 0 8"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </span>
          <input type="text" id="username" placeholder="username_anda">
        </div>
      </div>

      <!-- Email -->
      <div class="field">
        <label>Alamat Email</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </span>
          <input type="email" id="email" placeholder="nama@email.com">
        </div>
      </div>

      <!-- Telepon -->
      <div class="field">
        <label>No. Telepon</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.64 3.4 2 2 0 0 1 3.61 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.59a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
          </span>
          <input type="tel" id="phone" placeholder="+62 812 3456 7890" style="padding-left:42px">
        </div>
      </div>

      <!-- Kata Sandi -->
      <div class="field">
        <label>Kata Sandi</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
          </span>
          <input type="password" id="pw1" placeholder="Min. 8 karakter" oninput="checkStrength(this.value)">
          <button class="eye-btn" onclick="togglePw('pw1','eye1o','eye1c')" type="button">
            <svg id="eye1o" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <svg id="eye1c" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
          </button>
        </div>
        <!-- Strength indicator -->
        <div class="pw-strength" id="pwStrength">
          <div class="strength-bars">
            <div class="bar" id="bar1"></div>
            <div class="bar" id="bar2"></div>
            <div class="bar" id="bar3"></div>
            <div class="bar" id="bar4"></div>
          </div>
          <span class="strength-label" id="strengthLabel">Lemah</span>
        </div>
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div class="field">
        <label>Konfirmasi Kata Sandi</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </span>
          <input type="password" id="pw2" placeholder="Ulangi kata sandi" oninput="checkMatch()">
          <button class="eye-btn" onclick="togglePw('pw2','eye2o','eye2c')" type="button">
            <svg id="eye2o" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            <svg id="eye2c" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
          </button>
        </div>
      </div>

    </div><!-- /fields-grid -->

    <!-- Terms -->
    <label class="terms-row">
      <input type="checkbox" id="terms">
      <span class="chk-box" id="termBox">
        <svg id="termCk" width="10" height="10" viewBox="0 0 10 10" fill="none" style="display:none">
          <path d="M2 5l2.5 2.5L8 3" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </span>
      <span class="terms-text">
        Saya menyetujui <a href="#">Syarat &amp; Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> Noctura
      </span>
    </label>

    <!-- Submit -->
    <button class="btn-submit" type="button">Buat Akun</button>

    <!-- OR -->
    <div class="or-row">
      <div class="or-line"></div>
      <span class="or-text">atau daftar dengan</span>
      <div class="or-line"></div>
    </div>

    <!-- Socials -->
    <div class="socials">
      <a href="#" class="soc-btn">
        <svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Google
      </a>
      <a href="#" class="soc-btn">
        <svg viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.234 2.686.234v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
        Facebook
      </a>
      <a href="#" class="soc-btn">
        <svg viewBox="0 0 24 24" fill="#111"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        Twitter
      </a>
    </div>

    <div class="form-footer">
      Sudah punya akun? <a href="login.html">Masuk Sekarang</a>
    </div>

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
      x: Math.random() * c.width, y: Math.random() * c.height,
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
      ctx.beginPath(); ctx.arc(s.x, s.y, s.r, 0, Math.PI*2);
      ctx.fillStyle = `rgba(255,255,255,${s.a})`; ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  window.addEventListener('resize', init);
  init(); draw();
})();

/* Password toggle */
function togglePw(id, openId, closedId){
  const pw = document.getElementById(id);
  const open = document.getElementById(openId);
  const closed = document.getElementById(closedId);
  if(pw.type === 'password'){
    pw.type = 'text'; open.style.display = 'none'; closed.style.display = '';
  } else {
    pw.type = 'password'; open.style.display = ''; closed.style.display = 'none';
  }
}

/* Password strength */
function checkStrength(val){
  const wrap = document.getElementById('pwStrength');
  const bars = [document.getElementById('bar1'), document.getElementById('bar2'),
                document.getElementById('bar3'), document.getElementById('bar4')];
  const label = document.getElementById('strengthLabel');

  if(!val){ wrap.classList.remove('show'); return; }
  wrap.classList.add('show');

  let score = 0;
  if(val.length >= 8)  score++;
  if(/[A-Z]/.test(val)) score++;
  if(/[0-9]/.test(val)) score++;
  if(/[^A-Za-z0-9]/.test(val)) score++;

  bars.forEach((b,i) => {
    b.className = 'bar';
    if(i < score){
      if(score <= 1)      b.classList.add('weak');
      else if(score <= 2) b.classList.add('medium');
      else                b.classList.add('strong');
    }
  });

  label.className = 'strength-label';
  if(score <= 1)      { label.classList.add('weak');   label.textContent = 'Lemah'; }
  else if(score <= 2) { label.classList.add('medium'); label.textContent = 'Sedang'; }
  else if(score === 3){ label.classList.add('medium'); label.textContent = 'Baik'; }
  else                { label.classList.add('strong'); label.textContent = 'Kuat'; }

  // also recheck match
  checkMatch();
}

/* Confirm password match */
function checkMatch(){
  const p1 = document.getElementById('pw1').value;
  const p2 = document.getElementById('pw2');
  if(!p2.value) { p2.className = ''; return; }
  if(p1 === p2.value){ p2.classList.remove('invalid'); p2.classList.add('valid'); }
  else               { p2.classList.remove('valid');   p2.classList.add('invalid'); }
}

/* Terms checkbox */
document.getElementById('terms').addEventListener('change', function(){
  const ck = document.getElementById('termCk');
  const box = document.getElementById('termBox');
  ck.style.display = this.checked ? '' : 'none';
  box.style.background = this.checked ? '#4a8ef5' : '';
  box.style.borderColor = this.checked ? '#4a8ef5' : '';
});
</script>
</body>
</html>