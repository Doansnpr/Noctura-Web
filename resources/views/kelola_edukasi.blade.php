<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Kelola Edukasi</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/kelola_edukasi.css') }}">
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
    <a href="#" class="nav-item" id="menuDashboard">
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
        <a href="kelola-akun.html" class="sub-nav-item">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <span>Kelola Akun</span>
        </a>
        <a href="#" class="sub-nav-item" id="menuKelolaPertanyaan">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
          <span>Kelola Pertanyaan</span>
        </a>
        <a href="#" class="sub-nav-item" id="menuKelolaJawaban">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
          </svg>
          <span>Kelola Jawaban</span>
        </a>
        <a href="kelola-edukasi.html" class="sub-nav-item active">
          <svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
          </svg>
          <span>Kelola Edukasi</span>
        </a>
      </div>
    </div>
    <a href="#" class="nav-item" id="menuVisualisasi">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="9" width="4" height="12" rx="1"/>
        <rect x="10" y="5" width="4" height="16" rx="1"/>
        <rect x="17" y="2" width="4" height="19" rx="1"/>
      </svg>
      <span>Visualisasi</span>
    </a>
    <a href="#" class="nav-item" id="menuMonitoring">
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
      <svg class="toggle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
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
          <circle cx="11" cy="11" r="8"/>
          <path d="m21 21-4.35-4.35"/>
        </svg>
      </span>
      <input type="text" id="searchInput" placeholder="Cari edukasi...">
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

  <main class="page-body" id="mainContent">
    <!-- Konten akan diisi oleh JavaScript -->
  </main>
</div>

<!-- MODAL TAMBAH/EDIT EDUKASI -->
<div class="modal-bg" id="edukasiFormModalBg">
  <div class="modal-box">
    <div class="modal-head">
      <div>
        <div class="modal-title" id="edukasiFormTitle">Tambah Edukasi</div>
        <div class="modal-sub">Isi materi edukasi berdasarkan kategori hasil prediksi</div>
      </div>
      <button class="modal-close" id="closeEdukasiFormBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <input type="hidden" id="editEdukasiId">
    <div class="f-row col1">
      <div class="f-group">
        <label class="f-label">Kategori <span class="req">*</span></label>
        <select class="f-select" id="edukasiKategori">
          <option value="">Pilih Kategori</option>
          <option value="Healthy">🌿 Healthy (Tidur Sehat)</option>
          <option value="Insomnia">🌙 Insomnia (Susah Tidur)</option>
          <option value="Sleep Apnea">😴 Sleep Apnea (Henti Napas)</option>
        </select>
      </div>
    </div>
    <div class="f-row col1">
      <div class="f-group">
        <label class="f-label">Judul Edukasi <span class="req">*</span></label>
        <input class="f-input" id="edukasiJudul" placeholder="Contoh: Tips Tidur Berkualitas">
      </div>
    </div>
    <div class="f-row col1">
      <div class="f-group">
        <label class="f-label">Konten / Materi <span class="req">*</span></label>
        <textarea class="f-input" id="edukasiKonten" rows="5" placeholder="Tulis materi edukasi di sini..."></textarea>
      </div>
    </div>
    <div class="f-row col1">
      <div class="f-group">
        <label class="f-label">Sumber / Referensi</label>
        <input class="f-input" id="edukasiSumber" placeholder="Contoh: Kemenkes, WHO, American Sleep Association">
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" id="batalEdukasiFormBtn">Batal</button>
      <button class="btn btn-primary" id="simpanEdukasiBtn">Simpan Edukasi</button>
    </div>
  </div>
</div>

<!-- MODAL DETAIL EDUKASI -->
<div class="modal-bg" id="edukasiModalBg">
  <div class="modal-box" style="max-width: 700px;">
    <div class="modal-head">
      <div>
        <div class="modal-title" id="edukasiModalTitle">Detail Edukasi</div>
        <div class="modal-sub" id="edukasiModalSub">Berdasarkan hasil prediksi</div>
      </div>
      <button class="modal-close" id="closeEdukasiModalBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <div id="edukasiDetailContent"></div>
    <div class="modal-foot">
      <button class="btn btn-primary" id="tutupEdukasiModalBtn">Tutup</button>
    </div>
  </div>
</div>

<!-- MODAL HAPUS EDUKASI -->
<div class="modal-bg" id="delEdukasiModalBg">
  <div class="del-modal-box">
    <div class="del-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="3 6 5 6 21 6"/>
        <path d="M19 6l-1 14H6L5 6"/>
        <path d="M10 11v6M14 11v6"/>
        <path d="M9 6V4h6v2"/>
      </svg>
    </div>
    <div class="del-title">Hapus Edukasi?</div>
    <div class="del-desc">Edukasi "<strong id="delEdukasiName"></strong>" akan dihapus permanen.</div>
    <div class="del-actions">
      <button class="btn btn-ghost" id="batalDelEdukasiBtn">Batal</button>
      <button class="btn btn-danger" id="confirmDelEdukasiBtn">Ya, Hapus</button>
    </div>
  </div>
</div>

<div class="toast" id="toast">
  <div class="t-icon" id="tIcon"></div>
  <span id="tMsg"></span>
</div>

<script>
// ==================== DATA EDUKASI (HANYA 3, SESUAI KATEGORI) ====================
let edukasiList = [
  {
    id: 1, 
    kategori: 'Healthy', 
    judul: '🌿 Panduan Tidur Sehat', 
    konten: 'Tidur yang berkualitas adalah kunci kesehatan optimal. Berikut tips untuk menjaga kesehatan tidur Anda:\n\n1. Tidur 7-9 jam setiap malam secara teratur\n2. Usahakan tidur dan bangun di jam yang sama setiap hari\n3. Hindari kafein dan alkohol 6 jam sebelum tidur\n4. Matikan layar gadget 1 jam sebelum tidur\n5. Ciptakan lingkungan tidur yang gelap, sejuk, dan tenang\n6. Lakukan relaksasi seperti meditasi atau pernapasan dalam\n\nDengan menerapkan kebiasaan ini, kualitas tidur Anda akan meningkat dan tubuh menjadi lebih sehat!', 
    sumber: 'American Sleep Association'
  },
  {
    id: 2, 
    kategori: 'Insomnia', 
    judul: '🌙 Mengatasi Insomnia', 
    konten: 'Insomnia adalah kesulitan tidur yang dapat mempengaruhi kesehatan. Berikut cara mengatasinya:\n\n1. Terapi Perilaku Kognitif (CBT-I) - terapi paling efektif untuk insomnia\n2. Batasi waktu di tempat tidur hanya untuk tidur\n3. Jangan memaksakan diri tidur jika tidak mengantuk\n4. Hindari tidur siang lebih dari 30 menit\n5. Lakukan teknik relaksasi seperti meditasi atau yoga\n6. Konsultasikan dengan dokter jika insomnia berlanjut\n\nIngat, insomnia bisa diatasi dengan pendekatan yang tepat dan konsisten!', 
    sumber: 'Sleep Foundation'
  },
  {
    id: 3, 
    kategori: 'Sleep Apnea', 
    judul: '😴 Mengenal dan Menangani Sleep Apnea', 
    konten: 'Sleep apnea adalah gangguan tidur serius di mana pernapasan berhenti sementara saat tidur. Gejala dan penanganannya:\n\nGejala yang perlu diwaspadai:\n• Mendengkur keras\n• Terengah-engah atau tersedak saat tidur\n• Sakit kepala di pagi hari\n• Mengantuk berlebihan di siang hari\n\nPenanganan Sleep Apnea:\n1. CPAP (Continuous Positive Airway Pressure) - terapi utama\n2. Perubahan gaya hidup: menurunkan berat badan\n3. Tidur miring, bukan telentang\n4. Hindari alkohol dan obat penenang\n5. Konsultasi ke dokter spesialis tidur\n\nSleep apnea dapat dikelola dengan baik jika ditangani sejak dini!', 
    sumber: 'Mayo Clinic'
  }
];
let deleteEdukasiTarget = null;

// ==================== UTILITY ====================
function showToast(msg, ok) {
  const toast = document.getElementById('toast');
  const icon = document.getElementById('tIcon');
  const msgSpan = document.getElementById('tMsg');
  msgSpan.textContent = msg;
  icon.className = 't-icon ' + (ok ? 't-green' : 't-red');
  icon.innerHTML = ok ? '✓' : '✕';
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 2500);
}

// ==================== RENDER HALAMAN EDUKASI ====================
function renderEdukasiPage() {
  const mainContent = document.getElementById('mainContent');
  mainContent.innerHTML = `
    <div class="section-label">Master Data / Kelola Edukasi</div>
    <h1 class="page-title">Manajemen <span>Edukasi</span></h1>
    <p class="page-subtitle">Kelola materi edukasi berdasarkan hasil prediksi: Healthy (Tidur Sehat), Insomnia (Susah Tidur), dan Sleep Apnea (Henti Napas). Edukasi akan direkomendasikan secara otomatis sesuai hasil diagnosis pasien.</p>

    <div class="stats-bar">
      <div class="stat-card">
        <div class="stat-label">Total Edukasi</div>
        <div class="stat-val" id="totalEdukasi">0</div>
        <div class="stat-sub">Semua materi</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">🌿 Healthy</div>
        <div class="stat-val" id="totalHealthy" style="color:var(--accent-green)">0</div>
        <div class="stat-sub">Tidur sehat</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">🌙 Insomnia</div>
        <div class="stat-val" id="totalInsomnia" style="color:var(--accent-amber)">0</div>
        <div class="stat-sub">Susah tidur</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">😴 Sleep Apnea</div>
        <div class="stat-val" id="totalSleepApnea" style="color:var(--accent-red)">0</div>
        <div class="stat-sub">Henti napas</div>
      </div>
    </div>

    <div class="card">
      <div class="toolbar">
        <div class="toolbar-left">
          <span class="toolbar-title">Daftar Edukasi</span>
          <span class="count-badge" id="edukasiCountBadge">0 edukasi</span>
        </div>
        <div class="toolbar-right">
          <select class="filter-select" id="filterKategori">
            <option value="">Semua Kategori</option>
            <option value="Healthy">🌿 Healthy</option>
            <option value="Insomnia">🌙 Insomnia</option>
            <option value="Sleep Apnea">😴 Sleep Apnea</option>
          </select>
          <button class="btn btn-primary" id="tambahEdukasiBtn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Edukasi
          </button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Edukasi</th>
              <th>Kategori</th>
              <th>Sumber</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="edukasiTableBody"></tbody>
        </table>
      </div>
    </div>
  `;

  document.getElementById('tambahEdukasiBtn').addEventListener('click', () => bukaFormEdukasi(false));
  document.getElementById('filterKategori').addEventListener('change', renderEdukasiTable);
  document.getElementById('searchInput').addEventListener('input', renderEdukasiTable);
  
  renderEdukasiTable();
}

function renderEdukasiTable() {
  const search = document.getElementById('searchInput')?.value.toLowerCase() || '';
  const filterKategori = document.getElementById('filterKategori')?.value || '';

  let filtered = edukasiList.filter(e => {
    const matchSearch = e.judul.toLowerCase().includes(search) || e.konten.toLowerCase().includes(search);
    const matchKategori = filterKategori === '' || e.kategori === filterKategori;
    return matchSearch && matchKategori;
  });

  document.getElementById('edukasiCountBadge').textContent = filtered.length + ' edukasi';
  document.getElementById('totalEdukasi').textContent = edukasiList.length;
  document.getElementById('totalHealthy').textContent = edukasiList.filter(e => e.kategori === 'Healthy').length;
  document.getElementById('totalInsomnia').textContent = edukasiList.filter(e => e.kategori === 'Insomnia').length;
  document.getElementById('totalSleepApnea').textContent = edukasiList.filter(e => e.kategori === 'Sleep Apnea').length;

  const tbody = document.getElementById('edukasiTableBody');
  if (!filtered.length) {
    tbody.innerHTML = `
      <tr>
        <td colspan="5" style="text-align:center;padding:40px;">
          📚 Tidak ada data edukasi.
        </td>
      </tr>
    `;
    return;
  }

  tbody.innerHTML = filtered.map((e, idx) => {
    const kategoriBadge = e.kategori === 'Healthy' 
      ? '<span style="background:#dcfce7;color:#166534;padding:4px 11px;border-radius:20px;font-size:11px;font-weight:600;">🌿 Healthy</span>'
      : e.kategori === 'Insomnia' 
      ? '<span style="background:#fef3c7;color:#92400e;padding:4px 11px;border-radius:20px;font-size:11px;font-weight:600;">🌙 Insomnia</span>'
      : '<span style="background:#fed7aa;color:#9a3412;padding:4px 11px;border-radius:20px;font-size:11px;font-weight:600;">😴 Sleep Apnea</span>';
    
    return `
      <tr>
        <td>${idx+1}</td>
        <td><strong>${e.judul}</strong><br><small style="color:var(--text-muted);">${e.konten.substring(0, 80)}${e.konten.length > 80 ? '...' : ''}</small></td>
        <td>${kategoriBadge}</td>
        <td>${e.sumber || '-'}</td>
        <td>
          <div class="action-buttons">
            <button class="btn-icon btn-icon-edit" onclick="lihatDetailEdukasi(${e.id})">👁️</button>
            <button class="btn-icon btn-icon-edit" onclick="editEdukasi(${e.id})">✏️</button>
            <button class="btn-icon btn-icon-delete" onclick="hapusEdukasi(${e.id})">🗑️</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

// ==================== CRUD EDUKASI ====================
function bukaFormEdukasi(isEdit = false, data = null) {
  const modal = document.getElementById('edukasiFormModalBg');
  const title = document.getElementById('edukasiFormTitle');
  const editId = document.getElementById('editEdukasiId');
  const kategori = document.getElementById('edukasiKategori');
  const judul = document.getElementById('edukasiJudul');
  const konten = document.getElementById('edukasiKonten');
  const sumber = document.getElementById('edukasiSumber');

  if (isEdit && data) {
    title.textContent = '✏️ Edit Edukasi';
    editId.value = data.id;
    kategori.value = data.kategori;
    judul.value = data.judul;
    konten.value = data.konten;
    sumber.value = data.sumber || '';
  } else {
    title.textContent = '➕ Tambah Edukasi';
    editId.value = '';
    kategori.value = '';
    judul.value = '';
    konten.value = '';
    sumber.value = '';
  }
  modal.classList.add('open');
}

function tutupFormEdukasi() {
  document.getElementById('edukasiFormModalBg').classList.remove('open');
}

function simpanEdukasi() {
  const editId = document.getElementById('editEdukasiId').value;
  const kategori = document.getElementById('edukasiKategori').value;
  const judul = document.getElementById('edukasiJudul').value.trim();
  const konten = document.getElementById('edukasiKonten').value.trim();
  const sumber = document.getElementById('edukasiSumber').value.trim();

  if (!kategori || !judul || !konten) {
    showToast('❌ Harap isi semua field wajib!', false);
    return;
  }

  // Cek apakah kategori sudah ada (karena hanya boleh 1 per kategori)
  const kategoriExists = edukasiList.some(e => e.kategori === kategori && (editId ? e.id != parseInt(editId) : true));
  if (kategoriExists) {
    showToast(`❌ Kategori ${kategori} sudah memiliki edukasi! Hanya boleh 1 edukasi per kategori.`, false);
    return;
  }

  if (editId) {
    const idx = edukasiList.findIndex(e => e.id === parseInt(editId));
    if (idx !== -1) {
      edukasiList[idx] = { ...edukasiList[idx], kategori, judul, konten, sumber: sumber || '-' };
      showToast('✅ Edukasi berhasil diupdate!', true);
    }
  } else {
    // Generate ID baru
    const newId = Math.max(...edukasiList.map(e => e.id), 0) + 1;
    edukasiList.push({ id: newId, kategori, judul, konten, sumber: sumber || '-' });
    showToast('✅ Edukasi berhasil ditambahkan!', true);
  }
  tutupFormEdukasi();
  renderEdukasiTable();
}

function editEdukasi(id) {
  const data = edukasiList.find(e => e.id === id);
  if (data) bukaFormEdukasi(true, data);
}

function hapusEdukasi(id) {
  const data = edukasiList.find(e => e.id === id);
  if (data) {
    deleteEdukasiTarget = id;
    document.getElementById('delEdukasiName').textContent = data.judul;
    document.getElementById('delEdukasiModalBg').classList.add('open');
  }
}

function tutupDelEdukasiModal() {
  document.getElementById('delEdukasiModalBg').classList.remove('open');
  deleteEdukasiTarget = null;
}

function konfirmasiHapusEdukasi() {
  if (deleteEdukasiTarget !== null) {
    const data = edukasiList.find(e => e.id === deleteEdukasiTarget);
    edukasiList = edukasiList.filter(e => e.id !== deleteEdukasiTarget);
    showToast(`✅ "${data.judul}" berhasil dihapus`, true);
    tutupDelEdukasiModal();
    renderEdukasiTable();
  }
}

function lihatDetailEdukasi(id) {
  const data = edukasiList.find(e => e.id === id);
  if (!data) return;
  const kategoriIcon = data.kategori === 'Healthy' ? '🌿' : data.kategori === 'Insomnia' ? '🌙' : '😴';
  document.getElementById('edukasiModalTitle').textContent = `${kategoriIcon} ${data.judul}`;
  document.getElementById('edukasiModalSub').textContent = `Kategori: ${data.kategori}`;
  document.getElementById('edukasiDetailContent').innerHTML = `
    <div class="edu-detail-content">
      <strong>📖 Materi Edukasi:</strong>
      <p style="margin-top:10px;line-height:1.7;white-space:pre-line;">${data.konten}</p>
    </div>
    ${data.sumber && data.sumber !== '-' ? `<div class="edu-sumber">📚 Sumber: ${data.sumber}</div>` : ''}
    <div style="font-size:12px;color:var(--text-muted);margin-top:12px;">🆔 ID: ${data.id}</div>
  `;
  document.getElementById('edukasiModalBg').classList.add('open');
}

function tutupModalEdukasi() {
  document.getElementById('edukasiModalBg').classList.remove('open');
}

// ==================== FUNGSI UNTUK DIPANGGIL SAAT PREDIKSI ====================
// Fungsi ini akan menampilkan edukasi berdasarkan hasil prediksi
function getEdukasiByPrediction(hasilPrediksi) {
  // hasilPrediksi bisa berupa: 'Healthy', 'Insomnia', atau 'Sleep Apnea'
  const edukasi = edukasiList.find(e => e.kategori === hasilPrediksi);
  if (edukasi) {
    // Tampilkan modal edukasi
    lihatDetailEdukasi(edukasi.id);
    return edukasi;
  } else {
    showToast('⚠️ Belum ada edukasi untuk kategori ini. Silakan tambahkan terlebih dahulu.', false);
    return null;
  }
}

// Contoh penggunaan: panggil fungsi ini setelah prediksi selesai
// getEdukasiByPrediction('Insomnia');

// ==================== SIDEBAR TOGGLE ====================
(function() {
  const body = document.body;
  const toggleBtn = document.getElementById('sidebarToggleBtn');
  const mobileToggle = document.getElementById('mobileMenuToggle');
  const overlay = document.querySelector('.sidebar-overlay');
  const icon = document.querySelector('.toggle-icon');

  function updIcon() {
    if(icon) icon.innerHTML = body.classList.contains('sidebar-collapsed') 
      ? '<polyline points="9 18 15 12 9 6"/>' 
      : '<polyline points="15 18 9 12 15 6"/>';
  }

  if(localStorage.getItem('sidebarCollapsed') === 'true') body.classList.add('sidebar-collapsed');
  updIcon();

  if(toggleBtn) {
    toggleBtn.addEventListener('click', e => {
      e.stopPropagation();
      body.classList.toggle('sidebar-collapsed');
      localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
      updIcon();
    });
  }

  if(mobileToggle) {
    mobileToggle.addEventListener('click', () => body.classList.toggle('sidebar-open'));
  }

  if(overlay) {
    overlay.addEventListener('click', () => body.classList.remove('sidebar-open'));
  }

  window.addEventListener('resize', () => {
    if(window.innerWidth > 768) body.classList.remove('sidebar-open');
  });

  const masterTrigger = document.querySelector('.master-data-trigger');
  if(masterTrigger) {
    masterTrigger.addEventListener('click', e => {
      e.preventDefault();
      e.stopPropagation();
      document.getElementById('masterDataGroup').classList.toggle('open');
    });
  }

  document.getElementById('closeEdukasiFormBtn').addEventListener('click', tutupFormEdukasi);
  document.getElementById('batalEdukasiFormBtn').addEventListener('click', tutupFormEdukasi);
  document.getElementById('simpanEdukasiBtn').addEventListener('click', simpanEdukasi);
  document.getElementById('closeEdukasiModalBtn').addEventListener('click', tutupModalEdukasi);
  document.getElementById('tutupEdukasiModalBtn').addEventListener('click', tutupModalEdukasi);
  document.getElementById('batalDelEdukasiBtn').addEventListener('click', tutupDelEdukasiModal);
  document.getElementById('confirmDelEdukasiBtn').addEventListener('click', konfirmasiHapusEdukasi);
  document.getElementById('edukasiFormModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupFormEdukasi();
  });
  document.getElementById('edukasiModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupModalEdukasi();
  });
  document.getElementById('delEdukasiModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupDelEdukasiModal();
  });
})();

// Render halaman awal
renderEdukasiPage();
</script>
</body>
</html>