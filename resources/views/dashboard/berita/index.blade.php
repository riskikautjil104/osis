@extends('layouts.dashboard')

@section('title', 'Manajemen Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-newspaper me-2 text-primary"></i>Daftar Berita</h5>
        <a href="{{ route('dashboard.berita.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Berita
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="80">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" width="50" height="40" style="object-fit: cover; border-radius: 6px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:40px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ Str::limit($item->judul, 50) }}</td>
                        <td><span class="badge bg-success">{{ $item->kategori }}</span></td>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>
                            @if($item->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $item->views }}</td>
                        <td>
                            <a href="{{ route('dashboard.berita.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboard.berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus berita ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada data berita</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection