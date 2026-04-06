@extends('layouts.dashboard')

@section('title', 'Manajemen Agenda')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-calendar me-2 text-primary"></i>Daftar Agenda</h5>
        <a href="{{ route('dashboard.agenda.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Agenda
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agenda as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->waktu ?? '-' }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>
                            <span class="badge {{ $item->status_badge_class }}">
                                {{ $item->status_text }}
                            </span>
                        </td>
                        <td><span class="badge bg-info">{{ $item->kategori }}</span></td>
                        <td>
                            <a href="{{ route('dashboard.agenda.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboard.agenda.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus agenda ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada data agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection