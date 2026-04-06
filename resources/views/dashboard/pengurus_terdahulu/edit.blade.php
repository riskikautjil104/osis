<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" value="{{ $pengurus->nama }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Jabatan <span class="text-danger">*</span></label>
        <input type="text" name="jabatan" class="form-control" value="{{ $pengurus->jabatan }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Periode <span class="text-danger">*</span></label>
        <input type="text" name="periode" class="form-control" value="{{ $pengurus->periode }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="{{ $pengurus->urutan }}">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Foto Saat Ini</label>
        @if($pengurus->foto)
            <div class="mb-2">
                <img src="{{ asset($pengurus->foto) }}" class="img-fluid rounded" style="max-height: 150px;">
            </div>
        @endif
        <label class="form-label mt-2">Ganti Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Prestasi / Catatan Khusus</label>
        <textarea name="prestasi" class="form-control" rows="3">{{ $pengurus->prestasi }}</textarea>
    </div>
</div>