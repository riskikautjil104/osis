@extends('layouts.dashboard')

@section('title', 'Tambah Agenda')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-plus me-2 text-primary"></i>Tambah Agenda Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.agenda.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Judul Agenda <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Waktu</label>
                    <input type="text" name="waktu" class="form-control" placeholder="Contoh: 08:00 - 12:00" value="{{ old('waktu') }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                    <input type="text" name="tempat" class="form-control @error('tempat') is-invalid @enderror" value="{{ old('tempat') }}" required>
                    @error('tempat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                        <option value="Akademik">Akademik</option>
                        <option value="Seni">Seni</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Lingkungan">Lingkungan</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="segera">Segera</option>
                        <option value="berlangsung">Berlangsung</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1">
                        <label class="form-check-label">Jadikan sebagai agenda unggulan</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.agenda') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection