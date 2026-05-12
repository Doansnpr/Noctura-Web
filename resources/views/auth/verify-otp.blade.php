<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verifikasi OTP - Noctura</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/verify-otp.css') }}">
</head>
<body>

{{-- ── LEFT PANEL ── --}}
<div class="left">
  <div class="left-bg"></div>
  <div class="left-grid"></div>
  <div class="left-blob"></div>
  <canvas id="c"></canvas>

  {{-- Brand --}}
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
    <h2 class="left-headline">
      Satu Langkah<br>
      <em>Lagi</em> Menuju<br>
      Akses Anda.
    </h2>
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
    <div class="step-item active">
      <div class="step-num">2</div>
      <div class="step-lbl">Verifikasi kode OTP</div>
    </div>
    <div class="step-item">
      <div class="step-num">3</div>
      <div class="step-lbl">Buat kata sandi baru</div>
    </div>
  </div>
  </div>


</div>

{{-- ── RIGHT PANEL ── --}}
<div class="right">
  <div class="form-wrap">

    {{-- Header --}}
    <div class="form-top">
      <div class="form-pretitle">
        <span class="pretitle-dot"></span>
        Kode OTP Terkirim
      </div>
      <h1 class="form-title">Verifikasi<br><span>Kode</span> OTP</h1>
      <p class="form-sub">
        Kode 6 digit telah dikirim ke:
        <span class="email-badge">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
          </svg>
          {{ session('reset_email') }}
        </span>
      </p>
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
    <form action="{{ route('forgot-password.verify.post') }}" method="POST" novalidate autocomplete="off">
      @csrf

      <div class="otp-label">Masukkan Kode OTP</div>
      <div class="otp-wrap">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="0" placeholder="·">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="1" placeholder="·">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="2" placeholder="·">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="3" placeholder="·">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="4" placeholder="·">
        <input class="otp-input {{ $errors->has('otp') ? 'is-error' : '' }}" type="text" maxlength="1" inputmode="numeric" data-index="5" placeholder="·">
      </div>
      <input type="hidden" name="otp" id="otp-combined">

      @error('otp')
        <div class="field-error">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ $message }}
        </div>
      @enderror

      <div class="resend-row">
        Tidak menerima kode?
        <a href="{{ route('forgot-password') }}">Kirim ulang</a>
      </div>

      <button class="btn-submit" type="submit">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        Verifikasi Kode
      </button>
    </form>

    <div class="form-note">
      <a href="{{ route('forgot-password') }}">← Kembali ke lupa kata sandi</a>
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

/* ── OTP input logic (tidak diubah) ── */
const inputs  = document.querySelectorAll('.otp-input');
const combined = document.getElementById('otp-combined');

inputs.forEach((input, i) => {
  input.addEventListener('input', () => {
    input.value = input.value.replace(/[^0-9]/g, '');
    input.classList.toggle('filled', input.value !== '');
    if (input.value && i < inputs.length - 1) inputs[i + 1].focus();
    combined.value = Array.from(inputs).map(x => x.value).join('');
  });
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace' && !input.value && i > 0) inputs[i - 1].focus();
  });
  input.addEventListener('paste', (e) => {
    e.preventDefault();
    const paste = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
    paste.split('').forEach((char, idx) => {
      if (inputs[idx]) {
        inputs[idx].value = char;
        inputs[idx].classList.add('filled');
      }
    });
    combined.value = paste;
    if (inputs[paste.length - 1]) inputs[paste.length - 1].focus();
  });
});
</script>
</body>
</html>