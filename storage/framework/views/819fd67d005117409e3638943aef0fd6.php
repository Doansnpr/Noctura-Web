<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/dashboard-view.css')); ?>">
<div>
<div class="page-eyebrow">Dashboard Admin</div>
<h1 class="page-title">Selamat Datang, <span>Admin</span></h1>
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
        <a href="<?php echo e(route('monitoring')); ?>" class="card-badge" style="text-decoration:none;cursor:pointer;">Lihat Semua →</a>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sleep-detection-backend\resources\views/dashboard/index.blade.php ENDPATH**/ ?>