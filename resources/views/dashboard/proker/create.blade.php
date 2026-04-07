@extends('layouts.dashboard')

@section('title', 'Tambah Program Kerja')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold"><i class="fas fa-plus me-2 text-primary"></i>Tambah Program Kerja Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.proker.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Program <span class="text-danger">*</span></label>
                    <input type="text" name="nama_program" class="form-control" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="pendidikan">📚 Pendidikan</option>
                        <option value="kewirausahaan">💼 Kewirausahaan</option>
                        <option value="olahraga">⚽ Olahraga</option>
                        <option value="seni_budaya">🎨 Seni & Budaya</option>
                        <option value="lingkungan">🌿 Lingkungan</option>
                        <option value="sosial">🤝 Sosial</option>
                        <option value="keagamaan">🕌 Keagamaan</option>
                        <option value="lainnya">📋 Lainnya</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tempat</label>
                    <input type="text" name="tempat" class="form-control">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Penanggung Jawab <span class="text-danger">*</span></label>
                    <input type="text" name="penanggung_jawab" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Anggaran</label>
                    <input type="text" name="anggaran" class="form-control" placeholder="Contoh: Rp 5.000.000">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Progress (%)</label>
                    <input type="range" name="progress" class="form-range" min="0" max="100" value="0" onchange="updateProgress(this.value)">
                    <span id="progressValue" class="badge bg-primary mt-1">0%</span>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="rencana">📅 Rencana</option>
                        <option value="berjalan">▶️ Berjalan</option>
                        <option value="selesai">✅ Selesai</option>
                        <option value="tertunda">⏸️ Tertunda</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto/Gambar</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Deskripsi Program <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tujuan</label>
                    <textarea name="tujuan" class="form-control" rows="3"></textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Sasaran</label>
                    <textarea name="sasaran" class="form-control" rows="3"></textarea>
                </div>
                
                <div class="col-md-12 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1">
                        <label class="form-check-label">Jadikan sebagai program unggulan</label>
                    </div>
                    <div class="form-check mt-2">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Publikasikan di website</label>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="text-end">
                <a href="{{ route('dashboard.proker') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateProgress(value) {
        document.getElementById('progressValue').innerHTML = value + '%';
    }
</script>
@endsection