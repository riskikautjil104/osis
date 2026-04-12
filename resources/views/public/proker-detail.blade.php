@extends('layouts.app')

@section('title', $proker->nama_program)

@push('styles')
<style>
    .detail-section {
        background: #f9f9f7;
        padding: 3rem 0 4rem;
    }

    .breadcrumb-wrap {
        background: white;
        border: 1px solid #ededed;
        border-radius: 16px;
        padding: 0.9rem 1.1rem;
        margin-bottom: 1.5rem;
    }

    .breadcrumb {
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .breadcrumb-item.active {
        color: #888;
        font-size: 0.85rem;
    }

    .detail-card {
        background: white;
        border-radius: 24px;
        border: 1.5px solid #ececec;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0,0,0,0.05);
    }

    .detail-header {
        padding: 2rem 2rem 1.2rem;
        border-bottom: 1px solid #f1f1f1;
    }

    .detail-category {
        display: inline-block;
        background: rgba(15,110,86,0.09);
        color: var(--primary);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        margin-bottom: 0.9rem;
    }

    .detail-title {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.25;
        color: #111;
        margin-bottom: 1rem;
    }

    .detail-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.7rem;
    }

    .date-badge-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f6f8f7;
        color: #666;
        border: 1px solid #ececec;
        border-radius: 50px;
        padding: 0.5rem 0.95rem;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .detail-image {
        width: 100%;
        max-height: 430px;
        object-fit: cover;
        display: block;
    }

    .detail-body {
        padding: 1.6rem 2rem 2rem;
    }

    .progress-panel {
        background: linear-gradient(135deg, #f4faf7, #ffffff);
        border: 1px solid rgba(15,110,86,0.1);
        border-radius: 20px;
        padding: 1.2rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .progress-panel .progress {
        height: 10px;
        border-radius: 999px;
        overflow: hidden;
        background: #eaf1ee;
    }

    .progress-panel .progress-bar {
        border-radius: 999px;
    }

    .info-mini-card {
        background: #fafafa;
        border: 1px solid #efefef;
        border-radius: 18px;
        padding: 1.2rem 1rem;
        text-align: center;
        height: 100%;
        transition: all 0.25s ease;
    }

    .info-mini-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.05);
    }

    .info-mini-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 0.9rem;
        border-radius: 16px;
        background: rgba(15,110,86,0.08);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .info-mini-label {
        font-size: 0.76rem;
        color: #999;
        margin-bottom: 0.35rem;
    }

    .info-mini-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: #222;
        line-height: 1.5;
        word-break: break-word;
    }

    .content-section {
        margin-bottom: 1.7rem;
    }

    .content-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.08rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 0.7rem;
    }

    .content-text {
        font-size: 0.9rem;
        color: #777;
        line-height: 1.9;
        margin: 0;
    }

    .related-card {
        background: white;
        border: 1.5px solid #ececec;
        border-radius: 18px;
        padding: 1rem;
        height: 100%;
        transition: all 0.3s ease;
    }

    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(15,110,86,0.08);
        border-color: rgba(15,110,86,0.16);
    }

    .related-category {
        display: inline-block;
        background: rgba(15,110,86,0.09);
        color: var(--primary);
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.35rem 0.7rem;
        border-radius: 50px;
        margin-bottom: 0.75rem;
    }

    .related-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        color: #111;
        line-height: 1.5;
        margin-bottom: 0.9rem;
        min-height: 44px;
    }

    .btn-related {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        background: transparent;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.6rem 0.95rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-related:hover {
        background: var(--primary);
        color: white;
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

    @media (max-width: 768px) {
        .detail-header,
        .detail-body {
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }

        .detail-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<section class="detail-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('public.proker') }}">Program Kerja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($proker->nama_program, 50) }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="detail-card">
                    <div class="detail-header">
                        <span class="detail-category">{{ ucfirst(str_replace('_', ' ', $proker->kategori)) }}</span>
                        <h1 class="detail-title">{{ $proker->nama_program }}</h1>

                        <div class="detail-badges">
                            {!! $proker->status_badge !!}
                            <span class="date-badge-custom">
                                <i class="far fa-calendar-alt"></i>
                                {{ $proker->tanggal_mulai->format('d F Y') }}
                                @if($proker->tanggal_selesai)
                                    - {{ $proker->tanggal_selesai->format('d F Y') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    @if($proker->foto)
                        <img src="{{ asset($proker->foto) }}" class="detail-image" alt="{{ $proker->nama_program }}">
                    @endif

                    <div class="detail-body">
                        <div class="progress-panel">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Progress Program</strong>
                                <strong class="text-primary">{{ $proker->progress }}%</strong>
                            </div>
                            {!! $proker->progress_bar !!}
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="info-mini-label">Penanggung Jawab</div>
                                    <div class="info-mini-value">{{ $proker->penanggung_jawab }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-mini-label">Tempat</div>
                                    <div class="info-mini-value">{{ $proker->tempat ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="info-mini-label">Anggaran</div>
                                    <div class="info-mini-value">{{ $proker->anggaran ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <div class="content-title">Deskripsi Program</div>
                            <p class="content-text">{{ $proker->deskripsi }}</p>
                        </div>

                        @if($proker->tujuan)
                            <div class="content-section">
                                <div class="content-title">Tujuan</div>
                                <p class="content-text">{{ $proker->tujuan }}</p>
                            </div>
                        @endif

                        @if($proker->sasaran)
                            <div class="content-section">
                                <div class="content-title">Sasaran</div>
                                <p class="content-text">{{ $proker->sasaran }}</p>
                            </div>
                        @endif

                        @if($prokerTerkait->count() > 0)
                            <div class="mt-5">
                                <div class="content-title mb-3">Program Terkait</div>
                                <div class="row g-4">
                                    @foreach($prokerTerkait as $item)
                                        <div class="col-md-4">
                                            <div class="related-card">
                                                <span class="related-category">
                                                    {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                                </span>
                                                <div class="related-title">{{ Str::limit($item->nama_program, 40) }}</div>
                                                <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn-related">
                                                    Lihat Program <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('public.proker') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>Kembali ke Program Kerja
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection