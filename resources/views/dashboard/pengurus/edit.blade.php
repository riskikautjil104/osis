@extends('layouts.dashboard')

@section('title', 'Edit Pengurus')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Pengurus</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pengurus->nama) }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                    @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $pengurus->kelas) }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Motto</label>
                    <input type="text" name="motto" class="form-control" value="{{ old('motto', $pengurus->motto) }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    @if($pengurus->foto)
                        <div class="mb-2">
                            <img src="{{ asset($pengurus->foto) }}" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                        </div>
                    @else
                        <div class="avatar {{ $pengurus->avatar_color_class }}" style="width: 100px; height: 100px; font-size: 2rem; display: flex; align-items: center; justify-content: center;">
                            {{ $pengurus->initial }}
                        </div>
                    @endif
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <div id="previewContainer" style="display: none;">
                        <label class="form-label fw-semibold">Preview Foto Baru</label>
                        <div>
                            <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 50%; border: 2px solid #0F6E56; padding: 3px;">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Warna Avatar (jika tidak ada foto)</label>
                    <select name="warna_avatar" class="form-control">
                        <option value="g" {{ $pengurus->warna_avatar == 'g' ? 'selected' : '' }}>Hijau</option>
                        <option value="a" {{ $pengurus->warna_avatar == 'a' ? 'selected' : '' }}>Orange</option>
                        <option value="b" {{ $pengurus->warna_avatar == 'b' ? 'selected' : '' }}>Biru</option>
                        <option value="p" {{ $pengurus->warna_avatar == 'p' ? 'selected' : '' }}>Pink</option>
                        <option value="t" {{ $pengurus->warna_avatar == 't' ? 'selected' : '' }}>Teal</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $pengurus->urutan) }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_ketua" class="form-check-input" value="1" {{ $pengurus->is_ketua ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Jadikan sebagai Ketua OSIS</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.pengurus') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        
        reader.onload = function() {
            if (reader.result) {
                imagePreview.src = reader.result;
                previewContainer.style.display = 'block';
            }
        };
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>
@endsection