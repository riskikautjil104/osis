@extends('layouts.app')

@section('title', 'Program Kerja OSIS')

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
        max-width: 620px;
    }

    .page-hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    /* ===== MAIN SECTION ===== */
    .proker-section {
        background: #f9f9f7;
        padding: 0 0 4rem;
    }

    /* ===== STATS ===== */
    .stats-wrap {
        margin-top: -2rem;
        position: relative;
        z-index: 10;
    }

    .stats-card-proker {
        border-radius: 20px;
        padding: 1.4rem 1.2rem;
        color: white;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 14px 35px rgba(0,0,0,0.08);
    }

    .stats-card-proker::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 40%);
        pointer-events: none;
    }

    .stats-card-proker:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(255,255,255,0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.9rem;
        font-size: 1.2rem;
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
        color: rgba(255,255,255,0.85);
    }

    /* ===== FILTER ===== */
    .filter-wrap {
        background: white;
        border-radius: 18px;
        padding: 1.3rem 1.4rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        border: 1px solid #f0f0f0;
    }

    .filter-label {
        font-size: 0.76rem;
        font-weight: 700;
        color: #777;
        margin-bottom: 0.45rem;
        display: block;
    }

    .filter-select {
        height: 48px;
        border-radius: 14px;
        border: 1.5px solid #eaeaea;
        font-size: 0.88rem;
        box-shadow: none !important;
    }

    .filter-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(15,110,86,0.08) !important;
    }

    /* ===== SECTION TITLE ===== */
    .section-block-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #111;
        margin-bottom: 1rem;
    }

    /* ===== PROKER UNGGULAN ===== */
    .featured-card {
        background: white;
        border-radius: 22px;
        overflow: hidden;
        border: 1.5px solid #ececec;
        transition: all 0.3s ease;
        height: 100%;
    }

    .featured-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(15,110,86,0.09);
        border-color: rgba(15,110,86,0.16);
    }

    .featured-thumb {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .featured-placeholder {
        height: 190px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f3f7f5, #fbfbfb);
        font-size: 3rem;
    }

    .featured-body {
        padding: 1.2rem;
    }

    .badge-featured {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(239,159,39,0.15);
        color: #9b6200;
        border: 1px solid rgba(239,159,39,0.25);
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.42rem 0.8rem;
        margin-bottom: 0.8rem;
    }

    .featured-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        line-height: 1.4;
        margin-bottom: 0.55rem;
    }

    .featured-desc {
        font-size: 0.82rem;
        color: #999;
        line-height: 1.7;
        min-height: 56px;
    }

    /* ===== GRID CARD ===== */
    .proker-card {
        background: white;
        border-radius: 22px;
        overflow: hidden;
        border: 1.5px solid #ececec;
        height: 100%;
        position: relative;
        transition: all 0.3s ease;
    }

    .proker-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(15,110,86,0.09);
        border-color: rgba(15,110,86,0.16);
    }

    .status-badge-wrap {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 3;
    }

    .proker-thumb {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .proker-placeholder {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f4f7f5, #fbfbfb);
        font-size: 3.2rem;
    }

    .proker-body {
        padding: 1.15rem;
    }

    .proker-category {
        display: inline-block;
        background: rgba(15,110,86,0.09);
        color: var(--primary);
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.38rem 0.75rem;
        border-radius: 50px;
        margin-bottom: 0.75rem;
    }

    .proker-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        line-height: 1.4;
        margin-bottom: 0.5rem;
        min-height: 44px;
    }

    .proker-date {
        font-size: 0.78rem;
        color: #8a8a8a;
        margin-bottom: 0.6rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .proker-desc {
        font-size: 0.82rem;
        color: #999;
        line-height: 1.7;
        min-height: 55px;
    }

    .progress-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.76rem;
        color: #777;
        margin-bottom: 0.45rem;
    }

    .progress-value {
        color: var(--primary);
        font-weight: 700;
    }

    /* style progress bawaan dari backend */
    .proker-body .progress {
        height: 9px;
        border-radius: 999px;
        overflow: hidden;
        background: #edf2f0;
    }

    .proker-body .progress-bar {
        border-radius: 999px;
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

    .btn-detail-filled {
        display: inline-flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: white;
        background: var(--primary);
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0.7rem 1rem;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-detail-filled:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
    }

    .empty-state {
        background: white;
        border-radius: 20px;
        padding: 4rem 1.5rem;
        text-align: center;
        border: 1.5px dashed #e6e6e6;
        color: #aaa;
    }

    .empty-state i {
        font-size: 2.5rem;
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

    #noResult {
        display: none;
    }

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

        .filter-wrap {
            padding: 1rem;
        }

        .featured-body,
        .proker-body {
            padding: 1rem;
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
            <i class="fas fa-tasks" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Program Kerja</span>
        </div>
        <h1 class="page-hero-title">Program Kerja OSIS</h1>
        <p class="page-hero-sub">
            Berbagai program unggulan OSIS untuk mendorong kreativitas, kepemimpinan, dan pengembangan siswa.
        </p>
    </div>
    <div class="page-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:70px;">
            <path fill="#f9f9f7" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

<section class="proker-section">
    <div class="container">

        <!-- STATS -->
        <div class="stats-wrap mb-5">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stats-card-proker" style="background: linear-gradient(135deg, #0F6E56, #1D9E75);">
                        <div class="stats-icon"><i class="fas fa-tasks"></i></div>
                        <div class="text-center">
                            <div class="stats-number">{{ $stats['total'] }}</div>
                            <div class="stats-label">Total Program</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card-proker" style="background: linear-gradient(135deg, #EF9F27, #FAC775);">
                        <div class="stats-icon"><i class="fas fa-play-circle"></i></div>
                        <div class="text-center">
                            <div class="stats-number">{{ $stats['berjalan'] }}</div>
                            <div class="stats-label">Sedang Berjalan</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card-proker" style="background: linear-gradient(135deg, #28a745, #20c997);">
                        <div class="stats-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="text-center">
                            <div class="stats-number">{{ $stats['selesai'] }}</div>
                            <div class="stats-label">Telah Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card-proker" style="background: linear-gradient(135deg, #6c757d, #495057);">
                        <div class="stats-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="text-center">
                            <div class="stats-number">{{ $stats['rencana'] }}</div>
                            <div class="stats-label">Rencana</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="filter-wrap mb-5">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="filter-label">Filter Kategori</label>
                    <select id="filterKategori" class="form-select filter-select" onchange="filterProker()">
                        <option value="all">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->kategori }}">
                                @if($kat->kategori == 'pendidikan') 📚 Pendidikan
                                @elseif($kat->kategori == 'kewirausahaan') 💼 Kewirausahaan
                                @elseif($kat->kategori == 'olahraga') ⚽ Olahraga
                                @elseif($kat->kategori == 'seni_budaya') 🎨 Seni & Budaya
                                @elseif($kat->kategori == 'lingkungan') 🌿 Lingkungan
                                @elseif($kat->kategori == 'sosial') 🤝 Sosial
                                @elseif($kat->kategori == 'keagamaan') 🕌 Keagamaan
                                @else 📋 Lainnya
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="filter-label">Filter Status</label>
                    <select id="filterStatus" class="form-select filter-select" onchange="filterProker()">
                        <option value="all">Semua Status</option>
                        <option value="rencana">📅 Rencana</option>
                        <option value="berjalan">▶️ Berjalan</option>
                        <option value="selesai">✅ Selesai</option>
                        <option value="tertunda">⏸️ Tertunda</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- PROGRAM UNGGULAN -->
        @if($prokerUnggulan->count() > 0)
            <div class="mb-5">
                <div class="section-block-title">
                    <i class="fas fa-star text-warning me-2"></i>Program Unggulan
                </div>

                <div class="row g-4">
                    @foreach($prokerUnggulan as $item)
                        <div class="col-md-4">
                            <div class="featured-card">
                                @if($item->foto)
                                    <img src="{{ asset($item->foto) }}" class="featured-thumb" alt="{{ $item->nama_program }}">
                                @else
                                    <div class="featured-placeholder">{{ $item->category_icon }}</div>
                                @endif

                                <div class="featured-body">
                                    <span class="badge-featured">
                                        <i class="fas fa-star"></i> Unggulan
                                    </span>

                                    <div class="featured-title">{{ Str::limit($item->nama_program, 40) }}</div>
                                    <p class="featured-desc">{{ Str::limit($item->deskripsi, 90) }}</p>

                                    <div class="progress-label-row">
                                        <span>Progress</span>
                                        <span class="progress-value">{{ $item->progress }}%</span>
                                    </div>
                                    {!! $item->progress_bar !!}

                                    <div class="mt-3">
                                        <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn-detail-filled">
                                            Lihat Detail <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- SEMUA PROKER -->
        <div class="row g-4" id="prokerList">
            @forelse($proker as $item)
                <div class="col-md-6 col-lg-4 proker-item"
                     data-kategori="{{ strtolower($item->kategori) }}"
                     data-status="{{ strtolower($item->status) }}">
                    <div class="proker-card">
                        <div class="status-badge-wrap">{!! $item->status_badge !!}</div>

                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" class="proker-thumb" alt="{{ $item->nama_program }}">
                        @else
                            <div class="proker-placeholder">{{ $item->category_icon }}</div>
                        @endif

                        <div class="proker-body">
                            <span class="proker-category">
                                {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                            </span>

                            <div class="proker-title">{{ Str::limit($item->nama_program, 45) }}</div>

                            <div class="proker-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>
                                    {{ $item->tanggal_mulai->format('d/m/Y') }}
                                    @if($item->durasi != 'Berlangsung' && $item->tanggal_selesai)
                                        - {{ $item->tanggal_selesai->format('d/m/Y') }}
                                    @endif
                                </span>
                            </div>

                            <p class="proker-desc">{{ Str::limit($item->deskripsi, 90) }}</p>

                            <div class="mt-3">
                                <div class="progress-label-row">
                                    <span>Progress</span>
                                    <span class="progress-value">{{ $item->progress }}%</span>
                                </div>
                                {!! $item->progress_bar !!}
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn-detail-custom">
                                    Lihat Detail <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-tasks"></i>
                        <div class="empty-state-title">Belum ada program kerja</div>
                        <p class="empty-state-sub">Program kerja OSIS akan tampil di sini setelah data tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div id="noResult" class="mt-4">
            <div class="empty-state">
                <i class="fas fa-search-minus"></i>
                <div class="empty-state-title">Program tidak ditemukan</div>
                <p class="empty-state-sub">Coba ubah filter kategori atau status yang dipilih.</p>
            </div>
        </div>

        @if($proker->count())
            <div class="d-flex justify-content-center mt-4">
                {{ $proker->links() }}
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

@push('scripts')
<script>
    function filterProker() {
        const kategoriFilter = document.getElementById('filterKategori').value.toLowerCase();
        const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
        const items = document.querySelectorAll('.proker-item');
        const noResult = document.getElementById('noResult');

        let visible = 0;

        items.forEach(item => {
            const kategori = (item.dataset.kategori || '').toLowerCase().trim();
            const status = (item.dataset.status || '').toLowerCase().trim();

            let show = true;

            if (kategoriFilter !== 'all' && kategori !== kategoriFilter) show = false;
            if (statusFilter !== 'all' && status !== statusFilter) show = false;

            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        noResult.style.display = visible === 0 ? 'block' : 'none';
    }
</script>
@endpush