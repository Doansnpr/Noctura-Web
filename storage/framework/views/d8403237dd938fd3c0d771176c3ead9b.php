<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/kelola_edukasi.css')); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<style>
    /* ================= PAGINATION ================= */
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

    .pagination-pages {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    /* ================= EDUKASI CUSTOM ================= */
    .edu-thumb {
        width: 78px;
        height: 54px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--border-light);
        background: var(--bg-page);
        display: block;
    }

    .edu-thumb-empty {
        width: 78px;
        height: 54px;
        border-radius: 12px;
        border: 1px dashed var(--border-medium);
        background: var(--bg-page);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .edu-title-cell strong {
        display: block;
        color: var(--text-dark);
        margin-bottom: 5px;
        font-size: 15px;
    }

    .edu-title-cell small {
        color: var(--text-muted);
        font-size: 13px;
        line-height: 1.5;
    }

    .badge-healthy {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .badge-insomnia {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .badge-apnea {
        background: #fed7aa;
        color: #9a3412;
        border: 1px solid #fdba74;
    }

    .badge-info {
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    .badge-status-publish {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .badge-status-draft {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .img-upload-area {
        position: relative;
        width: 100%;
        border: 2px dashed var(--border-medium);
        border-radius: 14px;
        overflow: hidden;
        background: var(--bg-page);
        transition: border-color .2s, background .2s;
        cursor: pointer;
    }

    .img-upload-area:hover {
        border-color: var(--navy-500);
        background: var(--navy-50);
    }

    .img-upload-area.has-image {
        border-style: solid;
        border-color: var(--navy-500);
    }

    .img-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 32px 20px;
        color: var(--text-muted);
        font-size: 13px;
        font-weight: 500;
        text-align: center;
    }

    .img-placeholder span {
        color: var(--navy-600);
        font-weight: 700;
    }

    #previewImg {
        display: none;
        width: 100%;
        max-height: 240px;
        object-fit: cover;
        border-radius: 12px;
    }

    .img-overlay {
        display: none;
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .52);
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        border-radius: 12px;
    }

    .img-upload-area.has-image:hover .img-overlay {
        display: flex;
    }

    .img-remove-btn {
        display: none;
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(239,68,68,.9);
        border: none;
        color: #fff;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .img-upload-area.has-image .img-remove-btn {
        display: flex;
    }

    #gambarArtikel {
        display: none;
    }

    .detail-img-wrap {
        width: 100%;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 18px;
        max-height: 280px;
        background: var(--bg-page);
    }

    .detail-img-wrap img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .detail-item {
        background: var(--bg-page);
        border: 1px solid var(--border-light);
        border-radius: 14px;
        padding: 14px;
    }

    .detail-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 6px;
    }

    .detail-value {
        color: var(--text-body);
        font-size: 14px;
        font-weight: 600;
    }

    .detail-section {
        background: var(--bg-page);
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 20px;
        margin-top: 14px;
    }

    .detail-section h4 {
        color: var(--navy-900);
        margin-bottom: 10px;
    }

    .detail-section p {
        color: var(--text-body);
        line-height: 1.8;
        white-space: pre-line;
    }

    .detail-section ul {
        padding-left: 20px;
        color: var(--text-body);
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="kelola-edukasi-container">
    <div class="page-eyebrow">Master Data / Kelola Edukasi</div>
    <h1 class="page-title">Manajemen <span>Edukasi</span></h1>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Artikel Edukasi</span>
                <span class="count-badge" id="edukasiCountBadge">0 artikel</span>
            </div>

            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari artikel..." class="search-input">
                </div>

                <select class="filter-select" id="filterKategori">
                    <option value="">Semua Kategori</option>
                    <option value="healthy">Healthy</option>
                    <option value="insomnia">Insomnia</option>
                    <option value="sleep_apnea">Sleep Apnea</option>
                </select>

                <select class="filter-select" id="filterJenis">
                    <option value="">Semua Jenis</option>
                    <option value="informasi_umum">Informasi Umum</option>
                    <option value="gejala">Gejala</option>
                    <option value="penyebab">Penyebab</option>
                    <option value="penanganan">Penanganan</option>
                    <option value="tips_tidur">Tips Tidur</option>
                    <option value="pencegahan">Pencegahan</option>
                </select>

                <button class="btn btn-primary" id="tambahEdukasiBtn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Artikel
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="edukasiTableBody"></tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <div class="pagination-info" id="edukasiPaginationInfo">
                Menampilkan 0 data
            </div>

            <div class="pagination-controls">
                <select id="edukasiRowsPerPage" class="pagination-select">
                    <option value="5" selected>5 / halaman</option>
                    <option value="10">10 / halaman</option>
                    <option value="25">25 / halaman</option>
                    <option value="50">50 / halaman</option>
                </select>

                <button class="pagination-btn" id="edukasiPrevPageBtn">Sebelumnya</button>
                <div class="pagination-pages" id="edukasiPaginationPages"></div>
                <button class="pagination-btn" id="edukasiNextPageBtn">Berikutnya</button>
            </div>
        </div>
    </div>
</div>


<div class="modal-bg" id="edukasiFormModalBg">
    <div class="modal-box">
        <form id="edukasiForm">
            <div class="modal-head">
                <div>
                    <div class="modal-title" id="edukasiFormTitle">Tambah Artikel Edukasi</div>
                    <div class="modal-sub">Isi artikel edukasi sesuai kategori gangguan tidur</div>
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
                    <label class="f-label">Judul Artikel <span class="req">*</span></label>
                    <input class="f-input" id="judulArtikel" name="judul_artikel" placeholder="Contoh: Cara Mengatasi Insomnia Ringan">
                </div>
            </div>

            <div class="f-row col2">
                <div class="f-group">
                    <label class="f-label">Kategori Gangguan Tidur <span class="req">*</span></label>
                    <select class="f-select" id="kategoriGangguanTidur" name="kategori_gangguan_tidur">
                        <option value="">Pilih Kategori</option>
                        <option value="healthy">Healthy</option>
                        <option value="insomnia">Insomnia</option>
                        <option value="sleep_apnea">Sleep Apnea</option>
                    </select>
                </div>

                <div class="f-group">
                    <label class="f-label">Jenis Edukasi <span class="req">*</span></label>
                    <select class="f-select" id="jenisEdukasi" name="jenis_edukasi">
                        <option value="">Pilih Jenis Edukasi</option>
                        <option value="informasi_umum">Informasi Umum</option>
                        <option value="gejala">Gejala</option>
                        <option value="penyebab">Penyebab</option>
                        <option value="penanganan">Penanganan</option>
                        <option value="tips_tidur">Tips Tidur</option>
                        <option value="pencegahan">Pencegahan</option>
                    </select>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Ringkasan <span class="req">*</span></label>
                    <textarea class="f-input" id="ringkasan" name="ringkasan" rows="3" placeholder="Ringkasan singkat yang akan tampil di mobile"></textarea>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Gambar Artikel</label>

                    <div class="img-upload-area" id="imgUploadArea" title="Klik untuk pilih gambar">
                        <button type="button" class="img-remove-btn" id="imgRemoveBtn" title="Hapus gambar">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M18 6L6 18M6 6l12 12"/>
                            </svg>
                        </button>

                        <img id="previewImg" alt="Preview Gambar">

                        <div class="img-placeholder" id="imgPlaceholder">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="3"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <path d="m21 15-5-5L5 21"/>
                            </svg>
                            <p><span>Klik untuk upload</span> gambar artikel</p>
                            <p style="font-size:12px;color:var(--text-muted);margin-top:2px;">PNG, JPG, WEBP · Maks 2 MB</p>
                        </div>

                        <div class="img-overlay" id="imgOverlay">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            Ganti Gambar
                        </div>
                    </div>

                    <input type="file" id="gambarArtikel" name="gambar_artikel" accept="image/*">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Isi Artikel <span class="req">*</span></label>
                    <textarea class="f-input" id="isiArtikel" name="isi_artikel" rows="7" placeholder="Isi lengkap artikel edukasi"></textarea>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Tips Penanganan</label>
                    <textarea class="f-input" id="tipsPenanganan" name="tips_penanganan" rows="5" placeholder="Tulis satu tips per baris. Contoh:&#10;Tidur dan bangun di jam yang sama&#10;Hindari kafein sebelum tidur"></textarea>
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">Saran / Kapan Harus Konsultasi</label>
                    <textarea class="f-input" id="saranKonsultasi" name="saran_konsultasi" rows="4" placeholder="Contoh: Jika keluhan berlangsung lebih dari 2 minggu, sebaiknya konsultasikan ke tenaga kesehatan."></textarea>
                </div>
            </div>

            <div class="f-row col2">
                <div class="f-group">
                    <label class="f-label">Penulis</label>
                    <input class="f-input" id="penulis" name="penulis" placeholder="Admin Noctura">
                </div>

                <div class="f-group">
                    <label class="f-label">Estimasi Waktu Baca</label>
                    <input class="f-input" id="estimasiWaktuBaca" name="estimasi_waktu_baca" placeholder="Contoh: 5 menit">
                </div>
            </div>

            <div class="f-row col1">
                <div class="f-group">
                    <label class="f-label">
                        <input type="checkbox" id="statusPublish" name="status_publish" value="1" checked>
                        Status Publish
                    </label>
                    <small style="color:var(--text-muted);">
                        Jika dicentang, artikel akan ditampilkan di aplikasi mobile.
                    </small>
                </div>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn btn-ghost" id="batalEdukasiFormBtn">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanEdukasiBtn">Simpan Artikel</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-bg" id="edukasiModalBg">
    <div class="modal-box" style="max-width:760px;">
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

        <div class="del-title">Hapus Artikel?</div>
        <div class="del-desc">
            Artikel "<strong id="delEdukasiName"></strong>" akan dihapus permanen.
        </div>

        <div class="del-actions">
            <button class="btn btn-ghost" id="batalDelEdukasiBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDelEdukasiBtn">Hapus</button>
        </div>
    </div>
</div>


<div class="toast" id="toast">
    <div class="t-icon" id="tIcon"></div>
    <span id="tMsg"></span>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const state = {
        edukasiList : normalizeData(<?php echo json_encode($edukasi, 15, 512) ?>),
        deleteTarget: null,
        csrf        : document.querySelector('meta[name="csrf-token"]').content,
        baseUrl     : "<?php echo e(url('/edukasi')); ?>",
        currentPage : 1,
        rowsPerPage : 5
    };

    function normalizeData(data) {
        if (!data) return [];

        return data.map(item => ({
            id: String(item.id || item._id?.$oid || item._id || ''),

            judul_artikel: item.judul_artikel || '',
            kategori_gangguan_tidur: item.kategori_gangguan_tidur || '',
            jenis_edukasi: item.jenis_edukasi || '',
            ringkasan: item.ringkasan || '',
            isi_artikel: item.isi_artikel || '',
            gambar_artikel: item.gambar_artikel || '',
            tips_penanganan: Array.isArray(item.tips_penanganan) ? item.tips_penanganan : [],
            saran_konsultasi: item.saran_konsultasi || '',
            penulis: item.penulis || 'Admin Noctura',
            estimasi_waktu_baca: item.estimasi_waktu_baca || '3 menit',
            status_publish: Boolean(item.status_publish),
        })).filter(item => item.id);
    }

    function escapeHtml(text) {
        return String(text ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function imageSrc(path) {
        if (!path) return '';
        if (path.startsWith('http')) return path;
        if (path.startsWith('/storage/')) return path;
        if (path.startsWith('storage/')) return '/' + path;
        return `/storage/${path}`;
    }

    function showToast(message, success = true) {
        const toast = document.getElementById('toast');
        const icon  = document.getElementById('tIcon');
        const msg   = document.getElementById('tMsg');

        msg.textContent = message;
        icon.className = `t-icon ${success ? 't-green' : 't-red'}`;
        icon.innerHTML = success ? '✓' : '✕';

        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function labelKategori(value) {
        const map = {
            healthy: 'Healthy',
            insomnia: 'Insomnia',
            sleep_apnea: 'Sleep Apnea'
        };

        return map[value] || 'Lainnya';
    }

    function labelJenis(value) {
        const map = {
            informasi_umum: 'Informasi Umum',
            gejala: 'Gejala',
            penyebab: 'Penyebab',
            penanganan: 'Penanganan',
            tips_tidur: 'Tips Tidur',
            pencegahan: 'Pencegahan'
        };

        return map[value] || 'Lainnya';
    }

    function badgeKategori(value) {
        if (value === 'healthy') {
            return `<span class="badge badge-healthy">Healthy</span>`;
        }

        if (value === 'insomnia') {
            return `<span class="badge badge-insomnia">Insomnia</span>`;
        }

        if (value === 'sleep_apnea') {
            return `<span class="badge badge-apnea">Sleep Apnea</span>`;
        }

        return `<span class="badge">Lainnya</span>`;
    }

    function badgeJenis(value) {
        return `<span class="badge badge-info">${escapeHtml(labelJenis(value))}</span>`;
    }

    function badgeStatus(status) {
        return status
            ? `<span class="badge badge-status-publish">Published</span>`
            : `<span class="badge badge-status-draft">Draft</span>`;
    }

    function tipsToTextarea(tips) {
        if (!Array.isArray(tips)) return '';
        return tips.join('\n');
    }

    function renderEdukasiTable() {
        const search = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const filterKategori = document.getElementById('filterKategori')?.value || '';
        const filterJenis = document.getElementById('filterJenis')?.value || '';

        const tbody = document.getElementById('edukasiTableBody');
        const badge = document.getElementById('edukasiCountBadge');

        const filtered = state.edukasiList.filter(e => {
            const matchSearch =
                e.judul_artikel.toLowerCase().includes(search) ||
                e.ringkasan.toLowerCase().includes(search) ||
                e.isi_artikel.toLowerCase().includes(search) ||
                e.penulis.toLowerCase().includes(search);

            const matchKategori = !filterKategori || e.kategori_gangguan_tidur === filterKategori;
            const matchJenis = !filterJenis || e.jenis_edukasi === filterJenis;

            return matchSearch && matchKategori && matchJenis;
        });

        badge.textContent = `${filtered.length} artikel`;

        const totalData = filtered.length;
        const totalPages = Math.ceil(totalData / state.rowsPerPage) || 1;

        if (state.currentPage > totalPages) state.currentPage = totalPages;
        if (state.currentPage < 1) state.currentPage = 1;

        const startIndex = (state.currentPage - 1) * state.rowsPerPage;
        const endIndex = startIndex + state.rowsPerPage;
        const paginatedData = filtered.slice(startIndex, endIndex);

        if (!filtered.length) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center;padding:44px;color:var(--text-muted);">
                        Tidak ada artikel edukasi yang ditemukan.
                    </td>
                </tr>
            `;

            renderEdukasiPagination(0, 1, 0, 0);
            return;
        }

        tbody.innerHTML = paginatedData.map((e, idx) => {
            const gambar = e.gambar_artikel
                ? `<img class="edu-thumb" src="${imageSrc(e.gambar_artikel)}" alt="${escapeHtml(e.judul_artikel)}" onerror="this.outerHTML='<div class=&quot;edu-thumb-empty&quot;>No Img</div>'">`
                : `<div class="edu-thumb-empty">No Img</div>`;

            return `
                <tr>
                    <td><span class="row-num">${startIndex + idx + 1}</span></td>

                    <td>${gambar}</td>

                    <td>
                        <div class="edu-title-cell">
                            <strong>${escapeHtml(e.judul_artikel)}</strong>
                            <small>
                                ${escapeHtml(e.ringkasan.substring(0, 95))}
                                ${e.ringkasan.length > 95 ? '...' : ''}
                            </small>
                        </div>
                    </td>

                    <td>${badgeKategori(e.kategori_gangguan_tidur)}</td>

                    <td>${badgeJenis(e.jenis_edukasi)}</td>

                    <td>${badgeStatus(e.status_publish)}</td>

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
            `;
        }).join('');

        renderEdukasiPagination(
            totalData,
            totalPages,
            startIndex + 1,
            Math.min(endIndex, totalData)
        );

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.onclick = () => lihatDetailEdukasi(btn.dataset.id);
        });

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.onclick = () => editEdukasi(btn.dataset.id);
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.onclick = () => hapusEdukasi(btn.dataset.id);
        });
    }

    function renderEdukasiPagination(totalData, totalPages, startData, endData) {
        const paginationInfo = document.getElementById('edukasiPaginationInfo');
        const paginationPages = document.getElementById('edukasiPaginationPages');
        const prevBtn = document.getElementById('edukasiPrevPageBtn');
        const nextBtn = document.getElementById('edukasiNextPageBtn');

        if (!paginationInfo || !paginationPages || !prevBtn || !nextBtn) return;

        if (totalData === 0) {
            paginationInfo.textContent = 'Menampilkan 0 data';
            paginationPages.innerHTML = '';
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            return;
        }

        paginationInfo.textContent = `Menampilkan ${startData} - ${endData} dari ${totalData} artikel`;

        prevBtn.disabled = state.currentPage === 1;
        nextBtn.disabled = state.currentPage === totalPages;

        let buttons = '';

        for (let page = 1; page <= totalPages; page++) {
            buttons += `
                <button class="pagination-page ${page === state.currentPage ? 'active' : ''}" data-page="${page}">
                    ${page}
                </button>
            `;
        }

        paginationPages.innerHTML = buttons;

        document.querySelectorAll('.pagination-page').forEach(btn => {
            btn.onclick = e => {
                state.currentPage = Number(e.currentTarget.dataset.page);
                renderEdukasiTable();
            };
        });
    }

    const imgUploadArea = document.getElementById('imgUploadArea');
    const previewImg = document.getElementById('previewImg');
    const imgPlaceholder = document.getElementById('imgPlaceholder');
    const imgRemoveBtn = document.getElementById('imgRemoveBtn');
    const fileInput = document.getElementById('gambarArtikel');

    imgUploadArea.addEventListener('click', e => {
        if (e.target === imgRemoveBtn || imgRemoveBtn.contains(e.target)) return;
        fileInput.click();
    });

    imgUploadArea.addEventListener('dragover', e => {
        e.preventDefault();
        imgUploadArea.style.borderColor = 'var(--navy-500)';
        imgUploadArea.style.background = 'var(--navy-50)';
    });

    imgUploadArea.addEventListener('dragleave', () => {
        imgUploadArea.style.borderColor = '';
        imgUploadArea.style.background = '';
    });

    imgUploadArea.addEventListener('drop', e => {
        e.preventDefault();
        imgUploadArea.style.borderColor = '';
        imgUploadArea.style.background = '';

        const file = e.dataTransfer.files[0];

        if (file && file.type.startsWith('image/')) {
            applyFilePreview(file);
        } else {
            showToast('File harus berupa gambar.', false);
        }
    });

    fileInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            resetPreview();
            return;
        }

        if (!file.type.startsWith('image/')) {
            showToast('File harus berupa gambar.', false);
            resetPreview();
            return;
        }

        applyFilePreview(file);
    });

    imgRemoveBtn.addEventListener('click', e => {
        e.stopPropagation();
        resetPreview();
    });

    function applyFilePreview(file) {
        const url = URL.createObjectURL(file);
        setPreview(url);

        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;
    }

    function setPreview(src) {
        if (!src) {
            resetPreview();
            return;
        }

        previewImg.src = src;
        previewImg.style.display = 'block';
        imgPlaceholder.style.display = 'none';
        imgUploadArea.classList.add('has-image');
    }

    function resetPreview() {
        previewImg.src = '';
        previewImg.style.display = 'none';
        imgPlaceholder.style.display = '';
        imgUploadArea.classList.remove('has-image');
        fileInput.value = '';
    }

    function bukaFormEdukasi(isEdit = false, data = null) {
        document.getElementById('edukasiFormTitle').textContent = isEdit
            ? 'Edit Artikel Edukasi'
            : 'Tambah Artikel Edukasi';

        document.getElementById('editEdukasiId').value = isEdit ? data.id : '';
        document.getElementById('judulArtikel').value = isEdit ? data.judul_artikel : '';
        document.getElementById('kategoriGangguanTidur').value = isEdit ? data.kategori_gangguan_tidur : '';
        document.getElementById('jenisEdukasi').value = isEdit ? data.jenis_edukasi : '';
        document.getElementById('ringkasan').value = isEdit ? data.ringkasan : '';
        document.getElementById('isiArtikel').value = isEdit ? data.isi_artikel : '';
        document.getElementById('tipsPenanganan').value = isEdit ? tipsToTextarea(data.tips_penanganan) : '';
        document.getElementById('saranKonsultasi').value = isEdit ? data.saran_konsultasi : '';
        document.getElementById('penulis').value = isEdit ? data.penulis : 'Admin Noctura';
        document.getElementById('estimasiWaktuBaca').value = isEdit ? data.estimasi_waktu_baca : '3 menit';
        document.getElementById('statusPublish').checked = isEdit ? Boolean(data.status_publish) : true;

        resetPreview();

        if (isEdit && data.gambar_artikel) {
            setPreview(imageSrc(data.gambar_artikel));
        }

        document.getElementById('edukasiFormModalBg').classList.add('open');
    }

    function tutupFormEdukasi() {
        document.getElementById('edukasiFormModalBg').classList.remove('open');
        document.getElementById('edukasiForm').reset();
        document.getElementById('editEdukasiId').value = '';
        resetPreview();
    }

    async function simpanEdukasi() {
        const editId = document.getElementById('editEdukasiId').value;
        const judulArtikel = document.getElementById('judulArtikel').value.trim();
        const kategoriGangguanTidur = document.getElementById('kategoriGangguanTidur').value;
        const jenisEdukasi = document.getElementById('jenisEdukasi').value;
        const ringkasan = document.getElementById('ringkasan').value.trim();
        const isiArtikel = document.getElementById('isiArtikel').value.trim();

        if (!judulArtikel || !kategoriGangguanTidur || !jenisEdukasi || !ringkasan || !isiArtikel) {
            showToast('Judul, kategori, jenis edukasi, ringkasan, dan isi artikel wajib diisi.', false);
            return;
        }

        const formData = new FormData();
        formData.append('judul_artikel', judulArtikel);
        formData.append('kategori_gangguan_tidur', kategoriGangguanTidur);
        formData.append('jenis_edukasi', jenisEdukasi);
        formData.append('ringkasan', ringkasan);
        formData.append('isi_artikel', isiArtikel);
        formData.append('tips_penanganan', document.getElementById('tipsPenanganan').value.trim());
        formData.append('saran_konsultasi', document.getElementById('saranKonsultasi').value.trim());
        formData.append('penulis', document.getElementById('penulis').value.trim());
        formData.append('estimasi_waktu_baca', document.getElementById('estimasiWaktuBaca').value.trim());
        formData.append('status_publish', document.getElementById('statusPublish').checked ? 1 : 0);

        if (fileInput.files.length > 0) {
            formData.append('gambar_artikel', fileInput.files[0]);
        }

        let url = state.baseUrl;

        if (editId) {
            url += `/${editId}`;
            formData.append('_method', 'PUT');
        }

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': state.csrf,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await res.json();

            if (!res.ok || !result.success) {
                showToast(result.message || 'Gagal menyimpan artikel.', false);
                return;
            }

            const freshData = normalizeData([result.data])[0];

            if (editId) {
                const idx = state.edukasiList.findIndex(e => e.id === editId);

                if (idx !== -1) {
                    state.edukasiList[idx] = freshData;
                }

                showToast(result.message || 'Artikel berhasil diperbarui.');
            } else {
                state.edukasiList.unshift(freshData);
                showToast(result.message || 'Artikel berhasil ditambahkan.');
            }

            tutupFormEdukasi();
            renderEdukasiTable();
        } catch (err) {
            console.error(err);
            showToast('Terjadi kesalahan sistem saat menyimpan artikel.', false);
        }
    }

    function editEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);

        if (data) {
            bukaFormEdukasi(true, data);
        }
    }

    function lihatDetailEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);

        if (!data) return;

        document.getElementById('edukasiModalTitle').textContent = data.judul_artikel;
        document.getElementById('edukasiModalSub').textContent =
            `${labelKategori(data.kategori_gangguan_tidur)} • ${labelJenis(data.jenis_edukasi)}`;

        const imgHtml = data.gambar_artikel
            ? `
                <div class="detail-img-wrap">
                    <img src="${imageSrc(data.gambar_artikel)}"
                         alt="${escapeHtml(data.judul_artikel)}"
                         onerror="this.parentElement.style.display='none'">
                </div>
            `
            : '';

        const tipsHtml = data.tips_penanganan.length
            ? `
                <ul>
                    ${data.tips_penanganan.map(tip => `<li>${escapeHtml(tip)}</li>`).join('')}
                </ul>
            `
            : `<p>-</p>`;

        document.getElementById('edukasiDetailContent').innerHTML = `
            ${imgHtml}

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Kategori</div>
                    <div class="detail-value">${escapeHtml(labelKategori(data.kategori_gangguan_tidur))}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Jenis Edukasi</div>
                    <div class="detail-value">${escapeHtml(labelJenis(data.jenis_edukasi))}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Penulis</div>
                    <div class="detail-value">${escapeHtml(data.penulis || '-')}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Estimasi Baca</div>
                    <div class="detail-value">${escapeHtml(data.estimasi_waktu_baca || '-')}</div>
                </div>
            </div>

            <div class="detail-section">
                <h4>Ringkasan</h4>
                <p>${escapeHtml(data.ringkasan || '-')}</p>
            </div>

            <div class="detail-section">
                <h4>Isi Artikel</h4>
                <p>${escapeHtml(data.isi_artikel || '-')}</p>
            </div>

            <div class="detail-section">
                <h4>Tips Penanganan</h4>
                ${tipsHtml}
            </div>

            <div class="detail-section">
                <h4>Saran / Kapan Harus Konsultasi</h4>
                <p>${escapeHtml(data.saran_konsultasi || '-')}</p>
            </div>

            <div class="detail-section">
                <h4>Status</h4>
                <p>${data.status_publish ? 'Published' : 'Draft'}</p>
            </div>
        `;

        document.getElementById('edukasiModalBg').classList.add('open');
    }

    function tutupModalEdukasi() {
        document.getElementById('edukasiModalBg').classList.remove('open');
    }

    function hapusEdukasi(id) {
        const data = state.edukasiList.find(e => e.id === id);

        if (!data) return;

        state.deleteTarget = id;
        document.getElementById('delEdukasiName').textContent = data.judul_artikel;
        document.getElementById('delEdukasiModalBg').classList.add('open');
    }

    function tutupDelEdukasiModal() {
        document.getElementById('delEdukasiModalBg').classList.remove('open');
        state.deleteTarget = null;
    }

    async function konfirmasiHapusEdukasi() {
        if (!state.deleteTarget) return;

        try {
            const res = await fetch(`${state.baseUrl}/${state.deleteTarget}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': state.csrf,
                    'Accept': 'application/json'
                }
            });

            const result = await res.json();

            if (!res.ok || !result.success) {
                showToast(result.message || 'Gagal menghapus artikel.', false);
                return;
            }

            state.edukasiList = state.edukasiList.filter(e => e.id !== state.deleteTarget);

            tutupDelEdukasiModal();
            renderEdukasiTable();
            showToast(result.message || 'Artikel berhasil dihapus.');
        } catch (err) {
            console.error(err);
            showToast('Terjadi error saat menghapus artikel.', false);
        }
    }

    document.getElementById('tambahEdukasiBtn')?.addEventListener('click', () => bukaFormEdukasi(false));
    document.getElementById('simpanEdukasiBtn')?.addEventListener('click', simpanEdukasi);

    document.getElementById('searchInput')?.addEventListener('input', () => {
        state.currentPage = 1;
        renderEdukasiTable();
    });

    document.getElementById('filterKategori')?.addEventListener('change', () => {
        state.currentPage = 1;
        renderEdukasiTable();
    });

    document.getElementById('filterJenis')?.addEventListener('change', () => {
        state.currentPage = 1;
        renderEdukasiTable();
    });

    document.getElementById('edukasiRowsPerPage')?.addEventListener('change', e => {
        state.rowsPerPage = Number(e.target.value);
        state.currentPage = 1;
        renderEdukasiTable();
    });

    document.getElementById('edukasiPrevPageBtn')?.addEventListener('click', () => {
        if (state.currentPage > 1) {
            state.currentPage--;
            renderEdukasiTable();
        }
    });

    document.getElementById('edukasiNextPageBtn')?.addEventListener('click', () => {
        state.currentPage++;
        renderEdukasiTable();
    });

    document.getElementById('closeEdukasiFormBtn')?.addEventListener('click', tutupFormEdukasi);
    document.getElementById('batalEdukasiFormBtn')?.addEventListener('click', tutupFormEdukasi);
    document.getElementById('closeEdukasiModalBtn')?.addEventListener('click', tutupModalEdukasi);
    document.getElementById('tutupEdukasiModalBtn')?.addEventListener('click', tutupModalEdukasi);
    document.getElementById('batalDelEdukasiBtn')?.addEventListener('click', tutupDelEdukasiModal);
    document.getElementById('confirmDelEdukasiBtn')?.addEventListener('click', konfirmasiHapusEdukasi);

    ['edukasiFormModalBg', 'edukasiModalBg', 'delEdukasiModalBg'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', e => {
            if (e.target !== e.currentTarget) return;

            if (id === 'edukasiFormModalBg') tutupFormEdukasi();
            if (id === 'edukasiModalBg') tutupModalEdukasi();
            if (id === 'delEdukasiModalBg') tutupDelEdukasiModal();
        });
    });

    renderEdukasiTable();
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sleep-detection-backend\resources\views/edukasi/index.blade.php ENDPATH**/ ?>