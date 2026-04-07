@extends('layouts.app')

@section('title', $proker->nama_program)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('public.proker') }}">Program Kerja</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($proker->nama_program, 50) }}</li>
                    </ol>
                </nav>
                
                <!-- Header -->
                <div class="text-center mb-4">
                    <span class="badge bg-info mb-2">{{ ucfirst(str_replace('_', ' ', $proker->kategori)) }}</span>
                    <h1 class="fw-bold mb-3">{{ $proker->nama_program }}</h1>
                    <div class="d-flex justify-content-center gap-3 mb-3">
                        {!! $proker->status_badge !!}
                        <span class="badge bg-secondary">
                            <i class="far fa-calendar-alt me-1"></i> 
                            {{ $proker->tanggal_mulai->format('d F Y') }} 
                            @if($proker->tanggal_selesai)
                                - {{ $proker->tanggal_selesai->format('d F Y') }}
                            @endif
                        </span>
                    </div>
                </div>
                
                <!-- Foto -->
                @if($proker->foto)
                <div class="mb-4">
                    <img src="{{ asset($proker->foto) }}" class="img-fluid rounded-4 shadow-sm w-100" alt="{{ $proker->nama_program }}">
                </div>
                @endif
                
                <!-- Progress -->
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>Progress Program</strong>
                            <strong class="text-primary">{{ $proker->progress }}%</strong>
                        </div>
                        {!! $proker->progress_bar !!}
                    </div>
                </div>
                
                <!-- Informasi -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="bg-light p-3 rounded text-center">
                            <i class="fas fa-user fa-2x text-primary mb-2"></i>
                            <div class="small text-muted">Penanggung Jawab</div>
                            <div class="fw-bold">{{ $proker->penanggung_jawab }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-3 rounded text-center">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                            <div class="small text-muted">Tempat</div>
                            <div class="fw-bold">{{ $proker->tempat ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-3 rounded text-center">
                            <i class="fas fa-money-bill fa-2x text-primary mb-2"></i>
                            <div class="small text-muted">Anggaran</div>
                            <div class="fw-bold">{{ $proker->anggaran ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Deskripsi -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Deskripsi Program</h5>
                    <p class="text-muted" style="line-height: 1.8;">{{ $proker->deskripsi }}</p>
                </div>
                
                <!-- Tujuan -->
                @if($proker->tujuan)
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Tujuan</h5>
                    <p class="text-muted">{{ $proker->tujuan }}</p>
                </div>
                @endif
                
                <!-- Sasaran -->
                @if($proker->sasaran)
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Sasaran</h5>
                    <p class="text-muted">{{ $proker->sasaran }}</p>
                </div>
                @endif
                
                <!-- Proker Terkait -->
                @if($prokerTerkait->count() > 0)
                <div class="mt-5">
                    <h4 class="fw-bold mb-4">Program Terkait</h4>
                    <div class="row g-4">
                        @foreach($prokerTerkait as $item)
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <span class="badge bg-info mb-2">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</span>
                                    <h6 class="fw-bold">{{ Str::limit($item->nama_program, 40) }}</h6>
                                    <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn btn-sm btn-outline-primary mt-2">
                                        Lihat Program <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="text-center mt-4">
                    <a href="{{ route('public.proker') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Program Kerja
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection