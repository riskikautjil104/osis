@extends('layouts.dashboard')

@section('title', 'Upload Dokumen Baru')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-upload me-2 text-primary"></i>Upload Dokumen Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.dokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Judul Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        <option value="profil">📋 Profil Sekolah</option>
                        <option value="program_kerja">📊 Program Kerja</option>
                        <option value="laporan">📄 Laporan Kegiatan</option>
                        <option value="surat">✉️ Surat Keputusan</option>
                        <option value="peraturan">⚖️ Peraturan</option>
                        <option value="lainnya">📁 Lainnya</option>
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Upload File <span class="text-danger">*</span></label>
                    <input type="file" name="file" id="fileInput" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.jpg,.png,.zip" required onchange="previewFile(this)">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, CSV, JPG, PNG, ZIP. Max 10MB
                    </small>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3" id="fileInfo" style="display: none;">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="fileName"></span> - <span id="fileSize"></span>
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Dokumen</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" placeholder="Jelaskan isi dokumen ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" checked>
                        <label class="form-check-label fw-semibold">Publikasikan (ditampilkan di halaman One Data)</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.dokumen') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i>Upload Dokumen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewFile(input) {
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            
            fileName.innerHTML = '<strong>' + file.name + '</strong>';
            fileSize.innerHTML = sizeInMB + ' MB';
            fileInfo.style.display = 'block';
        } else {
            fileInfo.style.display = 'none';
        }
    }
</script>
@endsection