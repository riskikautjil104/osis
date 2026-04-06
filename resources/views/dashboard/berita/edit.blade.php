@extends('layouts.dashboard')

@section('title', 'Edit Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="Prestasi" {{ $berita->kategori == 'Prestasi' ? 'selected' : '' }}>🏆 Prestasi</option>
                        <option value="Kegiatan" {{ $berita->kategori == 'Kegiatan' ? 'selected' : '' }}>🎓 Kegiatan</option>
                        <option value="Lingkungan" {{ $berita->kategori == 'Lingkungan' ? 'selected' : '' }}>🌊 Lingkungan</option>
                        <option value="Budaya" {{ $berita->kategori == 'Budaya' ? 'selected' : '' }}>🎭 Budaya</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $berita->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Gambar Cover Saat Ini</label>
                    @if($berita->gambar)
                        <div class="mb-2">
                            <img src="{{ asset($berita->gambar) }}" width="150" class="rounded border">
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Konten Berita <span class="text-danger">*</span></label>
                    <textarea name="konten" id="editor" class="form-control" rows="15">{{ old('konten', $berita->konten) }}</textarea>
                    @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" {{ $berita->is_published ? 'checked' : '' }}>
                        <label class="form-check-label">Publikasikan</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.berita') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Berita
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
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
            placeholder: 'Edit konten berita di sini...'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection