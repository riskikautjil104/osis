@extends('layouts.app')

@section('title', 'One Data - Pusat Dokumen')

@push('styles')
<style>
    /* ===== PAGE HERO ===== */
    .page-hero {
        background: linear-gradient(115deg, var(--dark) 55%, var(--primary) 55%);
        position: relative;
        overflow: hidden;
        padding: 4rem 0 5rem;
    }

    .page-hero-pattern {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(29,158,117,0.12) 1px, transparent 1px),
            linear-gradient(90deg, rgba(29,158,117,0.12) 1px, transparent 1px);
        background-size: 50px 50px;
        z-index: 1;
    }

    .page-hero-dots {
        position: absolute;
        right: 0;
        top: 0;
        width: 45%;
        height: 100%;
        z-index: 1;
        opacity: 0.2;
        background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1.5px, transparent 1.5px);
        background-size: 28px 28px;
    }

    .page-hero-content {
        position: relative;
        z-index: 2;
    }

    .page-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(239,159,39,0.18);
        border: 1px solid rgba(239,159,39,0.35);
        border-radius: 50px;
        padding: 5px 14px;
        margin-bottom: 1rem;
    }

    .page-hero-eyebrow span {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--secondary-light);
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .page-hero-title {
        font-family: 'Syne', sans-serif;
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
        line-height: 1.15;
        margin-bottom: 0.75rem;
    }

    .page-hero-sub {
        color: rgba(255,255,255,0.55);
        font-size: 0.92rem;
        max-width: 700px;
    }

    .page-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    /* ===== MAIN SECTION ===== */
    .dokumen-section {
        background: #f9f9f7;
        padding: 0 0 4rem;
    }

    /* ===== STATS ===== */
    .stats-wrap {
        margin-top: -2rem;
        position: relative;
        z-index: 10;
    }

    .stats-card {
        border-radius: 20px;
        padding: 1.4rem 1.2rem;
        text-align: center;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 14px 35px rgba(0,0,0,0.08);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 40%);
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        margin: 0 auto 0.9rem;
        background: rgba(255,255,255,0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .stats-number {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.35rem;
    }

    .stats-label {
        font-size: 0.82rem;
        color: rgba(255,255,255,0.86);
    }

    /* ===== SEARCH & FILTER ===== */
    .search-wrap {
        background: white;
        border-radius: 18px;
        padding: 1.3rem 1.4rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        border: 1px solid #f0f0f0;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f5f7f6;
        border: 1.5px solid #eee;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        transition: all 0.25s ease;
        height: 50px;
    }

    .search-input-group:focus-within {
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(15,110,86,0.08);
    }

    .search-input-group i {
        color: #aaa;
        font-size: 14px;
    }

    .search-input-group input {
        border: none;
        background: transparent;
        flex: 1;
        outline: none;
        font-size: 0.88rem;
        color: #333;
    }

    .search-input-group input::placeholder {
        color: #bbb;
    }

    .filter-select {
        height: 50px;
        border-radius: 14px;
        border: 1.5px solid #eaeaea;
        font-size: 0.88rem;
        box-shadow: none !important;
    }

    .filter-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(15,110,86,0.08) !important;
    }

    .btn-search-submit {
        height: 50px;
        min-width: 50px;
        border-radius: 14px;
        background: var(--primary);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-search-submit:hover {
        background: var(--primary-light);
    }

    /* ===== TOP ACTION ===== */
    .top-action-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.4rem;
        flex-wrap: wrap;
    }

    .result-info {
        font-size: 0.84rem;
        color: #999;
    }

    .result-info strong {
        color: var(--primary);
    }

    .btn-export-custom {
        border-radius: 50px;
        padding: 0.7rem 1.15rem;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .dropdown-menu {
        border: none;
        border-radius: 16px;
        box-shadow: 0 18px 40px rgba(0,0,0,0.09);
        padding: 0.5rem;
    }

    .dropdown-item {
        border-radius: 12px;
        padding: 0.65rem 0.85rem;
        font-size: 0.84rem;
    }

    .dropdown-item:hover {
        background: rgba(15,110,86,0.08);
        color: var(--primary);
    }

    /* ===== DOCUMENT CARD ===== */
    .dokumen-card {
        background: white;
        border-radius: 22px;
        overflow: hidden;
        border: 1.5px solid #ececec;
        transition: all 0.3s ease;
        height: 100%;
    }

    .dokumen-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(15,110,86,0.09);
        border-color: rgba(15,110,86,0.16);
    }

    .dokumen-icon {
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f3f7f5, #fbfbfb);
        font-size: 3rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .dokumen-body {
        padding: 1.15rem;
    }

    .dokumen-category {
        display: inline-block;
        background: rgba(15,110,86,0.09);
        color: var(--primary);
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.38rem 0.75rem;
        border-radius: 50px;
        margin-bottom: 0.75rem;
    }

    .dokumen-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        line-height: 1.45;
        margin-bottom: 0.55rem;
        min-height: 46px;
    }

    .dokumen-meta {
        font-size: 0.76rem;
        color: #8d8d8d;
        line-height: 1.8;
        margin-bottom: 0.7rem;
    }

    .dokumen-desc {
        font-size: 0.82rem;
        color: #999;
        line-height: 1.7;
        min-height: 54px;
        margin-bottom: 0;
    }

    .btn-detail-custom {
        display: inline-flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        background: transparent;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0.7rem 1rem;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-detail-custom:hover {
        background: var(--primary);
        color: white;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        background: white;
        border-radius: 20px;
        padding: 4rem 1.5rem;
        text-align: center;
        border: 1.5px dashed #e6e6e6;
        color: #aaa;
    }

    .empty-state i {
        font-size: 2.8rem;
        opacity: 0.35;
        margin-bottom: 1rem;
        display: block;
    }

    .empty-state-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #666;
        margin-bottom: 0.4rem;
    }

    .empty-state-sub {
        font-size: 0.84rem;
        color: #aaa;
        margin: 0;
    }

    /* ===== BACK BUTTON ===== */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        background: transparent;
        font-size: 0.83rem;
        font-weight: 600;
        padding: 0.65rem 1.45rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: var(--primary);
        color: white;
    }

    .pagination {
        gap: 6px;
    }

    .pagination .page-link {
        border: none;
        border-radius: 12px;
        color: #666;
        font-size: 0.85rem;
        padding: 0.55rem 0.9rem;
        box-shadow: none !important;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        color: white;
    }

    .pagination .page-link:hover {
        background: rgba(15,110,86,0.08);
        color: var(--primary);
    }

    @media (max-width: 768px) {
        .page-hero-title {
            font-size: 2rem;
        }

        .search-wrap {
            padding: 1rem;
        }

        .top-action-row {
            align-items: stretch;
        }

        .top-action-row > * {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<section class="page-hero">
    <div class="page-hero-pattern"></div>
    <div class="page-hero-dots"></div>
    <div class="container page-hero-content">
        <div class="page-hero-eyebrow">
            <i class="fas fa-database" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>One Data</span>
        </div>
        <h1 class="page-hero-title">Pusat Dokumen Digital</h1>
        <p class="page-hero-sub">
            Kumpulan dokumen penting, laporan kegiatan, program kerja, dan informasi resmi lainnya dalam satu pusat data digital.
        </p>
    </div>
    <div class="page-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:70px;">
            <path fill="#f9f9f7" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

<section class="dokumen-section">
    <div class="container">

        <!-- Stats -->
        <div class="stats-wrap mb-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stats-card" style="background: linear-gradient(135deg, #0F6E56, #1D9E75);">
                        <div class="stats-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="stats-number">{{ $totalDokumen }}</div>
                        <div class="stats-label">Total Dokumen</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card" style="background: linear-gradient(135deg, #EF9F27, #FAC775);">
                        <div class="stats-icon"><i class="fas fa-download"></i></div>
                        <div class="stats-number">{{ $totalDownloads }}</div>
                        <div class="stats-label">Total Downloads</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card" style="background: linear-gradient(135deg, #1D9E75, #0F6E56);">
                        <div class="stats-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="stats-number">Aktif</div>
                        <div class="stats-label">Data Terupdate</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="search-wrap mb-4">
            <form method="GET" action="{{ route('public.dokumen') }}">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="search-input-group">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" placeholder="Cari dokumen..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <select name="kategori" class="form-select filter-select" onchange="this.form.submit()">
                            <option value="all">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->kategori }}" {{ request('kategori') == $kat->kategori ? 'selected' : '' }}>
                                    @if($kat->kategori == 'profil') 📋 Profil
                                    @elseif($kat->kategori == 'program_kerja') 📊 Program Kerja
                                    @elseif($kat->kategori == 'laporan') 📄 Laporan
                                    @elseif($kat->kategori == 'surat') ✉️ Surat
                                    @elseif($kat->kategori == 'peraturan') ⚖️ Peraturan
                                    @else 📁 Lainnya
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-search-submit w-100">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Top Action -->
        <div class="top-action-row">
            <div class="result-info">
                Menampilkan <strong>{{ $dokumen->count() }}</strong> dokumen yang tersedia
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-success btn-export-custom dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-1"></i> Export Data
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('public.dokumen.export', 'csv') }}">
                            <i class="fas fa-file-csv text-success me-2"></i> Export ke CSV
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('public.dokumen.export', 'excel') }}">
                            <i class="fas fa-file-excel text-success me-2"></i> Export ke Excel
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Dokumen Grid -->
        <div class="row g-4">
            @forelse($dokumen as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="dokumen-card">
                        <div class="dokumen-icon">
                            {!! $item->file_icon !!}
                        </div>

                        <div class="dokumen-body">
                            <span class="dokumen-category">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>

                            <div class="dokumen-title">
                                {{ Str::limit($item->judul, 50) }}
                            </div>

                            <div class="dokumen-meta">
                                <div>
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $item->tanggal->format('d F Y') }}
                                </div>
                                <div>
                                    <i class="fas fa-file-alt me-1"></i>
                                    {{ strtoupper($item->file_type) }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-download me-1"></i>
                                    {{ $item->download_count }}
                                </div>
                            </div>

                            @if($item->deskripsi)
                                <p class="dokumen-desc">
                                    {{ Str::limit($item->deskripsi, 90) }}
                                </p>
                            @endif

                            <div class="mt-3">
                                <a href="{{ route('public.dokumen.detail', [$item->id, $item->slug]) }}" class="btn-detail-custom">
                                    <i class="fas fa-info-circle"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <div class="empty-state-title">Belum ada dokumen</div>
                        <p class="empty-state-sub">Belum ada dokumen yang dipublikasikan saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($dokumen->count())
            <div class="d-flex justify-content-center mt-4">
                {{ $dokumen->links() }}
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection