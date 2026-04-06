@extends('layouts.dashboard')

@section('title', 'Edit Agenda')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-edit me-2 text-primary"></i>Edit Agenda</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Judul Agenda <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $agenda->judul) }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $agenda->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Waktu</label>
                    <input type="text" name="waktu" class="form-control" value="{{ old('waktu', $agenda->waktu) }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                    <input type="text" name="tempat" class="form-control @error('tempat') is-invalid @enderror" value="{{ old('tempat', $agenda->tempat) }}" required>
                    @error('tempat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="Akademik" {{ $agenda->kategori == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Seni" {{ $agenda->kategori == 'Seni' ? 'selected' : '' }}>Seni</option>
                        <option value="Olahraga" {{ $agenda->kategori == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="Lingkungan" {{ $agenda->kategori == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                        <option value="Sosial" {{ $agenda->kategori == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        <option value="Lainnya" {{ $agenda->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="segera" {{ $agenda->status == 'segera' ? 'selected' : '' }}>Segera</option>
                        <option value="berlangsung" {{ $agenda->status == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="selesai" {{ $agenda->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1" {{ $agenda->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label">Jadikan sebagai agenda unggulan</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.agenda') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection