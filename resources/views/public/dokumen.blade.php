@extends('layouts.app')

@section('title', 'One Data - Pusat Dokumen')

@section('content')
<style>
    .stats-card {
        background: linear-gradient(135deg, #0F6E56, #1D9E75);
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        color: white;
        transition: transform 0.3s;
    }
    .stats-card:hover {
        transform: translateY(-5px);
    }
    .stats-number {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 5px;
    }
    .dokumen-card {
        transition: all 0.3s;
        border-radius: 16px;
        overflow: hidden;
    }
    .dokumen-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .dokumen-icon {
        font-size: 48px;
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
    }
    .search-box {
        border-radius: 50px;
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s;
    }
    .search-box:focus {
        border-color: #0F6E56;
        box-shadow: none;
    }
    .btn-export {
        border-radius: 50px;
        padding: 8px 20px;
        margin: 0 5px;
    }
</style>

<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">One Data</div>
            <h2 class="section-title">Pusat Dokumen Digital</h2>
            <p class="section-subtitle">Kumpulan dokumen penting, laporan kegiatan, program kerja, dan informasi resmi lainnya</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-file-alt fa-3x mb-3"></i>
                    <div class="stats-number">{{ $totalDokumen }}</div>
                    <div>Total Dokumen</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #EF9F27, #FAC775);">
                    <i class="fas fa-download fa-3x mb-3"></i>
                    <div class="stats-number">{{ $totalDownloads }}</div>
                    <div>Total Downloads</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #1D9E75, #0F6E56);">
                    <i class="fas fa-chart-line fa-3x mb-3"></i>
                    <div class="stats-number">Aktif</div>
                    <div>Data Terupdate</div>
                </div>
            </div>
        </div>
        
        <!-- Search & Filter -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form method="GET" action="{{ route('public.dokumen') }}" class="d-flex gap-2">
                    <div class="flex-grow-1">
                        <input type="text" name="search" class="form-control search-box" placeholder="Cari dokumen..." value="{{ request('search') }}">
                    </div>
                    <select name="kategori" class="form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="all">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->kategori }}" {{ request('kategori') == $kat->kategori ? 'selected' : '' }}>
                                @if($kat->kategori == 'profil') 📋 Profil
                                @elseif($kat->kategori == 'program_kerja') 📊 Program Kerja
                                @elseif($kat->kategori == 'laporan') 📄 Laporan
                                @elseif($kat->kategori == 'surat') ✉️ Surat
                                @elseif($kat->kategori == 'peraturan') ⚖️ Peraturan
                                @else 📁 Lainnya
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Export Buttons -->
        <div class="text-end mb-4">
            <div class="btn-group">
                <button type="button" class="btn btn-success btn-export dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i> Export Data
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('public.dokumen.export', 'csv') }}">
                        <i class="fas fa-file-csv text-success me-2"></i> Export ke CSV
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('public.dokumen.export', 'excel') }}">
                        <i class="fas fa-file-excel text-success me-2"></i> Export ke Excel
                    </a></li>
                </ul>
            </div>
        </div>
        
        <!-- Dokumen Grid -->
        <div class="row g-4">
            @forelse($dokumen as $item)
            <div class="col-md-6 col-lg-4">
                <div class="dokumen-card card h-100 border-0 shadow-sm">
                    <div class="dokumen-icon">
                        {!! $item->file_icon !!}
                    </div>
                    <div class="card-body">
                        <span class="badge bg-{{ $item->category_badge }} mb-2">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</span>
                        <h5 class="fw-bold mb-2">{{ Str::limit($item->judul, 50) }}</h5>
                        <p class="small text-muted mb-2">
                            <i class="far fa-calendar-alt me-1"></i> {{ $item->tanggal->format('d F Y') }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-file-alt me-1"></i> {{ strtoupper($item->file_type) }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-download me-1"></i> {{ $item->download_count }}
                        </p>
                        @if($item->deskripsi)
                            <p class="small text-muted">{{ Str::limit($item->deskripsi, 80) }}</p>
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('public.dokumen.detail', [$item->id, $item->slug]) }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-info-circle me-1"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada dokumen</h5>
                    <p class="text-muted">Belum ada dokumen yang dipublikasikan</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $dokumen->links() }}
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection