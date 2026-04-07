@extends('layouts.dashboard')

@section('title', 'Manajemen Program Kerja OSIS')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-tasks me-2 text-primary"></i>Program Kerja OSIS
        </h5>
        <a href="{{ route('dashboard.proker.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Proker
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="60">Icon</th>
                        <th>Nama Program</th>
                        <th>Kategori</th>
                        <th>Penanggung Jawab</th>
                        <th width="120">Progress</th>
                        <th>Status</th>
                        <th>Publik</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proker as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><div style="font-size: 24px;">{{ $item->category_icon }}</div></td>
                        <td class="fw-semibold">{{ Str::limit($item->nama_program, 40) }}</td>
                        <td><span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $item->kategori)) }}</span></td>
                        <td>{{ $item->penanggung_jawab }}</td>
                        <td>
                            <div>
                                <small>{{ $item->progress }}%</small>
                                {!! $item->progress_bar !!}
                            </div>
                        </td>
                        <td>{!! $item->status_badge !!}</td>
                        <td>
                            @if($item->is_published)
                                <span class="badge bg-success">Ya</span>
                            @else
                                <span class="badge bg-secondary">Tidak</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dashboard.proker.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.proker.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus program kerja ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                            <p>Belum ada program kerja</p>
                            <a href="{{ route('dashboard.proker.create') }}" class="btn btn-primary btn-sm">Tambah Proker</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
             </table>
        </div>
    </div>
</div>
@endsection