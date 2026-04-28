<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Lupa Kata Sandi</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
:root {
  --navy: #0d1b35; --white: #ffffff; --off-white: #f5f7fa;
  --accent: #4a8ef5; --border: rgba(13,27,53,0.1);
}
body { font-family: 'DM Sans', sans-serif; min-height: 100vh; display: flex; background: var(--off-white); }
.left {
  width: 420px; flex-shrink: 0; background: var(--navy);
  display: flex; flex-direction: column; justify-content: center;
  align-items: center; padding: 60px 48px; position: relative; overflow: hidden;
}
.left::before {
  content: ''; position: absolute; width: 500px; height: 500px; border-radius: 50%;
  background: radial-gradient(circle, rgba(74,142,245,0.15) 0%, transparent 70%);
  top: -100px; left: -120px; pointer-events: none;
}
canvas { position: absolute; inset: 0; pointer-events: none; opacity: 0.6; }
.brand { position: relative; z-index: 1; text-align: center; }
.moon-wrap {
  width: 72px; height: 72px; margin: 0 auto 28px;
  background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.12);
  border-radius: 22px; display: flex; align-items: center; justify-content: center;
  backdrop-filter: blur(8px); box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}
.moon-wrap svg { width: 38px; height: 38px; filter: drop-shadow(0 0 10px rgba(255,255,255,0.4)); }
.brand-name { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #fff; letter-spacing: 0.12em; text-transform: uppercase; }
.brand-tag { font-size: 11px; letter-spacing: 0.3em; text-transform: uppercase; color: var(--accent); margin-top: 8px; }
.divider-h { width: 40px; height: 1.5px; background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent); margin: 32px auto; }
.left-copy { font-size: 13.5px; color: rgba(255,255,255,0.4); line-height: 1.7; text-align: center; max-width: 220px; }
.vline { width: 1px; background: var(--border); align-self: stretch; flex-shrink: 0; }
.right { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 50px 52px; background: var(--white); }
.form-box { width: 100%; max-width: 440px; }
.form-header { margin-bottom: 30px; padding-bottom: 26px; position: relative; }
.form-header::after { content: ''; position: absolute; bottom: 0; left: 0; width: 44px; height: 3px; background: linear-gradient(to right, var(--navy), var(--accent)); border-radius: 2px; }
.title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: var(--navy); line-height: 1.12; margin-bottom: 10px; }
.subtitle { font-size: 14px; color: #7a8fa8; line-height: 1.6; }
.alert-error { display: flex; align-items: center; gap: 10px; background: #fff5f5; border: 1.5px solid #fecaca; color: #c0392b; border-radius: 10px; padding: 12px 16px; font-size: 13px; margin-bottom: 20px; }
.alert-success { display: flex; align-items: center; gap: 10px; background: #f0fff4; border: 1.5px solid #b2f5c8; color: #1a7a3f; border-radius: 10px; padding: 12px 16px; font-size: 13px; margin-bottom: 20px; }
.field { margin-bottom: 16px; }
.field label { display: block; font-size: 11.5px; font-weight: 600; color: var(--navy); letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 9px; }
.input-wrap { position: relative; display: flex; align-items: center; }
.input-icon { position: absolute; left: 14px; color: #9fb3cc; display: flex; align-items: center; pointer-events: none; }
.input-wrap:focus-within .input-icon { color: var(--accent); }
input[type="email"] { width: 100%; padding: 13px 14px 13px 42px; border: 1.5px solid #dde4ef; border-radius: 10px; background: #f8fafd; color: var(--navy); font-family: 'DM Sans', sans-serif; font-size: 14px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
input[type="email"]:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 0 3px rgba(74,142,245,0.1); }
input.is-error { border-color: #fca5a5 !important; background: #fff5f5 !important; }
input::placeholder { color: #b8c6d9; font-size: 13.5px; }
.field-error { font-size: 11.5px; color: #e53e3e; margin-top: 6px; }
.btn-submit { width: 100%; padding: 15px; background: var(--navy); color: #fff; border: none; border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 13.5px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; cursor: pointer; transition: background 0.2s, transform 0.15s; box-shadow: 0 4px 22px rgba(13,27,53,0.28); margin-bottom: 16px; }
.btn-submit:hover { background: #1a2e55; transform: translateY(-1px); }
.back-link { text-align: center; font-size: 13px; color: #7a8fa8; }
.back-link a { color: var(--accent); font-weight: 600; text-decoration: none; }
.back-link a:hover { opacity: 0.7; }
@media (max-width: 820px) { .left, .vline { display: none; } .right { background: var(--off-white); padding: 40px 24px; } }
</style>
</head>
<body>
<div class="left">
  <canvas id="c"></canvas>
  <div class="brand">
    <div class="moon-wrap">
      <svg viewBox="0 0 38 38" fill="none"><path d="M22 6C17.6 6.9 14.3 10.8 14.3 15.5C14.3 20.9 18.6 25.2 24 25.2C26.2 25.2 28.2 24.5 29.8 23.3C28.3 27.9 24 31.2 19 31.2C12.4 31.2 7 25.8 7 19.2C7 12.6 12.4 7.2 19 7.2C20 7.2 21 7.3 22 6Z" fill="white"/></svg>
    </div>
    <div class="brand-name">Noctura</div>
    <div class="brand-tag">Sleep Intelligence</div>
    <div class="divider-h"></div>
    <div class="left-copy">Platform pemantauan kualitas tidur berbasis kecerdasan buatan</div>
  </div>
</div>
<div class="vline"></div>
<div class="right">
  <div class="form-box">
    <div class="form-header">
      <div class="title">Lupa Kata<br>Sandi?</div>
      <div class="subtitle">Masukkan email kamu, kami akan mengirimkan kode OTP untuk verifikasi.</div>
    </div>

    @if (session('error'))
      <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('forgot-password.send') }}" method="POST" novalidate autocomplete="off">
      @csrf
      <div class="field">
        <label for="email">Alamat Email</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
          </span>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="{{ $errors->has('email') ? 'is-error' : '' }}" autocomplete="new-password">
        </div>
        @error('email') <div class="field-error">{{ $message }}</div> @enderror
      </div>

      <button class="btn-submit" type="submit">Kirim Kode OTP</button>
    </form>

    <div class="back-link">
      Ingat kata sandi? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
  </div>
</div>
<script>
(function(){
  const c = document.getElementById('c'); if(!c) return;
  const ctx = c.getContext('2d'); let S = [];
  function resize(){ c.width = c.offsetWidth; c.height = c.offsetHeight; }
  function init(){ resize(); S = Array.from({length:90}, () => ({ x: Math.random()*c.width, y: Math.random()*c.height, r: Math.random()*1.2+0.2, a: Math.random()*0.7+0.1, da: (Math.random()-0.5)*0.003 })); }
  function draw(){ ctx.clearRect(0,0,c.width,c.height); S.forEach(s=>{ s.a+=s.da; if(s.a<0.05||s.a>0.8)s.da*=-1; ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2); ctx.fillStyle=`rgba(255,255,255,${s.a})`; ctx.fill(); }); requestAnimationFrame(draw); }
  window.addEventListener('resize', init); init(); draw();
})();
</script>
</body>
</html>