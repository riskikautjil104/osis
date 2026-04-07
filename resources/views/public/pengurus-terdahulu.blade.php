@extends('layouts.app')

@section('title', 'Pengurus Terdahulu')

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

    /* ===== FILTER BAR ===== */
    .filter-bar-wrap {
        background: white;
        border-radius: 16px;
        padding: 1.5rem 2rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        margin-top: -2rem;
        position: relative;
        z-index: 10;
    }

    .periode-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .periode-pill {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        border: 1.5px solid #eee;
        color: #888;
        background: #f8f8f8;
        transition: all 0.2s;
        user-select: none;
    }

    .periode-pill:hover { border-color: var(--primary); color: var(--primary); }

    .periode-pill.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .filter-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #bbb;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-right: 4px;
        white-space: nowrap;
    }

    /* ===== CARDS ===== */
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
        background: linear-gradient(90deg, var(--secondary), var(--secondary-light));
        opacity: 0;
        transition: opacity 0.3s;
    }

    .p-card:hover {
        border-color: rgba(239,159,39,0.25);
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(239,159,39,0.1);
    }

    .p-card:hover::before { opacity: 1; }

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

    .p-jabatan { font-size: 0.75rem; color: #888; margin-bottom: 8px; }

    .periode-badge {
        display: inline-block;
        background: rgba(239,159,39,0.12);
        color: #a06800;
        border: 1px solid rgba(239,159,39,0.3);
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
    }

    .p-prestasi {
        font-size: 0.72rem;
        color: #aaa;
        margin-top: 10px;
        line-height: 1.5;
        border-top: 1px solid #f0f0f0;
        padding-top: 10px;
        display: flex;
        align-items: flex-start;
        gap: 5px;
        text-align: left;
    }

    .p-prestasi i { color: var(--secondary); margin-top: 2px; flex-shrink: 0; }

    /* Timeline year header */
    .periode-group-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.78rem;
        font-weight: 700;
        color: rgba(255,255,255,0.6);
        letter-spacing: 2px;
        text-transform: uppercase;
        background: var(--primary);
        display: inline-block;
        padding: 4px 14px;
        border-radius: 50px;
        margin-bottom: 1rem;
    }

    /* Empty / no result */
    #noResult {
        display: none;
        text-align: center;
        padding: 4rem 1rem;
        color: #aaa;
    }

    #noResult i { font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 0.75rem; }

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
        .pengurus-grid { grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); }
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
            <i class="fas fa-history" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Legacy</span>
        </div>
        <h1 class="page-hero-title">Pengurus Terdahulu</h1>
        <p class="page-hero-sub">Para pemimpin yang telah mengabdikan diri untuk kemajuan OSIS</p>
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
                <div class="col-md-9">
                    <div class="periode-pills">
                        <span class="filter-label">Periode</span>
                        <span class="periode-pill active" data-value="all" onclick="filterPengurus('all', this)">
                            Semua
                        </span>
                        @foreach($periodes as $periode)
                            <span class="periode-pill" data-value="{{ $periode->periode }}" onclick="filterPengurus('{{ $periode->periode }}', this)">
                                {{ $periode->periode }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <small style="color: #aaa; font-size: 0.78rem;">
                        <i class="fas fa-users me-1"></i>
                        <span id="countLabel">{{ $pengurus->total() }}</span> alumni pengurus
                    </small>
                </div>
            </div>
        </div>

        {{-- Grid --}}
        <div class="pengurus-grid" id="pengurusList">
            @forelse($pengurus as $item)
            <div class="pengurus-item" data-periode="{{ $item->periode }}">
                <div class="p-card">
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" class="avatar-img" alt="{{ $item->nama }}">
                    @else
                        <div class="avatar avatar-bg-g">{{ $item->initial }}</div>
                    @endif
                    <div class="p-name">{{ $item->nama }}</div>
                    <div class="p-jabatan">{{ $item->jabatan }}</div>
                    <span class="periode-badge">{{ $item->periode }}</span>
                    @if($item->prestasi)
                        <div class="p-prestasi">
                            <i class="fas fa-trophy"></i>
                            {{ Str::limit($item->prestasi, 80) }}
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1;" class="text-center py-5">
                <p class="text-muted">Belum ada data pengurus terdahulu</p>
            </div>
            @endforelse
        </div>

        <div id="noResult">
            <i class="fas fa-search-minus"></i>
            Tidak ada data untuk periode ini.
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $pengurus->links() }}
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
    function filterPengurus(value, el) {
        // Update pill active state
        document.querySelectorAll('.periode-pill').forEach(p => p.classList.remove('active'));
        el.classList.add('active');

        const items = document.querySelectorAll('.pengurus-item');
        let visible = 0;

        items.forEach(item => {
            const match = value === 'all' || item.dataset.periode === value;
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        document.getElementById('noResult').style.display = visible === 0 ? 'block' : 'none';
        document.getElementById('countLabel').textContent = visible;
    }
</script>
@endpush