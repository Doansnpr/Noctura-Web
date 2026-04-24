<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noctura — Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>

<body>
    <div class="sidebar-overlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <div class="brand-icon">
                    <!-- Noctura logo scaled to 46px -->
                    <svg viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <radialGradient id="circleGrad" cx="40%" cy="35%" r="65%">
                                <stop offset="0%" stop-color="#3560d4" />
                                <stop offset="100%" stop-color="#112255" />
                            </radialGradient>
                        </defs>
                        <circle cx="23" cy="23" r="22" fill="url(#circleGrad)"
                            stroke="rgba(255,255,255,0.15)" stroke-width="1" />
                        <circle cx="24.5" cy="23" r="13.5" fill="white" />
                        <circle cx="30.5" cy="18.5" r="12.5" fill="url(#circleGrad)" />
                    </svg>
                </div>
                <span class="brand-name">Noctura</span>
            </div>
            <div class="brand-tagline">Sleep Intelligence</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main Menu</div>

            <a href="{{ route('dashboard') }}" class="nav-item active" data-nav="dashboard">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-group" id="masterDataGroup">
                <div class="nav-item master-data-trigger">
                    <div class="trigger-text">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3" />
                            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5" />
                            <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3" />
                        </svg>
                        <span>Master Data</span>
                    </div>
                    <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </div>
                <div class="sub-nav">
                    <div class="flyout-title">Master Data</div>
                    <a href="{{ route('akun') }}" class="sub-nav-item" data-sub="akun">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span>Kelola Akun</span>
                    </a>
                    <a href="{{ route('pertanyaan') }}" class="sub-nav-item" data-sub="question">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        <span>Kelola Pertanyaan</span>
                    </a>
                    <a href="{{ route('jawaban') }}" class="sub-nav-item" data-sub="answer">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        <span>Kelola Jawaban</span>
                    </a>
                    <a href="{{ route('edukasi') }}" class="sub-nav-item" data-sub="edu">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                        <span>Kelola Edukasi</span>
                    </a>
                </div>
            </div>

            <a href="" class="nav-item" data-nav="visual">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="9" width="4" height="12" rx="1" />
                    <rect x="10" y="5" width="4" height="16" rx="1" />
                    <rect x="17" y="2" width="4" height="19" rx="1" />
                </svg>
                <span>Visualisasi</span>
            </a>

            <a href="{{ route('monitoring') }}" class="nav-item {{ request()->routeIs('monitoring') ? 'active' : '' }}">
    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.07 4.93A10 10 0 1 1 4.93 19.07"/>
        <path d="M12 2v2M12 20v2M2 12h2M20 12h2"/>
    </svg>
    <span>Monitoring Prediksi</span>
</a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">DS</div>
                <div class="user-info">
                    <div class="user-name">Dr. Setiawan</div>
                    <div class="user-role">Sleep Specialist</div>
                </div>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="rgba(255,255,255,0.35)" stroke-width="2.5">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <header class="topbar">
            <button class="sidebar-toggle-btn" id="sidebarToggleBtn" title="Toggle Sidebar">
                <svg class="toggle-icon" id="toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>

            <div class="topbar-divider"></div>

            <div class="topbar-search">
                <span class="search-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                </span>
                <input type="text" placeholder="Cari sesuatu...">
            </div>

            <div class="topbar-actions">
                <div class="icon-btn">
                    <div class="notif-dot"></div>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                </div>
                <div class="icon-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                    </svg>
                </div>
            </div>
        </header>

        <main class="dashboard-body" id="mainContent">
            @yield('content')
        </main>
    </div>

    <script>
        (function() {
            const body = document.body;
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const mobileToggle = document.getElementById('mobileMenuToggle');
            const overlay = document.querySelector('.sidebar-overlay');
            const toggleIcon = document.getElementById('toggleIcon');
            const masterGroup = document.getElementById('masterDataGroup');
            const trigger = document.querySelector('.master-data-trigger');
            const subNavOriginal = masterGroup.querySelector('.sub-nav');

            // Flyout panel (cloned from sub-nav)
            let flyoutEl = null;

            function buildFlyout() {
                if (flyoutEl) return;
                flyoutEl = document.createElement('div');
                flyoutEl.className = 'sub-nav-flyout';
                flyoutEl.innerHTML = subNavOriginal.innerHTML;
                document.body.appendChild(flyoutEl);

                flyoutEl.querySelectorAll('.sub-nav-item').forEach(item => {
                    item.addEventListener('click', e => {
                        const sub = item.dataset.sub;
                        // Hapus semua active
                        document.querySelectorAll('.nav-item, .sub-nav-item').forEach(el => el.classList
                            .remove('active'));
                        // Aktifkan item yang diklik
                        item.classList.add('active');
                        const mirror = subNavOriginal.querySelector(`[data-sub="${sub}"]`);
                        if (mirror) mirror.classList.add('active');
                        closeFlyout();
                        // Tidak ada preventDefault → browser akan mengikuti href
                    });
                });
            }

            function openFlyout() {
                buildFlyout();
                const rect = trigger.getBoundingClientRect();
                const viewH = window.innerHeight;
                const flyH = 220;

                let topPos = rect.top;
                if (topPos + flyH > viewH - 16) topPos = viewH - flyH - 16;

                const arrowTop = (rect.top + rect.height / 2) - topPos - 6;

                flyoutEl.style.top = topPos + 'px';
                flyoutEl.style.setProperty('--arrow-top', arrowTop + 'px');

                requestAnimationFrame(() => {
                    flyoutEl.classList.add('visible');
                });
            }

            function closeFlyout() {
                if (!flyoutEl) return;
                flyoutEl.classList.remove('visible');
                masterGroup.classList.remove('open');
            }

            function isCollapsed() {
                return body.classList.contains('sidebar-collapsed');
            }

            function updateToggleIcon() {
                if (!toggleIcon) return;
                toggleIcon.innerHTML = isCollapsed() ?
                    `<polyline points="9 18 15 12 9 6"/>` :
                    `<polyline points="15 18 9 12 15 6"/>`;
            }

            // Initialize sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                body.classList.add('sidebar-collapsed');
            }
            updateToggleIcon();

            if (toggleBtn) {
                toggleBtn.addEventListener('click', e => {
                    e.stopPropagation();
                    closeFlyout();
                    masterGroup.classList.remove('open');
                    body.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sidebarCollapsed', isCollapsed());
                    updateToggleIcon();
                });
            }

            const closeSidebar = () => body.classList.remove('sidebar-open');
            if (mobileToggle) mobileToggle.addEventListener('click', () => body.classList.toggle('sidebar-open'));
            if (overlay) overlay.addEventListener('click', closeSidebar);

            document.addEventListener('click', e => {
                if (window.innerWidth <= 768) {
                    const sidebar = document.querySelector('.sidebar');
                    if (!sidebar.contains(e.target) && !(mobileToggle && mobileToggle.contains(e.target)) &&
                        body.classList.contains('sidebar-open')) {
                        closeSidebar();
                    }
                }
                if (flyoutEl && flyoutEl.classList.contains('visible')) {
                    if (!flyoutEl.contains(e.target) && !trigger.contains(e.target)) {
                        closeFlyout();
                    }
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) closeSidebar();
                if (flyoutEl && flyoutEl.classList.contains('visible')) openFlyout();
            });

            // Master Data trigger
            if (trigger) {
                trigger.addEventListener('click', e => {
                    e.preventDefault();
                    e.stopPropagation();

                    if (isCollapsed()) {
                        if (flyoutEl && flyoutEl.classList.contains('visible')) {
                            closeFlyout();
                        } else {
                            openFlyout();
                            masterGroup.classList.add('open');
                        }
                    } else {
                        if (flyoutEl) closeFlyout();
                        masterGroup.classList.toggle('open');
                    }
                });
            }

            // ========== ACTIVE STATE MANAGEMENT ==========
            const navItems = document.querySelectorAll('.nav-item[data-nav]');
            const subItems = document.querySelectorAll('.sub-nav-item');

            function clearActive() {
                navItems.forEach(i => i.classList.remove('active'));
                subItems.forEach(s => s.classList.remove('active'));
            }

            function setActiveFromUrl() {
                clearActive();
                const currentPath = window.location.pathname;

                // Cek sub-nav items
                let found = false;
                subItems.forEach(el => {
                    const href = el.getAttribute('href');
                    if (href && currentPath === new URL(href, window.location.origin).pathname) {
                        el.classList.add('active');
                        found = true;
                        // Jika ada di dalam sub-nav, buka group
                        if (el.closest('.sub-nav')) {
                            masterGroup.classList.add('open');
                        }
                    }
                });

                // Cek nav-item (dashboard, visualisasi, dll)
                navItems.forEach(el => {
                    const href = el.getAttribute('href');
                    if (href && currentPath === new URL(href, window.location.origin).pathname) {
                        el.classList.add('active');
                        found = true;
                    }
                });

                // Jika tidak ada yang cocok (misal halaman lain), default dashboard? Biarkan kosong.
            }

            // Event listener untuk klik manual (mencegah double active)
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    clearActive();
                    this.classList.add('active');
                });
            });

            subItems.forEach(sub => {
                sub.addEventListener('click', function() {
                    clearActive();
                    this.classList.add('active');
                });
            });

            // Set active saat halaman dimuat
            setActiveFromUrl();

            // Tangani navigasi dengan History API (jika ada)
            window.addEventListener('popstate', setActiveFromUrl);
        })();
    </script>
</body>

</html>
