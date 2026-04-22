@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_pertanyaan.css') }}">

<div class="kelola-pertanyaan-container">
    <div class="section-label">Master Data / Kelola Pertanyaan</div>
    <h1 class="page-title">Manajemen <span>Pertanyaan</span></h1>
    <p class="page-subtitle">Kelola daftar pertanyaan asesmen gangguan tidur untuk fitur prediksi. Setiap pertanyaan merepresentasikan satu fitur input model machine learning.</p>

    <div class="stats-bar">
        <div class="stat-card"><div class="stat-label">Total Pertanyaan</div><div class="stat-val" id="sTotal">0</div><div class="stat-sub">Semua variabel</div></div>
        <div class="stat-card"><div class="stat-label">Aktif</div><div class="stat-val" id="sAktif" style="color:var(--accent-green)">0</div><div class="stat-sub">Digunakan prediksi</div></div>
        <div class="stat-card"><div class="stat-label">Tipe Select</div><div class="stat-val" id="sSelect" style="color:var(--accent-amber)">0</div><div class="stat-sub">Pilihan opsi</div></div>
        <div class="stat-card"><div class="stat-label">Tipe Range</div><div class="stat-val" id="sRange" style="color:var(--accent-teal)">0</div><div class="stat-sub">Input angka</div></div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Pertanyaan</span>
                <span class="count-badge" id="countBadge">0 pertanyaan</span>
            </div>
            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari pertanyaan..." class="search-input">
                </div>
                <select class="filter-select" id="filterType">
                    <option value="">Semua Tipe</option>
                    <option value="select">Select</option>
                    <option value="range">Range</option>
                </select>
                <button class="btn btn-primary" id="btnTambah">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Pertanyaan
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>No</th><th>Pertanyaan / Variabel</th><th>Tipe</th><th>Opsi / Range</th><th>Urutan</th><th>Aksi</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Stress Level Panel -->
        <div class="stress-panel">
            <div class="sp-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                Detail Deskripsi Stress Level (1 – 10)
            </div>
            <div class="sp-sub">Setiap angka memiliki keterangan kondisi stres yang ditampilkan kepada pengguna saat mengisi asesmen.</div>
            <div class="stress-grid" id="stressLevelGrid"></div>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <div class="modal-head">
            <div><div class="modal-title" id="modalTitle">Tambah Pertanyaan</div><div class="modal-sub">Isi detail variabel untuk fitur prediksi</div></div>
            <button class="modal-close" id="closeModalBtn"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
        </div>
        <input type="hidden" id="editId">
        <div class="f-row col2">
            <div class="f-group"><label class="f-label">Nama Variabel <span class="req">*</span></label><input class="f-input" id="fName" placeholder="cth: Sleep Duration"></div>
            <div class="f-group"><label class="f-label">Urutan <span class="req">*</span></label><input type="number" class="f-input" id="fOrder" placeholder="1 – 99" min="1"></div>
        </div>
        <div class="f-row col1">
            <div class="f-group"><label class="f-label">Teks Pertanyaan <span class="req">*</span></label><input class="f-input" id="fQuestion" placeholder="cth: Berapa jam rata-rata Anda tidur?"></div>
        </div>
        <div class="f-row col1">
            <div class="f-group"><label class="f-label">Deskripsi / Keterangan</label><textarea class="f-textarea" id="fDesc" placeholder="Penjelasan tambahan..."></textarea></div>
        </div>
        <div class="f-row col1">
            <div class="f-group"><label class="f-label">Tipe Input <span class="req">*</span></label>
                <select class="f-select" id="fType">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="select">Select (Pilihan)</option>
                    <option value="range">Range (Angka)</option>
                </select>
            </div>
        </div>
        {{-- Range fields --}}
        <div class="f-row col2 range-fields" id="rangeFields">
            <div class="f-group"><label class="f-label">Nilai Minimum</label><input type="number" class="f-input" id="fMin" placeholder="0"></div>
            <div class="f-group"><label class="f-label">Nilai Maksimum</label><input type="number" class="f-input" id="fMax" placeholder="100"></div>
        </div>
        <div class="f-row col1 range-fields" id="rangeUnit">
            <div class="f-group"><label class="f-label">Satuan</label><input class="f-input" id="fUnit" placeholder="cth: jam"></div>
        </div>
        {{-- Select fields --}}
        <div class="f-row col1 select-fields" id="selectFields">
            <div class="f-group"><label class="f-label">Opsi Pilihan</label><textarea class="f-textarea" id="fOptions" placeholder="Satu opsi per baris"></textarea></div>
        </div>
        {{-- Stress desc fields --}}
        <div class="f-row col1 stress-desc-fields" id="stressDescFields">
            <div class="f-group"><label class="f-label">Deskripsi Per Level Stres (opsional)</label>
                <div class="stress-level-grid" id="stressLevelInputs"></div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-ghost" id="batalModalBtn">Batal</button>
            <button class="btn btn-primary" id="simpanModalBtn">Simpan Pertanyaan</button>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal-bg" id="delModalBg">
    <div class="del-modal-box">
        <div class="del-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg></div>
        <div class="del-title">Hapus Pertanyaan?</div>
        <div class="del-desc">Pertanyaan <strong id="delName"></strong> akan dihapus permanen.</div>
        <div class="del-actions">
            <button class="btn btn-ghost" id="batalDelBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDelBtn">Ya, Hapus</button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast"><div class="t-icon" id="tIcon"></div><span id="tMsg"></span></div>

<script>
// Data dan fungsi JavaScript sama seperti sebelumnya, tetapi disesuaikan dengan elemen baru.
// Karena panjang, akan saya sertakan di bawah setelah penjelasan.
</script>
@endsection