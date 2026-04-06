@extends('layouts.dashboard')

@section('title', 'Manajemen One Data - Dokumen')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-database me-2 text-primary"></i>One Data - Dokumen
        </h5>
        <a href="{{ route('dashboard.dokumen.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Upload Dokumen
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="60">Type</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Ukuran</th>
                        <th width="100">Downloads</th>
                        <th width="100">Views</th>
                        <th>Tanggal</th>
                        <th width="80">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dokumen as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{!! $item->file_icon !!}</td>
                        <td class="fw-semibold">{{ Str::limit($item->judul, 50) }}</td>
                        <td><span class="badge bg-{{ $item->category_badge }}">{{ $item->kategori }}</span></td>
                        <td>{{ $item->formatted_file_size }}</td>
                        <td>
                            <span class="badge bg-info">
                                <i class="fas fa-download me-1"></i> {{ $item->download_count }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">
                                <i class="fas fa-eye me-1"></i> {{ $item->view_count }}
                            </span>
                        </td>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>
                            @if($item->is_published)
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('dashboard.dokumen.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.dokumen.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <i class="fas fa-database fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">Belum ada dokumen yang diupload</p>
                            <a href="{{ route('dashboard.dokumen.create') }}" class="btn btn-primary btn-sm mt-3">
                                <i class="fas fa-plus me-1"></i>Upload Dokumen Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Info One Data:</strong> Fitur ini untuk menyimpan berbagai dokumen penting seperti profil sekolah, program kerja, laporan kegiatan, surat keputusan, dan dokumen publik lainnya.
        </div>
    </div>
</div>
@endsection