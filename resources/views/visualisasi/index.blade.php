@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/visualisasi.css') }}">

<div class="visualisasi-container">
    <div class="section-label">Visualisasi</div>
    <h1 class="page-title">Data <span>Gangguan Tidur</span></h1>
    <p class="page-subtitle">
        Analisis komprehensif pola tidur, distribusi risiko, dan tren temporal seluruh populasi pasien.
        Data diperbarui secara real-time oleh <strong>Guardian AI</strong>.
    </p>
    <br>


    {{-- ROW 1: Line + Donut --}}
    <div class="vis-grid-2">

        {{-- Chart 1: Line — REM & Deep Sleep --}}
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Tren Mingguan</div>
                    <div class="vis-card-title">REM & Deep Sleep</div>
                </div>
                <div class="vis-live-badge">
                    <span class="vis-pulse-dot"></span>LIVE
                </div>
            </div>
            <div class="vis-legend">
                <div class="vis-leg-item"><span class="vis-leg-line teal"></span>REM Sleep</div>
                <div class="vis-leg-item"><span class="vis-leg-line amber dashed"></span>Deep Sleep</div>
            </div>
            <div class="vis-chart-wrap" style="height:190px">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="vis-divider"></div>
            <div class="vis-stat-row">
                <div class="vis-stat-mini">
                    <div class="vis-card-label">Rata-rata REM</div>
                    <div class="vis-stat-val teal" id="statRem">—</div>
                </div>
                <div class="vis-stat-mini">
                    <div class="vis-card-label">Rata-rata Deep</div>
                    <div class="vis-stat-val amber" id="statDeep">—</div>
                </div>
                <div class="vis-stat-mini">
                    <div class="vis-card-label">Efisiensi Tidur</div>
                    <div class="vis-stat-val" id="statEff">—</div>
                </div>
            </div>
        </div>

        {{-- Chart 2: Donut — Distribusi Gangguan --}}
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Distribusi</div>
                    <div class="vis-card-title">Jenis Gangguan Tidur</div>
                </div>
                <span class="vis-badge navy">142 Pasien</span>
            </div>
            <div class="vis-donut-layout">
                <div class="vis-donut-wrap">
                    <canvas id="donutChart"></canvas>
                    <div class="vis-donut-center">
                        <div class="vis-donut-num">142</div>
                        <div class="vis-donut-sub">Total</div>
                    </div>
                </div>
                <div class="vis-donut-legend">
                    <div class="vis-donut-leg-item">
                        <div class="vis-donut-leg-top">
                            <span class="vis-leg-dot" style="background:#5b8def"></span>
                            <span class="vis-donut-leg-name">Apnea Obstruktif</span>
                            <span class="vis-donut-leg-pct">64%</span>
                        </div>
                        <div class="vis-leg-track"><div class="vis-leg-fill" style="width:64%;background:#5b8def"></div></div>
                    </div>
                    <div class="vis-donut-leg-item">
                        <div class="vis-donut-leg-top">
                            <span class="vis-leg-dot" style="background:#14b8a6"></span>
                            <span class="vis-donut-leg-name">Insomnia</span>
                            <span class="vis-donut-leg-pct">22%</span>
                        </div>
                        <div class="vis-leg-track"><div class="vis-leg-fill" style="width:22%;background:#14b8a6"></div></div>
                    </div>
                    <div class="vis-donut-leg-item">
                        <div class="vis-donut-leg-top">
                            <span class="vis-leg-dot" style="background:#f59e0b"></span>
                            <span class="vis-donut-leg-name">Hipersomnia</span>
                            <span class="vis-donut-leg-pct">14%</span>
                        </div>
                        <div class="vis-leg-track"><div class="vis-leg-fill" style="width:14%;background:#f59e0b"></div></div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end row 1 --}}

    {{-- ROW 2: Bar + Radar --}}
    <div class="vis-grid-2">

        {{-- Chart 3: Bar — AHI Score --}}
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Distribusi Harian</div>
                    <div class="vis-card-title">AHI Score per Hari</div>
                </div>
                <span class="vis-badge amber">AHI Index</span>
            </div>
            <div class="vis-tabs">
                <button class="vis-tab active" data-mode="normal">Normal</button>
                <button class="vis-tab" data-mode="moderate">Sedang</button>
                <button class="vis-tab" data-mode="severe">Parah</button>
            </div>
            <div class="vis-chart-wrap" style="height:160px">
                <canvas id="barChart"></canvas>
            </div>
            <div class="vis-legend" style="margin-top:12px;margin-bottom:0">
                <div class="vis-leg-item"><span class="vis-leg-sq teal-sq"></span>Normal &lt;5</div>
                <div class="vis-leg-item"><span class="vis-leg-sq amber-sq"></span>Sedang 5–15</div>
                <div class="vis-leg-item"><span class="vis-leg-sq red-sq"></span>Parah &gt;15</div>
            </div>
        </div>

        {{-- Chart 4: Radar — Kualitas Tidur --}}
        <div class="vis-card">
            <div class="vis-card-head">
                <div>
                    <div class="vis-card-label">Profil Klinis</div>
                    <div class="vis-card-title">Kualitas Tidur Pasien</div>
                </div>
                <span class="vis-badge teal">5 Dimensi</span>
            </div>
            <div class="vis-legend">
                <div class="vis-leg-item"><span class="vis-leg-sq teal-sq"></span>Minggu Ini</div>
                <div class="vis-leg-item"><span class="vis-leg-sq navy-sq"></span>Rata-rata</div>
            </div>
            <div class="vis-chart-wrap" style="height:190px">
                <canvas id="radarChart"></canvas>
            </div>
        </div>

    </div>{{-- end row 2 --}}

</div>{{-- end container --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
// ==================== DATA ====================
const barDatasets = {
    normal:   [3,  5,  2,  6,  4,  5,  1],
    moderate: [8,  12, 6,  14, 9,  11, 5],
    severe:   [18, 22, 12, 28, 16, 24, 9]
};

const trendData = {
    labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
    rem:    [58, 62, 70, 66, 74, 68, 72],
    deep:   [38, 44, 40, 48, 42, 46, 44],
    avgRem: 68.4, avgDeep: 42.1, avgEff: 81.2
};

// ==================== WARNA ====================
const C = {
    teal:    '#14b8a6',
    amber:   '#f59e0b',
    red:     '#f43f5e',
    blue:    '#5b8def',
    blueMid: '#93b4f5',
    text:    '#94a3b8',
    grid:    'rgba(30,41,59,.07)',
};

function getBarColor(v) {
    if (v < 5)   return C.teal;
    if (v <= 15) return C.amber;
    return C.red;
}

// ==================== BUILD CHARTS ====================
let lineChart, donutChart, barChart, radarChart;

function buildCharts() {
    // Stat summary
    document.getElementById('statRem').textContent  = trendData.avgRem + '%';
    document.getElementById('statDeep').textContent = trendData.avgDeep + '%';
    document.getElementById('statEff').textContent  = trendData.avgEff + '%';

    // LINE
    if (lineChart) lineChart.destroy();
    lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: trendData.labels,
            datasets: [
                {
                    label: 'REM Sleep',
                    data: trendData.rem,
                    borderColor: C.teal,
                    backgroundColor: 'rgba(20,184,166,0.12)',
                    borderWidth: 2, fill: true, tension: 0.42,
                    pointBackgroundColor: '#fff', pointBorderColor: C.teal,
                    pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6,
                },
                {
                    label: 'Deep Sleep',
                    data: trendData.deep,
                    borderColor: C.amber,
                    backgroundColor: 'rgba(245,158,11,0.08)',
                    borderWidth: 2, fill: true, tension: 0.42,
                    borderDash: [5,3],
                    pointBackgroundColor: '#fff', pointBorderColor: C.amber,
                    pointBorderWidth: 2, pointRadius: 4, pointHoverRadius: 6,
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: C.text, font: { size:11, family:"'Space Mono',monospace" } }, grid: { color: C.grid } },
                y: { min:20, max:90, ticks: { color: C.text, font:{size:11}, callback: v => v+'%' }, grid: { color: C.grid } }
            }
        }
    });

    // DONUT
    if (donutChart) donutChart.destroy();
    donutChart = new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Apnea Obstruktif','Insomnia','Hipersomnia'],
            datasets: [{ data:[64,22,14], backgroundColor:[C.blue,C.teal,C.amber], borderColor:'#fff', borderWidth:3, hoverOffset:8 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '70%',
            plugins: { legend: { display: false } }
        }
    });

    // BAR
    if (barChart) barChart.destroy();
    const bd = barDatasets.normal;
    barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
            datasets: [{ label:'AHI Score', data: bd, backgroundColor: bd.map(getBarColor), borderRadius:6, borderSkipped:false }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: C.text, font:{size:11,family:"'Space Mono',monospace"} }, grid:{display:false} },
                y: { min:0, max:35, ticks:{ color:C.text, font:{size:11}, stepSize:10 }, grid:{color:C.grid} }
            }
        }
    });

    // RADAR
    if (radarChart) radarChart.destroy();
    radarChart = new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: ['Durasi Tidur','Efisiensi','Kualitas REM','Deep Sleep','Onset Tidur'],
            datasets: [
                { label:'Minggu Ini', data:[72,81,68,55,63], borderColor: C.teal, backgroundColor:'rgba(20,184,166,0.12)', borderWidth:2, pointBackgroundColor:'#fff', pointBorderColor:C.teal, pointBorderWidth:2, pointRadius:4 },
                { label:'Rata-rata',  data:[65,74,60,50,58], borderColor: C.blueMid, backgroundColor:'rgba(147,180,245,0.12)', borderWidth:1.5, borderDash:[4,3], pointBackgroundColor:'#fff', pointBorderColor:C.blueMid, pointBorderWidth:2, pointRadius:3 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { r: { min:0, max:100, ticks:{display:false}, grid:{color:C.grid}, angleLines:{color:C.grid}, pointLabels:{ color:C.text, font:{size:11,family:"'DM Sans',sans-serif"} } } }
        }
    });
}

// ==================== EVENT LISTENERS ====================
document.addEventListener('DOMContentLoaded', () => {
    buildCharts();

    // Filter Periode
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // di sini bisa fetch data sesuai periode jika sudah ada API
        });
    });

    // Filter Cluster
    document.querySelectorAll('.cluster-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.cluster-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Bar Tabs
    document.querySelectorAll('.vis-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.vis-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const d = barDatasets[tab.dataset.mode];
            barChart.data.datasets[0].data = d;
            barChart.data.datasets[0].backgroundColor = d.map(getBarColor);
            barChart.update();
        });
    });
});
</script>
@endsection