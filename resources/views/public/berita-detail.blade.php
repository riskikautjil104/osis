@extends('layouts.app')

@section('title', $berita->judul)

{{-- ===== OPEN GRAPH / SOCIAL SHARING META TAGS ===== --}}
@push('meta')
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $berita->judul }} - OSIS SMANLI" />
<meta property="og:description" content="{{ $berita->excerpt ?? Str::limit(strip_tags($berita->konten), 160) }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="OSIS SMA Negeri 5 Morotai" />
<meta property="og:locale" content="id_ID" />
@if($berita->gambar)
<meta property="og:image" content="{{ asset($berita->gambar) }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="{{ $berita->judul }}" />
@endif
<meta property="article:published_time" content="{{ $berita->created_at->toIso8601String() }}" />
<meta property="article:section" content="{{ $berita->kategori }}" />

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $berita->judul }} - OSIS SMANLI" />
<meta name="twitter:description" content="{{ $berita->excerpt ?? Str::limit(strip_tags($berita->konten), 160) }}" />
@if($berita->gambar)
<meta name="twitter:image" content="{{ asset($berita->gambar) }}" />
@endif

{{-- WhatsApp & General --}}
<meta name="description" content="{{ $berita->excerpt ?? Str::limit(strip_tags($berita->konten), 160) }}" />
@endpush

@push('styles')
<style>
    /* ===== ARTICLE HERO ===== */
    .article-hero {
        background: linear-gradient(115deg, var(--dark) 55%, var(--primary) 55%);
        position: relative;
        overflow: hidden;
        padding: 3.5rem 0 5rem;
    }

    .article-hero-pattern {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(29,158,117,0.12) 1px, transparent 1px),
            linear-gradient(90deg, rgba(29,158,117,0.12) 1px, transparent 1px);
        background-size: 50px 50px;
        z-index: 1;
    }

    .article-hero-dots {
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

    .article-hero-content { position: relative; z-index: 2; }

    .article-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    /* Breadcrumb */
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .breadcrumb-custom a {
        color: rgba(255,255,255,0.5);
        font-size: 0.78rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-custom a:hover { color: var(--secondary-light); }

    .breadcrumb-custom .sep {
        color: rgba(255,255,255,0.25);
        font-size: 0.7rem;
    }

    .breadcrumb-custom .current {
        color: rgba(255,255,255,0.6);
        font-size: 0.78rem;
    }

    /* Hero badge */
    .article-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(239,159,39,0.18);
        border: 1px solid rgba(239,159,39,0.35);
        border-radius: 50px;
        padding: 4px 12px;
        margin-bottom: 1rem;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--secondary-light);
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .article-hero-title {
        font-family: 'Syne', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: white;
        line-height: 1.25;
        margin-bottom: 1rem;
        max-width: 700px;
    }

    .article-meta-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: rgba(255,255,255,0.5);
    }

    .article-meta-item i { font-size: 11px; }

    /* ===== ARTICLE CONTENT WRAPPER ===== */
    .article-wrap {
        background: #f9f9f7;
        padding: 3rem 0;
    }

    .article-main {
        background: white;
        border-radius: 20px;
        border: 1.5px solid #eee;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    /* Cover image */
    .article-cover {
        width: 100%;
        max-height: 440px;
        object-fit: cover;
        display: block;
    }

    /* Content body */
    .article-body {
        padding: 2.5rem 3rem;
    }

    .article-content {
        font-size: 1rem;
        line-height: 1.85;
        color: #333;
    }

    .article-content p { margin-bottom: 1.25rem; }

    .article-content img {
        max-width: 100%;
        border-radius: 12px;
        margin: 1.5rem 0;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .article-content h2, .article-content h3 {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        color: #111;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-content ul, .article-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }

    .article-content li { margin-bottom: 0.4rem; }

    .article-content blockquote {
        border-left: 3px solid var(--primary);
        padding: 0.75rem 1.25rem;
        background: rgba(15,110,86,0.05);
        border-radius: 0 10px 10px 0;
        margin: 1.5rem 0;
        color: #555;
        font-style: italic;
    }

    /* ===== SHARE SECTION ===== */
    .share-section {
        border-top: 1.5px solid #f0f0f0;
        padding-top: 1.75rem;
        margin-top: 2rem;
    }

    .share-label {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        color: #333;
        margin-bottom: 0.85rem;
    }

    .share-buttons { display: flex; gap: 8px; flex-wrap: wrap; }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 0.45rem 1.1rem;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.25s;
    }

    .share-btn:hover { transform: translateY(-2px); opacity: 0.9; }

    .share-btn.fb   { background: #1877F2; color: white; }
    .share-btn.tw   { background: #1DA1F2; color: white; }
    .share-btn.wa   { background: #25D366; color: white; }
    .share-btn.copy { background: #f0f0f0; color: #555; }
    .share-btn.copy.copied { background: var(--primary); color: white; }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: white;
        border-radius: 18px;
        border: 1.5px solid #eee;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .sidebar-card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1.5px solid #f0f0f0;
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        color: #111;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-card-header i { color: var(--primary); font-size: 13px; }

    /* Related news list */
    .related-item {
        display: flex;
        gap: 10px;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #f5f5f5;
        text-decoration: none;
        transition: background 0.2s;
    }

    .related-item:last-child { border-bottom: none; }
    .related-item:hover { background: #f9f9f7; }

    .related-thumb {
        width: 60px;
        height: 55px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .related-thumb-placeholder {
        width: 60px;
        height: 55px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #E1F5EE, #9FE1CB);
        font-size: 1.3rem;
    }

    .related-info { flex: 1; min-width: 0; }

    .related-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.8rem;
        color: #111;
        line-height: 1.4;
        margin-bottom: 3px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-date { font-size: 0.7rem; color: #aaa; }

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

    @media (max-width: 991px) {
        .article-hero-title { font-size: 1.7rem; }
        .article-body { padding: 1.5rem; }
    }

    @media (max-width: 768px) {
        .article-hero-title { font-size: 1.5rem; }
        .article-body { padding: 1.25rem; }
    }
</style>
@endpush

@section('content')

{{-- ARTICLE HERO --}}
<section class="article-hero">
    <div class="article-hero-pattern"></div>
    <div class="article-hero-dots"></div>
    <div class="container article-hero-content">
        {{-- Breadcrumb --}}
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('public.berita') }}">Berita</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <span class="current">{{ Str::limit($berita->judul, 40) }}</span>
        </div>

        {{-- Badge kategori --}}
        <div class="article-badge">
            <i class="fas fa-tag" style="font-size:9px;"></i>
            {{ $berita->kategori }}
        </div>

        {{-- Judul --}}
        <h1 class="article-hero-title">{{ $berita->judul }}</h1>

        {{-- Meta --}}
        <div class="article-meta-row">
            <div class="article-meta-item">
                <i class="far fa-calendar-alt"></i>
                {{ $berita->formatted_date }}
            </div>
            <div class="article-meta-item">
                <i class="far fa-eye"></i>
                {{ $berita->views }} views
            </div>
        </div>
    </div>
    <div class="article-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:70px;">
            <path fill="#f9f9f7" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

{{-- ARTICLE CONTENT --}}
<div class="article-wrap">
    <div class="container">
        <div class="row g-4">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">
                <div class="article-main">
                    {{-- Cover Image --}}
                    @if($berita->gambar)
                        <img src="{{ asset($berita->gambar) }}" class="article-cover" alt="{{ $berita->judul }}">
                    @endif

                    <div class="article-body">
                        {{-- Konten --}}
                        <div class="article-content">
                            {!! $berita->konten !!}
                        </div>

                        {{-- Share --}}
                        <div class="share-section">
                            <div class="share-label"><i class="fas fa-share-alt me-2" style="color:var(--primary);"></i>Bagikan artikel ini</div>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank" rel="noopener" class="share-btn fb">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                                   target="_blank" rel="noopener" class="share-btn tw">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}"
                                   target="_blank" rel="noopener" class="share-btn wa">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <button class="share-btn copy" id="copyBtn" onclick="copyLink()">
                                    <i class="fas fa-link"></i> Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-2">
                    <a href="{{ route('public.berita') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali ke Semua Berita
                    </a>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                @if($beritaTerkait->count() > 0)
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-newspaper"></i> Berita Terkait
                    </div>
                    @foreach($beritaTerkait as $item)
                    <a href="{{ route('public.berita.detail', [$item->id, $item->slug]) }}" class="related-item">
                        @if($item->gambar)
                            <img src="{{ asset($item->gambar) }}" class="related-thumb" alt="{{ $item->judul }}">
                        @else
                            <div class="related-thumb-placeholder">{{ $item->category_icon }}</div>
                        @endif
                        <div class="related-info">
                            <div class="related-title">{{ $item->judul }}</div>
                            <div class="related-date">
                                <i class="far fa-calendar-alt me-1"></i>{{ $item->formatted_date }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif

                {{-- Info card --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-info-circle"></i> Info Artikel
                    </div>
                    <div style="padding: 1rem 1.25rem;">
                        <div style="display:flex; flex-direction:column; gap:0.7rem;">
                            <div style="display:flex; justify-content:space-between; font-size:0.8rem;">
                                <span style="color:#aaa;">Kategori</span>
                                <span style="font-weight:600; color:var(--primary);">{{ $berita->kategori }}</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; font-size:0.8rem;">
                                <span style="color:#aaa;">Diterbitkan</span>
                                <span style="font-weight:600; color:#333;">{{ $berita->formatted_date }}</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; font-size:0.8rem;">
                                <span style="color:#aaa;">Dilihat</span>
                                <span style="font-weight:600; color:#333;">{{ $berita->views }} kali</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('copyBtn');
            btn.classList.add('copied');
            btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
            setTimeout(() => {
                btn.classList.remove('copied');
                btn.innerHTML = '<i class="fas fa-link"></i> Salin Link';
            }, 2500);
        });
    }
</script>
@endpush