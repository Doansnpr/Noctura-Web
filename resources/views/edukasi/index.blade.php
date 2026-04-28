@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_edukasi.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="kelola-edukasi-container">
    <div class="section-label">Master Data / Kelola Edukasi</div>
    <h1 class="page-title">Manajemen <span>Edukasi</span></h1>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Edukasi</span>
                <span class="count-badge" id="edukasiCountBadge">0 edukasi</span>
            </div>

            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </span>
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
                        <th>Author</th>
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
        <form id="edukasiForm">
            <div class="modal-head">
                <div>
                    <div class="modal-title" id="edukasiFormTitle">Tambah Edukasi</div>
                    <div class="modal-sub">Isi data edukasi</div>
                </div>
                <button type="button" class="modal-close" id="closeEdukasiFormBtn">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <input type="hidden" id="editEdukasiId" name="id">

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Kategori <span class="req">*</span></label>
                    <select class="f-select" id="edukasiKategori" name="category">
                        <option value="">Pilih Kategori</option>
                        <option value="Healthy">Healthy</option>
                        <option value="Insomnia">Insomnia</option>
                        <option value="Sleep Apnea">Sleep Apnea</option>
                    </select>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Judul Edukasi <span class="req">*</span></label>
                    <input class="f-input" id="edukasiJudul" name="title" placeholder="Contoh: Panduan Mengatasi Insomnia">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Summary</label>
                    <textarea class="f-input" id="edukasiSummary" name="summary" rows="3"></textarea>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Content / Materi <span class="req">*</span></label>
                    <textarea class="f-input" id="edukasiKonten" name="content" rows="6"></textarea>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Image URL</label>
                    <input class="f-input" id="edukasiImageUrl" name="image_url">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Author</label>
                    <input class="f-input" id="edukasiAuthor" name="author">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Tags</label>
                    <input class="f-input" id="edukasiTags" name="tags">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Read Time</label>
                    <input class="f-input" id="edukasiReadTime" name="read_time">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">
                        <input type="checkbox" id="edukasiPublished" name="is_published" value="1" checked>
                        Published
                    </label>
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn btn-ghost" id="batalEdukasiFormBtn">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanEdukasiBtn">Simpan Edukasi</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal-bg" id="edukasiModalBg">
    <div class="modal-box" style="max-width: 700px;">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="edukasiModalTitle">Detail Edukasi</div>
                <div class="modal-sub" id="edukasiModalSub"></div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== KONFIGURASI GLOBAL =====
    const state = {
        edukasiList: normalizeData(@json($edukasi)),
        deleteTarget: null,
        csrf: document.querySelector('meta[name="csrf-token"]')?.content,
        baseUrl: "{{ url('/edukasi') }}"
    };

    // ===== UTILITIES =====
    function normalizeData(data) {
        if (!data) return [];
        const dataArray = Array.isArray(data) ? data : [data];
        
        return dataArray.map(item => {
            const stringId = item.id 
                ? String(item.id) 
                : String(item._id?.$oid || item._id || '');

            return {
                id: stringId,
                title: item.title || '',
                category: item.category || '',
                summary: item.summary || '',
                content: item.content || '',
                author: item.author || 'Admin',
                image_url: item.image_url || '',
                read_time: item.read_time || '',
                tags: Array.isArray(item.tags) ? item.tags : [],
                is_published: Boolean(item.is_published),
            };
        }).filter(item => item.id);
    }

    function escapeHtml(text) {
        return String(text ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function showToast(message, success = true) {
        const toast = document.getElementById('toast');
        const icon = document.getElementById('tIcon');
        const msg = document.getElementById('tMsg');

        if (!toast) return;

        msg.textContent = message;
        icon.className = `t-icon ${success ? 't-green' : 't-red'}`;
        icon.innerHTML = success
            ? `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>`
            : `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M18 6L6 18M6 6l12 12"/></svg>`;

        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function badgeKategori(kategori) {
        const map = {
            'Healthy': '<span class="badge badge-healthy">Healthy</span>',
            'Insomnia': '<span class="badge badge-insomnia">Insomnia</span>',
            'Sleep Apnea': '<span class="badge badge-apnea">Sleep Apnea</span>',
        };
        return map[kategori] || '<span class="badge">Lainnya</span>';
    }

    // ===== RENDER TABLE =====
    function renderEdukasiTable() {
        const search = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const filterKategori = document.getElementById('filterKategori')?.value || '';
        const tbody = document.getElementById('edukasiTableBody');
        const badge = document.getElementById('edukasiCountBadge');

        if (!tbody) return;

        const filtered = state.edukasiList.filter(e => {
            const matchSearch = 
                e.title.toLowerCase().includes(search) ||
                e.content.toLowerCase().includes(search) ||
                e.summary.toLowerCase().includes(search);
            const matchKategori = !filterKategori || e.category === filterKategori;
            return matchSearch && matchKategori;
        });

        badge.textContent = `${filtered.length} edukasi`;

        if (!filtered.length) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px;color:var(--text-muted);">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 12px;display:block;opacity:.4">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                        Tidak ada data edukasi.
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = filtered.map((e, idx) => `
            <tr>
                <td><span class="row-num">${idx + 1}</span></td>
                <td>
                    <strong>${escapeHtml(e.title)}</strong><br>
                    <small class="konten-preview">
                        ${escapeHtml(e.summary || e.content.substring(0, 80))}${e.content.length > 80 ? '...' : ''}
                    </small>
                </td>
                <td>${badgeKategori(e.category)}</td>
                <td>${escapeHtml(e.author || '-')}</td>
                <td>
                    <div class="act-btns">
                        <button class="act-btn btn-detail" data-id="${e.id}">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Detail
                        </button>
                        <button class="act-btn btn-edit" data-id="${e.id}">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit
                        </button>
                        <button class="act-btn btn-delete" data-id="${e.id}">
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
            </tr>
        `).join('');

        // Re-attach event listeners
        tbody.querySelectorAll('.btn-detail').forEach(btn => 
            btn.onclick = () => lihatDetailEdukasi(btn.dataset.id));
        tbody.querySelectorAll('.btn-edit').forEach(btn => 
            btn.onclick = () => editEdukasi(btn.dataset.id));
        tbody.querySelectorAll('.btn-delete').forEach(btn => 
            btn.onclick = () => hapusEdukasi(btn.dataset.id));
    }

    // ===== MODAL FORM =====
    function bukaFormEdukasi(isEdit = false, data = null) {
        const modalBg = document.getElementById('edukasiFormModalBg');
        if (!modalBg) return;

        document.getElementById('edukasiFormTitle').textContent = isEdit ? 'Edit Edukasi' : 'Tambah Edukasi';
        document.getElementById('editEdukasiId').value = isEdit ? data?.id || '' : '';
        document.getElementById('edukasiKategori').value = isEdit ? data?.category || '' : '';
        document.getElementById('edukasiJudul').value = isEdit ? data?.title || '' : '';
        document.getElementById('edukasiSummary').value = isEdit ? data?.summary || '' : '';
        document.getElementById('edukasiKonten').value = isEdit ? data?.content || '' : '';
        document.getElementById('edukasiImageUrl').value = isEdit ? data?.image_url || '' : '';
        document.getElementById('edukasiAuthor').value = isEdit ? data?.author || 'Admin Kesehatan' : 'Admin Kesehatan';
        
        const tagsVal = isEdit && data?.tags 
            ? (Array.isArray(data.tags) ? data.tags.join(', ') : String(data.tags))
            : '';
        document.getElementById('edukasiTags').value = tagsVal;
        document.getElementById('edukasiReadTime').value = isEdit ? data?.read_time || '' : '';
        
        const checkbox = document.getElementById('edukasiPublished');
        if (checkbox) checkbox.checked = isEdit ? Boolean(data?.is_published) : true;

        modalBg.classList.add('open');
    }

    function tutupFormEdukasi() {
        document.getElementById('edukasiFormModalBg')?.classList.remove('open');
        document.getElementById('edukasiForm')?.reset();
        document.getElementById('editEdukasiId').value = '';
    }

    // ===== SIMPAN DATA (FIXED) =====
    async function simpanEdukasi() {
        const editId = document.getElementById('editEdukasiId')?.value;
        const formEl = document.getElementById('edukasiForm');
        
        if (!formEl) {
            showToast('Form tidak ditemukan!', false);
            return;
        }

        const formData = new FormData(formEl);
        const payload = Object.fromEntries(formData.entries());

        // ✅ FIX: Gunakan ID yang sesuai dengan HTML
        const checkbox = document.getElementById('edukasiPublished');
        payload.is_published = checkbox?.checked ? 1 : 0;

        // Konversi tags string ke array
        if (payload.tags && typeof payload.tags === 'string') {
            payload.tags = payload.tags.split(',').map(t => t.trim()).filter(Boolean);
        }

        const url = editId ? `${state.baseUrl}/${editId}` : state.baseUrl;
        const method = editId ? 'PUT' : 'POST';

        try {
            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': state.csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const result = await res.json();

            if (res.ok && result.success) {
                const freshData = normalizeData(result.data)[0];

                if (editId) {
                    const idx = state.edukasiList.findIndex(e => e.id === editId);
                    if (idx !== -1) state.edukasiList[idx] = freshData;
                } else {
                    state.edukasiList.unshift(freshData);
                }

                renderEdukasiTable();
                tutupFormEdukasi();
                showToast(editId ? 'Data berhasil diupdate!' : 'Data berhasil ditambahkan!');
            } else {
                showToast(`Gagal: ${result.message || 'Terjadi kesalahan'}`, false);
            }
        } catch (err) {
            console.error('Save error:', err);
            showToast('Terjadi kesalahan sistem.', false);
        }
    }

    // ===== EDIT & DETAIL =====
    function editEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);
        if (data) bukaFormEdukasi(true, data);
    }

    function lihatDetailEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);
        if (!data) return;

        const modalBg = document.getElementById('edukasiModalBg');
        const content = document.getElementById('edukasiDetailContent');
        
        if (!modalBg || !content) return;

        document.getElementById('edukasiModalTitle').textContent = data.title;
        document.getElementById('edukasiModalSub').textContent = `Kategori: ${data.category}`;

        content.innerHTML = `
            ${data.image_url ? `<img src="${escapeHtml(data.image_url)}" style="max-width:100%;border-radius:12px;margin-bottom:14px;" onerror="this.style.display='none'">` : ''}
            <div class="edu-detail-content">
                <strong>Summary:</strong>
                <p style="margin-top:8px;line-height:1.7;">${escapeHtml(data.summary || '-')}</p>
                <strong>Materi Edukasi:</strong>
                <p style="margin-top:8px;line-height:1.7;white-space:pre-line;">${escapeHtml(data.content)}</p>
            </div>
            <div class="edu-sumber">Author: ${escapeHtml(data.author || '-')}</div>
            <div class="edu-sumber">Tags: ${escapeHtml(data.tags?.join(', ') || '-')}</div>
            <div class="edu-sumber">Read Time: ${escapeHtml(data.read_time || '-')}</div>
            <div class="edu-sumber">Status: ${data.is_published ? 'Published' : 'Draft'}</div>
            <div style="font-size:12px;color:var(--text-muted);margin-top:12px;">ID: ${escapeHtml(data.id)}</div>
        `;

        modalBg.classList.add('open');
    }

    function tutupModalEdukasi() {
        document.getElementById('edukasiModalBg')?.classList.remove('open');
    }

    // ===== HAPUS DATA =====
    function hapusEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);
        if (!data) return;

        state.deleteTarget = id;
        document.getElementById('delEdukasiName').textContent = data.title;
        document.getElementById('delEdukasiModalBg')?.classList.add('open');
    }

    function tutupDelEdukasiModal() {
        document.getElementById('delEdukasiModalBg')?.classList.remove('open');
        state.deleteTarget = null;
    }

    async function konfirmasiHapusEdukasi() {
        if (!state.deleteTarget) return;

        try {
            const res = await fetch(`${state.baseUrl}/${state.deleteTarget}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': state.csrf,
                    'Accept': 'application/json',
                },
            });

            const result = await res.json();

            if (!res.ok) {
                showToast(result.message || 'Gagal menghapus data.', false);
                return;
            }

            state.edukasiList = state.edukasiList.filter(e => e.id !== state.deleteTarget);
            showToast('Edukasi berhasil dihapus!');
            tutupDelEdukasiModal();
            renderEdukasiTable();
        } catch (err) {
            console.error('Delete error:', err);
            showToast('Terjadi error saat menghapus data.', false);
        }
    }

    // ===== EVENT LISTENERS =====
    function setupEventListeners() {
        // Tombol utama
        document.getElementById('tambahEdukasiBtn')?.addEventListener('click', () => bukaFormEdukasi(false));
        document.getElementById('simpanEdukasiBtn')?.addEventListener('click', simpanEdukasi);
        
        // Search & filter
        document.getElementById('searchInput')?.addEventListener('input', renderEdukasiTable);
        document.getElementById('filterKategori')?.addEventListener('change', renderEdukasiTable);

        // Modal form
        document.getElementById('closeEdukasiFormBtn')?.addEventListener('click', tutupFormEdukasi);
        document.getElementById('batalEdukasiFormBtn')?.addEventListener('click', tutupFormEdukasi);

        // Modal detail
        document.getElementById('closeEdukasiModalBtn')?.addEventListener('click', tutupModalEdukasi);
        document.getElementById('tutupEdukasiModalBtn')?.addEventListener('click', tutupModalEdukasi);

        // Modal hapus
        document.getElementById('batalDelEdukasiBtn')?.addEventListener('click', tutupDelEdukasiModal);
        document.getElementById('confirmDelEdukasiBtn')?.addEventListener('click', konfirmasiHapusEdukasi);

        // Close modal on backdrop click
        ['edukasiFormModalBg', 'edukasiModalBg', 'delEdukasiModalBg'].forEach(id => {
            document.getElementById(id)?.addEventListener('click', (e) => {
                if (e.target === e.currentTarget) {
                    if (id === 'edukasiFormModalBg') tutupFormEdukasi();
                    else if (id === 'edukasiModalBg') tutupModalEdukasi();
                    else if (id === 'delEdukasiModalBg') tutupDelEdukasiModal();
                }
            });
        });
    }

    // ===== INIT =====
    renderEdukasiTable();
    setupEventListeners();
});
</script>
@endpush    
@endsection