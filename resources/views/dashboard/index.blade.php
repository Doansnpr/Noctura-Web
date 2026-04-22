@extends('layouts.dashboard')
@section('content')

<div class="page-eyebrow">Dashboard Admin</div>
<h1 class="welcome-title">Selamat datang, <span>Dr. Setiawan.</span></h1>
<p class="welcome-subtitle">
    Guardian AI menganalisis <strong>42 siklus tidur pasien baru</strong> hari ini.
    3 pasien menunjukkan tanda-tanda obstructive apnea akut.
</p>

<div class="alert-banner">
    <div class="alert-text">
        <div class="alert-title">3 Pasien Membutuhkan Perhatian Segera</div>
        <div class="alert-desc">
            Cluster A — Severe obstructive apnea terdeteksi.
        </div>
    </div>
</div>

<div class="grid-main">

    <!-- Risk -->
    <div class="card">
        <div class="card-label">Profil Risiko</div>
        <div class="donut-center">
            <div class="donut-number">142</div>
            <div class="donut-text">Total Kasus</div>
        </div>
    </div>

    <!-- AI -->
    <div class="card">
        <div class="ai-title">Analisis Tidur</div>
        <p class="ai-desc">
            Penurunan 15% pada siklus REM.
        </p>
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

</div>

@endsection