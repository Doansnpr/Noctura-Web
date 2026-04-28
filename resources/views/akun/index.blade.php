@extends('layouts.dashboard')

@section('content')
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
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
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
    </div>
</div>

{{-- ==================== MODAL TAMBAH/EDIT ==================== --}}
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

        {{-- Section: Informasi Akun --}}
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

        {{-- Section: Profil --}}
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

        {{-- Footer Modal --}}
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

{{-- Toast Notifikasi --}}
<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<script>
// ============================================================
// Data dari server (MongoDB via Laravel)
// ============================================================
let accounts = @json($accounts).map(a => ({
    ...a,
    createdAt: new Date(a.createdAt)
}));

let deleteTarget = null;

// Utility functions (getInitials, getAvatarColor, formatDate, showToast) - tidak berubah
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
    icon.innerHTML    = ok ? '✓' : '✕';
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

// Render Tabel
function renderTableAkun() {
    const search     = document.getElementById('searchInput').value.toLowerCase();
    const filterRole = document.getElementById('filterRole').value;
    const now        = new Date();

    const filtered = accounts.filter(a =>
        (a.name.toLowerCase().includes(search) || a.email.toLowerCase().includes(search)) &&
        (filterRole ? a.role === filterRole : true)
    );

    document.getElementById('countBadge').textContent = filtered.length + ' akun';
    document.getElementById('sTotal').textContent     = accounts.length;
    document.getElementById('sAdmin').textContent     = accounts.filter(a => a.role === 'Admin').length;
    document.getElementById('sUser').textContent      = accounts.filter(a => a.role === 'Pengguna').length;
    document.getElementById('sNew').textContent       = accounts.filter(a =>
        a.createdAt.getMonth()    === now.getMonth() &&
        a.createdAt.getFullYear() === now.getFullYear()
    ).length;

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
            <td>${i + 1}</td>
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
                    <button class="act-btn btn-edit" data-id="${a.id}">Edit</button>
                    <button class="act-btn btn-delete" data-id="${a.id}">Hapus</button>
                </div>
            </td>
        </tr>`;
    }).join('');

    document.querySelectorAll('.btn-edit').forEach(btn =>
        btn.addEventListener('click', e => openEdit(e.currentTarget.dataset.id))
    );
    document.querySelectorAll('.btn-delete').forEach(btn =>
        btn.addEventListener('click', e => openDelete(e.currentTarget.dataset.id))
    );
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

// ========== SIMPAN AKUN (TAMBAH/EDIT) - TANPA RELOAD ==========
async function saveAccount() {
    const name = document.getElementById('fName').value.trim();
    const emailPrefix = document.getElementById('fEmailPrefix').value.trim();
    const email = emailPrefix + '@gmail.com';
    const roleRaw = document.getElementById('fRole').value; // 'admin' atau 'pengguna'
    const password = document.getElementById('fPassword').value;
    const eid = document.getElementById('editId').value;
    const fullName = document.getElementById('fFullName').value.trim();
    const gender = document.getElementById('fGender').value;
    const phone = document.getElementById('fPhone').value.trim();

    // Validasi
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
    if (password) body.password = password;

    const isEdit = Boolean(eid);
    const url = isEdit ? `/akun/${eid}` : '/akun';
    const method = isEdit ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(body),
        });

        // Baca response sebagai text dulu untuk debugging
        const text = await res.text();
        let data;
        try {
            data = JSON.parse(text);
        } catch(e) {
            console.error('Response bukan JSON:', text);
            showToast('Server mengirim respons tidak valid.', false);
            return;
        }

        if (!res.ok) {
            let errMsg = data.message || 'Terjadi kesalahan.';
            if (data.errors) errMsg = Object.values(data.errors).flat().join(' ');
            showToast(errMsg, false);
            return;
        }

        if (!data.data) {
            showToast('Respons server tidak lengkap (data akun tidak ditemukan).', false);
            console.error('Data response:', data);
            return;
        }

        const savedAccount = data.data;
        const formattedAccount = {
            ...savedAccount,
            createdAt: new Date(savedAccount.createdAt)
        };

        if (isEdit) {
            const idx = accounts.findIndex(acc => acc.id === eid);
            if (idx !== -1) accounts[idx] = formattedAccount;
            else accounts.push(formattedAccount);
        } else {
            accounts.push(formattedAccount);
        }

        renderTableAkun();
        closeModal();
        showToast(data.message, true);
    } catch (err) {
        console.error(err);
        showToast('Kesalahan koneksi: ' + (err.message || 'Cek jaringan atau endpoint API.'), false);
    }
}

// ========== HAPUS AKUN ==========
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

// ========== INIT ==========
document.addEventListener('DOMContentLoaded', () => {
    renderTableAkun();
    blockNumbersOnFullName();
    blockLettersOnPhone();
    document.getElementById('btnTambah').addEventListener('click', openAdd);
    document.getElementById('filterRole').addEventListener('change', renderTableAkun);
    document.getElementById('searchInput').addEventListener('input', renderTableAkun);
    document.getElementById('modalBg').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });
    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('batalModalBtn').addEventListener('click', closeModal);
    document.getElementById('simpanModalBtn').addEventListener('click', saveAccount);
    document.getElementById('delModalBg').addEventListener('click', e => { if (e.target === e.currentTarget) closeDelModal(); });
    document.getElementById('batalDelBtn').addEventListener('click', closeDelModal);
    document.getElementById('confirmDelBtn').addEventListener('click', confirmDelete);
});
</script>
@endsection