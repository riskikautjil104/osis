@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card-stats">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Pengurus</h6>
                    <h2 class="mb-0">{{ $totalPengurus }}</h2>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-users fa-2x text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Agenda</h6>
                    <h2 class="mb-0">{{ $totalAgenda }}</h2>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-calendar fa-2x text-success"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Berita</h6>
                    <h2 class="mb-0">{{ $totalBerita }}</h2>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-newspaper fa-2x text-warning"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stats">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Galeri</h6>
                    <h2 class="mb-0">{{ $totalGaleri }}</h2>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-image fa-2x text-info"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-calendar-alt me-2 text-primary"></i> Agenda Terbaru
            </div>
            <div class="card-body">
                @forelse($recentAgenda as $item)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <div>
                        <h6 class="mb-0">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->tanggal->format('d/m/Y') }} - {{ $item->tempat }}</small>
                    </div>
                    <span class="badge bg-primary">{{ $item->status }}</span>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada agenda</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fas fa-newspaper me-2 text-primary"></i> Berita Terbaru
            </div>
            <div class="card-body">
                @forelse($recentBerita as $item)
                <div class="mb-3 pb-2 border-bottom">
                    <h6 class="mb-0">{{ $item->judul }}</h6>
                    <small class="text-muted">{{ $item->tanggal->format('d/m/Y') }} - {{ $item->kategori }}</small>
                </div>
                @empty
                <p class="text-muted text-center">Belum ada berita</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection