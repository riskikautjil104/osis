@extends('layouts.app')

@section('title', 'Agenda Kegiatan')

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

    /* ===== SECTION ===== */
    .agenda-section {
        background: #f9f9f7;
        padding: 0 0 4rem;
        margin-top: -1px;
    }

    /* ===== FILTER BAR ===== */
    .filter-wrap {
        background: white;
        border-radius: 18px;
        padding: 1.4rem 1.5rem;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        margin-top: -2rem;
        position: relative;
        z-index: 10;
        border: 1px solid #f0f0f0;
    }

    .filter-label {
        font-size: 0.76rem;
        font-weight: 700;
        color: #777;
        margin-bottom: 0.45rem;
        display: block;
        letter-spacing: .3px;
    }

    .filter-select {
        height: 48px;
        border-radius: 14px;
        border: 1.5px solid #eaeaea;
        font-size: 0.88rem;
        color: #333;
        box-shadow: none !important;
        transition: all 0.25s ease;
    }

    .filter-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(15,110,86,0.08) !important;
    }

    .agenda-summary {
        font-size: 0.82rem;
        color: #999;
    }

    .agenda-summary strong {
        color: var(--primary);
    }

    /* ===== AGENDA LIST ===== */
    .agenda-stack {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .agenda-card {
        background: white;
        border-radius: 20px;
        padding: 1.2rem 1.2rem;
        border: 1.5px solid #ececec;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .agenda-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary), var(--primary-light));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .agenda-card:hover {
        transform: translateY(-4px);
        border-color: rgba(15,110,86,0.18);
        box-shadow: 0 16px 40px rgba(15,110,86,0.09);
    }

    .agenda-card:hover::before {
        opacity: 1;
    }

    .agenda-card.segera {
        background: linear-gradient(160deg, #fffaf2, #ffffff);
    }

    .agenda-card.berlangsung {
        background: linear-gradient(160deg, #f0faf6, #ffffff);
        border-color: rgba(15,110,86,0.18);
    }

    .agenda-card.selesai {
        background: linear-gradient(160deg, #fbfbfb, #ffffff);
    }

    .agenda-date-box {
        min-width: 86px;
        max-width: 86px;
        background: #f6f8f7;
        border: 1px solid #ededed;
        border-radius: 18px;
        text-align: center;
        padding: 0.9rem 0.7rem;
    }

    .agenda-day {
        font-family: 'Syne', sans-serif;
        font-size: 1.45rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 6px;
    }

    .agenda-month {
        font-size: 0.72rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
    }

    .agenda-body {
        flex: 1;
        min-width: 0;
    }

    .agenda-title {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 0.5rem;
        line-height: 1.35;
    }

    .agenda-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.7rem 1rem;
        margin-bottom: 0.7rem;
    }

    .agenda-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: #8a8a8a;
    }

    .agenda-meta-item i {
        color: var(--primary);
        font-size: 12px;
    }

    .agenda-desc {
        font-size: 0.82rem;
        color: #9a9a9a;
        line-height: 1.7;
        margin: 0;
    }

    .agenda-side {
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
        min-width: 120px;
    }

    .status-badge-custom {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 50px;
        padding: 0.45rem 0.9rem;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .status-badge-custom.segera {
        background: rgba(239,159,39,0.14);
        color: #9b6200;
        border: 1px solid rgba(239,159,39,0.24);
    }

    .status-badge-custom.berlangsung {
        background: rgba(15,110,86,0.12);
        color: var(--primary);
        border: 1px solid rgba(15,110,86,0.18);
    }

    .status-badge-custom.selesai {
        background: rgba(120,120,120,0.1);
        color: #777;
        border: 1px solid rgba(120,120,120,0.14);
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
        margin-top: 1.2rem;
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

    /* ===== PAGINATION ===== */
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

    @media (max-width: 991px) {
        .agenda-card {
            flex-direction: column;
        }

        .agenda-date-box {
            min-width: 100%;
            max-width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-align: center;
        }

        .agenda-day {
            margin-bottom: 0;
        }

        .agenda-side {
            min-width: 100%;
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        .page-hero-title {
            font-size: 2rem;
        }

        .filter-wrap {
            padding: 1rem;
        }

        .agenda-card {
            padding: 1rem;
            border-radius: 18px;
        }

        .agenda-title {
            font-size: 0.95rem;
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
            <i class="fas fa-calendar-alt" style="color: var(--secondary-light); font-size: 11px;"></i>
            <span>Kalender Kegiatan</span>
        </div>
        <h1 class="page-hero-title">Semua Agenda OSIS</h1>
        <p class="page-hero-sub">
            Daftar lengkap program, kegiatan, dan event OSIS yang akan datang, sedang berlangsung, maupun yang telah selesai.
        </p>
    </div>
    <div class="page-hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" style="display:block; height:70px;">
            <path fill="#f9f9f7" d="M0,40 C360,90 1080,10 1440,60 L1440,100 L0,100 Z"/>
        </svg>
    </div>
</section>

<section class="agenda-section">
    <div class="container">

        <!-- FILTER -->
        <div class="filter-wrap mb-5">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="filter-label">Filter Status</label>
                    <select id="filterStatus" class="form-select filter-select" onchange="filterAgenda()">
                        <option value="all">Semua Status</option>
                        <option value="segera">Segera</option>
                        <option value="berlangsung">Berlangsung</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="filter-label">Filter Kategori</label>
                    <select id="filterKategori" class="form-select filter-select" onchange="filterAgenda()">
                        <option value="all">Semua Kategori</option>
                        <option value="Akademik">Akademik</option>
                        <option value="Seni">Seni</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Lingkungan">Lingkungan</option>
                        <option value="Sosial">Sosial</option>
                    </select>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="agenda-summary">
                        Total <strong>{{ $agenda->count() }}</strong> agenda ditampilkan
                    </div>
                </div>
            </div>
        </div>

        <!-- LIST -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="agenda-stack" id="agendaList">
                    @forelse($agenda as $item)
                        <div class="agenda-item"
                             data-status="{{ strtolower($item->status) }}"
                             data-kategori="{{ $item->kategori }}">
                            <div class="agenda-card {{ strtolower($item->status) }}">
                                <div class="agenda-date-box">
                                    <div class="agenda-day">{{ $item->formatted_date }}</div>
                                    <div class="agenda-month">{{ $item->formatted_month }}</div>
                                </div>

                                <div class="agenda-body">
                                    <h3 class="agenda-title">{{ $item->judul }}</h3>

                                    <div class="agenda-meta">
                                        @if($item->waktu)
                                            <div class="agenda-meta-item">
                                                <i class="far fa-clock"></i>
                                                <span>{{ $item->waktu }}</span>
                                            </div>
                                        @endif

                                        @if($item->tempat)
                                            <div class="agenda-meta-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $item->tempat }}</span>
                                            </div>
                                        @endif

                                        @if($item->kategori)
                                            <div class="agenda-meta-item">
                                                <i class="fas fa-tag"></i>
                                                <span>{{ $item->kategori }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if($item->deskripsi)
                                        <p class="agenda-desc">
                                            {{ Str::limit($item->deskripsi, 140) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="agenda-side">
                                    <span class="status-badge-custom {{ strtolower($item->status) }}">
                                        @if(strtolower($item->status) === 'berlangsung')
                                            <i class="fas fa-circle-play"></i>
                                        @elseif(strtolower($item->status) === 'selesai')
                                            <i class="fas fa-check-circle"></i>
                                        @else
                                            <i class="fas fa-hourglass-half"></i>
                                        @endif
                                        {{ $item->status_text }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <div class="empty-state-title">Belum ada agenda kegiatan</div>
                            <p class="empty-state-sub">Agenda OSIS akan tampil di sini setelah data tersedia.</p>
                        </div>
                    @endforelse
                </div>

                <div id="noResult">
                    <div class="empty-state">
                        <i class="fas fa-search-minus"></i>
                        <div class="empty-state-title">Agenda tidak ditemukan</div>
                        <p class="empty-state-sub">Coba ubah filter status atau kategori yang dipilih.</p>
                    </div>
                </div>

                @if($agenda->count())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $agenda->links() }}
                    </div>
                @endif
            </div>
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
    function filterAgenda() {
        const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
        const kategoriFilter = document.getElementById('filterKategori').value;
        const items = document.querySelectorAll('#agendaList .agenda-item');
        const noResult = document.getElementById('noResult');

        let visible = 0;

        items.forEach(item => {
            const status = (item.dataset.status || '').toLowerCase().trim();
            const kategori = (item.dataset.kategori || '').trim();

            let show = true;

            if (statusFilter !== 'all' && status !== statusFilter) {
                show = false;
            }

            if (kategoriFilter !== 'all' && kategori !== kategoriFilter) {
                show = false;
            }

            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        noResult.style.display = visible === 0 ? 'block' : 'none';
    }
</script>
@endpush