@extends('layouts.dashboard')

@section('title', 'Tambah Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-plus me-2 text-primary"></i>Tambah Berita Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="Prestasi">🏆 Prestasi</option>
                        <option value="Kegiatan">🎓 Kegiatan</option>
                        <option value="Lingkungan">🌊 Lingkungan</option>
                        <option value="Budaya">🎭 Budaya</option>
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gambar Cover</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Konten Berita <span class="text-danger">*</span></label>
                    <textarea name="konten" id="editor" class="form-control @error('konten') is-invalid @enderror" rows="15">{{ old('konten') }}</textarea>
                    @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Publikasikan sekarang</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.berita') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan & Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<!-- CKEditor 5 CDN -->
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
                    'link', 'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            placeholder: 'Tulis konten berita di sini...'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection