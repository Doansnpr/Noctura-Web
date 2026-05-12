<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="NOCTURA — Platform sleep intelligence untuk deteksi dini gangguan tidur melalui pengalaman mobile intuitif dan dashboard web profesional.">
  <title><?php echo $__env->yieldContent('title', 'NOCTURA — Sleep Intelligence Platform'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/noctura.css')); ?>">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  
  <header class="navbar" role="banner">
    <div class="container navbar-inner">

      <a class="brand" href="#home" aria-label="NOCTURA — Beranda">
        <div class="brand-icon">
          
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="moon-logo" aria-hidden="true">
            <path d="M12 3C8.5 3 5.5 5 4 8C3.2 9.6 3 11.3 3 12C3 16.9 7.1 21 12 21C16.2 21 19.7 18.2 20.7 14.4C19.5 14.8 18.3 15 17 15C12.6 15 9 11.4 9 7C9 5.7 9.3 4.4 9.9 3.3C10.6 3.1 11.3 3 12 3Z" fill="url(#moonGrad)" stroke="rgba(150,185,255,0.4)" stroke-width=".8"/>
            <circle cx="16" cy="6" r="1.2" fill="rgba(160,200,255,0.6)"/>
            <circle cx="19" cy="9" r=".8" fill="rgba(140,185,255,0.4)"/>
            <defs>
              <linearGradient id="moonGrad" x1="3" y1="3" x2="21" y2="21" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#c8deff"/>
                <stop offset="100%" stop-color="#6690ff"/>
              </linearGradient>
            </defs>
          </svg>
        </div>
        <span class="brand-name">NOC<span>TURA</span></span>
      </a>

      <nav aria-label="Navigasi utama">
        <ul class="nav-links">
          <li><a href="#tentang">Tentang</a></li>
          <li><a href="#dashboard">Dashboard</a></li>
          <li><a href="#fitur">Fitur</a></li>
          <li><a href="#alur">Alur</a></li>
          <li><a href="#faq">FAQ</a></li>
        </ul>
      </nav>

      <div class="nav-right">
        <a class="btn btn-ghost btn-sm" href="<?php echo e(route('admin.login')); ?>">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-5.3 0-8 2.7-8 4v1h16v-1c0-1.3-2.7-4-8-4z" fill="currentColor"/>
          </svg>
          Login Admin
        </a>
        <button class="hamburger" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-nav">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>

    
    <div class="container" style="position:relative">
      <nav class="mobile-nav" id="mobile-nav" aria-label="Menu mobile">
        <a href="#tentang">Tentang</a>
        <a href="#dashboard">Dashboard</a>
        <a href="#fitur">Fitur</a>
        <a href="#alur">Alur</a>
        <a href="#faq">FAQ</a>
        <a href="<?php echo e(route('admin.login')); ?>" style="color:var(--blue-3)">Login Admin</a>
      </nav>
    </div>
  </header>

  <main id="home">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  
  <footer class="footer">
    <div class="container">
      <div class="footer-wrap">
        <div class="footer-top">
          <div>
            <div class="footer-brand">
              <div class="brand-icon" style="width:36px;height:36px">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M12 3C8.5 3 5.5 5 4 8C3.2 9.6 3 11.3 3 12C3 16.9 7.1 21 12 21C16.2 21 19.7 18.2 20.7 14.4C19.5 14.8 18.3 15 17 15C12.6 15 9 11.4 9 7C9 5.7 9.3 4.4 9.9 3.3C10.6 3.1 11.3 3 12 3Z" fill="url(#moonGradF)"/>
                  <defs><linearGradient id="moonGradF" x1="3" y1="3" x2="21" y2="21" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#c8deff"/><stop offset="100%" stop-color="#6690ff"/></linearGradient></defs>
                </svg>
              </div>
              <span class="brand-name">NOC<span>TURA</span></span>
            </div>
            <p class="footer-copy">
              <p>NOCTURA adalah sleep intelligence platform yang menghubungkan pengalaman mobile dengan dashboard web profesional — untuk edukasi, skrining awal, dan monitoring kualitas tidur yang lebih baik.</p>
            </p>
          </div>
          <div class="footer-links">
            <div>
              <h4>Platform</h4>
              <ul>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#fitur">Fitur</a></li>
              </ul>
            </div>
            <div>
              <h4>Informasi</h4>
              <ul>
                <li><a href="#alur">Alur</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="<?php echo e(route('admin.login')); ?>">Login Admin</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <span>© <?php echo e(date('Y')); ?> NOCTURA. Sleep Intelligence Platform.</span>
          <span>Skrining awal gangguan tidur, bukan pengganti diagnosis dokter.</span>
        </div>
      </div>
    </div>
  </footer>

  <script src="<?php echo e(asset('js/noctura.js')); ?>" defer></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\sleep-detection-backend\resources\views/layouts/landingpage.blade.php ENDPATH**/ ?>