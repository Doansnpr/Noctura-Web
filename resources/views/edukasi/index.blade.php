@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_edukasi.css') }}">

<div class="kelola-edukasi-container">
    <div class="section-label">Master Data / Kelola Edukasi</div>
    <h1 class="page-title">Manajemen <span>Edukasi</span></h1>
    <p class="page-subtitle">Kelola materi edukasi berdasarkan hasil prediksi: Healthy (Tidur Sehat), Insomnia (Susah Tidur), dan Sleep Apnea (Henti Napas). Edukasi akan direkomendasikan secara otomatis sesuai hasil diagnosis pasien.</p>

    {{-- Statistik --}}
    <div class="stats-bar">
        <div class="stat-card">
            <div class="stat-label">Total Edukasi</div>
            <div class="stat-val" id="totalEdukasi">0</div>
            <div class="stat-sub">Semua materi</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Healthy</div>
            <div class="stat-val" id="totalHealthy" style="color:var(--accent-green)">0</div>
            <div class="stat-sub">Tidur sehat</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Insomnia</div>
            <div class="stat-val" id="totalInsomnia" style="color:var(--accent-amber)">0</div>
            <div class="stat-sub">Susah tidur</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Sleep Apnea</div>
            <div class="stat-val" id="totalSleepApnea" style="color:var(--accent-red)">0</div>
            <div class="stat-sub">Henti napas</div>
        </div>
    </div>

    {{-- Card Daftar Edukasi --}}
    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Edukasi</span>
                <span class="count-badge" id="edukasiCountBadge">0 edukasi</span>
            </div>
            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari edukasi..." class="search-input">
                </div>
                <select class="filter-select" id="filterKategori">
                    <option value="">Semua Kategori</option>
                    <option value="Healthy">Healthy</option>
                    <option value="Insomnia">Insomnia</option>
                    <option value="Sleep Apnea">Sleep Apnea</option>
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
</div>

{{-- MODAL TAMBAH/EDIT --}}
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
                    <option value="Healthy">Healthy (Tidur Sehat)</option>
                    <option value="Insomnia">Insomnia (Susah Tidur)</option>
                    <option value="Sleep Apnea">Sleep Apnea (Henti Napas)</option>
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
                <textarea class="f-input" id="edukasiKonten" rows="6" placeholder="Tulis materi edukasi di sini..."></textarea>
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

{{-- MODAL DETAIL --}}
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

{{-- MODAL HAPUS --}}
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
            <button class="btn btn-danger" id="confirmDelEdukasiBtn">Hapus</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// Data edukasi
let edukasiList = [
  { id: 1, kategori: 'Healthy', judul: 'Panduan Tidur Sehat', konten: 'Tidur yang berkualitas adalah kunci kesehatan optimal. Berikut tips untuk menjaga kesehatan tidur Anda:\n\n1. Tidur 7-9 jam setiap malam secara teratur\n2. Usahakan tidur dan bangun di jam yang sama setiap hari\n3. Hindari kafein dan alkohol 6 jam sebelum tidur\n4. Matikan layar gadget 1 jam sebelum tidur\n5. Ciptakan lingkungan tidur yang gelap, sejuk, dan tenang\n6. Lakukan relaksasi seperti meditasi atau pernapasan dalam\n\nDengan menerapkan kebiasaan ini, kualitas tidur Anda akan meningkat dan tubuh menjadi lebih sehat!', sumber: 'American Sleep Association' },
  { id: 2, kategori: 'Insomnia', judul: 'Mengatasi Insomnia', konten: 'Insomnia adalah kesulitan tidur yang dapat mempengaruhi kesehatan. Berikut cara mengatasinya:\n\n1. Terapi Perilaku Kognitif (CBT-I) - terapi paling efektif untuk insomnia\n2. Batasi waktu di tempat tidur hanya untuk tidur\n3. Jangan memaksakan diri tidur jika tidak mengantuk\n4. Hindari tidur siang lebih dari 30 menit\n5. Lakukan teknik relaksasi seperti meditasi atau yoga\n6. Konsultasikan dengan dokter jika insomnia berlanjut\n\nIngat, insomnia bisa diatasi dengan pendekatan yang tepat dan konsisten!', sumber: 'Sleep Foundation' },
  { id: 3, kategori: 'Sleep Apnea', judul: 'Mengenal dan Menangani Sleep Apnea', konten: 'Sleep apnea adalah gangguan tidur serius di mana pernapasan berhenti sementara saat tidur. Gejala dan penanganannya:\n\nGejala yang perlu diwaspadai:\n• Mendengkur keras\n• Terengah-engah atau tersedak saat tidur\n• Sakit kepala di pagi hari\n• Mengantuk berlebihan di siang hari\n\nPenanganan Sleep Apnea:\n1. CPAP (Continuous Positive Airway Pressure) - terapi utama\n2. Perubahan gaya hidup: menurunkan berat badan\n3. Tidur miring, bukan telentang\n4. Hindari alkohol dan obat penenang\n5. Konsultasi ke dokter spesialis tidur\n\nSleep apnea dapat dikelola dengan baik jika ditangani sejak dini!', sumber: 'Mayo Clinic' }
];
let deleteEdukasiTarget = null;
let nextEdukasiId = 4;

// Utility
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

// Render tabel (tombol aksi tanpa ikon)
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
    tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:40px;">📚 Tidak ada data edukasi.</td></tr>`;
    return;
  }

  tbody.innerHTML = filtered.map((e, idx) => {
    const kategoriBadge = e.kategori === 'Healthy' 
      ? '<span class="badge badge-healthy">Healthy</span>'
      : e.kategori === 'Insomnia' 
      ? '<span class="badge badge-insomnia">Insomnia</span>'
      : '<span class="badge badge-apnea">Sleep Apnea</span>';
    
    return `
      <tr>
        <td>${idx+1}</td>
        <td><strong>${e.judul}</strong><br><small class="konten-preview">${e.konten.substring(0, 80)}${e.konten.length > 80 ? '...' : ''}</small></td>
        <td>${kategoriBadge}</td>
        <td>${e.sumber || '-'}</td>
        <td>
          <div class="act-btns">
            <button class="act-btn btn-detail" data-id="${e.id}">Detail</button>
            <button class="act-btn btn-edit" data-id="${e.id}">Edit</button>
            <button class="act-btn btn-delete" data-id="${e.id}">Hapus</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');

  // Pasang event listener
  document.querySelectorAll('.btn-detail[data-id]').forEach(btn => {
    btn.removeEventListener('click', handleDetail);
    btn.addEventListener('click', handleDetail);
  });
  document.querySelectorAll('.btn-edit[data-id]').forEach(btn => {
    btn.removeEventListener('click', handleEdit);
    btn.addEventListener('click', handleEdit);
  });
  document.querySelectorAll('.btn-delete[data-id]').forEach(btn => {
    btn.removeEventListener('click', handleDelete);
    btn.addEventListener('click', handleDelete);
  });
}

function handleDetail(e) {
  const id = parseInt(e.currentTarget.getAttribute('data-id'));
  lihatDetailEdukasi(id);
}
function handleEdit(e) {
  const id = parseInt(e.currentTarget.getAttribute('data-id'));
  editEdukasi(id);
}
function handleDelete(e) {
  const id = parseInt(e.currentTarget.getAttribute('data-id'));
  hapusEdukasi(id);
}

// CRUD
function bukaFormEdukasi(isEdit = false, data = null) {
  const modal = document.getElementById('edukasiFormModalBg');
  const title = document.getElementById('edukasiFormTitle');
  const editId = document.getElementById('editEdukasiId');
  const kategori = document.getElementById('edukasiKategori');
  const judul = document.getElementById('edukasiJudul');
  const konten = document.getElementById('edukasiKonten');
  const sumber = document.getElementById('edukasiSumber');

  if (isEdit && data) {
    title.textContent = 'Edit Edukasi';
    editId.value = data.id;
    kategori.value = data.kategori;
    judul.value = data.judul;
    konten.value = data.konten;
    sumber.value = data.sumber || '';
  } else {
    title.textContent = 'Tambah Edukasi';
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
    edukasiList.push({ id: nextEdukasiId++, kategori, judul, konten, sumber: sumber || '-' });
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

// Fungsi lihat detail (tanpa emoji)
function lihatDetailEdukasi(id) {
  const data = edukasiList.find(e => e.id === id);
  if (!data) return;
  document.getElementById('edukasiModalTitle').textContent = data.judul;
  document.getElementById('edukasiModalSub').textContent = `Kategori: ${data.kategori}`;
  document.getElementById('edukasiDetailContent').innerHTML = `
    <div class="edu-detail-content">
      <strong>Materi Edukasi:</strong>
      <p style="margin-top:10px;line-height:1.7;white-space:pre-line;">${data.konten}</p>
    </div>
    ${data.sumber && data.sumber !== '-' ? `<div class="edu-sumber">Sumber: ${data.sumber}</div>` : ''}
    <div style="font-size:12px;color:var(--text-muted);margin-top:12px;">ID: ${data.id}</div>
  `;
  document.getElementById('edukasiModalBg').classList.add('open');
}
function tutupModalEdukasi() {
  document.getElementById('edukasiModalBg').classList.remove('open');
}
function getEdukasiByPrediction(hasilPrediksi) {
  const edukasi = edukasiList.find(e => e.kategori === hasilPrediksi);
  if (edukasi) {
    lihatDetailEdukasi(edukasi.id);
    return edukasi;
  } else {
    showToast('⚠️ Belum ada edukasi untuk kategori ini. Silakan tambahkan terlebih dahulu.', false);
    return null;
  }
}

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
  renderEdukasiTable();

  document.getElementById('tambahEdukasiBtn').addEventListener('click', () => bukaFormEdukasi(false));
  document.getElementById('filterKategori').addEventListener('change', renderEdukasiTable);
  document.getElementById('searchInput').addEventListener('input', renderEdukasiTable);

  // Modal form
  document.getElementById('closeEdukasiFormBtn').addEventListener('click', tutupFormEdukasi);
  document.getElementById('batalEdukasiFormBtn').addEventListener('click', tutupFormEdukasi);
  document.getElementById('simpanEdukasiBtn').addEventListener('click', simpanEdukasi);
  document.getElementById('edukasiFormModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupFormEdukasi();
  });

  // Modal detail
  document.getElementById('closeEdukasiModalBtn').addEventListener('click', tutupModalEdukasi);
  document.getElementById('tutupEdukasiModalBtn').addEventListener('click', tutupModalEdukasi);
  document.getElementById('edukasiModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupModalEdukasi();
  });

  // Modal hapus
  document.getElementById('batalDelEdukasiBtn').addEventListener('click', tutupDelEdukasiModal);
  document.getElementById('confirmDelEdukasiBtn').addEventListener('click', konfirmasiHapusEdukasi);
  document.getElementById('delEdukasiModalBg').addEventListener('click', e => {
    if(e.target === e.currentTarget) tutupDelEdukasiModal();
  });
});

// Expose global
window.lihatDetailEdukasi = lihatDetailEdukasi;
window.editEdukasi = editEdukasi;
window.hapusEdukasi = hapusEdukasi;
window.getEdukasiByPrediction = getEdukasiByPrediction;
</script>
@endsection