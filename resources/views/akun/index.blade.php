@extends('layouts.dashboard')

@section('content')
{{-- CSS khusus halaman kelola akun --}}
<link rel="stylesheet" href="{{ asset('css/kelola_akun.css') }}">

<div class="kelola-akun-container">
    <div class="section-label">Master Data / Kelola Akun</div>
    <h1 class="page-title">Manajemen <span>Akun</span></h1>
    <p class="page-subtitle">Kelola daftar akun pengguna dan administrator sistem Noctura. Atur hak akses dan informasi akun setiap pengguna terdaftar.</p>

    {{-- Statistik --}}
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

    {{-- Card Daftar Akun --}}
    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Akun</span>
                <span class="count-badge" id="countBadge">0 akun</span>
            </div>
            <div class="toolbar-right">
                {{-- Search input (dipindahkan dari topbar) --}}
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari akun..." class="search-input">
                </div>
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
</div>

{{-- ==================== MODAL TAMBAH/EDIT ==================== --}}
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

{{-- ==================== MODAL HAPUS ==================== --}}
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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                    <path d="M3 6h18M9 6v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M5 6v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6"/>
                    <line x1="10" y1="11" x2="10" y2="17"/>
                    <line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
                Hapus
            </button>
        </div>
    </div>
</div>

{{-- Toast Notifikasi --}}
<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// Data dummy (nanti ganti dengan fetch dari server)
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

// Utility
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

// Render tabel & statistik
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
      ? '<span class="role-badge badge-admin">Admin</span>'
      : '<span class="role-badge badge-user">Pengguna</span>';
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
          <div class="act-btns">
            <button class="act-btn btn-edit" data-id="${a.id}">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 3l4 4-7 7H10v-4l7-7zM4 20h16"/>
              </svg>
              Edit
            </button>
            <button class="act-btn btn-delete" data-id="${a.id}">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 6h18M9 6v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M5 6v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6"/>
                <line x1="10" y1="11" x2="10" y2="17"/>
                <line x1="14" y1="11" x2="14" y2="17"/>
              </svg>
              Hapus
            </button>
          </div>
        </td>
      </tr>
    `;
  }).join('');

  // Event listener untuk tombol Edit
  document.querySelectorAll('.btn-edit[data-id]').forEach(btn => {
    btn.removeEventListener('click', handleEdit);
    btn.addEventListener('click', handleEdit);
  });
  // Event listener untuk tombol Hapus
  document.querySelectorAll('.btn-delete[data-id]').forEach(btn => {
    btn.removeEventListener('click', handleDelete);
    btn.addEventListener('click', handleDelete);
  });
}

function handleEdit(e) {
  const id = parseInt(e.currentTarget.getAttribute('data-id'));
  openEdit(id);
}
function handleDelete(e) {
  const id = parseInt(e.currentTarget.getAttribute('data-id'));
  openDelete(id);
}

// CRUD functions
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
  document.getElementById('delName').innerHTML = a.name;
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

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
  renderTableAkun();

  document.getElementById('btnTambah').addEventListener('click', openAdd);
  document.getElementById('filterRole').addEventListener('change', renderTableAkun);
  document.getElementById('searchInput').addEventListener('input', renderTableAkun);

  // Modal events
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
});
</script>
@endsection