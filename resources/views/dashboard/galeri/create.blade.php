@extends('layouts.dashboard')

@section('title', 'Tambah Galeri')

@section('content')
<style>
    .dropzone {
        border: 2px dashed #ddd;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8f9fa;
    }
    .dropzone:hover, .dropzone.dragover {
        border-color: #0F6E56;
        background: #f0fdf4;
    }
    .image-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    .preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    .preview-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    .remove-preview {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
        font-size: 12px;
    }
</style>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-plus me-2 text-primary"></i>Tambah Foto ke Galeri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.galeri.store') }}" method="POST" enctype="multipart/form-data" id="galeriForm">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        <option value="kegiatan">🎪 Kegiatan</option>
                        <option value="prestasi">🏆 Prestasi</option>
                        <option value="seni">🎨 Seni & Budaya</option>
                        <option value="olahraga">⚽ Olahraga</option>
                        <option value="upacara">🏫 Upacara</option>
                        <option value="umum">📸 Umum</option>
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="0">
                    <small class="text-muted">Semakin kecil angka, semakin awal tampil</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Upload Foto <span class="text-danger">*</span></label>
                    <div class="dropzone" id="dropzone">
                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                        <p class="mb-1">Klik atau drag & drop foto di sini</p>
                        <small class="text-muted">Format: JPG, PNG, WEBP. Max 5MB</small>
                        <input type="file" name="gambar" id="fileInput" class="d-none" accept="image/*">
                    </div>
                    <div id="previewContainer" class="image-preview"></div>
                    @error('gambar')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Ceritakan tentang foto ini...">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Aktifkan (ditampilkan di website)</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.galeri') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Drag & Drop functionality
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    let selectedFile = null;
    
    // Click on dropzone
    dropzone.addEventListener('click', () => {
        fileInput.click();
    });
    
    // Drag & Drop events
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });
    
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });
    
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFile(files[0]);
        }
    });
    
    // File input change
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });
    
    function handleFile(file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            Swal.fire('Error!', 'File harus berupa gambar!', 'error');
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            Swal.fire('Error!', 'Ukuran file maksimal 5MB!', 'error');
            return;
        }
        
        selectedFile = file;
        
        // Preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = `
                <div class="preview-item">
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-preview" onclick="removePreview()">×</button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
        
        // Update hidden input or create new one
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
    }
    
    window.removePreview = function() {
        previewContainer.innerHTML = '';
        selectedFile = null;
        fileInput.value = '';
    };
    
    // Form submit validation
    document.getElementById('galeriForm').addEventListener('submit', function(e) {
        if (!selectedFile && !fileInput.files.length) {
            e.preventDefault();
            Swal.fire('Error!', 'Pilih foto terlebih dahulu!', 'error');
        }
    });
</script>
@endpush
@endsection