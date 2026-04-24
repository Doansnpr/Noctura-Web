@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/monitoring_prediksi.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="monitoring-container">
    {{-- Header --}}
    <div class="section-label">Monitoring Prediksi</div>
    <h1 class="page-title">Monitoring <span>Prediksi</span></h1>
    <p class="page-subtitle">Pantau seluruh riwayat hasil prediksi gangguan tidur pengguna. Klik tombol Detail untuk melihat lengkap input fitur tiap prediksi.</p>

    {{-- Statistik --}}
    <div class="stats-bar">
        <div class="stat-card" style="animation-delay:.04s">
            <div class="sc-corner" style="background:var(--navy-500)"></div>
            <div class="stat-label">Total Prediksi</div>
            <div class="stat-val" id="sTotal">0</div>
            <div class="stat-sub">Semua data</div>
        </div>
        <div class="stat-card" style="animation-delay:.09s">
            <div class="sc-corner" style="background:#be123c"></div>
            <div class="stat-label">Insomnia</div>
            <div class="stat-val" id="sInsomnia" style="color:#be123c">0</div>
            <div class="stat-sub">Terdeteksi</div>
        </div>
        <div class="stat-card" style="animation-delay:.14s">
            <div class="sc-corner" style="background:#c2410c"></div>
            <div class="stat-label">Sleep Apnea</div>
            <div class="stat-val" id="sApnea" style="color:#c2410c">0</div>
            <div class="stat-sub">Terdeteksi</div>
        </div>
        <div class="stat-card" style="animation-delay:.19s">
            <div class="sc-corner" style="background:var(--accent-green)"></div>
            <div class="stat-label">Normal</div>
            <div class="stat-val" id="sNormal" style="color:var(--accent-green)">0</div>
            <div class="stat-sub">Tidak ada gangguan</div>
        </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Riwayat Prediksi</span>
                <span class="count-badge" id="countBadge">0 data</span>
            </div>
            <div class="toolbar-right">
                <div class="topbar-search">
                    <span class="search-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari nama pengguna...">
                </div>
                <select class="filter-select" id="filterResult">
                    <option value="">Semua Hasil</option>
                    <option value="Insomnia">Insomnia</option>
                    <option value="Sleep Apnea">Sleep Apnea</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:48px">No</th>
                        <th>Nama Pengguna</th>
                        <th>Tanggal</th>
                        <th>Hasil Prediksi</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal-bg" id="detailModal">
    <div class="modal-box">
        <div class="modal-head">
            <div>
                <div class="modal-title" id="modalUserName">Nama Pengguna</div>
                <div class="modal-sub">Tanggal prediksi: <span id="modalDate"></span></div>
            </div>
            <button class="modal-close" id="closeModalBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="modal-result-hero" id="resultHero">
            <div class="hero-icon" id="heroIconWrap"></div>
            <div>
                <div class="hero-label">Hasil Prediksi</div>
                <div class="hero-result" id="heroResult"></div>
            </div>
        </div>

        <div class="feat-section-title">Input Fitur (9 Variabel)</div>
        <div class="feat-grid" id="featGrid"></div>

        <div class="modal-foot">
            <button class="btn btn-ghost" id="closeModalFooterBtn">Tutup</button>
        </div>
    </div>
</div>

{{-- ==================== MODAL HAPUS (custom) ==================== --}}
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
        <div class="del-title">Hapus Prediksi?</div>
        <div class="del-desc">
            Data prediksi dari <strong id="delUserName"></strong> akan dihapus permanen dan tidak bisa dikembalikan.
        </div>
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

<script>
    (function(){
        // Data prediksi dari server
        let predictions = @json($predictions ?? []);

        // Variabel untuk modal hapus
        let deleteTargetId = null;

        const avColors = ['av-blue','av-teal','av-green','av-purple','av-amber','av-red'];
        function getAvColor(name){
            let h = 0;
            for(let c of name) h += c.charCodeAt(0);
            return avColors[h % avColors.length];
        }
        function getInitials(name){
            return name.split(' ').map(w => w[0]).slice(0,2).join('').toUpperCase();
        }
        function fmtDate(dateStr){
            const d = new Date(dateStr);
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
            return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }
        function getBadge(result){
            if(result === 'Insomnia')   return `<span class="pred-badge badge-insomnia"><span class="dot"></span>Insomnia</span>`;
            if(result === 'Sleep Apnea')return `<span class="pred-badge badge-apnea"><span class="dot"></span>Sleep Apnea</span>`;
            return `<span class="pred-badge badge-normal"><span class="dot"></span>Normal</span>`;
        }

        function renderTable(){
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filterResult = document.getElementById('filterResult').value;

            const filtered = predictions.filter(p => {
                const matchSearch = p.name.toLowerCase().includes(searchTerm);
                const matchFilter = filterResult ? p.result === filterResult : true;
                return matchSearch && matchFilter;
            });

            // Update statistik
            document.getElementById('sTotal').textContent = predictions.length;
            document.getElementById('sInsomnia').textContent = predictions.filter(p => p.result === 'Insomnia').length;
            document.getElementById('sApnea').textContent = predictions.filter(p => p.result === 'Sleep Apnea').length;
            document.getElementById('sNormal').textContent = predictions.filter(p => p.result === 'Normal').length;
            document.getElementById('countBadge').textContent = filtered.length + ' data';

            const tbody = document.getElementById('tableBody');
            if(!filtered.length){
                tbody.innerHTML = `<tr><td colspan="5" class="empty-state">Tidak ada data prediksi yang ditemukan.</td></tr>`;
                return;
            }

            tbody.innerHTML = filtered.map((p, i) => `
                <tr>
                    <td><span class="row-no">${String(i+1).padStart(2,'0')}</span></td>
                    <td>
                        <div class="name-cell">
                            <div class="avatar ${getAvColor(p.name)}">${getInitials(p.name)}</div>
                            <span class="acc-name">${p.name}</span>
                        </div>
                    </td>
                    <td><span class="date-text">${fmtDate(p.date)}</span></td>
                    <td>${getBadge(p.result)}</td>
                    <td>
                        <div class="act-btns">
                            <button class="act-btn btn-detail" data-id="${p.id}">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail
                            </button>
                            <button class="act-btn btn-delete" data-id="${p.id}">
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
            `).join('');

            // Event listener tombol Detail
            document.querySelectorAll('.btn-detail[data-id]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const id = parseInt(btn.getAttribute('data-id'));
                    openDetail(id);
                });
            });

            // Event listener tombol Hapus
            document.querySelectorAll('.btn-delete[data-id]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const id = parseInt(btn.getAttribute('data-id'));
                    openDeleteModal(id);
                });
            });
        }

        function openDetail(id){
            const p = predictions.find(x => x.id === id);
            if(!p) return;

            const heroClass  = p.result === 'Insomnia' ? 'hero-insomnia' : (p.result === 'Sleep Apnea' ? 'hero-apnea' : 'hero-normal');
            const iconClass  = p.result === 'Insomnia' ? 'icon-insomnia' : (p.result === 'Sleep Apnea' ? 'icon-apnea'  : 'icon-normal');
            const colorClass = p.result === 'Insomnia' ? 'color-insomnia': (p.result === 'Sleep Apnea' ? 'color-apnea' : 'color-normal');

            const heroIcon = p.result === 'Insomnia'
                ? `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#be123c" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`
                : p.result === 'Sleep Apnea'
                ? `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c2410c" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>`
                : `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>`;

            document.getElementById('modalUserName').textContent = p.name;
            document.getElementById('modalDate').textContent = fmtDate(p.date);

            const resultHero = document.getElementById('resultHero');
            resultHero.className = `modal-result-hero ${heroClass}`;
            const heroIconWrap = document.getElementById('heroIconWrap');
            heroIconWrap.className = `hero-icon ${iconClass}`;
            heroIconWrap.innerHTML = heroIcon;
            const heroResult = document.getElementById('heroResult');
            heroResult.className = `hero-result ${colorClass}`;
            heroResult.textContent = p.result;

            const units = {
                Age: 'tahun', 'Sleep Duration': 'jam', 'Quality of Sleep': '/ 10',
                'Physical Activity Level': 'menit/hari', 'Stress Level': '/ 10', Steps: 'langkah'
            };
            const icons = {
                Gender: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 1 0 0 10A5 5 0 0 0 12 2zm0 12c-5.33 0-8 2.67-8 4v2h16v-2c0-1.33-2.67-4-8-4z"/></svg>`,
                Age:    `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>`,
                Occupation: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>`,
                'Sleep Duration': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>`,
                'Quality of Sleep': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`,
                'Physical Activity Level': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>`,
                'Stress Level': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><circle cx="12" cy="12" r="10"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`,
                'BMI Category': `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>`,
                Steps: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>`,
            };

            const featHtml = Object.entries(p.features).map(([key, val]) => `
                <div class="feat-item">
                    <div class="feat-key">${icons[key] || ''} ${key}</div>
                    <div class="feat-val">${val}<span class="feat-unit">${units[key]||''}</span></div>
                </div>
            `).join('');

            document.getElementById('featGrid').innerHTML = featHtml;
            document.getElementById('detailModal').classList.add('open');
        }

        // ========== MODAL HAPUS CUSTOM ==========
        function openDeleteModal(id) {
            const p = predictions.find(x => x.id === id);
            if (!p) return;
            deleteTargetId = id;
            document.getElementById('delUserName').textContent = p.name;
            document.getElementById('delModalBg').classList.add('open');
        }

        function closeDelModal() {
            document.getElementById('delModalBg').classList.remove('open');
            deleteTargetId = null;
        }

        function confirmDelete() {
            if (deleteTargetId === null) return;

            const confirmBtn = document.getElementById('confirmDelBtn');
            const originalText = confirmBtn.innerHTML;
            confirmBtn.innerHTML = 'Menghapus...';
            confirmBtn.disabled = true;

            fetch(`/monitoring-prediksi/${deleteTargetId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const index = predictions.findIndex(p => p.id === deleteTargetId);
                    if (index !== -1) predictions.splice(index, 1);
                    renderTable();
                    closeDelModal();
                    // Optional: tampilkan toast sukses (bisa ditambahkan jika ada toast component)
                    alert('Data berhasil dihapus'); // ganti dengan toast nanti
                } else {
                    alert('Gagal menghapus: ' + (data.message || 'Terjadi kesalahan'));
                    closeDelModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Koneksi bermasalah, coba lagi nanti.');
                closeDelModal();
            })
            .finally(() => {
                confirmBtn.innerHTML = originalText;
                confirmBtn.disabled = false;
            });
        }

        function closeDetail(){
            document.getElementById('detailModal').classList.remove('open');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            renderTable();

            document.getElementById('searchInput').addEventListener('input', renderTable);
            document.getElementById('filterResult').addEventListener('change', renderTable);

            document.getElementById('closeModalBtn').addEventListener('click', closeDetail);
            document.getElementById('closeModalFooterBtn').addEventListener('click', closeDetail);
            document.getElementById('detailModal').addEventListener('click', (e) => {
                if(e.target === e.currentTarget) closeDetail();
            });

            // Modal hapus custom
            const delModalBg = document.getElementById('delModalBg');
            document.getElementById('batalDelBtn').addEventListener('click', closeDelModal);
            document.getElementById('confirmDelBtn').addEventListener('click', confirmDelete);
            delModalBg.addEventListener('click', (e) => {
                if (e.target === delModalBg) closeDelModal();
            });
        });
    })();
</script>
@endsection