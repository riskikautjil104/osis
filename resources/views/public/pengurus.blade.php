@extends('layouts.app')

@section('title', 'Pengurus OSIS')

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

    /* ===== SEARCH BAR ===== */
    .search-bar-wrap {
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
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .search-input-group input::placeholder { color: #bbb; }

    /* ===== PENGURUS CARDS ===== */
    .pengurus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 1rem;
    }

    .p-card {
        background: white;
        border-radius: 18px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        border: 1.5px solid #eee;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .p-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        opacity: 0;
        transition: opacity 0.3s;
    }

    .p-card:hover {
        border-color: rgba(15,110,86,0.2);
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(15,110,86,0.1);
    }

    .p-card:hover::before { opacity: 1; }

    .p-card.ketua {
        background: linear-gradient(160deg, #f0faf6, white);
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(15,110,86,0.1);
    }

    .p-card.ketua::before { opacity: 1; }

    .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1.8rem;
    }

    .avatar-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem;
        display: block;
    }

    .avatar-bg-g { background: #E1F5EE; color: var(--primary); }
    .avatar-bg-a { background: #FAEEDA; color: #633806; }
    .avatar-bg-b { background: #E6F1FB; color: #185FA5; }
    .avatar-bg-p { background: #FBEAF0; color: #72243E; }
    .avatar-bg-t { background: #E1F5EE; color: #085041; }

    .p-name {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 0.92rem;
        color: #111;
        margin-bottom: 3px;
    }

    .p-jabatan { font-size: 0.75rem; color: #888; margin-bottom: 6px; }

    .p-meta {
        font-size: 0.72rem;
        color: #aaa;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        margin-top: 4px;
    }

    .p-motto {
        font-size: 0.72rem;
        color: #aaa;
        font-style: italic;
        margin-top: 8px;
        line-height: 1.5;
        border-top: 1px solid #f0f0f0;
        padding-top: 8px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        color: #aaa;
    }

    .empty-state i { font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.4; }

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

    /* No result notice */
    #noResult {
        display: none;
        text-align: center;
        padding: 3rem;
        color: #aaa;
    }

    @media (max-width: 768px) {
        .page-hero-title { font-size: 2rem; }
        .search-bar-wrap { padding: 1rem; }
        .pengurus-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); }
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
            <i class="fas fa-users" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Struktur Organisasi</span>
        </div>
        <h1 class="page-hero-title">Seluruh Pengurus OSIS</h1>
        <p class="page-hero-sub">Daftar lengkap pengurus OSIS periode 2024/2025</p>
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

        {{-- Search Bar --}}
        <div class="search-bar-wrap mb-5">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <div class="search-input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchPengurus" placeholder="Cari nama pengurus...">
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <small style="color: #aaa; font-size: 0.78rem;">
                        <i class="fas fa-info-circle me-1"></i>
                        Total <strong style="color: var(--primary);">{{ $pengurus->count() }}</strong> pengurus aktif
                    </small>
                </div>
            </div>
        </div>

        {{-- Grid --}}
        <div class="pengurus-grid" id="pengurusList">
            @foreach($pengurus as $item)
            <div class="pengurus-item" data-name="{{ strtolower($item->nama) }}">
                <div class="p-card {{ $item->is_ketua ? 'ketua' : '' }}">
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" class="avatar-img" alt="{{ $item->nama }}">
                    @else
                        <div class="avatar {{ $item->avatar_color_class }}">{{ $item->initial }}</div>
                    @endif
                    <div class="p-name">{{ $item->nama }}</div>
                    <div class="p-jabatan">{{ $item->jabatan }}</div>
                    @if($item->is_ketua)
                        <span class="badge" style="background: var(--primary); font-size: 0.65rem;">Ketua OSIS</span>
                    @endif
                    @if($item->kelas)
                        <div class="p-meta">
                            <i class="fas fa-graduation-cap"></i> {{ $item->kelas }}
                        </div>
                    @endif
                    @if($item->motto)
                        <div class="p-motto">
                            "{{ Str::limit($item->motto, 50) }}"
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div id="noResult">
            <i class="fas fa-search-minus d-block" style="font-size: 2rem; opacity: 0.3; margin-bottom: 0.75rem;"></i>
            Tidak ada pengurus yang ditemukan.
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchPengurus');
    const items = document.querySelectorAll('.pengurus-item');
    const noResult = document.getElementById('noResult');

    function searchPengurus() {
        const term = searchInput.value.toLowerCase();
        let visible = 0;

        items.forEach(item => {
            const match = item.dataset.name.includes(term);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        noResult.style.display = visible === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', searchPengurus);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Escape') { this.value = ''; searchPengurus(); }
    });
</script>
@endpush