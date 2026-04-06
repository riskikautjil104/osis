@extends('layouts.dashboard')

@section('title', 'Manajemen Pengurus')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">
            <i class="fas fa-users me-2 text-primary"></i>Daftar Pengurus OSIS
        </h5>
        <a href="{{ route('dashboard.pengurus.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Tambah Pengurus
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
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Kelas</th>
                        <th>Motto</th>
                        <th width="80">Ketua</th>
                        <th width="80">Urutan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengurus as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset($item->foto) }}" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                            @else
                                <div class="avatar {{ $item->avatar_color_class }}" style="width: 50px; height: 50px; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    {{ $item->initial }}
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->kelas ?? '-' }}</td>
                        <td>
                            @if($item->motto)
                                <span title="{{ $item->motto }}">
                                    {{ Str::limit($item->motto, 30) }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {!! $item->is_ketua ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' !!}
                        </td>
                        <td>{{ $item->urutan }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('dashboard.pengurus.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.pengurus.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pengurus {{ $item->nama }}?')">
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
                        <td colspan="9" class="text-center py-5">
                            <i class="fas fa-users-slash fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">Belum ada data pengurus</p>
                            <a href="{{ route('dashboard.pengurus.create') }}" class="btn btn-primary btn-sm mt-3">
                                <i class="fas fa-plus me-1"></i>Tambah Pengurus Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .avatar-bg-g { background: #E1F5EE; color: #0F6E56; }
    .avatar-bg-a { background: #FAEEDA; color: #633806; }
    .avatar-bg-b { background: #E6F1FB; color: #185FA5; }
    .avatar-bg-p { background: #FBEAF0; color: #72243E; }
    .avatar-bg-t { background: #E1F5EE; color: #085041; }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection