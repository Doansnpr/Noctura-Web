<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/kelola_akun.css')); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<style>
.pagination-wrap {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 14px;
  padding: 16px 4px 0;
  margin-top: 14px;
  flex-wrap: wrap;
}

.pagination-info {
  font-size: 14px;
  color: var(--text-muted);
  font-weight: 500;
}

.pagination-controls {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

.pagination-select {
  height: 38px;
  padding: 0 12px;
  border: 1px solid var(--border-light);
  border-radius: 10px;
  background: var(--bg-white);
  color: var(--text-body);
  font-size: 13px;
  font-family: 'DM Sans', sans-serif;
  outline: none;
  cursor: pointer;
  box-shadow: var(--shadow-sm);
}

.pagination-select:focus {
  border-color: var(--navy-500);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
}

.pagination-btn,
.pagination-page {
  height: 38px;
  min-width: 38px;
  padding: 0 13px;
  border: 1px solid var(--border-light);
  border-radius: 10px;
  background: var(--bg-white);
  color: var(--text-body);
  font-size: 13px;
  font-weight: 600;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  transition: all .2s ease;
  box-shadow: var(--shadow-sm);
}

.pagination-btn:hover,
.pagination-page:hover {
  background: var(--navy-50);
  border-color: var(--navy-500);
  color: var(--navy-600);
}

.pagination-page.active {
  background: var(--navy-600);
  border-color: var(--navy-600);
  color: #fff;
  box-shadow: var(--shadow-navy);
}

.pagination-btn:disabled {
  background: #f8fafc;
  color: #94a3b8;
  border-color: var(--border-light);
  cursor: not-allowed;
  box-shadow: none;
}

.pagination-btn:disabled:hover {
  background: #f8fafc;
  color: #94a3b8;
  border-color: var(--border-light);
}

.pagination-pages {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}
</style>

<div class="kelola-akun-container">
    <div class="page-eyebrow">Master Data / Kelola Akun</div>
    <h1 class="page-title">Manajemen <span>Akun</span></h1>

    
    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Akun</span>
                <span class="count-badge" id="countBadge">0 akun</span>
            </div>
            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari akun..." class="search-input" autocomplete="off">
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
        <div class="pagination-wrap">
        <div class="pagination-info" id="paginationInfo">
            Menampilkan 0 data
        </div>

        <div class="pagination-controls">
            <select id="rowsPerPage" class="pagination-select">
                <option value="5">5 / halaman</option>
                <option value="10" selected>10 / halaman</option>
                <option value="25">25 / halaman</option>
                <option value="50">50 / halaman</option>
            </select>

            <button class="pagination-btn" id="prevPageBtn">Sebelumnya</button>
            <div class="pagination-pages" id="paginationPages"></div>
            <button class="pagination-btn" id="nextPageBtn">Berikutnya</button>
        </div>
    </div>
    </div>
</div>


<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="modalTitle">Tambah Akun</div>
                <div class="modal-sub">Isi informasi akun untuk sistem Noctura</div>
            </div>
            <button class="modal-close" id="closeModalBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <input type="hidden" id="editId">

        <div class="modal-section-title">Informasi Akun</div>

        <div class="f-row col2">
            <div class="f-group">
                <label class="f-label">Username <span class="req">*</span></label>
                <input class="f-input" id="fName" autocomplete="off">
            </div>
            <div class="f-group">
                <label class="f-label">Role <span class="req">*</span></label>
                <select class="f-select" id="fRole">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="pengguna">Pengguna</option>
                </select>
            </div>
        </div>

        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Email <span class="req">*</span></label>
                <div class="email-wrapper">
                    <input class="f-input email-prefix-input" id="fEmailPrefix" type="text" autocomplete="off">
                    <span class="email-suffix">@gmail.com</span>
                </div>
            </div>
        </div>

        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">
                    Password <span class="req">*</span>
                    <span style="font-weight:400;color:var(--text-muted);font-size:12px;">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input class="f-input" id="fPassword" type="password" autocomplete="new-password">
            </div>
        </div>

        <div class="modal-section-title" style="margin-top:8px;">Informasi Profil</div>

        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Nama Lengkap</label>
                <input class="f-input" id="fFullName" autocomplete="off">
            </div>
        </div>

        <div class="f-row col2">
            <div class="f-group">
                <label class="f-label">Gender</label>
                <select class="f-select" id="fGender">
                    <option value="">-- Pilih Gender --</option>
                    <option value="L">Laki-laki (L)</option>
                    <option value="P">Perempuan (P)</option>
                </select>
            </div>
            <div class="f-group">
                <label class="f-label">No. Telepon</label>
                <input class="f-input" id="fPhone" type="tel" autocomplete="off" inputmode="numeric">
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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;">
                    <path d="M3 6h18M9 6v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M5 6v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6"/>
                    <line x1="10" y1="11" x2="10" y2="17"/>
                    <line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
                Hapus
            </button>
        </div>
    </div>
</div>


<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// ============================================================
// Data dari server (MongoDB via Laravel)
// ============================================================
let accounts = <?php echo json_encode($accounts, 15, 512) ?>.map(a => ({
    ...a,
    createdAt: new Date(a.createdAt)
}));

let deleteTarget = null;
let currentPage = 1;
let rowsPerPage = 5;

// Utility functions
function getInitials(name) {
    return name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
}
function getAvatarColor(name) {
    const colors = ['av-blue', 'av-teal', 'av-green', 'av-purple', 'av-amber', 'av-red'];
    let hash = 0;
    for (let i = 0; i < name.length; i++) hash += name.charCodeAt(i);
    return colors[hash % colors.length];
}
function formatDate(d) {
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}
function showToast(msg, ok) {
    const toast  = document.getElementById('toast');
    const icon   = document.getElementById('tIcon');
    const msgEl  = document.getElementById('tMsg');
    icon.className    = 't-icon ' + (ok ? 't-green' : 't-red');
    icon.innerHTML    = ok 
        ? `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>`
        : `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M18 6L6 18M6 6l12 12"/></svg>`;
    msgEl.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2500);
}

// Validasi
function isValidFullName(name) { return !/\d/.test(name); }
function isValidPhone(phone) { return /^\d+$/.test(phone); }

function blockNumbersOnFullName() {
    const el = document.getElementById('fFullName');
    el.addEventListener('keypress', e => { if (/\d/.test(e.key)) e.preventDefault(); });
    el.addEventListener('input', function() { this.value = this.value.replace(/\d/g, ''); });
}
function blockLettersOnPhone() {
    const el = document.getElementById('fPhone');
    el.addEventListener('keypress', e => { if (!/\d/.test(e.key)) e.preventDefault(); });
    el.addEventListener('input', function() { this.value = this.value.replace(/\D/g, ''); });
}

// Render Tabel (dengan tombol aksi gaya Edukasi)
function renderTableAkun() {
    const search     = document.getElementById('searchInput').value.toLowerCase();
    const filterRole = document.getElementById('filterRole').value;

    const filtered = accounts.filter(a =>
        (a.name.toLowerCase().includes(search) || a.email.toLowerCase().includes(search)) &&
        (filterRole ? a.role === filterRole : true)
    );

    document.getElementById('countBadge').textContent = filtered.length + ' akun';

    const tbody = document.getElementById('tableBody');

    const totalData = filtered.length;
    const totalPages = Math.ceil(totalData / rowsPerPage) || 1;

    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const paginatedData = filtered.slice(startIndex, endIndex);

    if (!filtered.length) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:48px;color:var(--text-muted);">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 12px;display:block;opacity:.4">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            Tidak ada akun yang ditemukan.
        </td></tr>`;

        renderPagination(0, 1, 0, 0);
        return;
    }

    tbody.innerHTML = paginatedData.map((a, i) => {
        const badge = a.role === 'Admin'
            ? '<span class="badge badge-admin">Admin</span>'
            : '<span class="badge badge-user">Pengguna</span>';

        return `
        <tr>
            <td><span class="row-num">${startIndex + i + 1}</span></td>
            <td>
                <div class="name-cell">
                    <div class="avatar ${getAvatarColor(a.name)}">${getInitials(a.name)}</div>
                    <div><div class="acc-name">${escapeHtml(a.name)}</div></div>
                </div>
            </td>
            <td>${badge}</td>
            <td>${escapeHtml(a.email)}</td>
            <td>${formatDate(a.createdAt)}</td>
            <td>
                <div class="act-btns">
                    <button class="act-btn btn-edit" data-id="${a.id}">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </button>
                    <button class="act-btn btn-delete" data-id="${a.id}">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14H6L5 6"/>
                            <path d="M10 11v6M14 11v6"/>
                            <path d="M9 6V4h6v2"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');

    renderPagination(totalData, totalPages, startIndex + 1, Math.min(endIndex, totalData));

    document.querySelectorAll('.btn-edit').forEach(btn =>
        btn.addEventListener('click', e => openEdit(e.currentTarget.dataset.id))
    );

    document.querySelectorAll('.btn-delete').forEach(btn =>
        btn.addEventListener('click', e => openDelete(e.currentTarget.dataset.id))
    );
}

function renderPagination(totalData, totalPages, startData, endData) {
    const paginationInfo = document.getElementById('paginationInfo');
    const paginationPages = document.getElementById('paginationPages');
    const prevBtn = document.getElementById('prevPageBtn');
    const nextBtn = document.getElementById('nextPageBtn');

    if (!paginationInfo || !paginationPages || !prevBtn || !nextBtn) return;

    if (totalData === 0) {
        paginationInfo.textContent = 'Menampilkan 0 data';
        paginationPages.innerHTML = '';
        prevBtn.disabled = true;
        nextBtn.disabled = true;
        return;
    }

    paginationInfo.textContent = `Menampilkan ${startData} - ${endData} dari ${totalData} akun`;

    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    let buttons = '';

    for (let page = 1; page <= totalPages; page++) {
        buttons += `
            <button class="pagination-page ${page === currentPage ? 'active' : ''}" data-page="${page}">
                ${page}
            </button>
        `;
    }

    paginationPages.innerHTML = buttons;

    document.querySelectorAll('.pagination-page').forEach(btn => {
        btn.addEventListener('click', e => {
            currentPage = Number(e.currentTarget.dataset.page);
            renderTableAkun();
        });
    });
}

function escapeHtml(text) {
    if (!text) return '';
    return String(text)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

// Form modal
function clearForm() {
    ['editId','fName','fEmailPrefix','fPassword','fFullName','fPhone'].forEach(id => {
        document.getElementById(id).value = '';
    });
    document.getElementById('fRole').value   = '';
    document.getElementById('fGender').value = '';
}
function openAdd() {
    clearForm();
    document.getElementById('modalTitle').textContent = 'Tambah Akun';
    document.getElementById('modalBg').classList.add('open');
}
function openEdit(id) {
    const a = accounts.find(x => x.id === id);
    if (!a) return;
    document.getElementById('editId').value    = id;
    document.getElementById('fName').value     = a.name || '';
    document.getElementById('fEmailPrefix').value = (a.email || '').replace('@gmail.com', '');
    document.getElementById('fRole').value     = a.role === 'Admin' ? 'admin' : 'pengguna';
    document.getElementById('fPassword').value = '';
    document.getElementById('fFullName').value = a.profile?.full_name || '';
    document.getElementById('fGender').value   = a.profile?.gender || '';
    document.getElementById('fPhone').value    = a.profile?.phone || '';
    document.getElementById('modalTitle').textContent = 'Edit Akun';
    document.getElementById('modalBg').classList.add('open');
}
function closeModal() {
    document.getElementById('modalBg').classList.remove('open');
}

// Simpan akun (tambah/edit)
async function saveAccount() {
    const name = document.getElementById('fName').value.trim();
    const emailPrefix = document.getElementById('fEmailPrefix').value.trim();
    const email = emailPrefix + '@gmail.com';
    const roleRaw = document.getElementById('fRole').value;
    const password = document.getElementById('fPassword').value;
    const eid = document.getElementById('editId').value;
    const fullName = document.getElementById('fFullName').value.trim();
    const gender = document.getElementById('fGender').value;
    const phone = document.getElementById('fPhone').value.trim();

    if (!name || !emailPrefix || !roleRaw) {
        showToast('Harap isi semua field yang wajib!', false);
        return;
    }
    if (!/^[a-zA-Z0-9._+-]+$/.test(emailPrefix)) {
        showToast('Bagian sebelum @gmail.com tidak valid!', false);
        return;
    }
    if (!eid && !password) {
        showToast('Password wajib diisi untuk akun baru!', false);
        return;
    }
    if (password && password.length < 6) {
        showToast('Password minimal 6 karakter!', false);
        return;
    }
    if (fullName && /\d/.test(fullName)) {
        showToast('Nama lengkap tidak boleh mengandung angka!', false);
        return;
    }
    if (phone && !/^\d+$/.test(phone)) {
        showToast('No. telepon hanya boleh berisi angka!', false);
        return;
    }

    // 👇 TAMBAHKAN INI - deklarasi isEdit dan url
    const isEdit = Boolean(eid);
    const url = isEdit ? `/akun/${eid}` : '/akun';
    
    // 👇 TAMBAHKAN INI - body dengan _method untuk edit
    const body = {
        username: name,
        email: email,
        role: roleRaw,
        profile: {
            full_name: fullName,
            gender: gender,
            phone: phone
        }
    };
    
    // 👇 TAMBAHKAN INI - method spoofing untuk edit
    if (isEdit) {
        body._method = 'PUT';
    }
    
    if (password) body.password = password;

    const method = 'POST';

    try {
        const res = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(body),
        });

        const text = await res.text();
        console.log("RAW RESPONSE:", text);
        let data;
        try { 
            data = JSON.parse(text); 
        } catch(e) { 
            console.error("Invalid JSON:", text);
            showToast('Respons tidak valid: ' + text.substring(0, 150), false);
            return;
        }

        if (!res.ok) {
            let errMsg = data.message || 'Terjadi kesalahan.';
            if (data.errors) errMsg = Object.values(data.errors).flat().join(' ');
            showToast(errMsg, false);
            return;
        }

        if (!data.data) {
            showToast('Respons server tidak lengkap.', false);
            return;
        }

        const savedAccount = {
            ...data.data,
            createdAt: new Date(data.data.createdAt)
        };

        if (isEdit) {
            const idx = accounts.findIndex(acc => acc.id === eid);
            if (idx !== -1) accounts[idx] = savedAccount;
            else accounts.push(savedAccount);
        } else {
            accounts.push(savedAccount);
        }

        renderTableAkun();
        closeModal();
        showToast(data.message, true);
    } catch (err) {
        console.error(err);
        showToast('Kesalahan koneksi: ' + (err.message || 'Cek jaringan atau endpoint API.'), false);
    }
}

// Hapus akun
function openDelete(id) {
    const a = accounts.find(x => x.id === id);
    if (!a) return;
    deleteTarget = id;
    document.getElementById('delName').textContent = a.name;
    document.getElementById('delModalBg').classList.add('open');
}
function closeDelModal() {
    document.getElementById('delModalBg').classList.remove('open');
    deleteTarget = null;
}
async function confirmDelete() {
    if (!deleteTarget) return;
    try {
        const res = await fetch(`/akun/${deleteTarget}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        });
        const text = await res.text();
        let data;
        try { data = JSON.parse(text); } catch(e) { data = { message: 'Respons tidak valid' }; }
        if (!res.ok) {
            showToast(data.message || 'Gagal menghapus.', false);
            return;
        }
        accounts = accounts.filter(acc => acc.id !== deleteTarget);
        renderTableAkun();
        closeDelModal();
        showToast(data.message, true);
    } catch (err) {
        console.error(err);
        showToast('Kesalahan koneksi saat menghapus.', false);
    }
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    renderTableAkun();
    blockNumbersOnFullName();
    blockLettersOnPhone();
    document.getElementById('btnTambah').addEventListener('click', openAdd);
    document.getElementById('filterRole').addEventListener('change', () => {
        currentPage = 1;
        renderTableAkun();
    });

    document.getElementById('searchInput').addEventListener('input', () => {
        currentPage = 1;
        renderTableAkun();
    });

    document.getElementById('rowsPerPage').addEventListener('change', e => {
        rowsPerPage = Number(e.target.value);
        currentPage = 1;
        renderTableAkun();
    });

    document.getElementById('prevPageBtn').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTableAkun();
        }
    });

    document.getElementById('nextPageBtn').addEventListener('click', () => {
        currentPage++;
        renderTableAkun();
    });
    document.getElementById('modalBg').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });
    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('batalModalBtn').addEventListener('click', closeModal);
    document.getElementById('simpanModalBtn').addEventListener('click', saveAccount);
    document.getElementById('delModalBg').addEventListener('click', e => { if (e.target === e.currentTarget) closeDelModal(); });
    document.getElementById('batalDelBtn').addEventListener('click', closeDelModal);
    document.getElementById('confirmDelBtn').addEventListener('click', confirmDelete);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sleep-detection-backend\resources\views/akun/index.blade.php ENDPATH**/ ?>