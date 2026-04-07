@extends('layouts.dashboard')

@section('title', 'Edit Program Kerja')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Program Kerja</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.proker.update', $proker->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Program <span class="text-danger">*</span></label>
                    <input type="text" name="nama_program" class="form-control" value="{{ old('nama_program', $proker->nama_program) }}" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="pendidikan" {{ $proker->kategori == 'pendidikan' ? 'selected' : '' }}>📚 Pendidikan</option>
                        <option value="kewirausahaan" {{ $proker->kategori == 'kewirausahaan' ? 'selected' : '' }}>💼 Kewirausahaan</option>
                        <option value="olahraga" {{ $proker->kategori == 'olahraga' ? 'selected' : '' }}>⚽ Olahraga</option>
                        <option value="seni_budaya" {{ $proker->kategori == 'seni_budaya' ? 'selected' : '' }}>🎨 Seni & Budaya</option>
                        <option value="lingkungan" {{ $proker->kategori == 'lingkungan' ? 'selected' : '' }}>🌿 Lingkungan</option>
                        <option value="sosial" {{ $proker->kategori == 'sosial' ? 'selected' : '' }}>🤝 Sosial</option>
                        <option value="keagamaan" {{ $proker->kategori == 'keagamaan' ? 'selected' : '' }}>🕌 Keagamaan</option>
                        <option value="lainnya" {{ $proker->kategori == 'lainnya' ? 'selected' : '' }}>📋 Lainnya</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $proker->tanggal_mulai->format('Y-m-d')) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $proker->tanggal_selesai ? $proker->tanggal_selesai->format('Y-m-d') : '') }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat</label>
                    <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $proker->tempat) }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Penanggung Jawab <span class="text-danger">*</span></label>
                    <input type="text" name="penanggung_jawab" class="form-control" value="{{ old('penanggung_jawab', $proker->penanggung_jawab) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Anggaran</label>
                    <input type="text" name="anggaran" class="form-control" value="{{ old('anggaran', $proker->anggaran) }}" placeholder="Contoh: Rp 5.000.000">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Progress (%)</label>
                    <input type="range" name="progress" class="form-range" min="0" max="100" value="{{ old('progress', $proker->progress) }}" onchange="updateProgress(this.value)">
                    <span id="progressValue" class="badge bg-primary mt-1">{{ $proker->progress }}%</span>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="rencana" {{ $proker->status == 'rencana' ? 'selected' : '' }}>📅 Rencana</option>
                        <option value="berjalan" {{ $proker->status == 'berjalan' ? 'selected' : '' }}>▶️ Berjalan</option>
                        <option value="selesai" {{ $proker->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="tertunda" {{ $proker->status == 'tertunda' ? 'selected' : '' }}>⏸️ Tertunda</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    @if($proker->foto)
                        <div class="mb-2">
                            <img src="{{ asset($proker->foto) }}" class="img-fluid rounded" style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Program <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $proker->deskripsi) }}</textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tujuan</label>
                    <textarea name="tujuan" class="form-control" rows="3">{{ old('tujuan', $proker->tujuan) }}</textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Sasaran</label>
                    <textarea name="sasaran" class="form-control" rows="3">{{ old('sasaran', $proker->sasaran) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1" {{ $proker->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label">Jadikan sebagai program unggulan</label>
                    </div>
                    <div class="form-check mt-2">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" {{ $proker->is_published ? 'checked' : '' }}>
                        <label class="form-check-label">Publikasikan di website</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.proker') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateProgress(value) {
        document.getElementById('progressValue').innerHTML = value + '%';
    }
</script>
@endsection