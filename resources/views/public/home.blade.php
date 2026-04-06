@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    /* ===== HERO ===== */
    .hero-section {
        min-height: 620px;
        background: var(--dark);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .hero-diagonal {
        position: absolute;
        inset: 0;
        background: linear-gradient(115deg, var(--dark) 55%, var(--primary) 55%);
        z-index: 0;
    }

    .hero-pattern {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(29,158,117,0.12) 1px, transparent 1px),
            linear-gradient(90deg, rgba(29,158,117,0.12) 1px, transparent 1px);
        background-size: 50px 50px;
        z-index: 1;
    }

    .hero-orb {
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(29,158,117,0.2) 0%, transparent 70%);
        top: -100px;
        right: -50px;
        z-index: 1;
        border-radius: 50%;
    }

    .hero-orb-2 {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(239,159,39,0.15) 0%, transparent 70%);
        bottom: -80px;
        left: 10%;
        z-index: 1;
        border-radius: 50%;
    }

    .hero-dots {
        position: absolute;
        right: 0;
        top: 0;
        width: 45%;
        height: 100%;
        z-index: 1;
        opacity: 0.25;
        background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1.5px, transparent 1.5px);
        background-size: 28px 28px;
    }

    .hero-content { position: relative; z-index: 3; }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(239,159,39,0.18);
        border: 1px solid rgba(239,159,39,0.35);
        border-radius: 50px;
        padding: 5px 14px;
        margin-bottom: 1.5rem;
    }

    .hero-eyebrow span {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--secondary-light);
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .hero-dot-blink {
        width: 7px;
        height: 7px;
        background: var(--secondary);
        border-radius: 50%;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    .hero-title {
        font-family: 'Syne', sans-serif;
        font-size: 3.8rem;
        font-weight: 800;
        color: white;
        line-height: 1.1;
        margin-bottom: 1.2rem;
    }

    .hero-title .accent {
        color: var(--secondary-light);
        display: block;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.55);
        font-size: 0.95rem;
        line-height: 1.7;
        max-width: 480px;
        margin-bottom: 2rem;
    }

    .hero-cta-group { display: flex; gap: 12px; flex-wrap: wrap; }

    .btn-hero-primary {
        background: var(--secondary);
        color: #2b1800;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.7rem 1.6rem;
        border-radius: 50px;
        border: none;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-hero-primary:hover {
        background: var(--secondary-light);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(239,159,39,0.4);
        color: #2b1800;
    }

    .btn-hero-outline {
        background: transparent;
        color: rgba(255,255,255,0.85);
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.7rem 1.6rem;
        border-radius: 50px;
        border: 1.5px solid rgba(255,255,255,0.25);
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-hero-outline:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.5);
        color: white;
    }

    .hero-stats { display: flex; gap: 0; margin-top: 3rem; }

    .hero-stat {
        flex: 1;
        padding: 1rem 1.2rem;
        border-right: 1px solid rgba(255,255,255,0.1);
    }

    .hero-stat:last-child { border-right: none; }

    .hero-stat-num {
        font-family: 'Syne', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        line-height: 1;
    }

    .hero-stat-label {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.45);
        margin-top: 4px;
        letter-spacing: 0.5px;
    }

    /* Hero right floating cards */
    .hero-card-float {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 20px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        color: white;
    }

    .hero-card-float .hcf-label {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.45);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .hero-card-float .hcf-val {
        font-family: 'Syne', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .hero-card-mini {
        background: var(--primary);
        border-radius: 14px;
        padding: 0.9rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 1rem;
        color: white;
    }

    .hero-card-mini .hcm-icon {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .hero-card-mini .hcm-text { font-size: 0.82rem; font-weight: 600; }
    .hero-card-mini .hcm-sub { font-size: 0.7rem; opacity: 0.6; }

    .hero-tag-float {
        position: absolute;
        top: 20px;
        right: 10px;
        background: var(--secondary);
        color: #2b1800;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.5px;
    }

    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 4;
    }

    /* ===== SAMBUTAN ===== */
    .sambutan-section {
        background: #f9f9f7;
        position: relative;
        overflow: hidden;
    }

    .sambutan-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary-light));
    }

    .sambutan-wrap {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 0;
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    }

    .sambutan-left {
        background: linear-gradient(160deg, var(--dark) 0%, var(--primary) 100%);
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .sambutan-left::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .sambutan-foto {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,0.3);
        object-fit: cover;
        position: relative;
        z-index: 1;
    }

    .sambutan-foto-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .sambutan-name {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: white;
        margin-top: 1rem;
        position: relative;
        z-index: 1;
    }

    .sambutan-role { font-size: 0.75rem; color: rgba(255,255,255,0.55); position: relative; z-index: 1; }

    .sambutan-badge {
        display: inline-block;
        margin-top: 0.75rem;
        background: rgba(239,159,39,0.2);
        border: 1px solid rgba(239,159,39,0.4);
        color: var(--secondary-light);
        font-size: 0.68rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        position: relative;
        z-index: 1;
    }

    .sambutan-right { padding: 3rem; position: relative; }

    .sambutan-quote-icon {
        font-size: 80px;
        color: rgba(15,110,86,0.06);
        position: absolute;
        bottom: 1.5rem;
        right: 2rem;
        font-family: Georgia, serif;
        line-height: 1;
    }

    .sambutan-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 1rem;
    }

    .sambutan-text { color: #666; line-height: 1.85; font-size: 0.9rem; }

    .btn-baca {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        margin-top: 1.5rem;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-baca:hover { background: var(--primary-light); color: white; transform: translateX(4px); }

    .sambutan-modal-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
    }

    /* ===== VISI MISI ===== */
    .vm-card {
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
    }

    .vm-card.visi {
        background: linear-gradient(135deg, var(--dark), var(--primary));
        color: white;
    }

    .vm-card.misi {
        background: #f8f9f7;
        border: 1.5px solid #e5e9e8;
    }

    .vm-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 1rem;
    }

    .vm-card.visi .vm-icon { background: rgba(255,255,255,0.15); color: white; }
    .vm-card.misi .vm-icon { background: rgba(15,110,86,0.1); color: var(--primary); }

    .vm-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .vm-card.visi .vm-title { color: white; }
    .vm-card.misi .vm-title { color: #111; }
    .vm-card.visi p { color: rgba(255,255,255,0.8); line-height: 1.75; font-size: 0.9rem; }
    .vm-card.misi ul { color: #555; line-height: 1.8; font-size: 0.88rem; padding-left: 1rem; }
    .vm-card.misi ul li { margin-bottom: 6px; }

    /* ===== PENGURUS ===== */
    .pengurus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .pengurus-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem 1rem;
        text-align: center;
        border: 1.5px solid #eee;
        transition: all 0.3s;
        height: 100%;
    }

    .pengurus-card:hover {
        border-color: rgba(15,110,86,0.25);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15,110,86,0.1);
    }

    .pengurus-card.ketua {
        background: linear-gradient(135deg, #f0faf6, white);
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(15,110,86,0.1);
    }

    .avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        margin: 0 auto 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1.6rem;
    }

    .avatar-img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 0.75rem;
        display: block;
    }

    .avatar-bg-g { background: #E1F5EE; color: var(--primary); }
    .avatar-bg-a { background: #FAEEDA; color: #633806; }
    .avatar-bg-b { background: #E6F1FB; color: #185FA5; }
    .avatar-bg-p { background: #FBEAF0; color: #72243E; }
    .avatar-bg-t { background: #E1F5EE; color: #085041; }

    /* ===== AGENDA ===== */
    .agenda-wrap { max-width: 720px; margin: 0 auto; }

    .agenda-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #f9f9f7;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 0.75rem;
        border-left: 4px solid #ddd;
        transition: all 0.25s;
    }

    .agenda-item:hover { transform: translateX(4px); background: white; box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
    .agenda-item.urgent { border-left-color: var(--secondary); }
    .agenda-item.upcoming { border-left-color: var(--primary); }

    .agenda-date {
        min-width: 54px;
        text-align: center;
        background: white;
        border-radius: 10px;
        padding: 6px 4px;
        border: 1px solid #eee;
    }

    .agenda-day {
        font-family: 'Syne', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    /* ===== BERITA ===== */
    .berita-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        border: 1.5px solid #eee;
        transition: all 0.3s;
        height: 100%;
    }

    .berita-card:hover {
        border-color: rgba(15,110,86,0.2);
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.08);
    }

    .berita-image {
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        background: linear-gradient(135deg, #E1F5EE, #9FE1CB);
        position: relative;
        overflow: hidden;
    }

    .berita-image::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(15,110,86,0.05) 1px, transparent 1px);
        background-size: 18px 18px;
    }

    .berita-cat { font-size: 0.68rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }

    /* ===== GALERI ===== */
    .galeri-masonry {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .galeri-item {
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        aspect-ratio: 1;
    }

    .galeri-item:nth-child(1) { grid-column: span 2; grid-row: span 2; aspect-ratio: auto; }
    .galeri-item:nth-child(5) { grid-column: span 2; aspect-ratio: auto; min-height: 150px; }

    .galeri-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
        display: block;
        min-height: 140px;
    }

    .galeri-item:hover img { transform: scale(1.06); }

    .galeri-overlay {
        position: absolute;
        inset: 0;
        background: rgba(4,52,44,0);
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        opacity: 0;
    }

    .galeri-item:hover .galeri-overlay { background: rgba(4,52,44,0.4); opacity: 1; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .hero-title { font-size: 2.6rem; }
        .sambutan-wrap { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .galeri-masonry { grid-template-columns: repeat(2, 1fr); }
        .galeri-item:nth-child(1) { grid-column: span 2; }
        .galeri-item:nth-child(5) { grid-column: span 2; }
    }

    @keyframes floatUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-content { animation: floatUp 0.8s ease forwards; }
</style>
@endpush

@section('content')

{{-- ============ HERO ============ --}}
<section id="home" class="hero-section">
    <div class="hero-diagonal"></div>
    <div class="hero-pattern"></div>
    <div class="hero-orb"></div>
    <div class="hero-orb-2"></div>
    <div class="hero-dots"></div>

    <div class="container position-relative" style="z-index:3; padding: 4rem 1rem 6rem;">
        <div class="row align-items-center g-5">
            {{-- LEFT: Copy --}}
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-eyebrow">
                        <div class="hero-dot-blink"></div>
                        <span>Organisasi Siswa Intra Sekolah</span>
                    </div>
                    <h1 class="hero-title">
                        Bergerak, Berkarya,
                        <span class="accent">Berprestasi.</span>
                    </h1>
                    <p class="hero-subtitle">
                        OSIS SMA Negeri 5 Kab. Pulau Morotai — wadah kreativitas, kepemimpinan,
                        dan pengembangan diri siswa menuju generasi emas Maluku Utara.
                    </p>
                    <div class="hero-cta-group">
                        <a href="{{ route('public.agenda') }}" class="btn-hero-primary">
                            <i class="fas fa-calendar-alt"></i> Lihat Agenda
                        </a>
                        <a href="{{ route('public.pengurus') }}" class="btn-hero-outline">
                            <i class="fas fa-users"></i> Kenal Pengurus
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-num">{{ $stats['pengurus'] }}</div>
                            <div class="hero-stat-label">Pengurus Aktif</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-num">{{ $stats['program'] }}</div>
                            <div class="hero-stat-label">Program Kerja</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-num">{{ $stats['prestasi'] }}</div>
                            <div class="hero-stat-label">Prestasi 2024</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Floating UI Cards --}}
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
                <div style="position: relative;">
                    <div class="hero-tag-float">✦ 2024/2025</div>
                    <div class="hero-card-float">
                        <div class="hcf-label">Program Unggulan</div>
                        <div class="hcf-val">Morotai Berprestasi</div>
                        <div style="margin-top: 0.75rem; display: flex; gap: 8px; flex-wrap: wrap;">
                            <span style="background: rgba(29,158,117,0.25); color: #9FE1CB; font-size: 0.7rem; padding: 4px 10px; border-radius: 50px; font-weight: 600;">Seni</span>
                            <span style="background: rgba(239,159,39,0.2); color: var(--secondary-light); font-size: 0.7rem; padding: 4px 10px; border-radius: 50px; font-weight: 600;">Olahraga</span>
                            <span style="background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); font-size: 0.7rem; padding: 4px 10px; border-radius: 50px; font-weight: 600;">Akademik</span>
                        </div>
                    </div>
                    <div class="hero-card-mini">
                        <div class="hcm-icon"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <div class="hcm-text">Agenda Bulan Ini</div>
                            <div class="hcm-sub">{{ $stats['program'] }} kegiatan terjadwal</div>
                        </div>
                        <div style="margin-left: auto; font-family: 'Syne', sans-serif; font-size: 1.4rem; font-weight: 800; color: var(--secondary-light);">{{ $stats['program'] }}</div>
                    </div>
                    <div class="hero-card-mini" style="background: rgba(239,159,39,0.15); border: 1px solid rgba(239,159,39,0.25);">
                        <div class="hcm-icon" style="background: rgba(239,159,39,0.2); color: var(--secondary-light);"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="hcm-text">Berita Terbaru</div>
                            <div class="hcm-sub">Lihat info terkini OSIS</div>
                        </div>
                        <div style="margin-left: auto;">
                            <a href="{{ route('public.berita') }}" style="color: var(--secondary-light); font-size: 12px; text-decoration: none;">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave --}}
    <div class="hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:80px;">
            <path fill="#ffffff" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

{{-- ============ SAMBUTAN KETUA OSIS ============ --}}
@if($sambutan)
<section class="sambutan-section py-5">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Sambutan Ketua</div>
            <h2 class="section-title">Kata Ketua OSIS</h2>
        </div>
        <div class="sambutan-wrap">
            <div class="sambutan-left">
                @if($sambutan->foto)
                    <img src="{{ asset($sambutan->foto) }}" class="sambutan-foto" alt="{{ $sambutan->nama_ketua }}">
                @else
                    <div class="sambutan-foto-placeholder">
                        <i class="fas fa-user-tie fa-2x" style="color: rgba(255,255,255,0.6);"></i>
                    </div>
                @endif
                <div class="sambutan-name">{{ $sambutan->nama_ketua }}</div>
                <div class="sambutan-role">{{ $sambutan->jabatan }}</div>
                <div class="sambutan-badge">Periode 2024/2025</div>
            </div>
            <div class="sambutan-right">
                <div class="sambutan-quote-icon">"</div>
                <div class="sambutan-title">{{ $sambutan->judul }}</div>
                <div class="sambutan-text">{{ $sambutan->excerpt }}</div>
                <button class="btn-baca" data-bs-toggle="modal" data-bs-target="#sambutanModal">
                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Modal Sambutan --}}
<div class="modal fade" id="sambutanModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header text-white border-0" style="background: var(--primary);">
                <h5 class="modal-title">
                    <i class="fas fa-microphone-alt me-2"></i>{{ $sambutan->judul }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    @if($sambutan->foto)
                        <img src="{{ asset($sambutan->foto) }}" class="sambutan-modal-img mb-3" alt="{{ $sambutan->nama_ketua }}">
                    @endif
                    <h5 class="fw-bold mb-0">{{ $sambutan->nama_ketua }}</h5>
                    <small class="text-muted">{{ $sambutan->jabatan }}</small>
                </div>
                <div style="line-height: 1.85; font-size: 0.9rem; color: #444;">
                    {!! nl2br(e($sambutan->konten)) !!}
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

{{-- ============ VISI MISI ============ --}}
@if($visiMisi)
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Tujuan Kami</div>
            <h2 class="section-title">Visi & Misi</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-5">
                <div class="vm-card visi">
                    <div class="vm-icon"><i class="fas fa-eye"></i></div>
                    <div class="vm-title">Visi</div>
                    <p>{{ $visiMisi->visi }}</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="vm-card misi">
                    <div class="vm-icon"><i class="fas fa-list-check"></i></div>
                    <div class="vm-title">Misi</div>
                    <ul>
                        @foreach($visiMisi->misi as $misi)
                            <li class="mb-2">{{ $misi }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============ PENGURUS ============ --}}
<section id="pengurus" class="py-5" style="background: #f9f9f7;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Struktur Organisasi</div>
            <h2 class="section-title">Pengurus OSIS</h2>
            <p class="section-subtitle">Mereka yang terpilih untuk memimpin dan melayani seluruh siswa</p>
        </div>
        <div class="pengurus-grid">
            @forelse($pengurus as $item)
            <div class="pengurus-card {{ $item->is_ketua ? 'ketua' : '' }}">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" class="avatar-img" alt="{{ $item->nama }}">
                @else
                    <div class="avatar {{ $item->avatar_color_class }}">{{ $item->initial }}</div>
                @endif
                <h6 class="fw-bold mb-1" style="font-size: 0.88rem;">{{ $item->nama }}</h6>
                <p class="text-muted mb-2" style="font-size: 0.75rem;">{{ $item->jabatan }}</p>
                @if($item->is_ketua)
                    <span class="badge" style="background: var(--primary); font-size: 0.65rem;">Ketua OSIS</span>
                @endif
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data pengurus</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.pengurus') }}" class="btn-outline-green">
                Lihat Semua Pengurus <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- ============ AGENDA ============ --}}
<section id="agenda" class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Kalender Kegiatan</div>
            <h2 class="section-title">Agenda Terbaru</h2>
            <p class="section-subtitle">Program dan kegiatan yang akan datang</p>
        </div>
        <div class="agenda-wrap">
            @forelse($agenda as $item)
            <div class="agenda-item {{ $item->status_class }}">
                <div class="agenda-date">
                    <div class="agenda-day">{{ $item->formatted_date }}</div>
                    <small style="font-size: 0.65rem; color: #aaa; text-transform: uppercase; font-weight: 600;">{{ $item->formatted_month }}</small>
                </div>
                <div class="flex-grow-1">
                    <div style="font-weight: 700; font-size: 0.88rem; color: #111; margin-bottom: 3px;">{{ $item->judul }}</div>
                    <div style="font-size: 0.75rem; color: #aaa;">
                        @if($item->waktu)<span><i class="far fa-clock me-1"></i>{{ $item->waktu }}</span>&nbsp;·&nbsp;@endif
                        <span><i class="fas fa-map-marker-alt me-1"></i>{{ $item->tempat }}</span>
                    </div>
                </div>
                <div>
                    <span class="badge {{ $item->status_badge_class }}">{{ $item->status_text }}</span>
                </div>
            </div>
            @empty
            <div class="text-center py-4">
                <p class="text-muted">Belum ada agenda kegiatan</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.agenda') }}" class="btn-outline-green">
                Lihat Semua Agenda <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- ============ BERITA ============ --}}
<section id="berita" class="py-5" style="background: #f9f9f7;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Info & Kabar</div>
            <h2 class="section-title">Berita Terkini</h2>
            <p class="section-subtitle">Liputan kegiatan dan informasi terbaru dari OSIS</p>
        </div>
        <div class="row g-4">
            @forelse($berita as $item)
            <div class="col-md-6 col-lg-4">
                <div class="berita-card">
                    <div class="berita-image">
                        {{ $item->category_icon }}
                    </div>
                    <div class="p-3">
                        <div class="berita-cat">{{ $item->kategori }}</div>
                        <h6 class="fw-bold mb-2" style="font-family: 'Syne', sans-serif; font-size: 0.95rem; line-height: 1.4;">
                            {{ Str::limit($item->judul, 50) }}
                        </h6>
                        <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.6;">{{ $item->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="far fa-calendar-alt me-1"></i>{{ $item->formatted_date }}
                            </small>
                            <a href="{{ route('public.berita.detail', [$item->id, $item->slug]) }}"
                               style="font-size: 0.75rem; color: var(--primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                Baca <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada berita</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.berita') }}" class="btn-outline-green">
                Lihat Semua Berita <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- ============ GALERI ============ --}}
<section id="galeri" class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-tag">Dokumentasi</div>
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-subtitle">Momen berharga dari berbagai kegiatan OSIS</p>
        </div>
        <div class="galeri-masonry">
            @forelse($galeri as $item)
            <div class="galeri-item" data-bs-toggle="modal" data-bs-target="#galeriModal{{ $item->id }}">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}">
                <div class="galeri-overlay"><i class="fas fa-search-plus"></i></div>
            </div>

            <div class="modal fade" id="galeriModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" style="font-size: 0.95rem; font-weight: 700;">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-0">
                            <img src="{{ asset($item->gambar) }}" class="img-fluid w-100" alt="{{ $item->judul }}">
                        </div>
                        <div class="modal-footer border-0">
                            <div class="w-100">
                                @if($item->deskripsi)
                                    <p class="mb-2" style="font-size: 0.85rem;">{{ $item->deskripsi }}</p>
                                @endif
                                <small class="text-muted">{{ $item->formatted_date }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: span 4;" class="text-center py-5">
                <p class="text-muted">Belum ada foto di galeri</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.galeri') }}" class="btn-outline-green">
                Lihat Galeri Lengkap <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

@endsection