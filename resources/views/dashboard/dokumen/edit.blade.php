@extends('layouts.dashboard')

@section('title', 'Edit Dokumen')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Dokumen</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Judul Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $dokumen->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="profil" {{ $dokumen->kategori == 'profil' ? 'selected' : '' }}>📋 Profil Sekolah</option>
                        <option value="program_kerja" {{ $dokumen->kategori == 'program_kerja' ? 'selected' : '' }}>📊 Program Kerja</option>
                        <option value="laporan" {{ $dokumen->kategori == 'laporan' ? 'selected' : '' }}>📄 Laporan Kegiatan</option>
                        <option value="surat" {{ $dokumen->kategori == 'surat' ? 'selected' : '' }}>✉️ Surat Keputusan</option>
                        <option value="peraturan" {{ $dokumen->kategori == 'peraturan' ? 'selected' : '' }}>⚖️ Peraturan</option>
                        <option value="lainnya" {{ $dokumen->kategori == 'lainnya' ? 'selected' : '' }}>📁 Lainnya</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $dokumen->tanggal->format('Y-m-d')) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">File Saat Ini</label>
                    <div class="alert alert-info">
                        {!! $dokumen->file_icon !!} 
                        <strong>{{ basename($dokumen->file_path) }}</strong>
                        <small class="text-muted">({{ $dokumen->formatted_file_size }})</small>
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Ganti File (Opsional)</label>
                    <input type="file" name="file" id="fileInput" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.jpg,.png,.zip">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file. Max 10MB</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Dokumen</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" {{ $dokumen->is_published ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Publikasikan</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.dokumen') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection