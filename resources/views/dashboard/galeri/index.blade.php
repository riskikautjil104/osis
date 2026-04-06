@extends('layouts.dashboard')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-images me-2 text-primary"></i>Galeri Foto</h5>
        <a href="{{ route('dashboard.galeri.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Foto
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="row g-3">
            @forelse($galeri as $item)
            <div class="col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm position-relative">
                    <div class="position-relative" style="height: 200px; overflow: hidden; border-radius: 12px 12px 0 0;">
                        <img src="{{ asset($item->gambar) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $item->judul }}">
                        @if($item->is_active)
                            <span class="position-absolute top-0 end-0 m-2 badge bg-success">Aktif</span>
                        @else
                            <span class="position-absolute top-0 end-0 m-2 badge bg-secondary">Nonaktif</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="fw-semibold mb-1">{{ Str::limit($item->judul, 30) }}</h6>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $item->formatted_date }}
                            </small>
                            <span class="badge bg-info">{{ $item->kategori }}</span>
                        </div>
                        @if($item->deskripsi)
                            <small class="text-muted d-block mt-2">{{ Str::limit($item->deskripsi, 50) }}</small>
                        @endif
                        <div class="mt-3">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('dashboard.galeri.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.galeri.destroy', $item->id) }}" method="POST" class="d-inline w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus foto ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-images fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada foto di galeri</h5>
                    <p class="text-muted">Silakan tambah foto pertama Anda</p>
                    <a href="{{ route('dashboard.galeri.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Foto
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection