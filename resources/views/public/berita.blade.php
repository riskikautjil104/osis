@extends('layouts.app')

@section('title', 'Berita & Artikel')

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

    .page-hero-sub { color: rgba(255,255,255,0.5); font-size: 0.9rem; }

    .page-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    /* ===== SEARCH & FILTER BAR ===== */
    .filter-bar-wrap {
        background: white;
        border-radius: 16px;
        padding: 1.5rem 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        margin-top: -2rem;
        position: relative;
        z-index: 10;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f5f7f6;
        border: 1.5px solid #eee;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        transition: all 0.25s;
    }

    .search-input-group:focus-within {
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(15,110,86,0.08);
    }

    .search-input-group i { color: #aaa; font-size: 14px; }

    .search-input-group input {
        border: none;
        background: transparent;
        flex: 1;
        font-size: 0.88rem;
        color: #333;
        outline: none;
        font-family: 'Roboto', sans-serif;
    }

    .search-input-group input::placeholder { color: #bbb; }

    /* Filter pills */
    .filter-pills {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 50px;
        border: 1.5px solid #e5e5e5;
        background: white;
        font-size: 0.78rem;
        font-weight: 600;
        color: #777;
        cursor: pointer;
        transition: all 0.22s;
        font-family: 'Roboto', sans-serif;
    }

    .filter-pill:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .filter-pill.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    /* ===== BERITA CARDS ===== */
    .berita-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.25rem;
    }

    .b-card {
        background: white;
        border-radius: 18px;
        border: 1.5px solid #eee;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .b-card:hover {
        border-color: rgba(15,110,86,0.2);
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(15,110,86,0.1);
    }

    /* Thumbnail */
    .b-thumb {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .b-thumb-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #E1F5EE, #9FE1CB);
        font-size: 3rem;
    }

    .b-body {
        padding: 1.2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .b-badge {
        display: inline-block;
        background: rgba(15,110,86,0.1);
        color: var(--primary);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 50px;
        margin-bottom: 0.6rem;
    }

    .b-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: #111;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    .b-excerpt {
        font-size: 0.8rem;
        color: #888;
        line-height: 1.6;
        flex: 1;
        margin-bottom: 1rem;
    }

    .b-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f0f0f0;
        padding-top: 0.85rem;
        margin-top: auto;
    }

    .b-meta {
        font-size: 0.72rem;
        color: #aaa;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .b-meta span { display: flex; align-items: center; gap: 4px; }

    .btn-baca {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary);
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.25s;
        white-space: nowrap;
    }

    .btn-baca:hover {
        background: var(--primary-light);
        color: white;
        transform: translateX(2px);
    }

    /* Empty state */
    #noResult {
        display: none;
        text-align: center;
        padding: 4rem 1rem;
        color: #aaa;
        grid-column: 1 / -1;
    }

    #noResult i { font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.4; display: block; }

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

    /* Pagination styling */
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        color: var(--primary);
        border-color: #e5e5e5;
        font-size: 0.82rem;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
    }

    @media (max-width: 768px) {
        .page-hero-title { font-size: 2rem; }
        .filter-bar-wrap { padding: 1rem; }
        .berita-grid { grid-template-columns: 1fr; }
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
            <i class="fas fa-newspaper" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Info & Kabar</span>
        </div>
        <h1 class="page-hero-title">Berita & Artikel</h1>
        <p class="page-hero-sub">Kumpulan berita dan informasi terbaru dari OSIS</p>
    </div>
    <div class="page-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:70px;">
            <path fill="#f9f9f7" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-5" style="background: #f9f9f7;">
    <div class="container">

        {{-- Filter Bar --}}
        <div class="filter-bar-wrap mb-5">
            <div class="row align-items-center g-3">
                <div class="col-md-5">
                    <div class="search-input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchBerita" placeholder="Cari judul berita...">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="filter-pills" id="filterPills">
                        <button class="filter-pill active" data-kategori="all">Semua</button>
                        <button class="filter-pill" data-kategori="Prestasi">🏆 Prestasi</button>
                        <button class="filter-pill" data-kategori="Kegiatan">🎓 Kegiatan</button>
                        <button class="filter-pill" data-kategori="Lingkungan">🌊 Lingkungan</button>
                        <button class="filter-pill" data-kategori="Budaya">🎭 Budaya</button>
                    </div>
                </div>
                <div class="col-md-2 text-md-end">
                    <small style="color: #aaa; font-size: 0.78rem;">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong style="color: var(--primary);">{{ $berita->total() }}</strong> artikel
                    </small>
                </div>
            </div>
        </div>

        {{-- Grid --}}
        <div class="berita-grid" id="beritaList">
            @forelse($berita as $item)
            <div class="berita-item" data-kategori="{{ $item->kategori }}" data-judul="{{ strtolower($item->judul) }}">
                <div class="b-card">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="b-thumb" alt="{{ $item->judul }}">
                    @else
                        <div class="b-thumb-placeholder">{{ $item->category_icon }}</div>
                    @endif
                    <div class="b-body">
                        <div class="b-badge">{{ $item->kategori }}</div>
                        <div class="b-title">{{ Str::limit($item->judul, 70) }}</div>
                        <div class="b-excerpt">{{ $item->excerpt }}</div>
                        <div class="b-footer">
                            <div class="b-meta">
                                <span><i class="far fa-calendar-alt"></i>{{ $item->formatted_date }}</span>
                                <span><i class="far fa-eye"></i>{{ $item->views }} views</span>
                            </div>
                            <a href="{{ route('public.berita.detail', [$item->id, $item->slug]) }}" class="btn-baca">
                                Baca <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:4rem; color:#aaa;">
                <i class="fas fa-newspaper d-block" style="font-size:2.5rem; opacity:0.3; margin-bottom:1rem;"></i>
                Belum ada berita tersedia.
            </div>
            @endforelse

            <div id="noResult">
                <i class="fas fa-search-minus"></i>
                Tidak ada berita yang ditemukan.
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $berita->links() }}
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchBerita');
    const pills = document.querySelectorAll('.filter-pill');
    const items = document.querySelectorAll('.berita-item');
    const noResult = document.getElementById('noResult');
    let activeKategori = 'all';

    function applyFilter() {
        const term = searchInput.value.toLowerCase();
        let visible = 0;

        items.forEach(item => {
            const judulMatch = item.dataset.judul.includes(term);
            const kategoriMatch = activeKategori === 'all' || item.dataset.kategori === activeKategori;
            const show = judulMatch && kategoriMatch;
            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        noResult.style.display = visible === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', applyFilter);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Escape') { this.value = ''; applyFilter(); }
    });

    pills.forEach(pill => {
        pill.addEventListener('click', function() {
            pills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            activeKategori = this.dataset.kategori;
            applyFilter();
        });
    });
</script>
@endpush