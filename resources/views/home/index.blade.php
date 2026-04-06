@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="hero-bg-pattern"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="hero-badge">
                    <i class="fas fa-star" style="color: #FAC775; font-size: 12px;"></i>
                    <span>Organisasi Siswa Intra Sekolah</span>
                </div>
                <h1 class="hero-title">Bergerak, Berkarya,<br><em>Berprestasi</em></h1>
                <p class="text-white-50 mb-4" style="font-size: 1rem;">
                    OSIS SMA Negeri 5 Kab. Pulau Morotai — wadah kreativitas, kepemimpinan, 
                    dan pengembangan diri siswa menuju generasi emas Maluku Utara.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="#agenda" class="btn btn-warning px-4 py-2 fw-semibold">Lihat Agenda</a>
                    <a href="#pengurus" class="btn btn-outline-light px-4 py-2 fw-semibold">Kenal Pengurus</a>
                </div>
                <div class="row mt-5 pt-4 justify-content-center">
                    <div class="col-4">
                        <h3 class="text-white fw-bold mb-0">{{ $stats['pengurus'] }}</h3>
                        <small class="text-white-50">Pengurus Aktif</small>
                    </div>
                    <div class="col-4">
                        <h3 class="text-white fw-bold mb-0">{{ $stats['program'] }}</h3>
                        <small class="text-white-50">Program Kerja</small>
                    </div>
                    <div class="col-4">
                        <h3 class="text-white fw-bold mb-0">{{ $stats['prestasi'] }}</h3>
                        <small class="text-white-50">Prestasi 2024</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
@if($visiMisi)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="mb-3">
                        <div class="section-tag d-inline-block mb-2">Tujuan Kami</div>
                    </div>
                    <i class="fas fa-eye fa-2x mb-3" style="color: var(--primary);"></i>
                    <h3 class="fw-bold mb-3">Visi</h3>
                    <p class="text-muted" style="line-height: 1.8;">{{ $visiMisi->visi }}</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <i class="fas fa-list-check fa-2x mb-3" style="color: var(--primary);"></i>
                    <h3 class="fw-bold mb-3">Misi</h3>
                    <ul class="text-muted" style="line-height: 1.8; padding-left: 1.25rem;">
                        @foreach($visiMisi->misi as $misi)
                            <li class="mb-2">{{ $misi }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Pengurus Section -->
<section id="pengurus" class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Struktur Organisasi</div>
            <h2 class="section-title">Pengurus OSIS 2024/2025</h2>
            <p class="section-subtitle">Mereka yang terpilih untuk memimpin dan melayani seluruh siswa</p>
        </div>
        <div class="row g-4">
            @forelse($pengurus as $item)
            <div class="col-md-6 col-lg-3">
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
                    @if($item->is_ketua)
                        <div class="mt-2"><span class="badge" style="background: var(--primary);">Ketua OSIS</span></div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data pengurus</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Agenda Section -->
<section id="agenda" class="py-5 bg-light">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Kalender Kegiatan</div>
            <h2 class="section-title">Agenda OSIS</h2>
            <p class="section-subtitle">Program dan kegiatan yang direncanakan untuk siswa</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @forelse($agenda as $item)
                <div class="agenda-item {{ $item->status_class }}">
                    <div class="agenda-date">
                        <div class="agenda-day">{{ $item->formatted_date }}</div>
                        <small class="text-muted">{{ $item->formatted_month }}</small>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                        <div class="d-flex flex-wrap gap-3 small text-muted">
                            @if($item->waktu)<span><i class="far fa-clock me-1"></i>{{ $item->waktu }}</span>@endif
                            <span><i class="fas fa-map-marker-alt me-1"></i>{{ $item->tempat }}</span>
                        </div>
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
        </div>
    </div>
</section>

<!-- Berita Section -->
<section id="berita" class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Info & Kabar</div>
            <h2 class="section-title">Berita Terkini</h2>
            <p class="section-subtitle">Liputan kegiatan dan informasi terbaru dari OSIS</p>
        </div>
        <div class="row g-4">
            @forelse($berita as $item)
            <div class="col-md-6 col-lg-3">
                <div class="berita-card">
                    <div class="berita-image" style="background: linear-gradient(135deg, #E1F5EE, #9FE1CB);">
                        {{ $item->category_icon }}
                    </div>
                    <div class="p-3">
                        <span class="badge bg-success mb-2">{{ $item->kategori }}</span>
                        <h6 class="fw-bold mb-2">{{ Str::limit($item->judul, 40) }}</h6>
                        <p class="small text-muted">{{ $item->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i>{{ $item->formatted_date }}</small>
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $item->id }}">
                                Baca
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Berita Modal -->
            <div class="modal fade" id="beritaModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" class="img-fluid rounded mb-3 w-100">
                            @endif
                            <div class="mb-2">
                                <span class="badge bg-success">{{ $item->kategori }}</span>
                                <small class="text-muted ms-2"><i class="far fa-calendar-alt me-1"></i>{{ $item->formatted_date }}</small>
                            </div>
                            <div>{!! nl2br(e($item->konten)) !!}</div>
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
    </div>
</section>

<!-- Galeri Section -->
<section id="galeri" class="py-5 bg-light">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Dokumentasi</div>
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-subtitle">Momen berharga dari berbagai kegiatan OSIS</p>
        </div>
        <div class="galeri-grid">
            @forelse($galeri as $item)
            <div class="galeri-item" data-bs-toggle="modal" data-bs-target="#galeriModal{{ $item->id }}">
                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}">
            </div>
            
            <!-- Galeri Modal -->
            <div class="modal fade" id="galeriModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset($item->gambar) }}" class="img-fluid rounded mb-3">
                            @if($item->deskripsi)
                                <p class="mb-2">{{ $item->deskripsi }}</p>
                            @endif
                            <small class="text-muted">{{ $item->formatted_date }}</small>
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
    </div>
</section>

<!-- Pengurus Terdahulu -->
@if($pengurusTerdahulu->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Legacy</div>
            <h2 class="section-title">Pengurus Terdahulu</h2>
            <p class="section-subtitle">Para pemimpin yang telah mengabdikan diri untuk kemajuan OSIS</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($pengurusTerdahulu as $item)
            <div class="col-md-3 col-lg-2 text-center">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" class="rounded-circle mb-2" width="80" height="80" style="object-fit: cover;">
                @else
                    <div class="avatar avatar-bg-g mx-auto" style="width: 80px; height: 80px; font-size: 1.8rem;">{{ $item->initial }}</div>
                @endif
                <h6 class="fw-bold mb-0 small">{{ $item->nama }}</h6>
                <p class="text-muted small mb-0">{{ $item->jabatan }}</p>
                <small class="text-primary">{{ $item->periode }}</small>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection