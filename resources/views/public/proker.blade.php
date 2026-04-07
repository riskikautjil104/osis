@extends('layouts.app')

@section('title', 'Program Kerja OSIS')

@section('content')
<style>
    .stats-card-proker {
        background: linear-gradient(135deg, #0F6E56, #1D9E75);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        color: white;
        transition: transform 0.3s;
    }
    .stats-card-proker:hover {
        transform: translateY(-5px);
    }
    .proker-card {
        transition: all 0.3s;
        border-radius: 16px;
        overflow: hidden;
    }
    .proker-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .progress-custom {
        height: 8px;
        border-radius: 10px;
    }
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }
</style>

<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Program Kerja</div>
            <h2 class="section-title">Program Kerja OSIS</h2>
            <p class="section-subtitle">Berbagai program unggulan untuk pengembangan siswa</p>
        </div>
        
        <!-- Stats -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stats-card-proker">
                    <i class="fas fa-tasks fa-2x mb-2"></i>
                    <div class="stats-number">{{ $stats['total'] }}</div>
                    <div>Total Program</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-proker" style="background: linear-gradient(135deg, #EF9F27, #FAC775);">
                    <i class="fas fa-play-circle fa-2x mb-2"></i>
                    <div class="stats-number">{{ $stats['berjalan'] }}</div>
                    <div>Sedang Berjalan</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-proker" style="background: linear-gradient(135deg, #28a745, #20c997);">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <div class="stats-number">{{ $stats['selesai'] }}</div>
                    <div>Telah Selesai</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-proker" style="background: linear-gradient(135deg, #6c757d, #495057);">
                    <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                    <div class="stats-number">{{ $stats['rencana'] }}</div>
                    <div>Rencana</div>
                </div>
            </div>
        </div>
        
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <div class="d-flex gap-2">
                    <select id="filterKategori" class="form-select" onchange="filterProker()">
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
                    <select id="filterStatus" class="form-select" onchange="filterProker()">
                        <option value="all">Semua Status</option>
                        <option value="rencana">📅 Rencana</option>
                        <option value="berjalan">▶️ Berjalan</option>
                        <option value="selesai">✅ Selesai</option>
                        <option value="tertunda">⏸️ Tertunda</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Proker Unggulan -->
        @if($prokerUnggulan->count() > 0)
        <div class="mb-5">
            <h4 class="fw-bold mb-3"><i class="fas fa-star text-warning me-2"></i>Program Unggulan</h4>
            <div class="row">
                @foreach($prokerUnggulan as $item)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm proker-card">
                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <span class="badge bg-warning text-dark mb-2">
                                <i class="fas fa-star me-1"></i> Unggulan
                            </span>
                            <h5 class="fw-bold">{{ Str::limit($item->nama_program, 40) }}</h5>
                            <p class="small text-muted">{{ Str::limit($item->deskripsi, 80) }}</p>
                            {!! $item->progress_bar !!}
                            <small class="text-muted">{{ $item->progress }}%</small>
                            <div class="mt-3">
                                <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn btn-primary btn-sm w-100">
                                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Semua Proker -->
        <div class="row g-4" id="prokerList">
            @forelse($proker as $item)
            <div class="col-md-6 col-lg-4 proker-item" data-kategori="{{ $item->kategori }}" data-status="{{ $item->status }}">
                <div class="card border-0 shadow-sm h-100 proker-card position-relative">
                    <div class="status-badge">{!! $item->status_badge !!}</div>
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                    @else
                        <div class="bg-light text-center py-4">
                            <div style="font-size: 48px;">{{ $item->category_icon }}</div>
                        </div>
                    @endif
                    <div class="card-body">
                        <span class="badge bg-info mb-2">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</span>
                        <h5 class="fw-bold mb-2">{{ Str::limit($item->nama_program, 45) }}</h5>
                        <p class="small text-muted mb-2">
                            <i class="far fa-calendar-alt me-1"></i> {{ $item->tanggal_mulai->format('d/m/Y') }}
                            @if($item->durasi != 'Berlangsung')
                                - {{ $item->tanggal_selesai->format('d/m/Y') }}
                            @endif
                        </p>
                        <p class="small text-muted">{{ Str::limit($item->deskripsi, 80) }}</p>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Progress</span>
                                <span class="fw-bold">{{ $item->progress }}%</span>
                            </div>
                            {!! $item->progress_bar !!}
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('public.proker.detail', [$item->id, $item->slug]) }}" class="btn btn-outline-primary btn-sm w-100">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada program kerja</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $proker->links() }}
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<script>
    function filterProker() {
        const kategoriFilter = document.getElementById('filterKategori').value;
        const statusFilter = document.getElementById('filterStatus').value;
        const items = document.querySelectorAll('.proker-item');
        
        items.forEach(item => {
            const kategori = item.dataset.kategori;
            const status = item.dataset.status;
            let show = true;
            
            if (kategoriFilter !== 'all' && kategori !== kategoriFilter) show = false;
            if (statusFilter !== 'all' && status !== statusFilter) show = false;
            
            item.style.display = show ? '' : 'none';
        });
    }
</script>
@endsection