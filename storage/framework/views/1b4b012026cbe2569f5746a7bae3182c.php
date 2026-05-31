<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/dashboard-view.css')); ?>">

<div>
    <div class="page-eyebrow">Dashboard Admin</div>
    <h1 class="page-title">Selamat Datang, <span>Admin</span></h1>
    <p class="page-subtitle">
        Pantau ringkasan pengguna, hasil prediksi gangguan tidur, dan artikel edukasi Noctura.
    </p>
</div>

<div class="quick-actions">
    <a href="<?php echo e(url('/monitoring-prediksi')); ?>" class="quick-action">
        Monitoring Prediksi
    </a>
    <a href="<?php echo e(url('/edukasi')); ?>" class="quick-action">
        Kelola Edukasi
    </a>
    <a href="<?php echo e(url('/akun')); ?>" class="quick-action">
        Kelola Akun
    </a>
</div>

<!-- KPI Cards -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap navy">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <span class="kpi-trend neutral">Admin</span>
        </div>
        <div class="kpi-value"><?php echo e(number_format($kpi['total_pengguna'], 0, ',', '.')); ?></div>
        <div class="kpi-label">Total Pengguna Terdaftar</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
            <span class="kpi-trend up">Hari ini: <?php echo e($kpi['prediksi_hari_ini']); ?></span>
        </div>
        <div class="kpi-value"><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?></div>
        <div class="kpi-label">Total Prediksi Dilakukan</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
            </div>
            <span class="kpi-trend neutral"><?php echo e($kpi['artikel_published']); ?> Published</span>
        </div>
        <div class="kpi-value"><?php echo e(number_format($kpi['total_edukasi'], 0, ',', '.')); ?></div>
        <div class="kpi-label">Total Artikel Edukasi</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-top">
            <div class="kpi-icon-wrap amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <span class="kpi-trend down">Monitoring</span>
        </div>
        <div class="kpi-value"><?php echo e(number_format($kpi['insomnia'] + $kpi['sleep_apnea'], 0, ',', '.')); ?></div>
        <div class="kpi-label">Total Indikasi Gangguan Tidur</div>
    </div>
</div>

<div class="dash-grid">

    <!-- Distribusi 6 Bulan -->
    <div class="card">
        <div class="card-head">
            <div>
                <div class="card-title">Distribusi Hasil Prediksi</div>
                <div class="card-sub">Rekapitulasi 6 bulan terakhir berdasarkan data aplikasi mobile</div>
            </div>
            <span class="card-badge">Per Bulan</span>
        </div>

        <?php
            $maxValue = 1;
            foreach ($monthlyDistribution as $month) {
                $maxValue = max($maxValue, $month['healthy'], $month['insomnia'], $month['sleep_apnea']);
            }

            function barHeight($value, $maxValue) {
                if ($value <= 0) return 10;
                return max(18, min(250, ($value / $maxValue) * 250));
            }
        ?>

        <div class="bar-chart">
            <?php $__currentLoopData = $monthlyDistribution; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bc-col">
                    <div class="bc-bar-wrap">
                        <div class="bc-bar healthy" style="height:<?php echo e(barHeight($month['healthy'], $maxValue)); ?>px">
                            <span class="bar-value"><?php echo e($month['healthy']); ?></span>
                        </div>

                        <div class="bc-bar insomnia" style="height:<?php echo e(barHeight($month['insomnia'], $maxValue)); ?>px">
                            <span class="bar-value"><?php echo e($month['insomnia']); ?></span>
                        </div>

                        <div class="bc-bar apnea" style="height:<?php echo e(barHeight($month['sleep_apnea'], $maxValue)); ?>px">
                            <span class="bar-value"><?php echo e($month['sleep_apnea']); ?></span>
                        </div>
                    </div>
                    <div class="bc-label"><?php echo e($month['label']); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="chart-legend">
            <div class="cl-item"><div class="cl-dot" style="background:var(--accent-green)"></div> Healthy</div>
            <div class="cl-item"><div class="cl-dot" style="background:var(--accent-teal)"></div> Insomnia</div>
            <div class="cl-item"><div class="cl-dot" style="background:var(--accent-amber)"></div> Sleep Apnea</div>
        </div>
    </div>

    <!-- Profil Kasus -->
    <div class="card">
        <div class="card-head">
            <div>
                <div class="card-title">Profil Hasil Prediksi</div>
                <div class="card-sub">Keseluruhan data prediksi yang tersimpan</div>
            </div>
            <span class="card-badge"><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?> Data</span>
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
                    <div class="donut-num"><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?></div>
                    <div class="donut-lbl">Total Prediksi</div>
                </div>
            </div>

            <div class="legend-list">
                <?php $__currentLoopData = $caseProfile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="legend-item">
                        <div class="legend-left">
                            <div class="legend-dot legend-dot-<?php echo e($case['key']); ?>"></div>
                            <?php echo e($case['label']); ?>

                        </div>
                        <div class="legend-right">
                            <span class="legend-count"><?php echo e(number_format($case['count'], 0, ',', '.')); ?> Data</span>
                            <span class="legend-pct"><?php echo e($case['percent']); ?>%</span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Artikel Edukasi -->
    <div class="card">
        <div class="card-head">
            <div>
                <div class="card-title">Ringkasan Edukasi</div>
                <div class="card-sub">Artikel edukasi yang tersedia untuk aplikasi mobile</div>
            </div>
            <a href="<?php echo e(url('/edukasi')); ?>" class="card-badge" style="text-decoration:none;">Kelola Artikel →</a>
        </div>

        <div class="edu-summary-grid">
            <div class="edu-summary-item">
                <span>Total Artikel</span>
                <b><?php echo e(number_format($kpi['total_edukasi'], 0, ',', '.')); ?></b>
            </div>
            <div class="edu-summary-item">
                <span>Published</span>
                <b><?php echo e(number_format($kpi['artikel_published'], 0, ',', '.')); ?></b>
            </div>
            <div class="edu-summary-item">
                <span>Draft</span>
                <b><?php echo e(number_format($kpi['artikel_draft'], 0, ',', '.')); ?></b>
            </div>
        </div>

        <div class="mini-table-wrap">
            <table class="pred-table">
                <thead>
                    <tr>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="patient-name"><?php echo e($article['judul']); ?></div>
                            </td>
                            <td><?php echo e($article['kategori']); ?></td>
                            <td>
                                <span class="diag-badge <?php echo e($article['status'] === 'Published' ? 'normal' : 'hypersomnia'); ?>">
                                    <?php echo e($article['status']); ?>

                                </span>
                            </td>
                            <td><?php echo e($article['tanggal']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="empty-state">Belum ada artikel edukasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Recent Predictions -->
<div class="card recent-card">
    <div class="card-head">
        <div>
            <div class="card-title">Prediksi Terbaru</div>
            <div class="card-sub">Prediksi terakhir dari aplikasi mobile</div>
        </div>
        <a href="<?php echo e(url('/monitoring-prediksi')); ?>" class="card-badge" style="text-decoration:none;cursor:pointer;">Lihat Semua →</a>
    </div>

    <div class="table-wrap">
        <table class="pred-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Waktu</th>
                    <th>Hasil Prediksi</th>
                    <th>Risiko</th>
                    <th>Confidence</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentPredictions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $badgeClass = match($item['prediction_key']) {
                            'healthy' => 'normal',
                            'insomnia' => 'insomnia',
                            'sleep_apnea' => 'hypersomnia',
                            default => 'apnea',
                        };

                        $severityClass = match($item['severity']) {
                            'Tinggi' => 'high',
                            'Sedang' => 'med',
                            default => 'low',
                        };

                        $confColor = match($severityClass) {
                            'high' => 'var(--accent-red)',
                            'med' => 'var(--accent-amber)',
                            default => 'var(--accent-green)',
                        };
                    ?>

                    <tr>
                        <td>
                            <div class="patient-name">User</div>
                            <div class="patient-id"><?php echo e($item['user_id']); ?></div>
                        </td>
                        <td><?php echo e($item['tanggal_tampil']); ?></td>
                        <td>
                            <span class="diag-badge <?php echo e($badgeClass); ?>">
                                <?php echo e($item['prediction']); ?>

                            </span>
                        </td>
                        <td>
                            <span class="severity-dot <?php echo e($severityClass); ?>"></span>
                            <?php echo e($item['severity']); ?>

                        </td>
                        <td>
                            <div class="conf-bar-wrap">
                                <div class="conf-bar-bg">
                                    <div class="conf-bar-fill" style="width:<?php echo e(min($item['confidence_utama'], 100)); ?>%;background:<?php echo e($confColor); ?>"></div>
                                </div>
                                <span class="conf-val" style="color:<?php echo e($confColor); ?>">
                                    <?php echo e($item['confidence_utama']); ?>%
                                </span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="empty-state">
                            Belum ada data prediksi dari aplikasi mobile.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script>
setInterval(() => {
    window.location.reload();
}, 30000);
</script>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noctura\resources\views/dashboard/index.blade.php ENDPATH**/ ?>