<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Jabatan <span class="text-danger">*</span></label>
        <input type="text" name="jabatan" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Periode <span class="text-danger">*</span></label>
        <input type="text" name="periode" class="form-control" placeholder="Contoh: 2022/2023" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="0">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <small class="text-muted">Max 2MB, format JPG/PNG</small>
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Prestasi / Catatan Khusus</label>
        <textarea name="prestasi" class="form-control" rows="3" placeholder="Contoh: Berhasil mengadakan 10 program kerja, Juara OSN tingkat kabupaten, dll"></textarea>
    </div>
</div>