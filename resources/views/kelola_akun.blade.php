<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Kelola Akun</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/kelola_akun.css') }}">
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
        <a href="kelola-akun.html" class="sub-nav-item active">
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
        <a href="kelola-edukasi.html" class="sub-nav-item">
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
      <input type="text" id="searchInput" placeholder="Cari akun...">
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

<!-- MODAL TAMBAH/EDIT AKUN -->
<div class="modal-bg" id="modalBg">
  <div class="modal-box">
    <div class="modal-head">
      <div>
        <div class="modal-title" id="modalTitle">Tambah Akun</div>
        <div class="modal-sub">Isi informasi akun baru untuk sistem Noctura</div>
      </div>
      <button class="modal-close" id="closeModalBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <input type="hidden" id="editId">
    <div class="f-row col2">
      <div class="f-group">
        <label class="f-label">Nama Lengkap <span class="req">*</span></label>
        <input class="f-input" id="fName" placeholder="cth: Dr. Andi Wijaya">
      </div>
      <div class="f-group">
        <label class="f-label">Role <span class="req">*</span></label>
        <select class="f-select" id="fRole">
          <option value="">-- Pilih Role --</option>
          <option value="Admin">Admin</option>
          <option value="Pengguna">Pengguna</option>
        </select>
      </div>
    </div>
    <div class="f-row col1">
      <div class="f-group">
        <label class="f-label">Email <span class="req">*</span></label>
        <input class="f-input" id="fEmail" type="email" placeholder="cth: andi@noctura.id">
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" id="batalModalBtn">Batal</button>
      <button class="btn btn-primary" id="simpanModalBtn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/>
          <polyline points="17 21 17 13 7 13 7 21"/>
          <polyline points="7 3 7 8 15 8"/>
        </svg>
        Simpan Akun
      </button>
    </div>
  </div>
</div>

<!-- MODAL HAPUS AKUN -->
<div class="modal-bg" id="delModalBg">
  <div class="del-modal-box">
    <div class="del-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="3 6 5 6 21 6"/>
        <path d="M19 6l-1 14H6L5 6"/>
        <path d="M10 11v6M14 11v6"/>
        <path d="M9 6V4h6v2"/>
      </svg>
    </div>
    <div class="del-title">Hapus Akun?</div>
    <div class="del-desc">Akun <strong id="delName"></strong> akan dihapus permanen dan tidak bisa dikembalikan.</div>
    <div class="del-actions">
      <button class="btn btn-ghost" id="batalDelBtn">Batal</button>
      <button class="btn btn-danger" id="confirmDelBtn">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="3 6 5 6 21 6"/>
        </svg>
        Ya, Hapus
      </button>
    </div>
  </div>
</div>

<div class="toast" id="toast">
  <div class="t-icon" id="tIcon"></div>
  <span id="tMsg"></span>
</div>

<script>
// ==================== DATA AKUN ====================
let accounts = [
  {id:1, name:'Dr. Setiawan', email:'setiawan@noctura.id', role:'Admin', createdAt: new Date('2024-01-10')},
  {id:2, name:'Rina Kartika', email:'rina@noctura.id', role:'Admin', createdAt: new Date('2024-02-14')},
  {id:3, name:'Budi Santoso', email:'budi@noctura.id', role:'Pengguna', createdAt: new Date('2024-03-05')},
  {id:4, name:'Siti Rahma', email:'siti.rahma@noctura.id', role:'Pengguna', createdAt: new Date('2024-04-22')},
  {id:5, name:'Agus Prasetyo', email:'agus@noctura.id', role:'Pengguna', createdAt: new Date('2024-05-18')},
  {id:6, name:'Dewi Lestari', email:'dewi@noctura.id', role:'Pengguna', createdAt: new Date('2024-06-30')},
  {id:7, name:'Hendra Kurniawan', email:'hendra@noctura.id', role:'Pengguna', createdAt: new Date('2024-07-11')},
  {id:8, name:'Nurul Fadhilah', email:'nurul@noctura.id', role:'Pengguna', createdAt: new Date('2026-04-02')},
];
let nextId = 9;
let deleteTarget = null;

// ==================== UTILITY ====================
function getInitials(name) {
  return name.split(' ').map(w=>w[0]).slice(0,2).join('').toUpperCase();
}

function getAvatarColor(name) {
  const colors = ['av-blue','av-teal','av-green','av-purple','av-amber','av-red'];
  let hash = 0;
  for(let i=0; i<name.length; i++) hash += name.charCodeAt(i);
  return colors[hash % colors.length];
}

function formatDate(d) {
  const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

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

// ==================== RENDER HALAMAN AKUN ====================
function renderAkunPage() {
  const mainContent = document.getElementById('mainContent');
  mainContent.innerHTML = `
    <div class="section-label">Master Data / Kelola Akun</div>
    <h1 class="page-title">Manajemen <span>Akun</span></h1>
    <p class="page-subtitle">Kelola daftar akun pengguna dan administrator sistem Noctura. Atur hak akses dan informasi akun setiap pengguna terdaftar.</p>

    <div class="stats-bar">
      <div class="stat-card">
        <div class="stat-label">Total Akun</div>
        <div class="stat-val" id="sTotal">0</div>
        <div class="stat-sub">Semua pengguna</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Admin</div>
        <div class="stat-val" id="sAdmin" style="color:var(--accent-purple)">0</div>
        <div class="stat-sub">Hak akses penuh</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Pengguna</div>
        <div class="stat-val" id="sUser" style="color:var(--accent-teal)">0</div>
        <div class="stat-sub">Akun reguler</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Terdaftar Bulan Ini</div>
        <div class="stat-val" id="sNew" style="color:var(--accent-green)">0</div>
        <div class="stat-sub">Pendaftaran terbaru</div>
      </div>
    </div>

    <div class="card">
      <div class="toolbar">
        <div class="toolbar-left">
          <span class="toolbar-title">Daftar Akun</span>
          <span class="count-badge" id="countBadge">0 akun</span>
        </div>
        <div class="toolbar-right">
          <select class="filter-select" id="filterRole">
            <option value="">Semua Role</option>
            <option value="Admin">Admin</option>
            <option value="Pengguna">Pengguna</option>
          </select>
          <button class="btn btn-primary" id="btnTambah">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Akun
          </button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Akun</th>
              <th>Role</th>
              <th>Email</th>
              <th>Terdaftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  `;

  document.getElementById('btnTambah').addEventListener('click', openAdd);
  document.getElementById('filterRole').addEventListener('change', renderTableAkun);
  document.getElementById('searchInput').addEventListener('input', renderTableAkun);
  
  renderTableAkun();
}

function renderTableAkun() {
  const search = document.getElementById('searchInput')?.value.toLowerCase() || '';
  const filterRole = document.getElementById('filterRole')?.value || '';
  const now = new Date();
  const thisMonth = now.getMonth();
  const thisYear = now.getFullYear();

  const filtered = accounts.filter(a =>
    (a.name.toLowerCase().includes(search) || a.email.toLowerCase().includes(search)) &&
    (filterRole ? a.role === filterRole : true)
  );

  document.getElementById('countBadge').textContent = filtered.length + ' akun';
  document.getElementById('sTotal').textContent = accounts.length;
  document.getElementById('sAdmin').textContent = accounts.filter(a => a.role === 'Admin').length;
  document.getElementById('sUser').textContent = accounts.filter(a => a.role === 'Pengguna').length;
  document.getElementById('sNew').textContent = accounts.filter(a => a.createdAt.getMonth() === thisMonth && a.createdAt.getFullYear() === thisYear).length;

  const tbody = document.getElementById('tableBody');
  if (!filtered.length) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:36px;color:var(--text-muted);">📭 Tidak ada akun yang ditemukan.</td></tr>`;
    return;
  }

  tbody.innerHTML = filtered.map((a, i) => {
    const badge = a.role === 'Admin' 
      ? '<span class="role-badge badge-admin">⭐ Admin</span>'
      : '<span class="role-badge badge-user">👤 Pengguna</span>';
    return `
      <tr>
        <td>${i+1}</td>
        <td>
          <div class="name-cell">
            <div class="avatar ${getAvatarColor(a.name)}">${getInitials(a.name)}</div>
            <div><div class="acc-name">${a.name}</div></div>
          </div>
        </td>
        <td>${badge}</td>
        <td>${a.email}</td>
        <td>${formatDate(a.createdAt)}</td>
        <td>
          <div class="action-buttons">
            <button class="btn-icon btn-icon-edit" onclick="openEdit(${a.id})">✏️</button>
            <button class="btn-icon btn-icon-delete" onclick="openDelete(${a.id})">🗑️</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

// ==================== CRUD AKUN ====================
function openAdd() {
  document.getElementById('editId').value = '';
  document.getElementById('fName').value = '';
  document.getElementById('fEmail').value = '';
  document.getElementById('fRole').value = '';
  document.getElementById('modalTitle').textContent = 'Tambah Akun';
  document.getElementById('modalBg').classList.add('open');
}

function openEdit(id) {
  const a = accounts.find(x => x.id === id);
  if(!a) return;
  document.getElementById('editId').value = id;
  document.getElementById('fName').value = a.name;
  document.getElementById('fEmail').value = a.email;
  document.getElementById('fRole').value = a.role;
  document.getElementById('modalTitle').textContent = 'Edit Akun';
  document.getElementById('modalBg').classList.add('open');
}

function closeModal() {
  document.getElementById('modalBg').classList.remove('open');
}

function saveAccount() {
  const name = document.getElementById('fName').value.trim();
  const email = document.getElementById('fEmail').value.trim();
  const role = document.getElementById('fRole').value;
  const eid = document.getElementById('editId').value;

  if(!name || !email || !role) {
    showToast('❌ Harap isi semua field!', false);
    return;
  }

  if(eid) {
    const idx = accounts.findIndex(x => x.id === parseInt(eid));
    if(idx > -1) accounts[idx] = {...accounts[idx], name, email, role};
    showToast('✅ Akun berhasil diperbarui!', true);
  } else {
    accounts.push({id: nextId++, name, email, role, createdAt: new Date()});
    showToast('✅ Akun berhasil ditambahkan!', true);
  }
  closeModal();
  renderTableAkun();
}

function openDelete(id) {
  const a = accounts.find(x => x.id === id);
  if(!a) return;
  deleteTarget = id;
  document.getElementById('delName').textContent = a.name;
  document.getElementById('delModalBg').classList.add('open');
}

function closeDelModal() {
  document.getElementById('delModalBg').classList.remove('open');
  deleteTarget = null;
}

function confirmDelete() {
  if(deleteTarget === null) return;
  const a = accounts.find(x => x.id === deleteTarget);
  accounts = accounts.filter(x => x.id !== deleteTarget);
  closeDelModal();
  renderTableAkun();
  showToast(`✅ "${a.name}" berhasil dihapus.`, true);
}

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

  document.getElementById('modalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) closeModal();
  });
  document.getElementById('delModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) closeDelModal();
  });
  document.getElementById('closeModalBtn').addEventListener('click', closeModal);
  document.getElementById('batalModalBtn').addEventListener('click', closeModal);
  document.getElementById('simpanModalBtn').addEventListener('click', saveAccount);
  document.getElementById('batalDelBtn').addEventListener('click', closeDelModal);
  document.getElementById('confirmDelBtn').addEventListener('click', confirmDelete);
})();

// Render halaman awal
renderAkunPage();
</script>
</body>
</html>