@extends('layouts.dashboard')

@section('title', 'Edit Galeri')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Foto Galeri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $galeri->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="kegiatan" {{ $galeri->kategori == 'kegiatan' ? 'selected' : '' }}>🎪 Kegiatan</option>
                        <option value="prestasi" {{ $galeri->kategori == 'prestasi' ? 'selected' : '' }}>🏆 Prestasi</option>
                        <option value="seni" {{ $galeri->kategori == 'seni' ? 'selected' : '' }}>🎨 Seni & Budaya</option>
                        <option value="olahraga" {{ $galeri->kategori == 'olahraga' ? 'selected' : '' }}>⚽ Olahraga</option>
                        <option value="upacara" {{ $galeri->kategori == 'upacara' ? 'selected' : '' }}>🏫 Upacara</option>
                        <option value="umum" {{ $galeri->kategori == 'umum' ? 'selected' : '' }}>📸 Umum</option>
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $galeri->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $galeri->urutan) }}">
                    <small class="text-muted">Semakin kecil angka, semakin awal tampil</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    <div class="mb-3">
                        <img src="{{ asset($galeri->gambar) }}" class="img-fluid rounded" style="max-height: 200px; border: 1px solid #ddd;">
                    </div>
                    <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG, WEBP. Max 5MB</small>
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $galeri->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Aktifkan (ditampilkan di website)</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.galeri') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview for edit page
    document.querySelector('input[name="gambar"]').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (!file.type.match('image.*')) {
                Swal.fire('Error!', 'File harus berupa gambar!', 'error');
                this.value = '';
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire('Error!', 'Ukuran file maksimal 5MB!', 'error');
                this.value = '';
                return;
            }
        }
    });
</script>
@endpush
@endsection