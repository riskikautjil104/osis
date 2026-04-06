@extends('layouts.app')

@section('title', 'Galeri Foto')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Dokumentasi</div>
            <h2 class="section-title">Galeri Foto</h2>
            <p class="section-subtitle">Kumpulan foto dokumentasi kegiatan OSIS</p>
        </div>
        
        <!-- Filter Kategori -->
        <div class="row mb-4">
            <div class="col-md-4 mx-auto">
                <select id="filterKategori" class="form-select" onchange="filterGaleri()">
                    <option value="all">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->kategori }}">
                            @if($kat->kategori == 'kegiatan') 🎪 Kegiatan
                            @elseif($kat->kategori == 'prestasi') 🏆 Prestasi
                            @elseif($kat->kategori == 'seni') 🎨 Seni & Budaya
                            @elseif($kat->kategori == 'olahraga') ⚽ Olahraga
                            @elseif($kat->kategori == 'upacara') 🏫 Upacara
                            @else 📸 Umum
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="galeri-grid" id="galeriList">
            @forelse($galeri as $item)
            <div class="galeri-item" data-kategori="{{ $item->kategori }}" data-bs-toggle="modal" data-bs-target="#galeriModal{{ $item->id }}">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}">
                <div class="galeri-overlay">
                    <div class="galeri-info">
                        <h6 class="text-white mb-1">{{ Str::limit($item->judul, 30) }}</h6>
                        <small class="text-white-50">{{ $item->formatted_date }}</small>
                    </div>
                </div>
            </div>
            
            <!-- Galeri Modal -->
            <div class="modal fade" id="galeriModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-0">
                            <img src="{{ asset($item->gambar) }}" class="img-fluid w-100" alt="{{ $item->judul }}">
                        </div>
                        <div class="modal-footer border-0">
                            <div class="w-100">
                                @if($item->deskripsi)
                                    <p class="mb-2">{{ $item->deskripsi }}</p>
                                @endif
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>{{ $item->formatted_date }}
                                    <span class="mx-2">•</span>
                                    <span class="badge bg-info">{{ $item->kategori }}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada foto di galeri</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $galeri->links() }}
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<style>
    .galeri-item {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    
    .galeri-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .galeri-item:hover img {
        transform: scale(1.1);
    }
    
    .galeri-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .galeri-item:hover .galeri-overlay {
        transform: translateY(0);
    }
    
    .galeri-info {
        color: white;
    }
    
    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
</style>

<script>
    function filterGaleri() {
        const kategoriFilter = document.getElementById('filterKategori').value;
        const items = document.querySelectorAll('.galeri-item');
        
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