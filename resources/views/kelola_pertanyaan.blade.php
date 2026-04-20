<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Noctura — Kelola Pertanyaan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/kelola_pertanyaan.css') }}">
</head>
<body>
<div class="sidebar-overlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-logo">
      <div class="brand-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg></div>
      <span class="brand-name">Noctura</span>
    </div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main Menu</div>
    <a href="#" class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Dashboard</span>
    </a>
    <div class="nav-group open" id="masterDataGroup">
      <div class="nav-item master-data-trigger">
        <div class="trigger-text">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/></svg>
          <span>Master Data</span>
        </div>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="sub-nav">
        <a href="#" class="sub-nav-item"><svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg><span>Kelola Akun</span></a>
        <a href="#" class="sub-nav-item active"><svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><span>Kelola Pertanyaan</span></a>
        <a href="#" class="sub-nav-item"><svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><span>Kelola Jawaban</span></a>
        <a href="#" class="sub-nav-item"><svg class="sub-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg><span>Kelola Edukasi</span></a>
      </div>
    </div>
    <a href="#" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="9" width="4" height="12" rx="1"/><rect x="10" y="5" width="4" height="16" rx="1"/><rect x="17" y="2" width="4" height="19" rx="1"/></svg><span>Visualisasi</span></a>
    <a href="#" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 1 4.93 19.07"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg><span>Monitoring Prediksi</span></a>
  </nav>
  <div class="sidebar-footer">
    <div class="user-pill">
      <div class="user-avatar">DS</div>
      <div class="user-info"><div class="user-name">Dr. Setiawan</div><div class="user-role">Sleep Specialist</div></div>
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
    </div>
  </div>
</aside>

<!-- MAIN -->
<div class="main-content">
  <header class="topbar">
    <button class="sidebar-toggle-btn" id="sidebarToggleBtn">
      <svg class="toggle-icon" id="toggleIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <div class="topbar-divider"></div>
    <div class="topbar-search">
      <span class="search-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg></span>
      <input type="text" id="searchInput" placeholder="Cari pertanyaan..." oninput="renderTable()">
    </div>
    <div class="topbar-actions">
      <div class="icon-btn"><div class="notif-dot"></div><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></div>
      <div class="icon-btn"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div>
    </div>
  </header>

  <main class="page-body">
    <div class="section-label">Master Data / Kelola Pertanyaan</div>
    <h1 class="page-title">Manajemen <span>Pertanyaan</span></h1>
    <p class="page-subtitle">Kelola daftar pertanyaan asesmen gangguan tidur untuk fitur prediksi. Setiap pertanyaan merepresentasikan satu fitur input model machine learning.</p>

    <div class="stats-bar">
      <div class="stat-card" style="animation-delay:.04s"><div class="sc-corner" style="background:var(--navy-500)"></div><div class="stat-label">Total Pertanyaan</div><div class="stat-val" id="sTotal">9</div><div class="stat-sub">Semua variabel</div></div>
      <div class="stat-card" style="animation-delay:.09s"><div class="sc-corner" style="background:var(--accent-green)"></div><div class="stat-label">Aktif</div><div class="stat-val" id="sAktif" style="color:var(--accent-green)">9</div><div class="stat-sub">Digunakan prediksi</div></div>
      <div class="stat-card" style="animation-delay:.14s"><div class="sc-corner" style="background:var(--accent-amber)"></div><div class="stat-label">Tipe Select</div><div class="stat-val" id="sSelect" style="color:var(--accent-amber)">3</div><div class="stat-sub">Pilihan opsi</div></div>
      <div class="stat-card" style="animation-delay:.19s"><div class="sc-corner" style="background:var(--accent-teal)"></div><div class="stat-label">Tipe Range</div><div class="stat-val" id="sRange" style="color:var(--accent-teal)">6</div><div class="stat-sub">Input angka</div></div>
    </div>

    <div class="card">
      <div class="toolbar">
        <div class="toolbar-left">
          <span class="toolbar-title">Daftar Pertanyaan</span>
          <span class="count-badge" id="countBadge">9 pertanyaan</span>
        </div>
        <div class="toolbar-right">
            <select class="filter-select" id="filterType" onchange="renderTable()">
                <option value="">Semua Tipe</option>
                <option value="select">Select</option>
                <option value="range">Range</option>
            </select>
            <button class="btn btn-primary" onclick="openAdd()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Tambah Pertanyaan
            </button>
            </div>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
                <th style="width:44px">#</th>
                <th>Pertanyaan / Variabel</th>
                <th>Tipe Input</th>
                <th>Opsi / Range</th>
                <th style="width:72px">Urutan</th>
                <th style="width:96px">Aksi</th>
            </tr>
            </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>

      <!-- STRESS LEVEL PANEL -->
      <div class="stress-panel">
        <div class="sp-title">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
          Detail Deskripsi Stress Level (1 – 10)
        </div>
        <div class="sp-sub">Setiap angka memiliki keterangan kondisi stres yang ditampilkan kepada pengguna saat mengisi asesmen.</div>
        <div class="stress-grid">
          <div class="sl-card"><div class="sl-num c1">1</div><div class="sl-title c1">Sangat Tenang</div><div class="sl-desc">Tidak mudah kepikiran, pikiran jernih dan rileks sepenuhnya.</div></div>
          <div class="sl-card"><div class="sl-num c2">2</div><div class="sl-title c2">Tenang</div><div class="sl-desc">Hampir tidak ada beban pikiran, kondisi santai dan nyaman.</div></div>
          <div class="sl-card"><div class="sl-num c3">3</div><div class="sl-title c3">Ringan</div><div class="sl-desc">Sedikit tekanan namun masih mudah dikelola dan tidak mengganggu.</div></div>
          <div class="sl-card"><div class="sl-num c4">4</div><div class="sl-title c4">Cukup Ringan</div><div class="sl-desc">Ada beberapa pikiran mengganjal namun masih bisa fokus beraktivitas.</div></div>
          <div class="sl-card"><div class="sl-num c5">5</div><div class="sl-title c5">Sedang</div><div class="sl-desc">Stres mulai terasa, ada tekanan dari pekerjaan atau tanggung jawab.</div></div>
          <div class="sl-card"><div class="sl-num c6">6</div><div class="sl-title c6">Cukup Tinggi</div><div class="sl-desc">Sering merasa cemas, konsentrasi terganggu dan mudah lelah mental.</div></div>
          <div class="sl-card"><div class="sl-num c7">7</div><div class="sl-title c7">Tinggi</div><div class="sl-desc">Sulit rileks, pikiran berputar terus dan tidur mulai terganggu.</div></div>
          <div class="sl-card"><div class="sl-num c8">8</div><div class="sl-title c8">Sangat Tinggi</div><div class="sl-desc">Tertekan berat, mood tidak stabil, sering panik atau kewalahan.</div></div>
          <div class="sl-card"><div class="sl-num c9">9</div><div class="sl-title c9">Kritis</div><div class="sl-desc">Hampir tidak bisa berfungsi normal, kecemasan ekstrem dan burnout.</div></div>
          <div class="sl-card"><div class="sl-num c10">10</div><div class="sl-title c10">Ekstrem</div><div class="sl-desc">Stres tertinggi, tidak mampu mengendalikan emosi, butuh bantuan segera.</div></div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- MODAL TAMBAH/EDIT -->
<div class="modal-bg" id="modalBg">
  <div class="modal-box">
    <div class="modal-head">
      <div><div class="modal-title" id="modalTitle">Tambah Pertanyaan</div><div class="modal-sub">Isi detail variabel untuk fitur prediksi gangguan tidur</div></div>
      <button class="modal-close" onclick="closeModal()"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
    </div>
    <input type="hidden" id="editId">
    <div class="f-row col2">
      <div class="f-group"><label class="f-label">Nama Variabel <span class="req">*</span></label><input class="f-input" id="fName" placeholder="cth: Sleep Duration"></div>
      <div class="f-group"><label class="f-label">Urutan <span class="req">*</span></label><input type="number" class="f-input" id="fOrder" placeholder="1 – 99" min="1"></div>
    </div>
    <div class="f-row col1">
      <div class="f-group"><label class="f-label">Teks Pertanyaan <span class="req">*</span></label><input class="f-input" id="fQuestion" placeholder="cth: Berapa jam rata-rata Anda tidur per malam?"></div>
    </div>
    <div class="f-row col1">
      <div class="f-group"><label class="f-label">Deskripsi / Keterangan</label><textarea class="f-textarea" id="fDesc" placeholder="Penjelasan tambahan untuk pengguna..."></textarea></div>
    </div>
    <div class="f-row col1">
      <div class="f-group"><label class="f-label">Tipe Input <span class="req">*</span></label>
        <select class="f-select" id="fType" onchange="toggleFields()">
          <option value="">-- Pilih Tipe --</option>
          <option value="select">Select (Pilihan)</option>
          <option value="range">Range (Angka)</option>
        </select>
      </div>
    </div>
    <!-- range -->
    <div class="f-row col2 range-fields" id="rangeFields">
      <div class="f-group"><label class="f-label">Nilai Minimum</label><input type="number" class="f-input" id="fMin" placeholder="0"><span class="f-hint">Nilai terkecil</span></div>
      <div class="f-group"><label class="f-label">Nilai Maksimum</label><input type="number" class="f-input" id="fMax" placeholder="100"><span class="f-hint">Nilai terbesar</span></div>
    </div>
    <div class="f-row col1 range-fields" id="rangeUnit">
      <div class="f-group"><label class="f-label">Satuan</label><input class="f-input" id="fUnit" placeholder="cth: jam, menit, langkah"><span class="f-hint">Satuan ditampilkan di samping angka</span></div>
    </div>
    <!-- select -->
    <div class="f-row col1 select-fields" id="selectFields">
      <div class="f-group"><label class="f-label">Opsi Pilihan</label><textarea class="f-textarea" id="fOptions" placeholder="Tulis satu opsi per baris&#10;cth:&#10;Male&#10;Female" style="min-height:90px"></textarea><span class="f-hint">Satu opsi per baris</span></div>
    </div>
    <!-- stress desc -->
    <div class="f-row col1 stress-desc-fields" id="stressDescFields">
      <div class="f-group">
        <label class="f-label">Deskripsi Per Level Stres <span style="font-weight:400;color:var(--text-muted)">(opsional)</span></label>
        <div class="stress-level-grid">
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-green)">Lv 1</div><textarea id="sl1" placeholder="Tidak mudah kepikiran..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-green)">Lv 2</div><textarea id="sl2" placeholder="Hampir tidak ada beban..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-green)">Lv 3</div><textarea id="sl3" placeholder="Sedikit tekanan..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:#65a30d">Lv 4</div><textarea id="sl4" placeholder="Ada pikiran mengganjal..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-amber)">Lv 5</div><textarea id="sl5" placeholder="Stres mulai terasa..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:#f97316">Lv 6</div><textarea id="sl6" placeholder="Sering merasa cemas..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-red)">Lv 7</div><textarea id="sl7" placeholder="Sulit rileks..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:var(--accent-red)">Lv 8</div><textarea id="sl8" placeholder="Tertekan berat..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:#dc2626">Lv 9</div><textarea id="sl9" placeholder="Hampir tidak bisa..."></textarea></div>
          <div class="slg-item"><div class="slg-label" style="color:#dc2626">Lv 10</div><textarea id="sl10" placeholder="Stres tertinggi..."></textarea></div>
        </div>
        <span class="f-hint" style="margin-top:6px;display:block">Isi jika variabel ini adalah Stress Level</span>
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal()">Batal</button>
      <button class="btn btn-primary" onclick="saveQuestion()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Pertanyaan
      </button>
    </div>
  </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal-bg" id="delModalBg">
  <div class="del-modal-box">
    <div class="del-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg></div>
    <div class="del-title">Hapus Pertanyaan?</div>
    <div class="del-desc">Pertanyaan <strong id="delName"></strong> akan dihapus permanen dan tidak bisa dikembalikan.</div>
    <div class="del-actions">
      <button class="btn btn-ghost" onclick="closeDelModal()">Batal</button>
      <button class="btn btn-danger" onclick="confirmDelete()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg>
        Ya, Hapus
      </button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <div class="t-icon" id="tIcon"></div>
  <span id="tMsg"></span>
</div>

<script>
let questions = [
  {id:1,name:'Gender',question:'Apa jenis kelamin Anda?',desc:'Jenis kelamin pengguna',type:'select',opts:'Male\nFemale',min:'',max:'',unit:'',status:'Aktif',order:1},
  {id:2,name:'Age',question:'Berapa usia Anda saat ini?',desc:'Usia pengguna dalam tahun',type:'range',opts:'',min:'18',max:'90',unit:'tahun',status:'Aktif',order:2},
  {id:3,name:'Occupation',question:'Apa pekerjaan / profesi Anda?',desc:'Pekerjaan utama pengguna',type:'select',opts:'Doctor\nEngineer\nTeacher\nNurse\nAccountant\nLawyer\nSales Representative\nScientist\nSoftware Engineer\nManager',min:'',max:'',unit:'',status:'Aktif',order:3},
  {id:4,name:'Sleep Duration',question:'Berapa rata-rata durasi tidur Anda per malam?',desc:'Jumlah jam tidur per malam',type:'range',opts:'',min:'1',max:'12',unit:'jam',status:'Aktif',order:4},
  {id:5,name:'Quality of Sleep',question:'Bagaimana kualitas tidur Anda secara keseluruhan?',desc:'Penilaian subjektif kualitas tidur 1–10',type:'range',opts:'',min:'1',max:'10',unit:'',status:'Aktif',order:5},
  {id:6,name:'Physical Activity Level',question:'Berapa menit Anda beraktivitas fisik per hari?',desc:'Durasi aktivitas fisik harian',type:'range',opts:'',min:'0',max:'120',unit:'menit/hari',status:'Aktif',order:6},
  {id:7,name:'Stress Level',question:'Seberapa tinggi tingkat stres Anda saat ini?',desc:'Tingkat stres harian dengan deskripsi tiap level',type:'range',opts:'',min:'1',max:'10',unit:'',status:'Aktif',order:7},
  {id:8,name:'BMI Category',question:'Masuk kategori manakah indeks massa tubuh Anda?',desc:'Kategori BMI berdasarkan berat dan tinggi badan',type:'select',opts:'Underweight\nNormal Weight\nOverweight\nObese',min:'',max:'',unit:'',status:'Aktif',order:8},
  {id:9,name:'Steps',question:'Berapa rata-rata langkah kaki Anda per hari?',desc:'Jumlah langkah kaki harian',type:'range',opts:'',min:'0',max:'25000',unit:'langkah',status:'Aktif',order:9},
];
let nextId = 10, deleteTarget = null;

function renderTable(){
  const search = document.getElementById('searchInput').value.toLowerCase();
  const fType  = document.getElementById('filterType').value;

  const filtered = questions.filter(q =>
    (q.name.toLowerCase().includes(search) || q.question.toLowerCase().includes(search)) &&
    (fType ? q.type===fType : true)
  );

  document.getElementById('countBadge').textContent = filtered.length+' pertanyaan';
  document.getElementById('sTotal').textContent  = questions.length;
  document.getElementById('sAktif').textContent  = questions.filter(q=>q.status==='Aktif').length;
  document.getElementById('sSelect').textContent = questions.filter(q=>q.type==='select').length;
  document.getElementById('sRange').textContent  = questions.filter(q=>q.type==='range').length;

  const tbody = document.getElementById('tableBody');
  if(!filtered.length){
    tbody.innerHTML=`<tr><td colspan="6" style="text-align:center;padding:36px;color:var(--text-muted);font-size:13px">Tidak ada pertanyaan yang ditemukan.</td></tr>`;
    return;
  }

  tbody.innerHTML = filtered.map(q=>{
    const badge = q.type==='select'
      ? `<span class="type-badge badge-select"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>Select</span>`
      : `<span class="type-badge badge-range"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><circle cx="8" cy="12" r="2" fill="currentColor"/></svg>Range</span>`;

    const opts = q.type==='select'
      ? (q.opts.split('\n').slice(0,3).join(', ')+(q.opts.split('\n').length>3?', ...':''))
      : `${q.min} – ${q.max}${q.unit?' '+q.unit:''}`;
    return `<tr>
      <td><span class="q-no">${String(q.order).padStart(2,'0')}</span></td>
      <td><div class="q-name">${q.name}</div><div class="q-desc">${q.question}</div></td>
      <td>${badge}</td>
      <td><span style="font-size:12px;color:var(--text-muted)">${opts}</span></td>
      <td><span class="ord-num">${String(q.order).padStart(2,'0')}</span></td>
      <td><div class="act-btns">
        <button class="act-btn" title="Edit" onclick="openEdit(${q.id})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4Z"/></svg>
        </button>
        <button class="act-btn del" title="Hapus" onclick="openDelete(${q.id})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        </button>
      </div></td>
    </tr>`;
  }).join('');
}

function openAdd(){
  document.getElementById('modalTitle').textContent='Tambah Pertanyaan';
  document.getElementById('editId').value='';
  clearForm();
  document.getElementById('modalBg').classList.add('open');
}
function openEdit(id){
  const q=questions.find(x=>x.id===id); if(!q) return;
  document.getElementById('modalTitle').textContent='Edit Pertanyaan';
  document.getElementById('editId').value=id;
  document.getElementById('fName').value=q.name;
  document.getElementById('fOrder').value=q.order;
  document.getElementById('fQuestion').value=q.question;
  document.getElementById('fDesc').value=q.desc;
  document.getElementById('fType').value=q.type;
  document.getElementById('fMin').value=q.min;
  document.getElementById('fMax').value=q.max;
  document.getElementById('fUnit').value=q.unit;
  document.getElementById('fOptions').value=q.opts;
  toggleFields();
  document.getElementById('modalBg').classList.add('open');
}
function closeModal(){ document.getElementById('modalBg').classList.remove('open'); }
function clearForm(){
  ['fName','fOrder','fQuestion','fDesc','fMin','fMax','fUnit','fOptions'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('fType').value='';
  for(let i=1;i<=10;i++) document.getElementById('sl'+i).value='';
  toggleFields();
}
function toggleFields(){
  const t=document.getElementById('fType').value;
  document.querySelectorAll('.range-fields').forEach(el=>el.style.display=t==='range'?'grid':'none');
  document.querySelectorAll('.select-fields').forEach(el=>el.style.display=t==='select'?'grid':'none');
  document.querySelectorAll('.stress-desc-fields').forEach(el=>el.style.display=t==='range'?'grid':'none');
}
function saveQuestion(){
  const name=document.getElementById('fName').value.trim();
  const order=parseInt(document.getElementById('fOrder').value);
  const question=document.getElementById('fQuestion').value.trim();
  const desc=document.getElementById('fDesc').value.trim();
  const type=document.getElementById('fType').value;
  const min=document.getElementById('fMin').value;
  const max=document.getElementById('fMax').value;
  const unit=document.getElementById('fUnit').value.trim();
  const opts=document.getElementById('fOptions').value.trim();

  if(!name||!order||!question||!type){
    showToast('Harap isi semua field wajib!',false);
    return;
  }

  const eid=document.getElementById('editId').value;
  if(eid){
    const idx=questions.findIndex(x=>x.id===parseInt(eid));
    if(idx>-1) questions[idx]={...questions[idx],name,order,question,desc,type,min,max,unit,opts};
    showToast('Pertanyaan berhasil diperbarui!',true);
  } else {
    questions.push({id:nextId++,name,order,question,desc,type,min,max,unit,opts,status:'Aktif'});
    showToast('Pertanyaan berhasil ditambahkan!',true);
  }

  questions.sort((a,b)=>a.order-b.order);
  closeModal();
  renderTable();
}
function openDelete(id){
  const q=questions.find(x=>x.id===id); if(!q) return;
  deleteTarget=id;
  document.getElementById('delName').textContent=q.name;
  document.getElementById('delModalBg').classList.add('open');
}
function closeDelModal(){ document.getElementById('delModalBg').classList.remove('open'); deleteTarget=null; }
function confirmDelete(){
  if(deleteTarget===null) return;
  const q=questions.find(x=>x.id===deleteTarget);
  questions=questions.filter(x=>x.id!==deleteTarget);
  closeDelModal(); renderTable();
  showToast('"'+q.name+'" berhasil dihapus.',true);
}
function showToast(msg,ok){
  const t=document.getElementById('toast'),i=document.getElementById('tIcon');
  document.getElementById('tMsg').textContent=msg;
  i.className='t-icon '+(ok?'t-green':'t-red');
  i.innerHTML=ok
    ? `<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>`
    : `<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M18 6L6 18M6 6l12 12"/></svg>`;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),3000);
}

// sidebar
(function(){
  const body=document.body;
  const toggleBtn=document.getElementById('sidebarToggleBtn');
  const mobileToggle=document.getElementById('mobileMenuToggle');
  const overlay=document.querySelector('.sidebar-overlay');
  const icon=document.getElementById('toggleIcon');
  function updIcon(){icon.innerHTML=body.classList.contains('sidebar-collapsed')?'<polyline points="9 18 15 12 9 6"/>' :'<polyline points="15 18 9 12 15 6"/>';}
  if(localStorage.getItem('sidebarCollapsed')==='true') body.classList.add('sidebar-collapsed');
  updIcon();
  toggleBtn.addEventListener('click',e=>{e.stopPropagation();body.classList.toggle('sidebar-collapsed');localStorage.setItem('sidebarCollapsed',body.classList.contains('sidebar-collapsed'));updIcon();});
  mobileToggle.addEventListener('click',()=>body.classList.toggle('sidebar-open'));
  overlay.addEventListener('click',()=>body.classList.remove('sidebar-open'));
  window.addEventListener('resize',()=>{if(window.innerWidth>768)body.classList.remove('sidebar-open');});
  document.querySelector('.master-data-trigger').addEventListener('click',e=>{e.preventDefault();e.stopPropagation();document.getElementById('masterDataGroup').classList.toggle('open');});
  document.getElementById('modalBg').addEventListener('click',e=>{if(e.target===e.currentTarget)closeModal();});
  document.getElementById('delModalBg').addEventListener('click',e=>{if(e.target===e.currentTarget)closeDelModal();});
})();

renderTable();
</script>
</body>
</html>