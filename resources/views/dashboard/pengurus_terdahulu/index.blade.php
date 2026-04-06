@extends('layouts.dashboard')

@section('title', 'Manajemen Pengurus Terdahulu')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-history me-2 text-primary"></i>Pengurus Terdahulu</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus me-1"></i>Tambah Pengurus
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Filter by Periode -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select id="filterPeriode" class="form-select">
                    <option value="all">Semua Periode</option>
                    @php
                        $periodes = $pengurus->pluck('periode')->unique()->sortDesc();
                    @endphp
                    @foreach($periodes as $periode)
                        <option value="{{ $periode }}">{{ $periode }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row g-4" id="pengurusList">
            @forelse($pengurus as $item)
            <div class="col-md-6 col-lg-4 col-xl-3 pengurus-item" data-periode="{{ $item->periode }}">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="position-relative">
                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" class="card-img-top" style="height: 250px; object-fit: cover; border-radius: 12px 12px 0 0;" alt="{{ $item->nama }}">
                        @else
                            <div class="bg-gradient-primary d-flex align-items-center justify-content-center" style="height: 250px; border-radius: 12px 12px 0 0; background: linear-gradient(135deg, #0F6E56, #1D9E75);">
                                <div class="text-center text-white">
                                    <div class="display-1 fw-bold">{{ substr($item->nama, 0, 2) }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-warning text-dark">{{ $item->periode }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                        <p class="text-muted small mb-2">{{ $item->jabatan }}</p>
                        @if($item->prestasi)
                            <div class="mt-2">
                                <small class="text-success">
                                    <i class="fas fa-trophy me-1"></i> {{ Str::limit($item->prestasi, 50) }}
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-warning btn-sm" onclick="editPengurus({{ $item->id }})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('dashboard.pengurus_terdahulu.destroy', $item->id) }}" method="POST" class="d-inline w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus data pengurus ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users-slash fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data pengurus terdahulu</h5>
                    <p class="text-muted">Silakan tambah data pengurus periode sebelumnya</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Pengurus Terdahulu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dashboard.pengurus_terdahulu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Periode <span class="text-danger">*</span></label>
                            <input type="text" name="periode" class="form-control" placeholder="Contoh: 2022/2023" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Max 2MB, format JPG/PNG</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Prestasi / Catatan Khusus</label>
                            <textarea name="prestasi" class="form-control" rows="3" placeholder="Contoh: Berhasil mengadakan 10 program kerja, Juara OSN tingkat kabupaten, dll"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Pengurus Terdahulu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div id="editContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0F6E56, #1D9E75);
    }
</style>

@push('scripts')
<script>
    // Filter by periode
    document.getElementById('filterPeriode').addEventListener('change', function() {
        const selectedPeriode = this.value;
        const items = document.querySelectorAll('.pengurus-item');
        
        items.forEach(item => {
            if (selectedPeriode === 'all' || item.dataset.periode === selectedPeriode) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Edit function
    function editPengurus(id) {
        fetch(`/dashboard/pengurus-terdahulu/${id}/edit`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('editContent').innerHTML = html;
                document.getElementById('editForm').action = `/dashboard/pengurus-terdahulu/${id}`;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
    }
</script>
@endpush
@endsection