@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_jawaban.css') }}">

<div class="kelola-jawaban-container">
    <div class="section-label">Master Data / Kelola Jawaban</div>
    <h1 class="page-title">Manajemen <span>Jawaban</span></h1>
    <p class="page-subtitle">Kelola pilihan jawaban untuk setiap pertanyaan tipe <strong>Select</strong>, serta konfigurasi batas nilai untuk pertanyaan tipe <strong>Range</strong>.</p>

    <div class="stats-bar">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#eef3fd;color:var(--navy-500)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <div class="stat-label">Total Jawaban</div>
            <div class="stat-val" id="totalJawaban">0</div>
            <div class="stat-sub">Semua entri jawaban</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#fffbeb;color:var(--accent-amber)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
            </div>
            <div class="stat-label">Pertanyaan Select</div>
            <div class="stat-val" id="totalSelect" style="color:var(--accent-amber)">0</div>
            <div class="stat-sub">Jawaban pilihan ganda</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#ecfeff;color:var(--accent-teal)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="stat-label">Pertanyaan Range</div>
            <div class="stat-val" id="totalRange" style="color:var(--accent-teal)">0</div>
            <div class="stat-sub">Jawaban input angka</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#ecfdf5;color:var(--accent-green)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            </div>
            <div class="stat-label">Total Opsi</div>
            <div class="stat-val" id="totalOpsi" style="color:var(--accent-green)">0</div>
            <div class="stat-sub">Pilihan tersedia</div>
        </div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Jawaban per Pertanyaan</span>
                <span class="count-badge" id="countBadge">0 jawaban</span>
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
                    Tambah Jawaban
                </button>
            </div>
        </div>

        <div id="jawabanList"></div>
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="modalTitle">Tambah Jawaban</div>
                <div class="modal-sub" id="modalSubtitle">Tentukan jawaban untuk pertanyaan</div>
            </div>
            <button class="modal-close" id="closeModalBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <input type="hidden" id="editId">

        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Pilih Pertanyaan <span class="req">*</span></label>
                <select class="f-select" id="pertanyaanId"></select>
            </div>
        </div>

        {{-- Preview tipe pertanyaan --}}
        <div id="tipePreview" style="display:none" class="tipe-preview">
            <span id="tipePreviewBadge"></span>
            <span id="tipePreviewText"></span>
        </div>

        {{-- Select fields --}}
        <div id="jawabanSelectFields">
            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Opsi Jawaban <span class="req">*</span></label>
                    <textarea class="f-textarea" id="opsiJawaban" placeholder="Tulis satu opsi per baris&#10;cth:&#10;Male&#10;Female&#10;Other"></textarea>
                    <span class="f-hint">💡 Satu opsi per baris. Opsi akan ditampilkan sebagai pilihan dropdown ke pengguna.</span>
                </div>
            </div>
            {{-- Live preview opsi --}}
            <div class="opsi-preview" id="opsiPreview">
                <div class="opsi-preview-title">Preview Opsi</div>
                <div class="opsi-chips" id="opsiChips"></div>
            </div>
        </div>

        {{-- Range fields --}}
        <div id="jawabanRangeFields" style="display:none">
            <div class="f-row col2">
                <div class="f-group">
                    <label class="f-label">Nilai Minimum <span class="req">*</span></label>
                    <input type="number" class="f-input" id="rangeMin" placeholder="0">
                </div>
                <div class="f-group">
                    <label class="f-label">Nilai Maksimum <span class="req">*</span></label>
                    <input type="number" class="f-input" id="rangeMax" placeholder="100">
                </div>
            </div>
            <div class="f-row col2">
                <div class="f-group">
                    <label class="f-label">Satuan</label>
                    <input class="f-input" id="rangeUnit" placeholder="cth: jam, langkah, menit">
                </div>
                <div class="f-group">
                    <label class="f-label">Label Kategori</label>
                    <input class="f-input" id="rangeLabel" placeholder="cth: Normal, Tinggi">
                </div>
            </div>
            {{-- Range visual preview --}}
            <div class="range-preview" id="rangePreview">
                <div class="range-preview-title">Preview Range</div>
                <div class="range-bar-wrap">
                    <span class="range-min-label" id="previewMin">0</span>
                    <div class="range-bar">
                        <div class="range-fill"></div>
                    </div>
                    <span class="range-max-label" id="previewMax">100</span>
                </div>
                <div class="range-meta">
                    <span id="previewUnit"></span>
                    <span id="previewLabel"></span>
                </div>
            </div>
        </div>

        <div class="modal-foot">
            <button class="btn btn-ghost" id="batalModalBtn">Batal</button>
            <button class="btn btn-primary" id="simpanModalBtn">Simpan Jawaban</button>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal-bg" id="delModalBg">
    <div class="del-modal-box">
        <div class="del-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        </div>
        <div class="del-title">Hapus Jawaban?</div>
        <div class="del-desc" id="delDesc">Jawaban ini akan dihapus permanen dan tidak bisa dikembalikan.</div>
        <div class="del-actions">
            <button class="btn btn-ghost" id="batalDelBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDelBtn">Hapus</button>
        </div>
    </div>
</div>

<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// ============ DATA PERTANYAAN ============
const questions = [
    {id:1, name:'Gender',                  type:'select', order:1},
    {id:2, name:'Age',                     type:'range',  order:2, unit:'tahun'},
    {id:3, name:'Occupation',              type:'select', order:3},
    {id:4, name:'Sleep Duration',          type:'range',  order:4, unit:'jam'},
    {id:5, name:'Quality of Sleep',        type:'range',  order:5, unit:''},
    {id:6, name:'Physical Activity Level', type:'range',  order:6, unit:'menit/hari'},
    {id:7, name:'Stress Level',            type:'range',  order:7, unit:''},
    {id:8, name:'BMI Category',            type:'select', order:8},
    {id:9, name:'Steps',                   type:'range',  order:9, unit:'langkah'},
];

const API_URL = '/api/jawaban';
let jawabanList = [];
let deleteTarget = null;

// ============ HELPERS ============
function getQuestion(id) { return questions.find(q => q.id === id); }
function getJawaban(id)  { return jawabanList.find(j => j.id === id); }

function normalize(j) {
    return {
        id:           j._id || j.id,
        pertanyaanId: j.pertanyaan_id,
        tipe:         j.tipe,
        opsi:         Array.isArray(j.opsi) ? j.opsi.join('\n') : (j.opsi || ''),
        rangeMin:     j.range_min ?? null,
        rangeMax:     j.range_max ?? null,
        unit:         j.unit || '',
        label:        j.label || '',
    };
}

// ============ API CALLS ============
async function apiFetch(url, options = {}) {
    const res = await fetch(url, {
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        ...options,
    });
    return res.json();
}

async function loadJawaban() {
    const search     = document.getElementById('searchInput').value;
    const typeFilter = document.getElementById('filterType').value;
    let url = API_URL + '?';
    if (search)     url += `search=${encodeURIComponent(search)}&`;
    if (typeFilter) url += `tipe=${typeFilter}`;

    const res = await apiFetch(url);
    if (!res.status) { showToast('Gagal memuat data!', false); return; }

    jawabanList = res.data.map(normalize);

    // Update stats dari response
    document.getElementById('totalJawaban').textContent = res.stats.total;
    document.getElementById('totalSelect').textContent  = res.stats.total_select;
    document.getElementById('totalRange').textContent   = res.stats.total_range;
    document.getElementById('totalOpsi').textContent    = res.stats.total_opsi;

    renderList();
}

// ============ RENDER LIST ============
function renderList() {
    document.getElementById('countBadge').textContent = jawabanList.length + ' jawaban';
    const container = document.getElementById('jawabanList');

    if (jawabanList.length === 0) {
        container.innerHTML = `<div class="empty-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" style="opacity:.3"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <p>Tidak ada jawaban ditemukan</p>
        </div>`;
        return;
    }

    container.innerHTML = jawabanList.map(j => {
        const q = getQuestion(j.pertanyaanId);
        if (!q) return '';

        const badge = j.tipe === 'select'
            ? `<span class="type-badge badge-select"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>Select</span>`
            : `<span class="type-badge badge-range"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>Range</span>`;

        let content = '';
        if (j.tipe === 'select') {
            const opts = j.opsi ? j.opsi.split('\n').filter(Boolean) : [];
            content = `
                <div class="jawaban-content">
                    <div class="jawaban-content-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                        ${opts.length} Opsi tersedia
                    </div>
                    <div class="opts-chips">
                        ${opts.map(o => `<span class="opt-chip">${o}</span>`).join('')}
                    </div>
                </div>`;
        } else {
            const pct = Math.min(100, ((j.rangeMax - j.rangeMin) / (j.rangeMax || 100)) * 100);
            content = `
                <div class="jawaban-content">
                    <div class="jawaban-content-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Range Nilai ${j.label ? '· ' + j.label : ''}
                    </div>
                    <div class="range-display">
                        <div class="range-display-nums">
                            <span class="range-num-min">${j.rangeMin}</span>
                            <div class="range-track">
                                <div class="range-track-fill" style="width:${pct}%"></div>
                            </div>
                            <span class="range-num-max">${j.rangeMax}</span>
                            ${j.unit ? `<span class="range-unit-tag">${j.unit}</span>` : ''}
                        </div>
                        ${j.label ? `<span class="range-label-chip">${j.label}</span>` : ''}
                    </div>
                </div>`;
        }

        return `
            <div class="jawaban-card" data-id="${j.id}">
                <div class="jawaban-card-header">
                    <div class="jawaban-card-left">
                        <div class="q-order-dot">${q.order}</div>
                        <div class="q-info"><div class="q-name">${q.name}</div></div>
                        ${badge}
                    </div>
                    <div class="jawaban-card-actions">
                        <button class="act-btn" onclick="openEdit('${j.id}')" title="Edit jawaban">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="act-btn del" onclick="openDel('${j.id}')" title="Hapus jawaban">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                        </button>
                    </div>
                </div>
                ${content}
            </div>`;
    }).join('');
}

// ============ MODAL ============
function buildPertanyaanOptions(selectedId = null) {
    const sel = document.getElementById('pertanyaanId');
    sel.innerHTML = '<option value="">-- Pilih Pertanyaan --</option>';
    questions.forEach(q => {
        const opt = document.createElement('option');
        opt.value = q.id;
        opt.textContent = `${q.order}. ${q.name} (${q.type})`;
        if (selectedId && q.id === selectedId) opt.selected = true;
        sel.appendChild(opt);
    });
}

function handlePertanyaanChange(qid) {
    const q = getQuestion(parseInt(qid));
    const preview = document.getElementById('tipePreview');
    if (!q) { preview.style.display = 'none'; showJawabanFields(''); return; }
    preview.style.display = 'flex';
    document.getElementById('tipePreviewBadge').className = 'type-badge ' + (q.type === 'select' ? 'badge-select' : 'badge-range');
    document.getElementById('tipePreviewBadge').textContent = q.type === 'select' ? 'Select' : 'Range';
    document.getElementById('tipePreviewText').textContent = q.type === 'select' ? 'Isi opsi pilihan satu per baris.' : 'Tentukan nilai minimum dan maksimum.';
    showJawabanFields(q.type);
}

function showJawabanFields(type) {
    document.getElementById('jawabanSelectFields').style.display = type === 'select' ? 'block' : 'none';
    document.getElementById('jawabanRangeFields').style.display  = type === 'range'  ? 'block' : 'none';
}

function openModal(mode, id = null) {
    document.getElementById('modalBg').classList.add('open');
    document.getElementById('tipePreview').style.display = 'none';
    showJawabanFields('');

    if (mode === 'add') {
        document.getElementById('modalTitle').textContent    = 'Tambah Jawaban';
        document.getElementById('modalSubtitle').textContent = 'Tentukan jawaban untuk pertanyaan';
        document.getElementById('editId').value              = '';
        buildPertanyaanOptions();
        document.getElementById('opsiJawaban').value = '';
        document.getElementById('rangeMin').value    = '';
        document.getElementById('rangeMax').value    = '';
        document.getElementById('rangeUnit').value   = '';
        document.getElementById('rangeLabel').value  = '';
        document.getElementById('opsiChips').innerHTML      = '';
        document.getElementById('opsiPreview').style.display = 'none';
    } else {
        const j = getJawaban(id);
        if (!j) return;
        const q = getQuestion(j.pertanyaanId);
        document.getElementById('modalTitle').textContent    = 'Edit Jawaban';
        document.getElementById('modalSubtitle').textContent = `Mengedit jawaban untuk: ${q?.name || ''}`;
        document.getElementById('editId').value              = j.id;
        buildPertanyaanOptions(j.pertanyaanId);
        handlePertanyaanChange(j.pertanyaanId);

        if (j.tipe === 'select') {
            document.getElementById('opsiJawaban').value = j.opsi || '';
            updateOpsiPreview(j.opsi || '');
        } else {
            document.getElementById('rangeMin').value   = j.rangeMin ?? '';
            document.getElementById('rangeMax').value   = j.rangeMax ?? '';
            document.getElementById('rangeUnit').value  = j.unit || '';
            document.getElementById('rangeLabel').value = j.label || '';
            updateRangePreview();
        }
    }
}

function closeModal() { document.getElementById('modalBg').classList.remove('open'); }

async function saveModal() {
    const qid = parseInt(document.getElementById('pertanyaanId').value);
    const q   = getQuestion(qid);
    if (!q) { showToast('Pilih pertanyaan terlebih dahulu!', false); return; }

    const id   = document.getElementById('editId').value;
    const body = { pertanyaan_id: qid, tipe: q.type };

    if (q.type === 'select') {
        const opsiRaw = document.getElementById('opsiJawaban').value.trim();
        if (!opsiRaw) { showToast('Isi minimal satu opsi jawaban!', false); return; }
        body.opsi = opsiRaw.split('\n').filter(Boolean);
    } else {
        const min = document.getElementById('rangeMin').value;
        const max = document.getElementById('rangeMax').value;
        if (min === '' || max === '') { showToast('Isi nilai minimum dan maksimum!', false); return; }
        body.range_min = parseFloat(min);
        body.range_max = parseFloat(max);
        body.unit      = document.getElementById('rangeUnit').value.trim();
        body.label     = document.getElementById('rangeLabel').value.trim();
    }

    const isEdit  = !!id;
    const url     = isEdit ? `${API_URL}/${id}` : API_URL;
    const method  = isEdit ? 'PUT' : 'POST';

    const res = await apiFetch(url, { method, body: JSON.stringify(body) });

    if (!res.status) {
        showToast(res.message || 'Gagal menyimpan data!', false);
        return;
    }

    closeModal();
    showToast(isEdit ? 'Jawaban berhasil diperbarui!' : 'Jawaban berhasil ditambahkan!', true);
    await loadJawaban();
}

function openEdit(id) { openModal('edit', id); }

function openDel(id) {
    const j = getJawaban(id);
    const q = j ? getQuestion(j.pertanyaanId) : null;
    deleteTarget = id;
    document.getElementById('delDesc').innerHTML = `Jawaban untuk pertanyaan <strong>${q?.name || ''}</strong> akan dihapus permanen.`;
    document.getElementById('delModalBg').classList.add('open');
}

async function confirmDel() {
    const res = await apiFetch(`${API_URL}/${deleteTarget}`, { method: 'DELETE' });
    document.getElementById('delModalBg').classList.remove('open');
    if (!res.status) { showToast(res.message || 'Gagal menghapus!', false); return; }
    showToast('Jawaban berhasil dihapus.', true);
    await loadJawaban();
}

// ============ LIVE PREVIEW ============
function updateOpsiPreview(val) {
    const opts      = val.split('\n').filter(Boolean);
    const container = document.getElementById('opsiChips');
    const preview   = document.getElementById('opsiPreview');
    if (opts.length === 0) { preview.style.display = 'none'; return; }
    preview.style.display  = 'block';
    container.innerHTML = opts.map(o => `<span class="opt-chip">${o}</span>`).join('');
}

function updateRangePreview() {
    const min   = document.getElementById('rangeMin').value;
    const max   = document.getElementById('rangeMax').value;
    const unit  = document.getElementById('rangeUnit').value;
    const label = document.getElementById('rangeLabel').value;
    document.getElementById('previewMin').textContent   = min || '0';
    document.getElementById('previewMax').textContent   = max || '100';
    document.getElementById('previewUnit').textContent  = unit  ? `Satuan: ${unit}`    : '';
    document.getElementById('previewLabel').textContent = label ? `Kategori: ${label}` : '';
}

// ============ TOAST ============
function showToast(msg, ok = true) {
    const t    = document.getElementById('toast');
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
document.getElementById('btnTambah').onclick      = () => openModal('add');
document.getElementById('closeModalBtn').onclick  = closeModal;
document.getElementById('batalModalBtn').onclick  = closeModal;
document.getElementById('simpanModalBtn').onclick = saveModal;
document.getElementById('batalDelBtn').onclick    = () => document.getElementById('delModalBg').classList.remove('open');
document.getElementById('confirmDelBtn').onclick  = confirmDel;

document.getElementById('searchInput').addEventListener('input',  loadJawaban);
document.getElementById('filterType').addEventListener('change',  loadJawaban);

document.getElementById('pertanyaanId').addEventListener('change', function() {
    handlePertanyaanChange(this.value);
});

document.getElementById('opsiJawaban').addEventListener('input', function() {
    updateOpsiPreview(this.value);
});

['rangeMin','rangeMax','rangeUnit','rangeLabel'].forEach(id => {
    document.getElementById(id).addEventListener('input', updateRangePreview);
});

document.querySelectorAll('.modal-bg').forEach(bg => {
    bg.addEventListener('click', function(e) { if (e.target === this) this.classList.remove('open'); });
});

// ============ INIT ============
loadJawaban();
</script>
@endsection