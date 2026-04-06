@extends('layouts.app')

@section('title', 'Pengurus Terdahulu')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Legacy</div>
            <h2 class="section-title">Pengurus Terdahulu</h2>
            <p class="section-subtitle">Para pemimpin yang telah mengabdikan diri untuk kemajuan OSIS</p>
        </div>
        
        <!-- Filter Periode -->
        <div class="row mb-4">
            <div class="col-md-4 mx-auto">
                <select id="filterPeriode" class="form-select" onchange="filterPengurus()">
                    <option value="all">Semua Periode</option>
                    @foreach($periodes as $periode)
                        <option value="{{ $periode->periode }}">{{ $periode->periode }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row g-4" id="pengurusList">
            @forelse($pengurus as $item)
            <div class="col-md-4 col-lg-3 pengurus-item" data-periode="{{ $item->periode }}">
                <div class="card h-100 border-0 shadow-sm text-center hover-card">
                    <div class="card-body">
                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                        @else
                            <div class="avatar avatar-bg-g mx-auto mb-3" style="width: 120px; height: 120px; font-size: 2.5rem;">
                                {{ $item->initial }}
                            </div>
                        @endif
                        <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                        <p class="text-muted small mb-2">{{ $item->jabatan }}</p>
                        <span class="badge bg-warning text-dark mb-2">{{ $item->periode }}</span>
                        @if($item->prestasi)
                            <p class="small text-muted mt-2">
                                <i class="fas fa-trophy text-warning me-1"></i>
                                {{ Str::limit($item->prestasi, 80) }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada data pengurus terdahulu</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $pengurus->links() }}
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
</style>

<script>
    function filterPengurus() {
        const periodeFilter = document.getElementById('filterPeriode').value;
        const items = document.querySelectorAll('.pengurus-item');
        
        items.forEach(item => {
            const periode = item.dataset.periode;
            if (periodeFilter === 'all' || periode === periodeFilter) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection