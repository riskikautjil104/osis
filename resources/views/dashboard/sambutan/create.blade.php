@extends('layouts.dashboard')

@section('title', 'Tambah Sambutan Ketua OSIS')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-plus me-2 text-primary"></i>Tambah Sambutan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.sambutan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Judul Sambutan <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', 'Sambutan Ketua OSIS') }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Ketua OSIS <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ketua" class="form-control @error('nama_ketua') is-invalid @enderror" value="{{ old('nama_ketua') }}" required>
                    @error('nama_ketua')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', 'Ketua OSIS') }}" required>
                    @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto Ketua</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                    <small class="text-muted">Format: JPG, PNG. Max 2MB. Ukuran推荐 300x300px</small>
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <div id="previewContainer" style="display: none;">
                        <label class="form-label fw-semibold">Preview Foto</label>
                        <div>
                            <img id="imagePreview" src="#" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 50%; border: 2px solid #0F6E56; padding: 3px;">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Konten Sambutan <span class="text-danger">*</span></label>
                    <textarea name="konten" id="editor" class="form-control @error('konten') is-invalid @enderror" rows="10">{{ old('konten') }}</textarea>
                    @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Tulis sambutan ketua OSIS di sini. Bisa berisi visi misi, harapan, ajakan, dll.</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                        <label class="form-check-label fw-semibold">Aktifkan (ditampilkan di halaman depan)</label>
                        <small class="text-muted d-block">Hanya 1 sambutan yang bisa aktif. Jika diaktifkan, sambutan lain akan otomatis nonaktif.</small>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.sambutan') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'alignment', '|',
                    'link', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            },
            placeholder: 'Tulis sambutan ketua OSIS di sini...'
        })
        .catch(error => {
            console.error(error);
        });
    
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