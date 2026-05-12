<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/monitoring_prediksi.css')); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<div class="monitoring-container">
    <div class="page-eyebrow">Monitoring / Hasil Prediksi</div>
    <h1 class="page-title">Monitoring <span>Prediksi Tidur</span></h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Prediksi</div>
            <div class="stat-value" id="statTotal">0</div>
            <div class="stat-desc">Seluruh data prediksi</div>
        </div>

        <div class="stat-card stat-healthy">
            <div class="stat-label">Healthy</div>
            <div class="stat-value" id="statHealthy">0</div>
            <div class="stat-desc">Tidur sehat</div>
        </div>

        <div class="stat-card stat-insomnia">
            <div class="stat-label">Insomnia</div>
            <div class="stat-value" id="statInsomnia">0</div>
            <div class="stat-desc">Indikasi insomnia</div>
        </div>

        <div class="stat-card stat-apnea">
            <div class="stat-label">Sleep Apnea</div>
            <div class="stat-value" id="statApnea">0</div>
            <div class="stat-desc">Indikasi sleep apnea</div>
        </div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Hasil Prediksi</span>
                <span class="count-badge" id="predictionCountBadge">0 data</span>
            </div>

            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari user / hasil..." class="search-input">
                </div>

                <select id="filterPrediksi" class="filter-select">
                    <option value="">Semua Prediksi</option>
                    <option value="Healthy">Healthy</option>
                    <option value="Insomnia">Insomnia</option>
                    <option value="Sleep Apnea">Sleep Apnea</option>
                </select>

                <select id="filterConfidence" class="filter-select">
                    <option value="">Semua Confidence</option>
                    <option value="tinggi">Tinggi ≥ 80%</option>
                    <option value="sedang">Sedang 50% - 79%</option>
                    <option value="rendah">Rendah &lt; 50%</option>
                </select>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>Hasil Prediksi</th>
                        <th>Label</th>
                        <th>Confidence</th>
                        <th>Tanggal Prediksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="predictionTableBody"></tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <div class="pagination-info" id="paginationInfo">Menampilkan 0 data</div>

            <div class="pagination-controls">
                <select id="rowsPerPage" class="pagination-select">
                    <option value="5" selected>5 / halaman</option>
                    <option value="10">10 / halaman</option>
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


<div class="modal-bg" id="detailModalBg">
    <div class="modal-box detail-modal">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="detailTitle">Detail Prediksi</div>
                <div class="modal-sub" id="detailSub">Informasi lengkap hasil prediksi</div>
            </div>

            <button class="modal-close" id="closeDetailBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div id="detailContent"></div>

        <div class="modal-foot">
            <button class="btn btn-primary" id="tutupDetailBtn">Tutup</button>
        </div>
    </div>
</div>


<div class="modal-bg" id="deleteModalBg">
    <div class="delete-modal-box">
        <div class="delete-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14H6L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4h6v2"/>
            </svg>
        </div>

        <div class="delete-title">Hapus Data Prediksi?</div>
        <div class="delete-desc">
            Data prediksi milik user <strong id="deleteUserId"></strong> akan dihapus permanen.
        </div>

        <div class="delete-actions">
            <button class="btn btn-ghost" id="cancelDeleteBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
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
        data: <?php echo json_encode($prediksi, 15, 512) ?>,
        currentPage: 1,
        rowsPerPage: 5,
        deleteTarget: null,
        csrf: document.querySelector('meta[name="csrf-token"]').content,
        baseUrl: "<?php echo e(url('/monitoring-prediksi')); ?>"
    };

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

        msg.textContent = message;
        icon.className = `t-icon ${success ? 't-green' : 't-red'}`;
        icon.innerHTML = success ? '✓' : '✕';

        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function formatDate(dateValue) {
        if (!dateValue) return '-';

        const date = new Date(dateValue);
        if (isNaN(date.getTime())) return '-';

        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()} ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
    }

    function badgePrediction(prediction) {
        if (prediction === 'Healthy') {
            return `<span class="badge badge-healthy">Healthy</span>`;
        }

        if (prediction === 'Insomnia') {
            return `<span class="badge badge-insomnia">Insomnia</span>`;
        }

        if (prediction === 'Sleep Apnea') {
            return `<span class="badge badge-apnea">Sleep Apnea</span>`;
        }

        return `<span class="badge badge-unknown">${escapeHtml(prediction || '-')}</span>`;
    }

    function confidenceLevel(percent) {
        const value = Number(percent) || 0;

        if (value >= 80) return 'tinggi';
        if (value >= 50) return 'sedang';
        return 'rendah';
    }

    function confidenceBadge(percent) {
        const value = Number(percent) || 0;
        const level = confidenceLevel(value);

        return `
            <div class="confidence-wrap">
                <span class="confidence-badge confidence-${level}">${value}%</span>
                <div class="confidence-bar">
                    <div class="confidence-fill confidence-fill-${level}" style="width:${Math.min(value, 100)}%"></div>
                </div>
            </div>
        `;
    }

    function getFilteredData() {
        const search = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const filterPrediksi = document.getElementById('filterPrediksi')?.value || '';
        const filterConfidence = document.getElementById('filterConfidence')?.value || '';

        return state.data.filter(item => {
            const matchSearch =
                String(item.user_id || '').toLowerCase().includes(search) ||
                String(item.prediction || '').toLowerCase().includes(search) ||
                String(item.label || '').toLowerCase().includes(search);

            const matchPrediksi = !filterPrediksi || item.prediction === filterPrediksi;

            const level = confidenceLevel(item.confidence_utama);
            const matchConfidence = !filterConfidence || level === filterConfidence;

            return matchSearch && matchPrediksi && matchConfidence;
        });
    }

    function renderStats() {
        const total = state.data.length;
        const healthy = state.data.filter(item => item.prediction === 'Healthy').length;
        const insomnia = state.data.filter(item => item.prediction === 'Insomnia').length;
        const apnea = state.data.filter(item => item.prediction === 'Sleep Apnea').length;

        document.getElementById('statTotal').textContent = total;
        document.getElementById('statHealthy').textContent = healthy;
        document.getElementById('statInsomnia').textContent = insomnia;
        document.getElementById('statApnea').textContent = apnea;
    }

    function renderTable() {
        const filtered = getFilteredData();

        document.getElementById('predictionCountBadge').textContent = `${filtered.length} data`;

        const tbody = document.getElementById('predictionTableBody');

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
                        Tidak ada data prediksi yang ditemukan.
                    </td>
                </tr>
            `;

            renderPagination(0, 1, 0, 0);
            return;
        }

        tbody.innerHTML = paginatedData.map((item, index) => `
            <tr>
                <td><span class="row-num">${startIndex + index + 1}</span></td>

                <td>
                    <div class="user-id-cell">
                        <span>${escapeHtml(shortText(item.user_id, 14))}</span>
                        <small>${escapeHtml(item.id)}</small>
                    </div>
                </td>

                <td>${badgePrediction(item.prediction)}</td>

                <td>
                    <div class="label-cell">${escapeHtml(item.label || '-')}</div>
                </td>

                <td>${confidenceBadge(item.confidence_utama)}</td>

                <td>${formatDate(item.predicted_at || item.created_at)}</td>

                <td>
                    <div class="act-btns">
                        <button class="act-btn btn-detail" data-id="${item.id}">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Detail
                        </button>

                        <button class="act-btn btn-delete" data-id="${item.id}">
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

        renderPagination(
            totalData,
            totalPages,
            startIndex + 1,
            Math.min(endIndex, totalData)
        );

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.onclick = () => openDetail(btn.dataset.id);
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.onclick = () => openDelete(btn.dataset.id);
        });
    }

    function renderPagination(totalData, totalPages, startData, endData) {
        const paginationInfo = document.getElementById('paginationInfo');
        const paginationPages = document.getElementById('paginationPages');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');

        if (totalData === 0) {
            paginationInfo.textContent = 'Menampilkan 0 data';
            paginationPages.innerHTML = '';
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            return;
        }

        paginationInfo.textContent = `Menampilkan ${startData} - ${endData} dari ${totalData} data`;
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
                renderTable();
            };
        });
    }

    function shortText(text, length = 20) {
        text = String(text || '-');
        return text.length > length ? text.substring(0, length) + '...' : text;
    }

    function renderObjectList(obj) {
        if (!obj || Object.keys(obj).length === 0) {
            return `<div class="empty-info">Tidak ada data.</div>`;
        }

        return `
            <div class="info-grid">
                ${Object.entries(obj).map(([key, value]) => `
                    <div class="info-item">
                        <div class="info-label">${escapeHtml(formatKey(key))}</div>
                        <div class="info-value">${escapeHtml(formatValue(value))}</div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function renderConfidenceDetail(confidence) {
        if (!confidence || Object.keys(confidence).length === 0) {
            return `<div class="empty-info">Tidak ada data confidence.</div>`;
        }

        return `
            <div class="confidence-detail-list">
                ${Object.entries(confidence).map(([key, value]) => {
                    let percent = Number(value) || 0;
                    if (percent <= 1) percent *= 100;
                    percent = Math.round(percent * 10) / 10;

                    return `
                        <div class="confidence-detail-item">
                            <div class="confidence-detail-top">
                                <span>${escapeHtml(key)}</span>
                                <strong>${percent}%</strong>
                            </div>
                            <div class="confidence-bar">
                                <div class="confidence-fill confidence-fill-${confidenceLevel(percent)}" style="width:${Math.min(percent, 100)}%"></div>
                            </div>
                        </div>
                    `;
                }).join('')}
            </div>
        `;
    }

    function renderSuggestions(suggestions) {
        if (!Array.isArray(suggestions) || suggestions.length === 0) {
            return `<div class="empty-info">Tidak ada saran.</div>`;
        }

        return `
            <ul class="suggestion-list">
                ${suggestions.map(item => `<li>${escapeHtml(item)}</li>`).join('')}
            </ul>
        `;
    }

    function formatKey(key) {
        return String(key)
            .replaceAll('_', ' ')
            .replace(/\b\w/g, char => char.toUpperCase());
    }

    function formatValue(value) {
        if (Array.isArray(value)) return value.join(', ');
        if (typeof value === 'object' && value !== null) return JSON.stringify(value);
        return value ?? '-';
    }

    function openDetail(id) {
        const item = state.data.find(data => data.id === id);
        if (!item) return;

        document.getElementById('detailTitle').textContent = `Detail Prediksi - ${item.prediction}`;
        document.getElementById('detailSub').textContent = `User ID: ${item.user_id}`;

        document.getElementById('detailContent').innerHTML = `
            <div class="detail-summary">
                <div class="detail-summary-card">
                    <div class="detail-summary-label">Hasil Prediksi</div>
                    <div class="detail-summary-value">${badgePrediction(item.prediction)}</div>
                </div>

                <div class="detail-summary-card">
                    <div class="detail-summary-label">Label</div>
                    <div class="detail-summary-value">${escapeHtml(item.label || '-')}</div>
                </div>

                <div class="detail-summary-card">
                    <div class="detail-summary-label">Confidence Utama</div>
                    <div class="detail-summary-value">${confidenceBadge(item.confidence_utama)}</div>
                </div>

                <div class="detail-summary-card">
                    <div class="detail-summary-label">Tanggal Prediksi</div>
                    <div class="detail-summary-value">${formatDate(item.predicted_at || item.created_at)}</div>
                </div>
            </div>

            <div class="detail-section">
                <h4>Deskripsi Hasil</h4>
                <p>${escapeHtml(item.description || '-')}</p>
            </div>

            <div class="detail-section">
                <h4>Confidence Model</h4>
                ${renderConfidenceDetail(item.confidence)}
            </div>

            <div class="detail-section">
                <h4>Saran Sistem</h4>
                ${renderSuggestions(item.suggestions)}
            </div>

            <div class="detail-section">
                <h4>Data Input Pengguna</h4>
                ${renderObjectList(item.input_data)}
            </div>
        `;

        document.getElementById('detailModalBg').classList.add('open');
    }

    function closeDetail() {
        document.getElementById('detailModalBg').classList.remove('open');
    }

    function openDelete(id) {
        const item = state.data.find(data => data.id === id);
        if (!item) return;

        state.deleteTarget = id;
        document.getElementById('deleteUserId').textContent = item.user_id;
        document.getElementById('deleteModalBg').classList.add('open');
    }

    function closeDelete() {
        state.deleteTarget = null;
        document.getElementById('deleteModalBg').classList.remove('open');
    }

    async function confirmDelete() {
        if (!state.deleteTarget) return;

        try {
            const response = await fetch(`${state.baseUrl}/${state.deleteTarget}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': state.csrf,
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                showToast(result.message || 'Gagal menghapus data prediksi.', false);
                return;
            }

            state.data = state.data.filter(item => item.id !== state.deleteTarget);

            closeDelete();
            renderStats();
            renderTable();
            showToast(result.message || 'Data prediksi berhasil dihapus.');
        } catch (error) {
            console.error(error);
            showToast('Terjadi kesalahan saat menghapus data.', false);
        }
    }

    document.getElementById('searchInput')?.addEventListener('input', () => {
        state.currentPage = 1;
        renderTable();
    });

    document.getElementById('filterPrediksi')?.addEventListener('change', () => {
        state.currentPage = 1;
        renderTable();
    });

    document.getElementById('filterConfidence')?.addEventListener('change', () => {
        state.currentPage = 1;
        renderTable();
    });

    document.getElementById('rowsPerPage')?.addEventListener('change', e => {
        state.rowsPerPage = Number(e.target.value);
        state.currentPage = 1;
        renderTable();
    });

    document.getElementById('prevPageBtn')?.addEventListener('click', () => {
        if (state.currentPage > 1) {
            state.currentPage--;
            renderTable();
        }
    });

    document.getElementById('nextPageBtn')?.addEventListener('click', () => {
        const totalPages = Math.ceil(getFilteredData().length / state.rowsPerPage) || 1;

        if (state.currentPage < totalPages) {
            state.currentPage++;
            renderTable();
        }
    });

    document.getElementById('closeDetailBtn')?.addEventListener('click', closeDetail);
    document.getElementById('tutupDetailBtn')?.addEventListener('click', closeDetail);
    document.getElementById('cancelDeleteBtn')?.addEventListener('click', closeDelete);
    document.getElementById('confirmDeleteBtn')?.addEventListener('click', confirmDelete);

    ['detailModalBg', 'deleteModalBg'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', e => {
            if (e.target !== e.currentTarget) return;
            if (id === 'detailModalBg') closeDetail();
            if (id === 'deleteModalBg') closeDelete();
        });
    });

    renderStats();
    renderTable();
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\sleep-detection-backend\resources\views/monitoring_prediksi/index.blade.php ENDPATH**/ ?>