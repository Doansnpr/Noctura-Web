<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Reset Kata Sandi</title>
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
.step-item.done .step-num {
  background: rgba(74,142,245,0.2);
  border-color: rgba(74,142,245,0.35);
  color: var(--accent);
}
.step-item.done .step-num svg {
  display: block;
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
.step-item.done .step-lbl {
  color: rgba(255,255,255,0.4);
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
  margin-bottom: 16px;
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

input[type="password"],
input[type="text"] {
  width: 100%;
  padding: 14px 46px 14px 44px;
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

.eye-btn {
  position: absolute;
  right: 13px;
  background: none;
  border: none;
  cursor: pointer;
  color: #b0c0d8;
  display: flex;
  align-items: center;
  padding: 4px;
  transition: color .2s;
  border-radius: 6px;
}
.eye-btn:hover { color: var(--navy); background: rgba(13,27,53,0.05); }

/* Password strength indicator */
.pw-strength {
  margin-top: 6px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.pw-bars {
  display: flex;
  gap: 4px;
  flex: 1;
}
.pw-bar {
  flex: 1;
  height: 3px;
  border-radius: 2px;
  background: #e2e8f3;
  transition: background .3s;
}
.pw-bar.weak   { background: #fca5a5; }
.pw-bar.fair   { background: #fbbf24; }
.pw-bar.good   { background: #34d399; }
.pw-bar.strong { background: #10b981; }
.pw-lbl {
  font-size: 10.5px;
  font-weight: 600;
  color: var(--text-muted);
  min-width: 48px;
  text-align: right;
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
  margin-top: 8px;
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
    <div class="left-eyebrow">Langkah Terakhir</div>
    <h2 class="left-headline">
      Buat Kata<br>
      Sandi <em>Baru</em><br>
      Yang Kuat.
    </h2>
    <p class="left-body">
      Pilih kata sandi yang kuat dan unik untuk menjaga keamanan akun pemantauan tidur Anda.
    </p>
  </div>

  {{-- Step indicator --}}
  <div class="left-steps">
    <div class="step-item done">
      <div class="step-num">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <div class="step-lbl">Email terverifikasi</div>
    </div>
    <div class="step-item done">
      <div class="step-num">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <div class="step-lbl">Kode OTP diverifikasi</div>
    </div>
    <div class="step-item active">
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
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </span>
        Reset Kata Sandi
      </div>
      <h1 class="form-title">Kata Sandi<br><span>Baru</span></h1>
      <p class="form-sub">Masukkan kata sandi baru untuk akun Anda. Pastikan minimal 6 karakter.</p>
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

    {{-- Form --}}
    <form action="{{ route('forgot-password.reset.post') }}" method="POST" novalidate autocomplete="off">
      @csrf

      <div class="field-group">

        {{-- New Password --}}
        <div class="field">
          <label for="password">Kata Sandi Baru</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Minimal 6 karakter"
              class="{{ $errors->has('password') ? 'is-error' : '' }}"
              autocomplete="new-password"
              oninput="checkStrength(this.value)"
            >
            <button class="eye-btn" onclick="togglePw('password','eye1open','eye1closed')" type="button" aria-label="Tampilkan kata sandi">
              <svg id="eye1open" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
              <svg id="eye1closed" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
          <div class="pw-strength" id="pwStrength" style="display:none">
            <div class="pw-bars">
              <div class="pw-bar" id="bar1"></div>
              <div class="pw-bar" id="bar2"></div>
              <div class="pw-bar" id="bar3"></div>
              <div class="pw-bar" id="bar4"></div>
            </div>
            <div class="pw-lbl" id="pwLbl"></div>
          </div>
          @error('password')
            <div class="field-error">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="field">
          <label for="password_confirmation">Konfirmasi Kata Sandi</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              placeholder="Ulangi kata sandi baru"
              class="{{ $errors->has('password_confirmation') ? 'is-error' : '' }}"
              autocomplete="new-password"
            >
            <button class="eye-btn" onclick="togglePw('password_confirmation','eye2open','eye2closed')" type="button" aria-label="Tampilkan konfirmasi">
              <svg id="eye2open" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
              <svg id="eye2closed" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
          @error('password_confirmation')
            <div class="field-error">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              {{ $message }}
            </div>
          @enderror
        </div>

      </div>

      <button class="btn-submit" type="submit">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
        </svg>
        Simpan Kata Sandi Baru
      </button>

    </form>
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

/* ── Password toggle ── */
function togglePw(id, openId, closedId){
  const pw = document.getElementById(id);
  const open = document.getElementById(openId);
  const closed = document.getElementById(closedId);
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

/* ── Password strength ── */
function checkStrength(val){
  const wrap = document.getElementById('pwStrength');
  const lbl  = document.getElementById('pwLbl');
  const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];

  if(!val){ wrap.style.display = 'none'; return; }
  wrap.style.display = 'flex';

  let score = 0;
  if(val.length >= 6)  score++;
  if(val.length >= 10) score++;
  if(/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
  if(/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) score++;

  const levels = ['', 'weak', 'fair', 'good', 'strong'];
  const labels = ['', 'Lemah', 'Cukup', 'Bagus', 'Kuat'];
  const colors = {'weak':'#fca5a5','fair':'#fbbf24','good':'#34d399','strong':'#10b981'};

  bars.forEach((b, i) => {
    b.className = 'pw-bar';
    b.style.background = i < score ? (colors[levels[score]] || '#e2e8f3') : '#e2e8f3';
  });

  lbl.textContent = labels[score] || '';
  lbl.style.color = colors[levels[score]] || '#b0bec9';
}
</script>
</body>
</html>