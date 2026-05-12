<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Kata Sandi - Noctura</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
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
      <p class="form-sub">Masukkan kata sandi baru. Pastikan minimal 6 karakter.</p>
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