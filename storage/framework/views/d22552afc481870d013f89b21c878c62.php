<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/visualisasi.css')); ?>">

<div class="visualisasi-container">
    <div class="section-label">Visualisasi</div>
    <h1 class="page-title">Data <span>Prediksi Gangguan Tidur</span></h1>
    <p class="page-subtitle">
        Analisis komprehensif hasil prediksi, distribusi usia, gender, dan tren temporal.
    </p>
    <br>

    
    <div class="vis-grid-2">

        
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Distribusi</div>
                    <div class="vis-card-title">Jenis Gangguan Tidur</div>
                </div>
                <span class="vis-badge navy" id="totalPrediksi">0 Prediksi</span>
            </div>
            <div class="vis-donut-layout">
                <div class="vis-donut-wrap">
                    <canvas id="donutGangguanChart"></canvas>
                    <div class="vis-donut-center">
                        <div class="vis-donut-num" id="totalDonut">0</div>
                        <div class="vis-donut-sub">Total</div>
                    </div>
                </div>
                <div class="vis-donut-legend" id="donutGangguanLegend"></div>
            </div>
        </div>

        
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Tren Bulanan</div>
                    <div class="vis-card-title">Jumlah Prediksi per Bulan</div>
                </div>
                <div class="vis-live-badge">
                    <span class="vis-pulse-dot"></span>LIVE
                </div>
            </div>
            <div class="vis-chart-wrap" style="height:220px">
                <canvas id="lineTrenChart"></canvas>
            </div>
        </div>

    </div>

    
    <div class="vis-grid-2">

        
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Demografi</div>
                    <div class="vis-card-title">Distribusi Usia Pengguna</div>
                </div>
                <span class="vis-badge teal">Kelompok Usia</span>
            </div>
            <div class="vis-chart-label">Jumlah pengguna per kelompok</div>
            <div class="vis-chart-wrap" style="height:200px">
                <canvas id="barUsiaChart"></canvas>
            </div>
            <div class="vis-chart-footer">
                <span>Kelompok terbanyak</span>
                <span class="vis-chart-footer-val amber" id="usiaTop">—</span>
            </div>
        </div>

        
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Demografi</div>
                    <div class="vis-card-title">Perbandingan Gender</div>
                </div>
                <span class="vis-badge amber">Gender</span>
            </div>
            <div class="vis-donut-layout">
                <div class="vis-donut-wrap">
                    <canvas id="donutGenderChart"></canvas>
                    <div class="vis-donut-center">
                        <div class="vis-donut-num" id="totalGender">0</div>
                        <div class="vis-donut-sub">Total</div>
                    </div>
                </div>
                <div class="vis-donut-legend" id="donutGenderLegend"></div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const warnaGangguan = ['#6366f1', '#8b5cf6', '#38bdf8', '#a78bfa'];
    const warnaGender   = ['#6366f1', '#38bdf8'];
    const warnaUsia     = ['#1e40af', '#6366f1', '#8b5cf6', '#38bdf8', '#a78bfa'];

    Chart.defaults.font.family = "'DM Sans', 'Segoe UI', sans-serif";
    Chart.defaults.font.size   = 11;
    Chart.defaults.color       = '#64748b';

    const gridConfig = {
        color: 'rgba(148,163,184,0.15)',
        drawBorder: false,
    };
    const tickConfig = {
        color: '#94a3b8',
        padding: 6,
        font: { size: 11 }
    };

    let chartGangguan, chartTren, chartUsia, chartGender;

    async function loadData() {
        try {
            const response = await fetch('/api/chart-data');
            const result   = await response.json();
            if (result.success) {
                const data = result;
                updateGangguanChart(data.gangguan);
                updateTrenChart(data.tren);
                updateUsiaChart(data.usia);
                updateGenderChart(data.gender);
            } else {
                console.error('Error:', result.message);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }

    function buildDonutLegend(containerId, labels, data, colors, total) {
        const div = document.getElementById(containerId);
        if (!div) return;
        div.innerHTML = '';
        labels.forEach((label, i) => {
            const persen = ((data[i] / total) * 100).toFixed(1);
            div.innerHTML += `
                <div class="vis-donut-leg-item">
                    <div class="vis-donut-leg-top">
                        <span class="vis-leg-dot" style="background:${colors[i]}"></span>
                        <span class="vis-donut-leg-name">${label}</span>
                        <span class="vis-donut-leg-pct">${persen}%</span>
                        <span class="vis-donut-leg-count">${data[i]}</span>
                    </div>
                    <div class="vis-leg-track">
                        <div class="vis-leg-fill" style="width:${persen}%;background:${colors[i]}"></div>
                    </div>
                </div>
            `;
        });
    }

    function updateGangguanChart(data) {
        const canvas = document.getElementById('donutGangguanChart');
        if (!canvas) return;
        if (chartGangguan) chartGangguan.destroy();

        chartGangguan = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: warnaGangguan.slice(0, data.labels.length),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} (${((ctx.parsed / data.total) * 100).toFixed(1)}%)`
                        }
                    }
                }
            }
        });

        document.getElementById('totalPrediksi').textContent = data.total + ' Prediksi';
        document.getElementById('totalDonut').textContent    = data.total;
        buildDonutLegend('donutGangguanLegend', data.labels, data.data, warnaGangguan, data.total);
    }

    function updateTrenChart(data) {
        const canvas = document.getElementById('lineTrenChart');
        if (!canvas) return;
        if (chartTren) chartTren.destroy();

        chartTren = new Chart(canvas, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Jumlah Prediksi',
                    data: data.data,
                    borderColor: '#14b8a6',
                    backgroundColor: 'rgba(20,184,166,0.08)',
                    borderWidth: 2.5,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#14b8a6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#0d9488',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#94a3b8',
                        bodyColor: '#f1f5f9',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: ctx => `Prediksi: ${ctx.parsed.y}`
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 11 }, padding: 6 }
                    },
                    y: {
                        position: 'left',
                        grid: { color: 'rgba(148,163,184,0.15)', drawBorder: false },
                        border: { display: false },
                        ticks: {
                            color: '#334155',
                            font: { size: 12, weight: '600' },
                            padding: 10,
                            stepSize: 1,
                            precision: 0,
                            callback: val => Number.isInteger(val) ? val : null
                        },
                        beginAtZero: true,
                        suggestedMax: Math.max(...data.data) + 2
                    }
                }
            }
        });
    }

    function updateUsiaChart(data) {
        const canvas = document.getElementById('barUsiaChart');
        if (!canvas) return;
        if (chartUsia) chartUsia.destroy();

        // Cari kelompok terbanyak
        const maxIdx = data.data.indexOf(Math.max(...data.data));
        document.getElementById('usiaTop').textContent = `${data.labels[maxIdx]} (${data.data[maxIdx]} org)`;

        chartUsia = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: data.data,
                    backgroundColor: warnaUsia.slice(0, data.labels.length).map(c => c + 'cc'),
                    hoverBackgroundColor: warnaUsia.slice(0, data.labels.length),
                    borderRadius: 8,
                    borderSkipped: false,
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#94a3b8',
                        bodyColor: '#f1f5f9',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: ctx => `Pengguna: ${ctx.parsed.y}`
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { ...tickConfig }
                    },
                    y: {
                        grid: gridConfig,
                        border: { display: false, dash: [4, 4] },
                        ticks: { ...tickConfig },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function updateGenderChart(data) {
        const canvas = document.getElementById('donutGenderChart');
        if (!canvas) return;
        const total = data.data.reduce((a, b) => a + b, 0);
        if (chartGender) chartGender.destroy();

        chartGender = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: warnaGender.slice(0, data.labels.length),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} (${((ctx.parsed / total) * 100).toFixed(1)}%)`
                        }
                    }
                }
            }
        });

        document.getElementById('totalGender').textContent = total;
        buildDonutLegend('donutGenderLegend', data.labels, data.data, warnaGender, total);
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadData();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sleep-detection-backend\resources\views/visualisasi/index.blade.php ENDPATH**/ ?>