@extends('layouts.app')

@section('title', 'Galeri Foto')

@push('styles')
<style>
    /* ===== PAGE HERO ===== */
    .page-hero {
        background: linear-gradient(115deg, var(--dark) 55%, var(--primary) 55%);
        position: relative;
        overflow: hidden;
        padding: 4rem 0 5.5rem;
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

    .page-hero-content { position: relative; z-index: 2; }

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
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
        margin-bottom: 1.75rem;
    }

    .hero-stats { display: flex; gap: 2.5rem; }

    .hero-stat-val {
        font-family: 'Syne', sans-serif;
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--secondary-light);
    }

    .hero-stat-lbl {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.4);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 2px;
    }

    .page-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar-wrap {
        background: white;
        border-radius: 16px;
        padding: 1.25rem 1.75rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        margin-top: -2rem;
        position: relative;
        z-index: 10;
        margin-bottom: 2.5rem;
    }

    .cat-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .filter-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #bbb;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        white-space: nowrap;
        margin-right: 4px;
    }

    .cat-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        border: 1.5px solid #eee;
        color: #888;
        background: #f8f8f8;
        transition: all 0.2s;
        user-select: none;
    }

    .cat-pill:hover { border-color: var(--primary); color: var(--primary); }

    .cat-pill.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .count-info {
        font-size: 0.75rem;
        color: #aaa;
        white-space: nowrap;
    }

    .count-info span { color: var(--primary); font-weight: 700; }

    /* ===== MASONRY GRID ===== */
    .galeri-masonry {
        columns: 3;
        column-gap: 1.25rem;
    }

    @media (max-width: 992px) { .galeri-masonry { columns: 2; } }
    @media (max-width: 576px) { .galeri-masonry { columns: 1; } }

    .galeri-card {
        break-inside: avoid;
        margin-bottom: 1.25rem;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: block;
    }

    .galeri-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.18);
    }

    .galeri-card img {
        width: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .galeri-card:hover img { transform: scale(1.06); }

    /* Overlay */
    .galeri-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(4,52,44,0.9) 0%, rgba(4,52,44,0.3) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .galeri-card:hover .galeri-overlay { opacity: 1; }

    .galeri-overlay-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.92rem;
        color: white;
        margin-bottom: 5px;
    }

    .galeri-overlay-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .galeri-overlay-date {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.6);
    }

    /* Zoom icon */
    .zoom-icon {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 34px;
        height: 34px;
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: white;
        font-size: 13px;
    }

    .galeri-card:hover .zoom-icon { opacity: 1; }

    /* Category badge on card */
    .kat-badge {
        font-size: 0.62rem;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .kat-kegiatan { background: rgba(239,159,39,0.25); color: #FAC775; }
    .kat-prestasi  { background: rgba(15,110,86,0.3);  color: #9FE1CB; }
    .kat-seni      { background: rgba(139,92,246,0.25); color: #c4b5fd; }
    .kat-olahraga  { background: rgba(59,130,246,0.25); color: #93c5fd; }
    .kat-upacara   { background: rgba(236,72,153,0.25); color: #f9a8d4; }
    .kat-umum      { background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.75); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        color: #aaa;
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 2.5rem;
        opacity: 0.25;
        display: block;
        margin-bottom: 0.75rem;
    }

    /* ===== LIGHTBOX ===== */
    .lb-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(4,52,44,0.93);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        padding: 1.5rem;
    }

    .lb-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .lb-box {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        max-width: 720px;
        width: 100%;
        transform: scale(0.92);
        transition: transform 0.3s ease;
    }

    .lb-backdrop.open .lb-box { transform: scale(1); }

    .lb-img-wrap { position: relative; }

    .lb-img-wrap img {
        width: 100%;
        display: block;
        max-height: 460px;
        object-fit: cover;
    }

    .lb-close-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 38px;
        height: 38px;
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 50%;
        border: none;
        cursor: pointer;
        color: white;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .lb-close-btn:hover { background: rgba(0,0,0,0.6); }

    .lb-info { padding: 1.25rem 1.5rem 1.5rem; }

    .lb-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #111;
        margin-bottom: 6px;
    }

    .lb-desc {
        font-size: 0.83rem;
        color: #666;
        line-height: 1.65;
        margin-bottom: 12px;
    }

    .lb-footer {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .lb-date-txt {
        font-size: 0.75rem;
        color: #aaa;
    }

    /* Back button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        background: transparent;
        font-size: 0.83rem;
        font-weight: 600;
        padding: 0.55rem 1.4rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-back:hover { background: var(--primary); color: white; }

    @media (max-width: 768px) {
        .page-hero-title { font-size: 2rem; }
        .filter-bar-wrap { padding: 1rem; }
        .hero-stats { gap: 1.5rem; }
    }
</style>
@endpush

@section('content')

{{-- PAGE HERO --}}
<section class="page-hero">
    <div class="page-hero-pattern"></div>
    <div class="page-hero-dots"></div>
    <div class="container page-hero-content">
        <div class="page-hero-eyebrow">
            <i class="fas fa-camera" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Dokumentasi</span>
        </div>
        <h1 class="page-hero-title">Galeri Foto</h1>
        <p class="page-hero-sub">Kumpulan foto dokumentasi kegiatan dan momen berharga OSIS</p>
        <div class="hero-stats">
            <div>
                <div class="hero-stat-val">{{ $galeri->total() }}</div>
                <div class="hero-stat-lbl">Total Foto</div>
            </div>
            <div>
                <div class="hero-stat-val">{{ $kategoris->count() }}</div>
                <div class="hero-stat-lbl">Kategori</div>
            </div>
            <div>
                <div class="hero-stat-val">{{ date('Y') }}</div>
                <div class="hero-stat-lbl">Tahun Aktif</div>
            </div>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" style="display:block; height:60px;">
            <path fill="#f9f9f7" d="M0,30 C360,75 1080,5 1440,45 L1440,80 L0,80 Z"/>
        </svg>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-5" style="background: #f9f9f7;">
    <div class="container">

        {{-- Filter Bar --}}
        <div class="filter-bar-wrap">
            <div class="row align-items-center g-3">
                <div class="col-md-9">
                    <div class="cat-pills">
                        <span class="filter-label">Kategori</span>
                        <span class="cat-pill active" data-cat="all" onclick="filterGaleri('all', this)">
                            Semua
                        </span>
                        @foreach($kategoris as $kat)
                            <span class="cat-pill" data-cat="{{ $kat->kategori }}" onclick="filterGaleri('{{ $kat->kategori }}', this)">
                                @if($kat->kategori == 'kegiatan') 🎪 Kegiatan
                                @elseif($kat->kategori == 'prestasi') 🏆 Prestasi
                                @elseif($kat->kategori == 'seni') 🎨 Seni
                                @elseif($kat->kategori == 'olahraga') ⚽ Olahraga
                                @elseif($kat->kategori == 'upacara') 🏫 Upacara
                                @else 📸 Umum
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <div class="count-info">
                        <i class="fas fa-images me-1"></i>
                        <span id="countLabel">{{ $galeri->count() }}</span> foto ditampilkan
                    </div>
                </div>
            </div>
        </div>

        {{-- Masonry Grid --}}
        <div class="galeri-masonry" id="galeriList">
            @forelse($galeri as $item)
            <div class="galeri-card"
                 data-kategori="{{ $item->kategori }}"
                 onclick="openLightbox(
                     '{{ asset($item->gambar) }}',
                     '{{ addslashes($item->judul) }}',
                     '{{ addslashes($item->deskripsi ?? '') }}',
                     '{{ $item->formatted_date }}',
                     '{{ $item->kategori }}'
                 )">

                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">

                <div class="zoom-icon">
                    <i class="fas fa-search-plus"></i>
                </div>

                <div class="galeri-overlay">
                    <div class="galeri-overlay-title">{{ Str::limit($item->judul, 40) }}</div>
                    <div class="galeri-overlay-meta">
                        <span class="galeri-overlay-date">
                            <i class="fas fa-calendar me-1"></i>{{ $item->formatted_date }}
                        </span>
                        <span class="kat-badge kat-{{ $item->kategori }}">
                            {{ $item->kategori }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="column-span: all;">
                <i class="fas fa-image"></i>
                <p>Belum ada foto di galeri</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $galeri->links() }}
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

{{-- LIGHTBOX --}}
<div class="lb-backdrop" id="lbBackdrop" onclick="closeLbOnBg(event)">
    <div class="lb-box" id="lbBox">
        <div class="lb-img-wrap">
            <img id="lbImg" src="" alt="">
            <button class="lb-close-btn" onclick="closeLightbox()">✕</button>
        </div>
        <div class="lb-info">
            <div class="lb-title" id="lbTitle"></div>
            <div class="lb-desc" id="lbDesc"></div>
            <div class="lb-footer">
                <span class="lb-date-txt" id="lbDate"></span>
                <span class="kat-badge" id="lbBadge"></span>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /* ===== FILTER ===== */
    function filterGaleri(cat, el) {
        document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
        el.classList.add('active');

        const items = document.querySelectorAll('.galeri-card');
        let visible = 0;

        items.forEach(item => {
            const match = cat === 'all' || item.dataset.kategori === cat;
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        document.getElementById('countLabel').textContent = visible;
    }

    /* ===== LIGHTBOX ===== */
    const BADGE_CLASS = {
        kegiatan: 'kat-kegiatan',
        prestasi:  'kat-prestasi',
        seni:      'kat-seni',
        olahraga:  'kat-olahraga',
        upacara:   'kat-upacara',
    };

    function openLightbox(img, judul, deskripsi, date, kategori) {
        document.getElementById('lbImg').src   = img;
        document.getElementById('lbTitle').textContent = judul;
        document.getElementById('lbDesc').textContent  = deskripsi || '';
        document.getElementById('lbDate').innerHTML    = '<i class="fas fa-calendar me-1"></i>' + date;

        const badge = document.getElementById('lbBadge');
        badge.className = 'kat-badge ' + (BADGE_CLASS[kategori] || '');
        badge.textContent = kategori;

        document.getElementById('lbBackdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lbBackdrop').classList.remove('open');
        document.body.style.overflow = '';
    }

    function closeLbOnBg(e) {
        if (e.target.id === 'lbBackdrop') closeLightbox();
    }

    // Tutup dengan Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush