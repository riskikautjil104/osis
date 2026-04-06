@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Info & Kabar</div>
            <h2 class="section-title">Semua Berita</h2>
            <p class="section-subtitle">Kumpulan berita dan informasi terbaru dari OSIS</p>
        </div>
        
        <!-- Filter Kategori -->
        <div class="row mb-4">
            <div class="col-md-4 mx-auto">
                <select id="filterKategori" class="form-select" onchange="filterBerita()">
                    <option value="all">Semua Kategori</option>
                    <option value="Prestasi">🏆 Prestasi</option>
                    <option value="Kegiatan">🎓 Kegiatan</option>
                    <option value="Lingkungan">🌊 Lingkungan</option>
                    <option value="Budaya">🎭 Budaya</option>
                </select>
            </div>
        </div>
        
        <div class="row g-4" id="beritaList">
            @forelse($berita as $item)
            <div class="col-md-6 col-lg-4 berita-item" data-kategori="{{ $item->kategori }}">
                <div class="berita-card h-100">
                    <div class="berita-image" style="background: linear-gradient(135deg, #E1F5EE, #9FE1CB);">
                        {{ $item->category_icon }}
                    </div>
                    <div class="p-3">
                        <span class="badge bg-success mb-2">{{ $item->kategori }}</span>
                        <h5 class="fw-bold mb-2">{{ Str::limit($item->judul, 60) }}</h5>
                        <p class="small text-muted">{{ $item->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i>{{ $item->formatted_date }}
                                <span class="ms-2"><i class="far fa-eye me-1"></i>{{ $item->views }} views</span>
                            </small>
                            <a href="{{ route('public.berita.detail', [$item->id, $item->slug]) }}" class="btn btn-sm btn-outline-success">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada berita</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $berita->links() }}
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<script>
    function filterBerita() {
        const kategoriFilter = document.getElementById('filterKategori').value;
        const items = document.querySelectorAll('.berita-item');
        
        items.forEach(item => {
            const kategori = item.dataset.kategori;
            if (kategoriFilter === 'all' || kategori === kategoriFilter) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection