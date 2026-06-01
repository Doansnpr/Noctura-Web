<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Kata Sandi - Noctura</title>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/reset-password.css')); ?>">
</head>
<body>

  
  <div class="bg-gradient"></div>

  
  <div class="login-wrapper">
    <div class="login-card form-wrap">

      
      <div class="card-left">
        <canvas id="c"></canvas>
        <img src="<?php echo e(asset('assets/img/logo-noctura.png')); ?>" alt="Noctura Logo" class="card-logo">
      </div>

      
      <div class="card-right">

        
        <div class="form-top">
          <div class="form-pretitle">Reset Kata Sandi</div>
          <h1 class="form-title">Kata Sandi<br><span>Baru</span></h1>
          <p class="form-sub">
            Masukkan kata sandi baru. Gunakan minimal 6 karakter agar akun tetap aman.
          </p>
        </div>

        
        <?php if(session('error')): ?>
          <div class="alert-error">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <?php echo e(session('error')); ?>

          </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
          <div class="alert-success">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>

        
        <form action="<?php echo e(route('forgot-password.reset.post')); ?>" method="POST" novalidate autocomplete="off">
          <?php echo csrf_field(); ?>

          <div class="field-group">

            
            <div class="field">
              <label for="password">Kata Sandi Baru</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                  </svg>
                </span>

                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Minimal 6 karakter"
                  class="<?php echo e($errors->has('password') ? 'is-error' : ''); ?>"
                  autocomplete="new-password"
                  oninput="checkStrength(this.value)"
                >

                <button class="eye-btn" onclick="togglePw('password','eye1open','eye1closed')" type="button" aria-label="Tampilkan kata sandi">
                  <svg id="eye1open" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
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

              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="field-error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="field">
              <label for="password_confirmation">Konfirmasi Kata Sandi</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                  </svg>
                </span>

                <input
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                  placeholder="Ulangi kata sandi baru"
                  class="<?php echo e($errors->has('password_confirmation') ? 'is-error' : ''); ?>"
                  autocomplete="new-password"
                >

                <button class="eye-btn" onclick="togglePw('password_confirmation','eye2open','eye2closed')" type="button" aria-label="Tampilkan konfirmasi">
                  <svg id="eye2open" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  <svg id="eye2closed" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                    <line x1="1" y1="1" x2="23" y2="23"/>
                  </svg>
                </button>
              </div>

              <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="field-error"><?php echo e($message); ?></div>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

          </div>

          <button class="btn-submit" type="submit">
            Simpan Kata Sandi Baru
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
              <polyline points="17 21 17 13 7 13 7 21"/>
              <polyline points="7 3 7 8 15 8"/>
            </svg>
          </button>
        </form>

      </div>
    </div>
  </div>

<script>
/* ── Canvas Particles ── */
(function(){
  const c = document.getElementById('c');
  if(!c) return;

  const ctx = c.getContext('2d');
  let S = [];

  function resize(){
    c.width = c.parentElement.offsetWidth;
    c.height = c.parentElement.offsetHeight;
  }

  function init(){
    resize();

    S = Array.from({length: 70}, () => ({
      x: Math.random() * c.width,
      y: Math.random() * c.height,
      r: Math.random() * 1.3 + 0.15,
      a: Math.random() * 0.6 + 0.1,
      da: (Math.random() - 0.5) * 0.003,
      vx: (Math.random() - 0.5) * 0.04,
      vy: (Math.random() - 0.5) * 0.04
    }));
  }

  function draw(){
    ctx.clearRect(0, 0, c.width, c.height);

    S.forEach(s => {
      s.a += s.da;
      s.x += s.vx;
      s.y += s.vy;

      if(s.a < 0.05 || s.a > 0.8) s.da *= -1;
      if(s.x < 0) s.x = c.width;
      if(s.x > c.width) s.x = 0;
      if(s.y < 0) s.y = c.height;
      if(s.y > c.height) s.y = 0;

      ctx.beginPath();
      ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255, 255, 255, ${s.a})`;
      ctx.fill();
    });

    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', resize);
  init();
  draw();
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
  const bars = [
    document.getElementById('bar1'),
    document.getElementById('bar2'),
    document.getElementById('bar3'),
    document.getElementById('bar4')
  ];

  if(!val){
    wrap.style.display = 'none';
    return;
  }

  wrap.style.display = 'flex';

  let score = 0;

  if(val.length >= 6) score++;
  if(val.length >= 10) score++;
  if(/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
  if(/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) score++;

  const levels = ['', 'weak', 'fair', 'good', 'strong'];
  const labels = ['', 'Lemah', 'Cukup', 'Bagus', 'Kuat'];
  const colors = {
    weak: '#fca5a5',
    fair: '#fbbf24',
    good: '#34d399',
    strong: '#10b981'
  };

  bars.forEach((bar, i) => {
    bar.style.background = i < score ? (colors[levels[score]] || '#e2e8f0') : '#e2e8f0';
  });

  lbl.textContent = labels[score] || '';
  lbl.style.color = colors[levels[score]] || '#64748b';
}
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\noctura\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>