<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Kata Sandi - Noctura</title>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/forgot-password.css')); ?>">
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
          <div class="form-pretitle">Pemulihan Akun</div>
          <h1 class="form-title">Lupa<br><span>Kata Sandi?</span></h1>
          <p class="form-sub">
            Masukkan email terdaftar untuk menerima kode OTP pemulihan akun Anda.
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

        
        <form action="<?php echo e(route('forgot-password.send')); ?>" method="POST" novalidate autocomplete="off">
          <?php echo csrf_field(); ?>

          <div class="field-group">
            <div class="field">
              <label for="email">Alamat Email</label>

              <div class="input-wrap">
                <span class="input-icon">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                  </svg>
                </span>

                <input
                  type="email"
                  id="email"
                  name="email"
                  value="<?php echo e(old('email')); ?>"
                  placeholder="nama@email.com"
                  class="<?php echo e($errors->has('email') ? 'is-error' : ''); ?>"
                  autocomplete="new-password"
                >
              </div>

              <?php $__errorArgs = ['email'];
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
            Kirim Kode OTP
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="22" y1="2" x2="11" y2="13"/>
              <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
          </button>
        </form>

        <div class="form-note">
          Ingat kata sandi?
          <a href="<?php echo e(route('login')); ?>">Masuk di sini</a>
        </div>

      </div>
    </div>
  </div>

<script>
/* ── Canvas Particles (Bintang Putih di dalam Card Kiri) ── */
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
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\noctura\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>