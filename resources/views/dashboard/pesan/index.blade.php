@extends('layouts.dashboard')

@section('title', 'Manajemen Pesan Masuk')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-envelope me-2 text-primary"></i>Pesan Masuk
            @if($unreadCount > 0)
                <span class="badge bg-danger ms-2">{{ $unreadCount }} Baru</span>
            @endif
        </h5>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesan as $index => $item)
                    <tr class="{{ $item->status == 'belum_dibaca' ? 'fw-bold' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ Str::limit($item->subjek, 30) }}</td>
                        <td>{{ Str::limit($item->pesan, 40) }}</td>
                        <td>{!! $item->status_badge !!}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dashboard.pesan.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat & Balas">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('dashboard.pesan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesan ini?')">
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
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada pesan masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection