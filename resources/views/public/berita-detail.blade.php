@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.berita') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 50) }}</li>
                    </ol>
                </nav>
                
                <!-- Berita Header -->
                <div class="text-center mb-4">
                    <span class="badge bg-success mb-3">{{ $berita->kategori }}</span>
                    <h1 class="fw-bold mb-3">{{ $berita->judul }}</h1>
                    <div class="text-muted mb-4">
                        <span><i class="far fa-calendar-alt me-1"></i>{{ $berita->formatted_date }}</span>
                        <span class="mx-3">•</span>
                        <span><i class="far fa-eye me-1"></i>{{ $berita->views }} views</span>
                    </div>
                </div>
                
                <!-- Gambar Cover -->
                @if($berita->gambar)
                <div class="mb-4">
                    <img src="{{ asset($berita->gambar) }}" class="img-fluid rounded-4 shadow-sm w-100" alt="{{ $berita->judul }}">
                </div>
                @endif
                
                <!-- Konten Berita -->
                <div class="berita-konten" style="font-size: 1.05rem; line-height: 1.8;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>
                
                <!-- Share Button -->
                <div class="mt-5 pt-3 border-top">
                    <h6 class="mb-3">Bagikan artikel ini:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="btn btn-info btn-sm text-white">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Berita Terkait -->
        @if($beritaTerkait->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="fw-bold mb-4">Berita Terkait</h4>
            </div>
            @foreach($beritaTerkait as $item)
            <div class="col-md-4">
                <div class="berita-card h-100">
                    <div class="berita-image" style="background: linear-gradient(135deg, #E1F5EE, #9FE1CB); height: 120px;">
                        {{ $item->category_icon }}
                    </div>
                    <div class="p-3">
                        <h6 class="fw-bold mb-2">{{ Str::limit($item->judul, 40) }}</h6>
                        <small class="text-muted">{{ $item->formatted_date }}</small>
                        <div class="mt-2">
                            <a href="{{ route('public.berita.detail', [$item->id, $item->slug]) }}" class="btn btn-sm btn-outline-success">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('public.berita') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Semua Berita
            </a>
        </div>
    </div>
</section>

<style>
    .berita-konten p {
        margin-bottom: 1rem;
    }
    .berita-konten img {
        max-width: 100%;
        border-radius: 8px;
        margin: 1rem 0;
    }
    .berita-konten h2, .berita-konten h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    .berita-konten ul, .berita-konten ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
</style>
@endsection