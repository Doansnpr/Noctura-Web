<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Guardian AI | Noctura</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    <!-- SIDEBAR dengan Master Data Dropdown & icon dashboard baru -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <div class="brand-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff"
                        stroke-width="2.5">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                </div>
                <span class="brand-name">Noctura</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main Menu</div>

            <!-- Dashboard dengan icon rumah (home) baru -->
            <a href="#" class="nav-item active" data-nav="dashboard">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Dashboard
            </a>

            <!-- MASTER DATA GROUP dengan Dropdown -->
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
                    <a href="#" class="sub-nav-item" data-sub="user">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Manajemen Pengguna
                    </a>
                    <a href="#" class="sub-nav-item" data-sub="question">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        Manajemen Pertanyaan
                    </a>
                    <a href="#" class="sub-nav-item" data-sub="answer">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                        Manajemen Jawaban
                    </a>
                    <a href="#" class="sub-nav-item" data-sub="edu">
                        <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                        Manajemen Edukasi
                    </a>
                </div>
            </div>

            <!-- Visualisasi dengan icon bar chart (tiga persegi panjang) -->
            <a href="#" class="nav-item" data-nav="visual">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="9" width="4" height="12" rx="1" />
                    <rect x="10" y="5" width="4" height="16" rx="1" />
                    <rect x="17" y="2" width="4" height="19" rx="1" />
                </svg>
                Visualisasi
            </a>

            <a href="#" class="nav-item" data-nav="predict">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M19.07 4.93A10 10 0 1 1 4.93 19.07" />
                    <path d="M12 2v2M12 20v2M2 12h2M20 12h2" />
                </svg>
                Monotoring Prediksi
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">DS</div>
                <div class="user-info">
                    <div class="user-name">Dr. Setiawan</div>
                    <div class="user-role">Sleep Specialist</div>
                </div>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                    stroke="rgba(255,255,255,0.4)" stroke-width="2.5">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT (Topbar tanpa tabs) -->
    <div class="main-content">
        <header class="topbar">
            <div class="topbar-divider"></div>
            <div class="topbar-search">
                <span class="search-icon">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                </span>
                <input type="text" placeholder="Search">
            </div>

            <div class="topbar-actions">
                <div class="icon-btn">
                    <div class="notif-dot"></div>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                </div>
                <div class="icon-btn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                    </svg>
                </div>
            </div>
        </header>

        <main class="dashboard-body">
            <div class="section-label">Dashboard Admin</div>
            <h1 class="welcome-title">Welcome back, <span>Dr. Setiawan.</span></h1>
            <p class="welcome-subtitle">
                The Guardian AI analyzed <strong>42 new patient</strong> sleep cycles today.
                3 patients show signs of acute obstructive apnea.
            </p>

            <!-- Alert Banner -->
            <div class="alert-banner">
                <div class="alert-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.2">
                        <path
                            d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                </div>
                <div class="alert-text">
                    <div class="alert-title">3 Patients Need Immediate Attention</div>
                    <div class="alert-desc">Cluster A — Severe obstructive apnea detected. Circadian disruption index
                        above threshold.</div>
                </div>
                <button class="alert-action">View Patients →</button>
            </div>

            <!-- Main Grid -->
            <div class="grid-main">
                <div class="card">
                    <div class="risk-card-header">
                        <div>
                            <div class="card-label">Risk Profile</div>
                            <div class="card-sublabel">Patient Population</div>
                        </div>
                        <div class="risk-badge">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                        </div>
                    </div>
                    <div class="donut-wrap">
                        <svg class="donut-svg" viewBox="0 0 134 134">
                            <circle class="donut-track" cx="67" cy="67" r="52" />
                            <circle class="donut-apnea" cx="67" cy="67" r="52" />
                            <circle class="donut-insomnia" cx="67" cy="67" r="52" />
                            <circle class="donut-hypersomnia" cx="67" cy="67" r="52" />
                        </svg>
                        <div class="donut-center">
                            <div class="donut-number">142</div>
                            <div class="donut-text">Total Cases</div>
                        </div>
                    </div>
                    <div class="legend-list">
                        <div class="legend-item">
                            <div class="legend-left">
                                <div class="legend-dot" style="background:var(--navy-600)"></div>Obstructive Apnea
                            </div>
                            <div class="legend-pct">64%</div>
                        </div>
                        <div class="legend-item">
                            <div class="legend-left">
                                <div class="legend-dot" style="background:var(--accent-teal)"></div>Insomnia
                            </div>
                            <div class="legend-pct">22%</div>
                        </div>
                        <div class="legend-item">
                            <div class="legend-left">
                                <div class="legend-dot" style="background:var(--accent-amber)"></div>Hypersomnia
                            </div>
                            <div class="legend-pct">14%</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="ai-card-tag">
                        <div class="pulse-dot"></div>AI Diagnostic Summary
                    </div>
                    <div class="ai-card-inner">
                        <div>
                            <div class="ai-title">Deep Sleep Analysis (Week 12)</div>
                            <p class="ai-desc">Analysis reveals a consistent <strong>15% decline</strong> in REM cycles
                                across the elderly demographic in Cluster A. Circadian disruption correlates strongly
                                with local humidity peaks.</p>
                            <a class="ai-link" href="#">View Full Intelligence Report <svg width="14"
                                    height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg></a>
                        </div>
                        <div class="mini-chart">
                            <div class="chart-label">REM CYCLE</div>
                            <div class="bar" style="height:32%"></div>
                            <div class="bar hi" style="height:58%"></div>
                            <div class="bar" style="height:42%"></div>
                            <div class="bar hi" style="height:78%"></div>
                            <div class="bar" style="height:50%"></div>
                            <div class="bar" style="height:65%"></div>
                            <div class="bar" style="height:35%"></div>
                            <div class="bar hi" style="height:85%"></div>
                            <div class="bar" style="height:45%"></div>
                            <div class="bar" style="height:60%"></div>
                            <div class="bar" style="height:28%"></div>
                            <div class="bar hi" style="height:72%"></div>
                            <div class="bar" style="height:55%"></div>
                            <div class="bar" style="height:40%"></div>
                            <div class="bar hi" style="height:90%"></div>
                            <div class="bar" style="height:33%"></div>
                            <div class="bar" style="height:62%"></div>
                            <div class="bar" style="height:48%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-bottom">
                <div class="card">
                    <div class="stat-corner" style="background:var(--accent-green)"></div>
                    <div class="stat-label">Accuracy Rate</div>
                    <div class="stat-value green">98.4<span class="stat-suffix">%</span></div><span
                        class="stat-badge up"><svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3">
                            <path d="M12 19V5M5 12l7-7 7 7" />
                        </svg>+2.1% this week</span>
                    <div class="stat-divider"></div>
                    <div class="stat-desc">vs. last week average — model performance stable</div>
                </div>
                <div class="card">
                    <div class="stat-corner" style="background:var(--navy-500)"></div>
                    <div class="stat-label">Processing Load</div>
                    <div class="stat-value navy">1.2<span class="stat-suffix">s</span></div><span
                        class="stat-badge info">latency</span>
                    <div class="stat-divider"></div>
                    <div class="stat-desc">Average model inference time per patient record</div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Dropdown toggle Master Data
        const masterGroup = document.getElementById('masterDataGroup');
        const trigger = document.querySelector('.master-data-trigger');
        if (trigger) {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                masterGroup.classList.toggle('open');
            });
        }

        // Active state management untuk semua nav items (sidebar utama & submenu)
        const navItems = document.querySelectorAll('.nav-item[data-nav]');
        const subItems = document.querySelectorAll('.sub-nav-item');

        function setActive(activeElement, isSub = false) {
            navItems.forEach(item => item.classList.remove('active'));
            subItems.forEach(sub => sub.classList.remove('active'));
            if (isSub) {
                activeElement.classList.add('active');
            } else {
                activeElement.classList.add('active');
            }
        }

        navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                setActive(item, false);
            });
        });

        subItems.forEach(sub => {
            sub.addEventListener('click', (e) => {
                e.preventDefault();
                setActive(sub, true);
            });
        });

        // Default aktif dashboard
        const defaultDash = document.querySelector('.nav-item[data-nav="dashboard"]');
        if (defaultDash && !defaultDash.classList.contains('active')) {
            navItems.forEach(item => item.classList.remove('active'));
            defaultDash.classList.add('active');
        }
    </script>
</body>

</html>
