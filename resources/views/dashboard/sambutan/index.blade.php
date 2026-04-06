@extends('layouts.dashboard')

@section('title', 'Manajemen Sambutan Ketua OSIS')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-microphone-alt me-2 text-primary"></i>Sambutan Ketua OSIS
        </h5>
        <a href="{{ route('dashboard.sambutan.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Sambutan
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
                        <th width="80">Foto</th>
                        <th>Judul</th>
                        <th>Nama Ketua</th>
                        <th>Jabatan</th>
                        <th width="100">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sambutan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset($item->foto) }}" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                                </div>
                            @endif
                         </td>
                        <td class="fw-semibold">{{ Str::limit($item->judul, 40) }}</td>
                        <td>{{ $item->nama_ketua }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('dashboard.sambutan.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.sambutan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus sambutan ini?')">
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
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-microphone-slash fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">Belum ada sambutan ketua OSIS</p>
                            <a href="{{ route('dashboard.sambutan.create') }}" class="btn btn-primary btn-sm mt-3">
                                <i class="fas fa-plus me-1"></i>Tambah Sambutan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Catatan:</strong> Hanya 1 sambutan yang bisa aktif (ditampilkan di halaman depan). Jika Anda mengaktifkan sambutan baru, sambutan sebelumnya akan otomatis nonaktif.
        </div>
    </div>
</div>
@endsection