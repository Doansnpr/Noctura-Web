@extends('layouts.dashboard')
@section('content')

<style>
/* ========== Variabel & Animasi ========== */
:root {
    --bg-white: #ffffff;
    --bg-page: #f1f5f9;
    --border-light: #e2e8f0;
    --border-medium: #cbd5e1;
    --text-dark: #0f172a;
    --text-body: #334155;
    --text-muted: #64748b;
    --navy-50: #eef2ff;
    --navy-100: #dbeafe;
    --navy-500: #3b82f6;
    --navy-600: #2563eb;
    --navy-700: #1d4ed8;
    --navy-900: #1e3a8a;
    --accent-teal: #0d9488;
    --accent-green: #10b981;
    --accent-amber: #f59e0b;
    --accent-red: #ef4444;
    --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
    --shadow-navy: 0 10px 25px -5px rgba(30, 64, 175, 0.2);
    --radius-sm: 8px;
    --radius-lg: 16px;
    --radius-xl: 24px;
    --radius-2xl: 28px;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ========== KPI Grid ========== */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}
.kpi-card {
    background: var(--bg-white);
    border: 1.5px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: 26px 28px;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeUp 0.5s ease both;
}
.kpi-card:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--navy-100);
    transform: translateY(-4px);
}
.kpi-card:nth-child(1) { animation-delay: 0.05s; }
.kpi-card:nth-child(2) { animation-delay: 0.1s; }
.kpi-card:nth-child(3) { animation-delay: 0.15s; }
.kpi-card:nth-child(4) { animation-delay: 0.2s; }

.kpi-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 18px;
}
.kpi-icon-wrap {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.kpi-icon-wrap.navy { background: var(--navy-50); color: var(--navy-600); }
.kpi-icon-wrap.teal { background: #e0f7fa; color: var(--accent-teal); }
.kpi-icon-wrap.green { background: #ecfdf5; color: var(--accent-green); }
.kpi-icon-wrap.amber { background: #fffbeb; color: var(--accent-amber); }
.kpi-icon-wrap svg { width: 22px; height: 22px; }

.kpi-trend {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 50px;
}
.kpi-trend.up { background: #ecfdf5; color: var(--accent-green); }
.kpi-trend.down { background: #fef2f2; color: var(--accent-red); }
.kpi-trend.neutral { background: var(--navy-50); color: var(--navy-500); }
.kpi-trend svg { width: 12px; height: 12px; }

.kpi-value {
    font-size: 38px; font-weight: 700;
    color: var(--navy-900); line-height: 1;
    margin-bottom: 6px;
}
.kpi-label {
    font-size: 13px; color: var(--text-muted); font-weight: 500;
}

/* ========== Alert Banner ========== */
.alert-banner {
    display: flex; align-items: center; gap: 18px;
    background: linear-gradient(135deg, var(--navy-900) 0%, #2a4bc9 100%);
    border-radius: var(--radius-2xl); padding: 22px 32px;
    margin-bottom: 32px; box-shadow: var(--shadow-navy);
    position: relative; overflow: hidden; animation: fadeUp 0.4s ease both;
}
.alert-banner::before {
    content: ''; position: absolute;
    top: -40px; right: -40px;
    width: 180px; height: 180px;
    background: rgba(255,255,255,0.06); border-radius: 50%;
}
.alert-banner::after {
    content: ''; position: absolute;
    bottom: -40px; left: 30%;
    width: 120px; height: 120px;
    background: rgba(255,255,255,0.04); border-radius: 50%;
}
.alert-icon {
    width: 52px; height: 52px;
    background: rgba(255,255,255,0.15); border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0; position: relative; z-index: 1;
}
.alert-icon svg { width: 24px; height: 24px; }
.alert-text { flex: 1; position: relative; z-index: 1; }
.alert-title { font-size: 16px; font-weight: 600; color: #fff; margin-bottom: 4px; }
.alert-desc { font-size: 13.5px; color: rgba(255,255,255,0.7); }
.alert-action {
    padding: 12px 28px;
    background: rgba(255,255,255,0.15);
    border: 1.5px solid rgba(255,255,255,0.3);
    border-radius: 50px; font-size: 13.5px; font-weight: 600; color: #fff;
    cursor: pointer; white-space: nowrap; transition: all 0.2s;
    font-family: 'Poppins', sans-serif; position: relative; z-index: 1;
    text-decoration: none; backdrop-filter: blur(4px);
}
.alert-action:hover { background: rgba(255,255,255,0.3); }

/* ========== Dashboard Grid (1 Kolom Penuh) ========== */
.dash-grid {
    display: flex;
    flex-direction: column;
    gap: 28px;
    margin-bottom: 32px;
}

/* ========== Card Umum ========== */
.card {
    background: var(--bg-white);
    border: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: var(--radius-2xl);
    padding: 32px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative; overflow: hidden;
    animation: fadeUp 0.5s ease both;
}
.card:hover {
    box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
    border-color: var(--border-light);
}
.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }

.card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(148, 163, 184, 0.12);
}
.card-title {
    font-size: 20px; font-weight: 700;
    color: var(--navy-900); line-height: 1.2;
}
.card-sub {
    font-size: 13.5px; color: var(--text-muted); margin-top: 6px;
}
.card-badge {
    font-size: 12px; font-weight: 600;
    padding: 8px 14px; border-radius: 999px;
    background: #eef2ff; color: #3651c7;
    border: 1px solid rgba(54, 81, 199, 0.12);
    white-space: nowrap;
}

/* ========== Bar Chart (Distribusi) ========== */
.bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 24px;
    height: 320px; /* Ditingkatkan karena layout full */
    padding: 20px 16px 6px;
    margin-bottom: 24px;
    border-bottom: 2px solid rgba(148, 163, 184, 0.1);
    position: relative;
    background-image: repeating-linear-gradient(
        to top,
        rgba(148, 163, 184, 0.08) 0px,
        rgba(148, 163, 184, 0.08) 1px,
        transparent 1px,
        transparent 50px
    );
    background-position: bottom;
}

.bc-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.bc-bar-wrap {
    width: 100%;
    max-width: 100px; /* Batas max agar tidak terlalu lebar di monitor besar */
    height: 260px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
    gap: 6px;
}

.bc-bar {
    width: 100%;
    border-radius: 8px 8px 4px 4px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-height: 10px;
    position: relative;
    cursor: pointer;
}
.bc-bar:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.15);
}

.bc-bar.apnea {
    background: linear-gradient(180deg, #3b82f6 0%, var(--navy-900) 100%);
    box-shadow: 0 8px 16px rgba(30, 58, 138, 0.2);
}
.bc-bar.insomnia {
    background: linear-gradient(180deg, #2dd4bf 0%, var(--accent-teal) 100%);
    box-shadow: 0 8px 16px rgba(13, 148, 136, 0.2);
}
.bc-bar.hypersomnia {
    background: linear-gradient(180deg, #fbbf24 0%, var(--accent-amber) 100%);
    box-shadow: 0 8px 16px rgba(245, 158, 11, 0.2);
}

.bc-bar .bar-value {
    position: absolute;
    top: -28px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--navy-900);
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 8px;
    white-space: nowrap;
    opacity: 0;
    transition: all 0.2s;
    pointer-events: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    z-index: 5;
}
.bc-bar .bar-value::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border-width: 5px 5px 0 5px;
    border-style: solid;
    border-color: var(--navy-900) transparent transparent transparent;
}
.bc-bar:hover .bar-value {
    opacity: 1;
    top: -32px;
}

.bc-label {
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 600;
}

.chart-legend {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
}
.cl-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-body);
    padding: 10px 16px;
    border-radius: 999px;
    background: #f8fafc;
    border: 1px solid rgba(148, 163, 184, 0.12);
    transition: all 0.2s;
}
.cl-item:hover {
    border-color: var(--border-medium);
    background: #fff;
}
.cl-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

/* ========== Performa Model (Horizontal Layout) ========== */
.model-card {
    display: flex;
    flex-direction: column;
}
.model-body {
    display: flex;
    align-items: center;
    gap: 48px;
    flex: 1;
    padding: 20px 0;
}
.model-ring {
    position: relative;
    width: 180px; height: 180px; /* Diperbesar */
    flex-shrink: 0;
}
.model-ring svg {
    width: 180px; height: 180px;
    transform: rotate(-90deg);
    filter: drop-shadow(0 4px 12px rgba(16, 185, 129, 0.2));
}
.ring-bg {
    fill: none;
    stroke: #e9eef8;
    stroke-width: 14;
}
.ring-fill {
    fill: none;
    stroke: url(#greenGradient); /* Menggunakan gradient */
    stroke-width: 14;
    stroke-linecap: round;
    stroke-dasharray: 327;
    stroke-dashoffset: 5;
}
.ring-center {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.ring-value {
    font-size: 32px; font-weight: 800;
    color: var(--accent-green); line-height: 1;
}
.ring-label {
    font-size: 11px; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.12em;
    margin-top: 6px;
}
.model-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    flex: 1;
    max-width: 500px;
}
.stat {
    background: #f8fafc;
    border: 1px solid rgba(148, 163, 184, 0.12);
    border-radius: 20px;
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    transition: all 0.2s;
}
.stat:hover {
    border-color: var(--navy-100);
    transform: translateY(-2px);
}
.stat span {
    font-size: 12px; color: var(--text-muted); font-weight: 500;
}
.stat b {
    font-size: 22px; font-weight: 700; color: var(--navy-900);
}
.model-footer {
    background: linear-gradient(180deg, #f8fbff 0%, #f4f7ff 100%);
    border: 1px solid rgba(148, 163, 184, 0.12);
    border-radius: 20px;
    padding: 18px 24px;
    font-size: 13px;
    color: var(--text-muted);
    line-height: 1.6;
    margin-top: 8px;
}
.model-footer b {
    color: var(--navy-800); font-size: 14px;
}

/* ========== Profil Kasus Donut (Horizontal Layout) ========== */
.donut-layout {
    display: flex;
    align-items: center;
    gap: 60px;
    justify-content: center;
    padding: 20px 0;
}
.donut-wrap {
    position: relative;
    width: 220px; height: 220px; /* Diperbesar */
    flex-shrink: 0;
}
.donut-svg {
    width: 220px; height: 220px;
    transform: rotate(-90deg);
    filter: drop-shadow(0 4px 12px rgba(30, 64, 175, 0.15));
}
.donut-track {
    fill: none; stroke: #e9eef8; stroke-width: 20;
}
.donut-seg1 {
    fill: none; stroke: var(--navy-600); stroke-width: 20;
    stroke-linecap: round;
    stroke-dasharray: 213 377;   
}
.donut-seg2 {
    fill: none; stroke: var(--accent-teal); stroke-width: 20;
    stroke-linecap: round;
    stroke-dasharray: 102 377;
    stroke-dashoffset: -213;
}
.donut-seg3 {
    fill: none; stroke: var(--accent-amber); stroke-width: 20;
    stroke-linecap: round;
    stroke-dasharray: 61 377;
    stroke-dashoffset: -315;
}
.donut-center {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.donut-num {
    font-size: 40px; font-weight: 800;
    color: var(--navy-900); line-height: 1;
}
.donut-lbl {
    font-size: 11px; color: #64748b;
    letter-spacing: 0.14em; text-transform: uppercase;
    margin-top: 8px;
}

.legend-list { flex: 1; max-width: 400px; }
.legend-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 0; border-bottom: 1px solid rgba(148, 163, 184, 0.12);
}
.legend-item:last-child { border-bottom: none; }
.legend-left {
    display: flex; align-items: center; gap: 12px;
    font-size: 15px; color: var(--text-dark); font-weight: 600;
}
.legend-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.legend-right { display: flex; align-items: center; gap: 12px; }
.legend-pct { font-size: 18px; font-weight: 700; color: var(--navy-900); }
.legend-count { font-size: 13px; color: var(--text-muted); font-weight: 500;}

/* ========== Recent Predictions Table ========== */
.recent-card { animation-delay: 0.4s; }
.table-wrap { overflow-x: auto; }
table.pred-table {
    width: 100%; border-collapse: collapse; font-size: 13.5px;
}
.pred-table th {
    text-align: left; font-size: 11px; font-weight: 700;
    color: var(--text-muted); letter-spacing: 0.1em;
    text-transform: uppercase; padding: 0 16px 16px;
    border-bottom: 2px solid var(--border-light);
}
.pred-table th:first-child { padding-left: 0; }
.pred-table td {
    padding: 16px; border-bottom: 1px solid var(--border-light);
    color: var(--text-body); vertical-align: middle;
}
.pred-table td:first-child { padding-left: 0; }
.pred-table tr:last-child td { border-bottom: none; }
.pred-table tr:hover td { background-color: #f8fafc; }

.patient-name { font-weight: 600; color: var(--text-dark); font-size: 14px; }
.patient-id { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

.diag-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 14px; border-radius: 50px;
    font-size: 12px; font-weight: 600; white-space: nowrap;
}
.diag-badge.apnea { background: #eef1ff; color: var(--navy-600); border: 1.5px solid var(--navy-100); }
.diag-badge.insomnia { background: #e0f7fa; color: var(--accent-teal); border: 1.5px solid #b2ebf2; }
.diag-badge.hypersomnia { background: #fffbeb; color: var(--accent-amber); border: 1.5px solid #fde68a; }
.diag-badge.normal { background: #ecfdf5; color: var(--accent-green); border: 1.5px solid #a7f3d0; }

.conf-bar-wrap { display: flex; align-items: center; gap: 10px; }
.conf-bar-bg { flex: 1; height: 8px; background: #f1f5f9; border-radius: 4px; overflow: hidden; }
.conf-bar-fill { height: 100%; border-radius: 4px; transition: width 0.6s ease; }
.conf-val { font-size: 12px; font-weight: 700; width: 40px; text-align: right; }

.severity-dot {
    width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 6px;
}
.severity-dot.high { background: var(--accent-red); box-shadow: 0 0 6px rgba(239,68,68,0.4); }
.severity-dot.med { background: var(--accent-amber); box-shadow: 0 0 6px rgba(245,158,11,0.3); }
.severity-dot.low { background: var(--accent-green); box-shadow: 0 0 6px rgba(16,185,129,0.3); }

/* ========== Responsive ========== */
@media (max-width: 1024px) {
    .model-body, .donut-layout {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .model-stats, .legend-list {
        width: 100%;
        max-width: 100%;
    }
}
@media (max-width: 800px) {
    .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .card {
        padding: 24px;
    }
    .bar-chart {
        height: 260px;
        gap: 12px;
    }
    .bc-bar-wrap {
        height: 200px;
    }
}
</style>

<div class="page-eyebrow">Dashboard Admin</div>
<h1 class="welcome-title">Selamat Datang, <span>Dr. Setiawan</span></h1>
<p class="welcome-subtitle">
    Sistem deteksi gangguan tidur berbasis <strong>Decision Tree</strong> telah memproses
    <strong>42 prediksi baru</strong> hari ini. Pantau kondisi pengguna dan performa model secara real-time.
</p>

<!-- Alert -->
<div class="alert-banner">
    <div class="alert-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
        </svg>
    </div>
    <div class="alert-text">
        <div class="alert-title">3 Pengguna Memerlukan Perhatian Segera</div>
        <div class="alert-desc">Terdeteksi severe obstructive sleep apnea dengan tingkat keparahan tinggi — konfidensialitas model ≥ 94%.</div>
    </div>
    <a href="{{ route('monitoring') }}" class="alert-action">Lihat Detail →</a>
</div>

<!-- KPI Cards -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap navy">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <span class="kpi-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                +8%
            </span>
        </div>
        <div class="kpi-value">1.284</div>
        <div class="kpi-label">Total Pengguna Terdaftar</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
            <span class="kpi-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                +42
            </span>
        </div>
        <div class="kpi-value">3.761</div>
        <div class="kpi-label">Total Prediksi Dilakukan</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <span class="kpi-trend neutral">Stabil</span>
        </div>
        <div class="kpi-value">98.4<span style="font-size:22px;font-weight:400;opacity:0.5">%</span></div>
        <div class="kpi-label">Akurasi Model Decision Tree</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <span class="kpi-trend down">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                +3
            </span>
        </div>
        <div class="kpi-value">3</div>
        <div class="kpi-label">Kasus Risiko Tinggi Hari Ini</div>
    </div>
</div>

<!-- Main Charts Grid (Vertikal 1 Kolom) -->
<div class="dash-grid">

    <!-- 1. Distribusi Gangguan (Full Width) -->
    <div class="card">
        <div class="card-head">
            <div>
                <div class="card-title">Distribusi Gangguan Tidur</div>
                <div class="card-sub">Rekapitulasi 6 bulan terakhir</div>
            </div>
            <span class="card-badge">Per Bulan</span>
        </div>
        <div class="bar-chart">
            <!-- Nov -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:68px"><span class="bar-value">68</span></div>
                    <div class="bc-bar insomnia" style="height:28px"><span class="bar-value">28</span></div>
                    <div class="bc-bar hypersomnia" style="height:14px"><span class="bar-value">14</span></div>
                </div>
                <div class="bc-label">Nov</div>
            </div>
            <!-- Des -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:82px"><span class="bar-value">82</span></div>
                    <div class="bc-bar insomnia" style="height:32px"><span class="bar-value">32</span></div>
                    <div class="bc-bar hypersomnia" style="height:18px"><span class="bar-value">18</span></div>
                </div>
                <div class="bc-label">Des</div>
            </div>
            <!-- Jan -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:74px"><span class="bar-value">74</span></div>
                    <div class="bc-bar insomnia" style="height:26px"><span class="bar-value">26</span></div>
                    <div class="bc-bar hypersomnia" style="height:12px"><span class="bar-value">12</span></div>
                </div>
                <div class="bc-label">Jan</div>
            </div>
            <!-- Feb -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:90px"><span class="bar-value">90</span></div>
                    <div class="bc-bar insomnia" style="height:34px"><span class="bar-value">34</span></div>
                    <div class="bc-bar hypersomnia" style="height:20px"><span class="bar-value">20</span></div>
                </div>
                <div class="bc-label">Feb</div>
            </div>
            <!-- Mar -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:86px"><span class="bar-value">86</span></div>
                    <div class="bc-bar insomnia" style="height:38px"><span class="bar-value">38</span></div>
                    <div class="bc-bar hypersomnia" style="height:16px"><span class="bar-value">16</span></div>
                </div>
                <div class="bc-label">Mar</div>
            </div>
            <!-- Apr -->
            <div class="bc-col">
                <div class="bc-bar-wrap">
                    <div class="bc-bar apnea" style="height:96px"><span class="bar-value">96</span></div>
                    <div class="bc-bar insomnia" style="height:36px"><span class="bar-value">36</span></div>
                    <div class="bc-bar hypersomnia" style="height:22px"><span class="bar-value">22</span></div>
                </div>
                <div class="bc-label">Apr</div>
            </div>
        </div>
        <div class="chart-legend">
            <div class="cl-item"><div class="cl-dot" style="background:var(--navy-600)"></div> Healthy</div>
            <div class="cl-item"><div class="cl-dot" style="background:var(--accent-teal)"></div> Insomnia</div>
            <div class="cl-item"><div class="cl-dot" style="background:var(--accent-amber)"></div> Sleep Apnea</div>
        </div>
    </div>

    <!-- 2. Performa Model (Full Width) -->
    <div class="card model-card">
        <div class="card-head">
            <div>
                <div class="card-title">Performa Model</div>
                <div class="card-sub">Decision Tree C4.5</div>
            </div>
        </div>
        <div class="model-body">
            <div class="model-ring">
                <!-- Menambahkan ID gradient untuk efek warna yang lebih cantik -->
                <svg viewBox="0 0 120 120">
                    <defs>
                        <linearGradient id="greenGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#10b981;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#34d399;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <circle cx="60" cy="60" r="52" class="ring-bg"/>
                    <circle cx="60" cy="60" r="52" class="ring-fill"/>
                </svg>
                <div class="ring-center">
                    <div class="ring-value">98.4%</div>
                    <div class="ring-label">Akurasi</div>
                </div>
            </div>
            <div class="model-stats">
                <div class="stat"><span>Presisi</span><b>97.8%</b></div>
                <div class="stat"><span>Recall</span><b>98.1%</b></div>
                <div class="stat"><span>F1-Score</span><b>97.9%</b></div>
                <div class="stat"><span>Data Uji</span><b>620</b></div>
            </div>
        </div>
        <div class="model-footer">
            <b>Decision Tree (C4.5 / J48)</b><br>
            <span>Dilatih dengan 2.480 data — update 20 Apr 2026</span>
        </div>
    </div>

    <!-- 3. Profil Kasus Donut (Full Width) -->
    <div class="card">
        <div class="card-head">
            <div>
                <div class="card-title">Profil Kasus</div>
                <div class="card-sub">Keseluruhan data</div>
            </div>
        </div>
        <div class="donut-layout">
            <div class="donut-wrap">
                <svg class="donut-svg" viewBox="0 0 160 160">
                    <circle class="donut-track" cx="80" cy="80" r="60"/>
                    <circle class="donut-seg1" cx="80" cy="80" r="60"/>
                    <circle class="donut-seg2" cx="80" cy="80" r="60"/>
                    <circle class="donut-seg3" cx="80" cy="80" r="60"/>
                </svg>
                <div class="donut-center">
                    <div class="donut-num">1.284</div>
                    <div class="donut-lbl">Total Kasus</div>
                </div>
            </div>
            <div class="legend-list">
                <div class="legend-item">
                    <div class="legend-left">
                        <div class="legend-dot" style="background:var(--navy-600)"></div>
                        Healthy
                    </div>
                    <div class="legend-right">
                        <span class="legend-count">731 Kasus</span>
                        <span class="legend-pct">56.9%</span>
                    </div>
                </div>
                <div class="legend-item">
                    <div class="legend-left">
                        <div class="legend-dot" style="background:var(--accent-teal)"></div>
                        Insomnia
                    </div>
                    <div class="legend-right">
                        <span class="legend-count">347 Kasus</span>
                        <span class="legend-pct">27.0%</span>
                    </div>
                </div>
                <div class="legend-item">
                    <div class="legend-left">
                        <div class="legend-dot" style="background:var(--accent-amber)"></div>
                        Sleep Apnea
                    </div>
                    <div class="legend-right">
                        <span class="legend-count">206 Kasus</span>
                        <span class="legend-pct">16.1%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Predictions -->
<div class="card recent-card">
    <div class="card-head">
        <div>
            <div class="card-title">Prediksi Terbaru</div>
            <div class="card-sub">10 prediksi terakhir dari aplikasi mobile</div>
        </div>
        <a href="{{ route('monitoring') }}" class="card-badge" style="text-decoration:none;cursor:pointer;">Lihat Semua →</a>
    </div>
    <div class="table-wrap">
        <table class="pred-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Waktu</th>
                    <th>Diagnosis</th>
                    <th>Keparahan</th>
                    <th>Konfidensialitas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="patient-name">Budi Santoso</div>
                        <div class="patient-id">#USR-0041</div>
                    </td>
                    <td>Hari ini, 14.32</td>
                    <td><span class="diag-badge apnea">Sleep Apnea</span></td>
                    <td><span class="severity-dot high"></span> Tinggi</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:94%;background:var(--accent-red)"></div></div>
                            <span class="conf-val" style="color:var(--accent-red)">94%</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="patient-name">Siti Rahayu</div>
                        <div class="patient-id">#USR-0040</div>
                    </td>
                    <td>Hari ini, 13.15</td>
                    <td><span class="diag-badge insomnia">Insomnia</span></td>
                    <td><span class="severity-dot med"></span> Sedang</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:88%;background:var(--accent-teal)"></div></div>
                            <span class="conf-val" style="color:var(--accent-teal)">88%</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="patient-name">Ahmad Fauzi</div>
                        <div class="patient-id">#USR-0039</div>
                    </td>
                    <td>Hari ini, 11.48</td>
                    <td><span class="diag-badge apnea">Sleep Apnea</span></td>
                    <td><span class="severity-dot high"></span> Tinggi</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:97%;background:var(--accent-red)"></div></div>
                            <span class="conf-val" style="color:var(--accent-red)">97%</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="patient-name">Dewi Lestari</div>
                        <div class="patient-id">#USR-0038</div>
                    </td>
                    <td>Hari ini, 10.22</td>
                    <td><span class="diag-badge hypersomnia">Sleep Apnea</span></td>
                    <td><span class="severity-dot med"></span> Sedang</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:82%;background:var(--accent-amber)"></div></div>
                            <span class="conf-val" style="color:var(--accent-amber)">82%</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="patient-name">Rizky Pratama</div>
                        <div class="patient-id">#USR-0037</div>
                    </td>
                    <td>Hari ini, 09.05</td>
                    <td><span class="diag-badge normal">Normal</span></td>
                    <td><span class="severity-dot low"></span> Rendah</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:91%;background:var(--accent-green)"></div></div>
                            <span class="conf-val" style="color:var(--accent-green)">91%</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="patient-name">Ningsih Wulandari</div>
                        <div class="patient-id">#USR-0036</div>
                    </td>
                    <td>Kemarin, 21.50</td>
                    <td><span class="diag-badge apnea">Sleep Apnea</span></td>
                    <td><span class="severity-dot high"></span> Tinggi</td>
                    <td>
                        <div class="conf-bar-wrap">
                            <div class="conf-bar-bg"><div class="conf-bar-fill" style="width:95%;background:var(--accent-red)"></div></div>
                            <span class="conf-val" style="color:var(--accent-red)">95%</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<div class="grid-bottom">

    <div class="card">
        <div class="stat-label">Akurasi</div>
        <div class="stat-value green">98.4%</div>
    </div>

    <div class="card">
        <div class="stat-label">Latency</div>
        <div class="stat-value navy">1.2s</div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

</div>

@endsection