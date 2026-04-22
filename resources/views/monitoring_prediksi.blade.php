<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Monitoring Prediksi</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/monitoring_prediksi.css') }}">
</head>
<body>
<div class="sidebar-overlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-logo">
      <div class="brand-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </div>
      <span class="brand-name">Noctura</span>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main Menu</div>
    <a href="#" class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      <span>Dashboard</span>
    </a>

    <div class="nav-group open" id="masterDataGroup">
      <div class="nav-item master-data-trigger">
        <div class="trigger-text">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <ellipse cx="12" cy="5" rx="9" ry="3"/>
            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
            <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
          </svg>
          <span>Master Data</span>
        </div>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M9 18l6-6-6-6"/>
        </svg>
      </div>
      <div class="sub-nav">
        <a href="#" class="sub-nav-item">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
          <span>Kelola Akun</span>
        </a>
        <a href="#" class="sub-nav-item">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
          <span>Kelola Pertanyaan</span>
        </a>
        <a href="#" class="sub-nav-item">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          <span>Kelola Jawaban</span>
        </a>
        <a href="#" class="sub-nav-item">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
          </svg>
          <span>Kelola Edukasi</span>
        </a>
      </div>
    </div>

    <a href="#" class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="9" width="4" height="12" rx="1"/>
        <rect x="10" y="5" width="4" height="16" rx="1"/>
        <rect x="17" y="2" width="4" height="19" rx="1"/>
      </svg>
      <span>Visualisasi</span>
    </a>

    <a href="#" class="nav-item active">
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
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="2.5">
        <path d="M9 18l6-6-6-6"/>
      </svg>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="main-content">
  <header class="topbar">
    <button class="sidebar-toggle-btn" id="sidebarToggleBtn">
      <svg class="toggle-icon" id="toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
    </button>
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <div class="topbar-divider"></div>
    <div class="topbar-search">
      <span class="search-icon">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
      </span>
      <input type="text" id="searchInput" placeholder="Cari nama pengguna..." oninput="renderTable()">
    </div>
    <div class="topbar-actions">
      <div class="icon-btn">
        <div class="notif-dot"></div>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
      </div>
      <div class="icon-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>
    </div>
  </header>

  <main class="page-body">
    <div class="section-label">Monitoring Prediksi</div>
    <h1 class="page-title">Monitoring <span>Prediksi</span></h1>
    <p class="page-subtitle">Pantau seluruh riwayat hasil prediksi gangguan tidur pengguna. Klik tombol Detail untuk melihat lengkap input fitur tiap prediksi.</p>

    <!-- STATS BAR -->
    <div class="stats-bar">
      <div class="stat-card" style="animation-delay:.04s">
        <div class="sc-corner" style="background:var(--navy-500)"></div>
        <div class="stat-label">Total Prediksi</div>
        <div class="stat-val" id="sTotal">0</div>
        <div class="stat-sub">Semua data</div>
      </div>
      <div class="stat-card" style="animation-delay:.09s">
        <div class="sc-corner" style="background:#be123c"></div>
        <div class="stat-label">Insomnia</div>
        <div class="stat-val" id="sInsomnia" style="color:#be123c">0</div>
        <div class="stat-sub">Terdeteksi</div>
      </div>
      <div class="stat-card" style="animation-delay:.14s">
        <div class="sc-corner" style="background:#c2410c"></div>
        <div class="stat-label">Sleep Apnea</div>
        <div class="stat-val" id="sApnea" style="color:#c2410c">0</div>
        <div class="stat-sub">Terdeteksi</div>
      </div>
      <div class="stat-card" style="animation-delay:.19s">
        <div class="sc-corner" style="background:var(--accent-green)"></div>
        <div class="stat-label">Normal</div>
        <div class="stat-val" id="sNormal" style="color:var(--accent-green)">0</div>
        <div class="stat-sub">Tidak ada gangguan</div>
      </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card">
      <div class="toolbar">
        <div class="toolbar-left">
          <span class="toolbar-title">Riwayat Prediksi</span>
          <span class="count-badge" id="countBadge">0 data</span>
        </div>
        <div class="toolbar-right">
          <select class="filter-select" id="filterResult" onchange="renderTable()">
            <option value="">Semua Hasil</option>
            <option value="Insomnia">Insomnia</option>
            <option value="Sleep Apnea">Sleep Apnea</option>
            <option value="Normal">Normal</option>
          </select>
        </div>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width:48px">No</th>
              <th>Nama Pengguna</th>
              <th>Tanggal</th>
              <th>Hasil Prediksi</th>
              <th style="width:96px">Aksi</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- MODAL DETAIL -->
<div class="modal-bg" id="detailModal">
  <div class="modal-box">
    <div class="modal-head">
      <div>
        <div class="modal-title" id="modalUserName">Nama Pengguna</div>
        <div class="modal-sub">Tanggal prediksi: <span id="modalDate"></span></div>
      </div>
      <button class="modal-close" onclick="closeDetail()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Result Hero -->
    <div class="modal-result-hero" id="resultHero">
      <div class="hero-icon" id="heroIconWrap"></div>
      <div>
        <div class="hero-label">Hasil Prediksi</div>
        <div class="hero-result" id="heroResult"></div>
      </div>
    </div>

    <!-- Feature Grid -->
    <div class="feat-section-title">Input Fitur (9 Variabel)</div>
    <div class="feat-grid" id="featGrid"></div>

    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeDetail()">Tutup</button>
    </div>
  </div>
</div>

<script src="monitoring_prediksi.js"></script>
</body>
</html>