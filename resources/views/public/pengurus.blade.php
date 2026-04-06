@extends('layouts.app')

@section('title', 'Pengurus OSIS')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Struktur Organisasi</div>
            <h2 class="section-title">Seluruh Pengurus OSIS</h2>
            <p class="section-subtitle">Berikut adalah daftar lengkap pengurus OSIS periode 2024/2025</p>
        </div>
        
        <!-- Filter & Search -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <input type="text" id="searchPengurus" class="form-control" placeholder="Cari pengurus...">
                    <button class="btn btn-primary" onclick="searchPengurus()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row g-4" id="pengurusList">
            @foreach($pengurus as $item)
            <div class="col-md-6 col-lg-3 pengurus-item" data-name="{{ strtolower($item->nama) }}">
                <div class="pengurus-card {{ $item->is_ketua ? 'ketua' : '' }}">
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" class="avatar-img" alt="{{ $item->nama }}">
                    @else
                        <div class="avatar {{ $item->avatar_color_class }}">{{ $item->initial }}</div>
                    @endif
                    <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                    <p class="text-muted small mb-2">{{ $item->jabatan }}</p>
                    @if($item->kelas)
                        <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>{{ $item->kelas }}</small>
                    @endif
                    @if($item->motto)
                        <p class="small text-muted mt-2"><i class="fas fa-quote-left me-1"></i> {{ Str::limit($item->motto, 50) }}</p>
                    @endif
                    @if($item->is_ketua)
                        <div class="mt-2"><span class="badge" style="background: var(--primary);">Ketua OSIS</span></div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<style>
    .pengurus-card {
        transition: all 0.3s ease;
        height: 100%;
    }
    .pengurus-card:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    function searchPengurus() {
        const searchTerm = document.getElementById('searchPengurus').value.toLowerCase();
        const items = document.querySelectorAll('.pengurus-item');
        
        items.forEach(item => {
            const name = item.dataset.name;
            if (name.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    document.getElementById('searchPengurus').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            searchPengurus();
        }
    });
</script>
@endsection