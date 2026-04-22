@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kelola_jawaban.css') }}">

<div class="kelola-jawaban-container">
    <div class="section-label">Master Data / Kelola Jawaban</div>
    <h1 class="page-title">Manajemen <span>Jawaban</span></h1>
    <p class="page-subtitle">Kelola pilihan jawaban untuk setiap pertanyaan tipe Select, serta pemetaan range ke kategori untuk pertanyaan tipe Range.</p>

    <div class="stats-bar">
        <div class="stat-card"><div class="stat-label">Total Jawaban</div><div class="stat-val" id="totalJawaban">0</div></div>
        <div class="stat-card"><div class="stat-label">Pertanyaan Select</div><div class="stat-val" id="totalSelect">0</div></div>
        <div class="stat-card"><div class="stat-label">Pertanyaan Range</div><div class="stat-val" id="totalRange">0</div></div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-left">
                <span class="toolbar-title">Daftar Jawaban</span>
                <span class="count-badge" id="countBadge">0 jawaban</span>
            </div>
            <div class="toolbar-right">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari pertanyaan..." class="search-input">
                </div>
                <button class="btn btn-primary" id="btnTambah">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Jawaban
                </button>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>No</th><th>Pertanyaan</th><th>Tipe</th><th>Jawaban / Opsi</th><th>Aksi</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit Jawaban --}}
<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <div class="modal-head">
            <div><div class="modal-title" id="modalTitle">Tambah Jawaban</div></div>
            <button class="modal-close" id="closeModalBtn"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
        </div>
        <input type="hidden" id="editId">
        <div class="f-row col1">
            <div class="f-group">
                <label class="f-label">Pilih Pertanyaan <span class="req">*</span></label>
                <select class="f-select" id="pertanyaanId"></select>
            </div>
        </div>
        <div class="f-row col1" id="jawabanSelectFields">
            <div class="f-group">
                <label class="f-label">Opsi Jawaban <span class="req">*</span></label>
                <textarea class="f-textarea" id="opsiJawaban" placeholder="Tulis satu opsi per baris"></textarea>
                <span class="f-hint">Satu opsi per baris</span>
            </div>
        </div>
        <div class="f-row col2" id="jawabanRangeFields" style="display:none;">
            <div class="f-group"><label class="f-label">Range Min</label><input type="number" class="f-input" id="rangeMin"></div>
            <div class="f-group"><label class="f-label">Range Max</label><input type="number" class="f-input" id="rangeMax"></div>
        </div>
        <div class="f-row col1" id="jawabanRangeLabelFields" style="display:none;">
            <div class="f-group"><label class="f-label">Label Kategori</label><input class="f-input" id="rangeLabel" placeholder="cth: Normal"></div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-ghost" id="batalModalBtn">Batal</button>
            <button class="btn btn-primary" id="simpanModalBtn">Simpan Jawaban</button>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal-bg" id="delModalBg">
    <div class="del-modal-box">
        <div class="del-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg></div>
        <div class="del-title">Hapus Jawaban?</div>
        <div class="del-desc">Jawaban ini akan dihapus permanen.</div>
        <div class="del-actions">
            <button class="btn btn-ghost" id="batalDelBtn">Batal</button>
            <button class="btn btn-danger" id="confirmDelBtn">Ya, Hapus</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"><div class="t-icon" id="tIcon"></div><span id="tMsg"></span></div>

<script>
// Data dummy pertanyaan (sama dengan di pertanyaan)
const questions = [
  {id:1,name:'Gender',type:'select',opts:'Male\nFemale'},
  {id:2,name:'Age',type:'range',min:18,max:90,unit:'tahun'},
  {id:3,name:'Occupation',type:'select',opts:'Doctor\nEngineer\nTeacher\nNurse\nAccountant\nLawyer\nSales Representative\nScientist\nSoftware Engineer\nManager'},
  {id:4,name:'Sleep Duration',type:'range',min:1,max:12,unit:'jam'},
  {id:5,name:'Quality of Sleep',type:'range',min:1,max:10},
  {id:6,name:'Physical Activity Level',type:'range',min:0,max:120,unit:'menit/hari'},
  {id:7,name:'Stress Level',type:'range',min:1,max:10},
  {id:8,name:'BMI Category',type:'select',opts:'Underweight\nNormal Weight\nOverweight\nObese'},
  {id:9,name:'Steps',type:'range',min:0,max:25000,unit:'langkah'},
];

// Data jawaban (dummy)
let jawabanList = [
  {id:1, pertanyaanId:1, tipe:'select', opsi: 'Male\nFemale'},
  {id:2, pertanyaanId:3, tipe:'select', opsi: 'Doctor\nEngineer\nTeacher\nNurse\nAccountant\nLawyer\nSales Representative\nScientist\nSoftware Engineer\nManager'},
  {id:3, pertanyaanId:8, tipe:'select', opsi: 'Underweight\nNormal Weight\nOverweight\nObese'},
  {id:4, pertanyaanId:2, tipe:'range', rangeMin:18, rangeMax:90, label:'Usia'},
  // ... tambahkan sesuai kebutuhan
];
let nextId = 10;
let deleteTarget = null;

// Fungsi render dan CRUD akan mirip dengan sebelumnya.
// Karena panjang, saya sarankan menyalin dari kode asli dengan penyesuaian.
</script>
@endsection