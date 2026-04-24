@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_pertanyaan.css') }}">

<div class="kelola-pertanyaan-container">
    <div class="section-label">Master Data / Kelola Pertanyaan</div>
    <h1 class="page-title">Manajemen <span>Pertanyaan</span></h1>
    <p class="page-subtitle">Kelola daftar pertanyaan asesmen gangguan tidur untuk fitur prediksi. Setiap pertanyaan merepresentasikan satu fitur input model machine learning.</p>

    <div class="stats-bar">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#eef3fd;color:var(--navy-500)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            </div>
            <div class="stat-label">Total Pertanyaan</div>
            <div class="stat-val" id="sTotal">0</div>
            <div class="stat-sub">Semua variabel</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#ecfdf5;color:var(--accent-green)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <div class="stat-label">Aktif</div>
            <div class="stat-val" id="sAktif" style="color:var(--accent-green)">0</div>
            <div class="stat-sub">Digunakan prediksi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#fffbeb;color:var(--accent-amber)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
            </div>
            <div class="stat-label">Tipe Select</div>
            <div class="stat-val" id="sSelect" style="color:var(--accent-amber)">0</div>
            <div class="stat-sub">Pilihan opsi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#ecfeff;color:var(--accent-teal)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="stat-label">Tipe Range</div>
            <div class="stat-val" id="sRange" style="color:var(--accent-teal)">0</div>
            <div class="stat-sub">Input angka</div>
        </div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Pertanyaan</span>
                <span class="count-badge" id="countBadge">0 pertanyaan</span>
            </div>
            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari pertanyaan..." class="search-input">
                </div>
                <select class="filter-select" id="filterType">
                    <option value="">Semua Tipe</option>
                    <option value="select">Select</option>
                    <option value="range">Range</option>
                </select>
                <button class="btn btn-primary" id="btnTambah">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Pertanyaan
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Pertanyaan / Variabel</th>
                        <th style="width:120px">Tipe</th>
                        <th style="width:110px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Stress Level Panel -->
        <div class="stress-panel">
            <div class="sp-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                Detail Deskripsi Stress Level (1 – 10)
            </div>
            <div class="sp-sub">Setiap angka memiliki keterangan kondisi stres yang ditampilkan kepada pengguna saat mengisi asesmen.</div>
            <div class="stress-grid" id="stressLevelGrid"></div>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="modalTitle">Tambah Pertanyaan</div>
                <div class="modal-sub">Isi detail variabel untuk fitur prediksi</div>
            </div>
            <button class="modal-close" id="closeModalBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <input type="hidden" id="editId">
        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Nama Variabel <span class="req">*</span></label>
                <input class="f-input" id="fName" placeholder="cth: Sleep Duration">
            </div>
        </div>
        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Teks Pertanyaan <span class="req">*</span></label>
                <input class="f-input" id="fQuestion" placeholder="cth: Berapa jam rata-rata Anda tidur?">
            </div>
        </div>
        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Deskripsi / Keterangan</label>
                <textarea class="f-textarea" id="fDesc" placeholder="Penjelasan tambahan..."></textarea>
            </div>
        </div>
        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Tipe Input <span class="req">*</span></label>
                <select class="f-select" id="fType">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="select">Select (Pilihan)</option>
                    <option value="range">Range (Angka)</option>
                </select>
            </div>
        </div>
        <div class="f-row col2 range-fields" id="rangeFields" style="display:none">
            <div class="f-group">
                <label class="f-label">Nilai Minimum</label>
                <input type="number" class="f-input" id="fMin" placeholder="0">
            </div>
            <div class="f-group">
                <label class="f-label">Nilai Maksimum</label>
                <input type="number" class="f-input" id="fMax" placeholder="100">
            </div>
        </div>
        <div class="f-row col1 range-fields" id="rangeUnit" style="display:none">
            <div class="f-group">
                <label class="f-label">Satuan</label>
                <input class="f-input" id="fUnit" placeholder="cth: jam">
            </div>
        </div>
        <div class="f-row col1 select-fields" id="selectFields" style="display:none">
            <div class="f-group">
                <label class="f-label">Opsi Pilihan</label>
                <textarea class="f-textarea" id="fOptions" placeholder="Satu opsi per baris&#10;cth:&#10;Male&#10;Female"></textarea>
                <span class="f-hint">Tulis satu opsi per baris</span>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-ghost" id="batalModalBtn">Batal</button>
            <button class="btn btn-primary" id="simpanModalBtn">Simpan Pertanyaan</button>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal-bg" id="delModalBg">
    <div class="del-modal-box">
        <div class="del-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        </div>
        <div class="del-title">Hapus Pertanyaan?</div>
        <div class="del-desc">Pertanyaan <strong id="delName"></strong> akan dihapus permanen.</div>
        <div class="del-actions">
            <button class="btn btn-ghost" id="batalDelBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDelBtn">Hapus</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// ============ DATA ============
const stressLevels = [
    {num:1,  cls:'c1',  title:'Sangat Tenang',    desc:'Tidak ada tekanan. Pikiran jernih dan rileks sepenuhnya.'},
    {num:2,  cls:'c2',  title:'Tenang',           desc:'Sedikit aktivitas mental, tubuh santai dan nyaman.'},
    {num:3,  cls:'c3',  title:'Ringan',           desc:'Ada sedikit beban pikiran namun masih terkontrol.'},
    {num:4,  cls:'c4',  title:'Cukup Ringan',     desc:'Tekanan mulai terasa, namun mudah diatasi.'},
    {num:5,  cls:'c5',  title:'Sedang',           desc:'Stres moderat. Mulai mempengaruhi konsentrasi.'},
    {num:6,  cls:'c6',  title:'Cukup Tinggi',     desc:'Ketegangan terasa jelas. Perlu perhatian ekstra.'},
    {num:7,  cls:'c7',  title:'Tinggi',           desc:'Stres signifikan. Mempengaruhi tidur dan mood.'},
    {num:8,  cls:'c8',  title:'Sangat Tinggi',    desc:'Hampir melebihi kapasitas. Butuh intervensi.'},
    {num:9,  cls:'c9',  title:'Kritis',           desc:'Stres berat. Risiko burnout dan masalah kesehatan.'},
    {num:10, cls:'c10', title:'Ekstrem',          desc:'Level tertinggi. Sangat berbahaya bagi kesehatan.'},
];

let questions = [
    {id:1, name:'Gender', question:'Apa jenis kelamin Anda?', desc:'', type:'select', opts:'Male\nFemale', order:1},
    {id:2, name:'Age', question:'Berapa usia Anda?', desc:'', type:'range', min:18, max:90, unit:'tahun', order:2},
    {id:3, name:'Occupation', question:'Apa pekerjaan Anda?', desc:'', type:'select', opts:'Doctor\nEngineer\nTeacher\nNurse\nAccountant\nLawyer\nSales Representative\nScientist\nSoftware Engineer\nManager', order:3},
    {id:4, name:'Sleep Duration', question:'Berapa jam rata-rata Anda tidur per malam?', desc:'', type:'range', min:1, max:12, unit:'jam', order:4},
    {id:5, name:'Quality of Sleep', question:'Bagaimana kualitas tidur Anda? (1–10)', desc:'', type:'range', min:1, max:10, unit:'', order:5},
    {id:6, name:'Physical Activity Level', question:'Berapa menit Anda beraktivitas fisik per hari?', desc:'', type:'range', min:0, max:120, unit:'menit/hari', order:6},
    {id:7, name:'Stress Level', question:'Seberapa tinggi tingkat stres Anda? (1–10)', desc:'', type:'range', min:1, max:10, unit:'', order:7},
    {id:8, name:'BMI Category', question:'Apa kategori BMI Anda?', desc:'', type:'select', opts:'Underweight\nNormal Weight\nOverweight\nObese', order:8},
    {id:9, name:'Steps', question:'Berapa langkah rata-rata Anda per hari?', desc:'', type:'range', min:0, max:25000, unit:'langkah', order:9},
];
let nextId = 10;
let deleteTarget = null;
let filteredQuestions = [...questions];

// ============ RENDER ============
function updateStats() {
    document.getElementById('sTotal').textContent = questions.length;
    document.getElementById('sAktif').textContent = questions.length;
    document.getElementById('sSelect').textContent = questions.filter(q => q.type === 'select').length;
    document.getElementById('sRange').textContent = questions.filter(q => q.type === 'range').length;
}

function renderTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const typeFilter = document.getElementById('filterType').value;
    filteredQuestions = questions.filter(q => {
        const matchSearch = q.name.toLowerCase().includes(search) || q.question.toLowerCase().includes(search);
        const matchType = !typeFilter || q.type === typeFilter;
        return matchSearch && matchType;
    });
    document.getElementById('countBadge').textContent = filteredQuestions.length + ' pertanyaan';

    const tbody = document.getElementById('tableBody');
    if (filteredQuestions.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;padding:48px;color:var(--text-muted)">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 12px;display:block;opacity:.4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Tidak ada pertanyaan ditemukan
        </td></tr>`;
        return;
    }

    tbody.innerHTML = filteredQuestions.map((q, i) => {
        const badge = q.type === 'select'
            ? `<span class="type-badge badge-select"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>Select</span>`
            : `<span class="type-badge badge-range"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>Range</span>`;

        return `<tr>
            <td><span class="row-num">${i+1}</span></td>
            <td>
                <div class="q-name">${q.name}</div>
                <div class="q-text">${q.question}</div>
            </td>
            <td>${badge}</td>
            <td>
                <div class="act-btns">
                    <button class="act-btn" onclick="openEdit(${q.id})" title="Edit">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </button>
                    <button class="act-btn del" onclick="openDel(${q.id})" title="Hapus">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

function renderStressPanel() {
    document.getElementById('stressLevelGrid').innerHTML = stressLevels.map(s => `
        <div class="sl-card">
            <div class="sl-num ${s.cls}">${s.num}</div>
            <div class="sl-title ${s.cls}">${s.title}</div>
            <div class="sl-desc">${s.desc}</div>
        </div>
    `).join('');
}

// ============ MODAL ============
function openModal(mode, id = null) {
    document.getElementById('modalBg').classList.add('open');
    document.getElementById('rangeFields').style.display = 'none';
    document.getElementById('rangeUnit').style.display = 'none';
    document.getElementById('selectFields').style.display = 'none';

    if (mode === 'add') {
        document.getElementById('modalTitle').textContent = 'Tambah Pertanyaan';
        document.getElementById('editId').value = '';
        document.getElementById('fName').value = '';
        document.getElementById('fQuestion').value = '';
        document.getElementById('fDesc').value = '';
        document.getElementById('fType').value = '';
        document.getElementById('fMin').value = '';
        document.getElementById('fMax').value = '';
        document.getElementById('fUnit').value = '';
        document.getElementById('fOptions').value = '';
    } else {
        const q = questions.find(x => x.id === id);
        if (!q) return;
        document.getElementById('modalTitle').textContent = 'Edit Pertanyaan';
        document.getElementById('editId').value = q.id;
        document.getElementById('fName').value = q.name;
        document.getElementById('fQuestion').value = q.question;
        document.getElementById('fDesc').value = q.desc || '';
        document.getElementById('fType').value = q.type;
        if (q.type === 'range') {
            document.getElementById('rangeFields').style.display = 'grid';
            document.getElementById('rangeUnit').style.display = 'grid';
            document.getElementById('fMin').value = q.min ?? '';
            document.getElementById('fMax').value = q.max ?? '';
            document.getElementById('fUnit').value = q.unit || '';
        } else {
            document.getElementById('selectFields').style.display = 'grid';
            document.getElementById('fOptions').value = q.opts || '';
        }
    }
}

function closeModal() {
    document.getElementById('modalBg').classList.remove('open');
}

function saveModal() {
    const name = document.getElementById('fName').value.trim();
    const question = document.getElementById('fQuestion').value.trim();
    const desc = document.getElementById('fDesc').value.trim();
    const type = document.getElementById('fType').value;
    if (!name || !question || !type) { showToast('Harap isi semua field wajib!', false); return; }

    const id = document.getElementById('editId').value;
    const data = { name, question, desc, type };
    if (type === 'range') {
        data.min = parseFloat(document.getElementById('fMin').value) || 0;
        data.max = parseFloat(document.getElementById('fMax').value) || 100;
        data.unit = document.getElementById('fUnit').value.trim();
    } else {
        data.opts = document.getElementById('fOptions').value.trim();
    }

    if (id) {
        const idx = questions.findIndex(x => x.id === parseInt(id));
        questions[idx] = { ...questions[idx], ...data };
        showToast('Pertanyaan berhasil diperbarui!', true);
    } else {
        questions.push({ id: nextId++, ...data });
        showToast('Pertanyaan berhasil ditambahkan!', true);
    }

    closeModal();
    updateStats();
    renderTable();
}

function openEdit(id) { openModal('edit', id); }

function openDel(id) {
    const q = questions.find(x => x.id === id);
    if (!q) return;
    deleteTarget = id;
    document.getElementById('delName').textContent = q.name;
    document.getElementById('delModalBg').classList.add('open');
}

function confirmDel() {
    questions = questions.filter(x => x.id !== deleteTarget);
    document.getElementById('delModalBg').classList.remove('open');
    showToast('Pertanyaan berhasil dihapus.', true);
    updateStats();
    renderTable();
}

// ============ TOAST ============
function showToast(msg, ok = true) {
    const t = document.getElementById('toast');
    const icon = document.getElementById('tIcon');
    document.getElementById('tMsg').textContent = msg;
    icon.className = 't-icon ' + (ok ? 't-green' : 't-red');
    icon.innerHTML = ok
        ? `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>`
        : `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M18 6L6 18M6 6l12 12"/></svg>`;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
}

// ============ EVENTS ============
document.getElementById('btnTambah').onclick = () => openModal('add');
document.getElementById('closeModalBtn').onclick = closeModal;
document.getElementById('batalModalBtn').onclick = closeModal;
document.getElementById('simpanModalBtn').onclick = saveModal;
document.getElementById('batalDelBtn').onclick = () => document.getElementById('delModalBg').classList.remove('open');
document.getElementById('confirmDelBtn').onclick = confirmDel;
document.getElementById('searchInput').addEventListener('input', renderTable);
document.getElementById('filterType').addEventListener('change', renderTable);

document.getElementById('fType').addEventListener('change', function() {
    const v = this.value;
    document.getElementById('rangeFields').style.display = v === 'range' ? 'grid' : 'none';
    document.getElementById('rangeUnit').style.display = v === 'range' ? 'grid' : 'none';
    document.getElementById('selectFields').style.display = v === 'select' ? 'grid' : 'none';
});

document.querySelectorAll('.modal-bg').forEach(bg => {
    bg.addEventListener('click', function(e) { if (e.target === this) this.classList.remove('open'); });
});

// ============ INIT ============
updateStats();
renderTable();
renderStressPanel();
</script>
@endsection