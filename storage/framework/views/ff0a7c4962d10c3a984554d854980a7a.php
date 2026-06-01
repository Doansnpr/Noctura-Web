<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/dashboard-view.css')); ?>">

<div class="dashboard-page">
    <div class="page-eyebrow">Dashboard Admin</div>
    <h1 class="page-title">Selamat Datang, <span>Admin</span></h1>
    <p class="page-subtitle">
        Pantau ringkasan pengguna, hasil prediksi gangguan tidur, dan artikel edukasi Noctura.
    </p>

    <div class="quick-actions">
        <a href="<?php echo e(url('/monitoring-prediksi')); ?>" class="quick-action">Monitoring Prediksi</a>
        <a href="<?php echo e(url('/edukasi')); ?>" class="quick-action">Kelola Edukasi</a>
        <a href="<?php echo e(url('/akun')); ?>" class="quick-action">Kelola Akun</a>
    </div>

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
                <span class="kpi-chip">Admin</span>
            </div>
            <div class="kpi-value"><?php echo e(number_format($kpi['total_pengguna'], 0, ',', '.')); ?></div>
            <div class="kpi-label">Total Pengguna</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-icon-wrap teal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <span class="kpi-chip success">Hari ini <?php echo e($kpi['prediksi_hari_ini']); ?></span>
            </div>
            <div class="kpi-value"><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?></div>
            <div class="kpi-label">Total Prediksi</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-top">
                <div class="kpi-icon-wrap green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>
                <span class="kpi-chip"><?php echo e($kpi['artikel_published']); ?> Published</span>
            </div>
            <div class="kpi-value"><?php echo e(number_format($kpi['total_edukasi'], 0, ',', '.')); ?></div>
            <div class="kpi-label">Artikel Edukasi</div>
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
                <span class="kpi-chip warning">Monitoring</span>
            </div>
            <div class="kpi-value"><?php echo e(number_format($kpi['indikasi_gangguan'], 0, ',', '.')); ?></div>
            <div class="kpi-label">Indikasi Gangguan</div>
        </div>
    </div>

    <?php
        $healthyPercent = $caseProfile[0]['percent'] ?? 0;
        $insomniaPercent = $caseProfile[1]['percent'] ?? 0;
        $apneaPercent = $caseProfile[2]['percent'] ?? 0;

        $healthyStop = $healthyPercent;
        $insomniaStop = $healthyPercent + $insomniaPercent;

        $donutBackground = $kpi['total_prediksi'] > 0
            ? "conic-gradient(#5b61f6 0 {$healthyStop}%, #38bdf8 {$healthyStop}% {$insomniaStop}%, #8b5cf6 {$insomniaStop}% 100%)"
            : "conic-gradient(#e2e8f0 0 100%)";

        $maxMonth = 1;
        foreach ($monthlyDistribution as $month) {
            $totalMonth = ($month['healthy'] ?? 0) + ($month['insomnia'] ?? 0) + ($month['sleep_apnea'] ?? 0);
            $maxMonth = max($maxMonth, $totalMonth);
        }
    ?>

    <div class="dashboard-compact-grid">

        <div class="compact-card">
            <div class="compact-head">
                <div>
                    <div class="compact-label">Distribusi</div>
                    <div class="compact-title">Jenis Gangguan Tidur</div>
                </div>
                <span class="compact-badge"><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?> prediksi</span>
            </div>

            <div class="compact-body split">
                <div class="mini-donut">
                    <div class="mini-donut-ring" style="background: <?php echo e($donutBackground); ?>">
                        <div class="mini-donut-center">
                            <b><?php echo e(number_format($kpi['total_prediksi'], 0, ',', '.')); ?></b>
                            <span>Total</span>
                        </div>
                    </div>
                </div>

                <div class="compact-list">
                    <?php $__currentLoopData = $caseProfile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="compact-row">
                            <div class="compact-row-top">
                                <span>
                                    <i class="dot dot-<?php echo e($case['key']); ?>"></i>
                                    <?php echo e($case['label']); ?>

                                </span>
                                <b><?php echo e($case['percent']); ?>%</b>
                            </div>
                            <div class="mini-progress">
                                <div class="mini-progress-fill fill-<?php echo e($case['key']); ?>" style="width: <?php echo e($case['percent']); ?>%"></div>
                            </div>
                            <small><?php echo e(number_format($case['count'], 0, ',', '.')); ?> data</small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="compact-card">
            <div class="compact-head">
                <div>
                    <div class="compact-label">Tren Bulanan</div>
                    <div class="compact-title">Jumlah Prediksi per Bulan</div>
                </div>
                <span class="compact-live">● Live</span>
            </div>

            <div class="mini-line-area">
                <?php $__currentLoopData = $monthlyDistribution; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalMonth = ($month['healthy'] ?? 0) + ($month['insomnia'] ?? 0) + ($month['sleep_apnea'] ?? 0);
                        $height = $totalMonth > 0 ? max(8, ($totalMonth / $maxMonth) * 120) : 5;
                    ?>

                    <div class="mini-line-col" title="<?php echo e($totalMonth); ?> prediksi">
                        <div class="mini-line-dot" style="bottom: <?php echo e($height); ?>px"></div>
                        <div class="mini-line-bar" style="height: <?php echo e($height); ?>px"></div>
                        <span><?php echo e($month['label']); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="compact-card">
            <div class="compact-head">
                <div>
                    <div class="compact-label">Edukasi</div>
                    <div class="compact-title">Ringkasan Artikel</div>
                </div>
                <a href="<?php echo e(url('/edukasi')); ?>" class="compact-badge">Kelola →</a>
            </div>

            <div class="edu-mini-grid">
                <div class="edu-mini-item">
                    <span>Total</span>
                    <b><?php echo e(number_format($kpi['total_edukasi'], 0, ',', '.')); ?></b>
                </div>
                <div class="edu-mini-item">
                    <span>Published</span>
                    <b><?php echo e(number_format($kpi['artikel_published'], 0, ',', '.')); ?></b>
                </div>
                <div class="edu-mini-item">
                    <span>Draft</span>
                    <b><?php echo e(number_format($kpi['artikel_draft'], 0, ',', '.')); ?></b>
                </div>
            </div>

            <div class="mini-article-list">
                <?php $__empty_1 = true; $__currentLoopData = $recentArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mini-article-item">
                        <div>
                            <b><?php echo e($article['judul']); ?></b>
                            <span><?php echo e($article['kategori']); ?> • <?php echo e($article['tanggal']); ?></span>
                        </div>
                        <small class="<?php echo e($article['status'] === 'Published' ? 'status-published' : 'status-draft'); ?>">
                            <?php echo e($article['status']); ?>

                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-mini">Belum ada artikel edukasi.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="compact-card">
            <div class="compact-head">
                <div>
                    <div class="compact-label">Monitoring</div>
                    <div class="compact-title">Prediksi Terbaru</div>
                </div>
                <a href="<?php echo e(url('/monitoring-prediksi')); ?>" class="compact-badge">Lihat Semua →</a>
            </div>

            <div class="mini-prediction-list">
                <?php $__empty_1 = true; $__currentLoopData = $recentPredictions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $badgeClass = match($item['prediction_key']) {
                            'healthy' => 'badge-healthy',
                            'insomnia' => 'badge-insomnia',
                            'sleep_apnea' => 'badge-apnea',
                            default => 'badge-default',
                        };
                    ?>

                    <div class="mini-prediction-item">
                        <div class="prediction-left">
                            <b><?php echo e($item['user_id']); ?></b>
                            <span><?php echo e($item['tanggal_tampil']); ?></span>
                        </div>

                        <div class="prediction-mid">
                            <small class="mini-badge <?php echo e($badgeClass); ?>"><?php echo e($item['prediction']); ?></small>
                        </div>

                        <div class="prediction-confidence">
                            <b><?php echo e($item['confidence_utama']); ?>%</b>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-mini">Belum ada data prediksi.</div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\sleep-detection-backend\resources\views/dashboard/index.blade.php ENDPATH**/ ?>