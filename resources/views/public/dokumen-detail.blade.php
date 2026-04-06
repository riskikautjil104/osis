@extends('layouts.app')

@section('title', $dokumen->judul)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.dokumen') }}">One Data</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($dokumen->judul, 50) }}</li>
                    </ol>
                </nav>
                
                <!-- Dokumen Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div style="font-size: 80px;">
                                {!! $dokumen->file_icon !!}
                            </div>
                            <h1 class="fw-bold mt-3">{{ $dokumen->judul }}</h1>
                            <div class="mt-2">
                                <span class="badge bg-{{ $dokumen->category_badge }} me-2">
                                    {{ ucfirst(str_replace('_', ' ', $dokumen->kategori)) }}
                                </span>
                                <span class="badge bg-secondary">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $dokumen->tanggal->format('d F Y') }}
                                </span>
                            </div>
                        </div>
                        
                        @if($dokumen->deskripsi)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Deskripsi</h5>
                            <p class="text-muted" style="line-height: 1.8;">{{ $dokumen->deskripsi }}</p>
                        </div>
                        @endif
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="bg-light p-3 rounded text-center">
                                    <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                                    <div class="small text-muted">Tipe File</div>
                                    <div class="fw-bold">{{ strtoupper($dokumen->file_type) }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light p-3 rounded text-center">
                                    <i class="fas fa-weight-hanging fa-2x text-primary mb-2"></i>
                                    <div class="small text-muted">Ukuran File</div>
                                    <div class="fw-bold">{{ $dokumen->formatted_file_size }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light p-3 rounded text-center">
                                    <i class="fas fa-download fa-2x text-primary mb-2"></i>
                                    <div class="small text-muted">Total Downloads</div>
                                    <div class="fw-bold">{{ $dokumen->download_count }} kali</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{ route('public.dokumen.download', $dokumen->id) }}" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-download me-2"></i> Download Dokumen
                            </a>
                            @if(in_array($dokumen->file_type, ['pdf', 'jpg', 'png']))
                                <a href="{{ asset($dokumen->file_path) }}" target="_blank" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-eye me-2"></i> Preview
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Dokumen Terkait -->
                @if($dokumenTerkait->count() > 0)
                <div class="mt-5">
                    <h4 class="fw-bold mb-4">Dokumen Terkait</h4>
                    <div class="row g-4">
                        @foreach($dokumenTerkait as $item)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div style="font-size: 32px; margin-right: 15px;">
                                            {!! $item->file_icon !!}
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ Str::limit($item->judul, 40) }}</h6>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt me-1"></i> {{ $item->tanggal->format('d/m/Y') }}
                                            </small>
                                        </div>
                                        <a href="{{ route('public.dokumen.detail', [$item->id, $item->slug]) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="text-center mt-4">
                    <a href="{{ route('public.dokumen') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke One Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection