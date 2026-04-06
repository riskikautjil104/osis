@extends('layouts.app')

@section('title', 'Agenda Kegiatan')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Kalender Kegiatan</div>
            <h2 class="section-title">Semua Agenda OSIS</h2>
            <p class="section-subtitle">Daftar lengkap program dan kegiatan OSIS</p>
        </div>
        
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select id="filterStatus" class="form-select" onchange="filterAgenda()">
                    <option value="all">Semua Status</option>
                    <option value="segera">Segera</option>
                    <option value="berlangsung">Berlangsung</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="col-md-4">
                <select id="filterKategori" class="form-select" onchange="filterAgenda()">
                    <option value="all">Semua Kategori</option>
                    <option value="Akademik">Akademik</option>
                    <option value="Seni">Seni</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Sosial">Sosial</option>
                </select>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div id="agendaList">
                    @forelse($agenda as $item)
                    <div class="agenda-item {{ $item->status_class }}" data-status="{{ $item->status }}" data-kategori="{{ $item->kategori }}">
                        <div class="agenda-date">
                            <div class="agenda-day">{{ $item->formatted_date }}</div>
                            <small class="text-muted">{{ $item->formatted_month }}</small>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                            <div class="d-flex flex-wrap gap-3 small text-muted">
                                @if($item->waktu)<span><i class="far fa-clock me-1"></i>{{ $item->waktu }}</span>@endif
                                <span><i class="fas fa-map-marker-alt me-1"></i>{{ $item->tempat }}</span>
                                <span><i class="fas fa-tag me-1"></i>{{ $item->kategori }}</span>
                            </div>
                            @if($item->deskripsi)
                                <p class="small text-muted mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                            @endif
                        </div>
                        <div>
                            <span class="badge {{ $item->status_badge_class }}">{{ $item->status_text }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <p class="text-muted">Belum ada agenda kegiatan</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $agenda->links() }}
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<script>
    function filterAgenda() {
        const statusFilter = document.getElementById('filterStatus').value;
        const kategoriFilter = document.getElementById('filterKategori').value;
        const items = document.querySelectorAll('#agendaList .agenda-item');
        
        items.forEach(item => {
            const status = item.dataset.status;
            const kategori = item.dataset.kategori;
            let show = true;
            
            if (statusFilter !== 'all' && status !== statusFilter) {
                show = false;
            }
            if (kategoriFilter !== 'all' && kategori !== kategoriFilter) {
                show = false;
            }
            
            item.style.display = show ? '' : 'none';
        });
    }
</script>
@endsection