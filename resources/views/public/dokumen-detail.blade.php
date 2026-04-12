@extends('layouts.app')

@section('title', $dokumen->judul)

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
        padding: 2rem 2rem 1.4rem;
        text-align: center;
        border-bottom: 1px solid #f3f3f3;
        background: linear-gradient(180deg, #ffffff 0%, #fcfcfc 100%);
    }

    .file-icon-wrap {
        width: 110px;
        height: 110px;
        margin: 0 auto 1.2rem;
        border-radius: 28px;
        background: linear-gradient(135deg, #f3f7f5, #fbfbfb);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        border: 1px solid #efefef;
    }

    .detail-title {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.25;
        color: #111;
        margin-bottom: 0.9rem;
    }

    .detail-badges {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.7rem;
    }

    .badge-category-custom {
        display: inline-flex;
        align-items: center;
        background: rgba(15,110,86,0.09);
        color: var(--primary);
        border: 1px solid rgba(15,110,86,0.14);
        border-radius: 50px;
        padding: 0.5rem 0.95rem;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .badge-date-custom {
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

    .detail-body {
        padding: 1.6rem 2rem 2rem;
    }

    .content-section {
        margin-bottom: 1.7rem;
    }

    .content-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.06rem;
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
        font-size: 0.92rem;
        font-weight: 700;
        color: #222;
        line-height: 1.5;
        word-break: break-word;
    }

    .action-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .btn-download-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1.5px solid var(--primary);
        color: white;
        background: var(--primary);
        font-size: 0.88rem;
        font-weight: 600;
        padding: 0.85rem 1.5rem;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-download-custom:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
    }

    .btn-preview-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1.5px solid #dcdcdc;
        color: #666;
        background: white;
        font-size: 0.88rem;
        font-weight: 600;
        padding: 0.85rem 1.5rem;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-preview-custom:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(15,110,86,0.03);
    }

    .related-section {
        margin-top: 2rem;
    }

    .related-title-main {
        font-family: 'Syne', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 1rem;
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

    .related-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .related-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        border-radius: 16px;
        background: linear-gradient(135deg, #f3f7f5, #fbfbfb);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        border: 1px solid #efefef;
    }

    .related-body {
        flex: 1;
        min-width: 0;
    }

    .related-doc-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: #111;
        line-height: 1.5;
        margin-bottom: 0.3rem;
    }

    .related-doc-meta {
        font-size: 0.76rem;
        color: #999;
    }

    .btn-related-arrow {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 12px;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        background: transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-related-arrow:hover {
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

        .file-icon-wrap {
            width: 90px;
            height: 90px;
            font-size: 3rem;
            border-radius: 22px;
        }

        .action-wrap {
            flex-direction: column;
        }

        .btn-download-custom,
        .btn-preview-custom {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<section class="detail-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <!-- Breadcrumb -->
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('public.dokumen') }}">One Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($dokumen->judul, 50) }}</li>
                        </ol>
                    </nav>
                </div>

                <!-- Detail Card -->
                <div class="detail-card">
                    <div class="detail-header">
                        <div class="file-icon-wrap">
                            {!! $dokumen->file_icon !!}
                        </div>

                        <h1 class="detail-title">{{ $dokumen->judul }}</h1>

                        <div class="detail-badges">
                            <span class="badge-category-custom">
                                {{ ucfirst(str_replace('_', ' ', $dokumen->kategori)) }}
                            </span>
                            <span class="badge-date-custom">
                                <i class="far fa-calendar-alt"></i>
                                {{ $dokumen->tanggal->format('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-body">
                        @if($dokumen->deskripsi)
                            <div class="content-section">
                                <div class="content-title">Deskripsi</div>
                                <p class="content-text">{{ $dokumen->deskripsi }}</p>
                            </div>
                        @endif

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="info-mini-label">Tipe File</div>
                                    <div class="info-mini-value">{{ strtoupper($dokumen->file_type) }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-weight-hanging"></i>
                                    </div>
                                    <div class="info-mini-label">Ukuran File</div>
                                    <div class="info-mini-value">{{ $dokumen->formatted_file_size }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-mini-card">
                                    <div class="info-mini-icon">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="info-mini-label">Total Downloads</div>
                                    <div class="info-mini-value">{{ $dokumen->download_count }} kali</div>
                                </div>
                            </div>
                        </div>

                        <div class="action-wrap">
                            <a href="{{ route('public.dokumen.download', $dokumen->id) }}" class="btn-download-custom">
                                <i class="fas fa-download"></i> Download Dokumen
                            </a>

                            @if(in_array(strtolower($dokumen->file_type), ['pdf', 'jpg', 'jpeg', 'png']))
                                <a href="{{ asset($dokumen->file_path) }}" target="_blank" class="btn-preview-custom">
                                    <i class="fas fa-eye"></i> Preview
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Dokumen Terkait -->
                @if($dokumenTerkait->count() > 0)
                    <div class="related-section">
                        <div class="related-title-main">Dokumen Terkait</div>

                        <div class="row g-4">
                            @foreach($dokumenTerkait as $item)
                                <div class="col-md-6">
                                    <div class="related-card">
                                        <div class="related-row">
                                            <div class="related-icon">
                                                {!! $item->file_icon !!}
                                            </div>

                                            <div class="related-body">
                                                <div class="related-doc-title">
                                                    {{ Str::limit($item->judul, 40) }}
                                                </div>
                                                <div class="related-doc-meta">
                                                    <i class="far fa-calendar-alt me-1"></i>
                                                    {{ $item->tanggal->format('d/m/Y') }}
                                                </div>
                                            </div>

                                            <a href="{{ route('public.dokumen.detail', [$item->id, $item->slug]) }}" class="btn-related-arrow">
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ route('public.dokumen') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>Kembali ke One Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection