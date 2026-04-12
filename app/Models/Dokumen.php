<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = [
        'judul', 'slug', 'deskripsi', 'file_path', 'file_type', 
        'file_size', 'kategori', 'thumbnail', 'download_count', 
        'view_count', 'tanggal', 'is_published'
    ];
    
    protected $casts = [
       'tanggal' => 'datetime',
        'is_published' => 'boolean',
        'download_count' => 'integer',
        'view_count' => 'integer',
    ];
   
    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($dokumen) {
            $dokumen->slug = Str::slug($dokumen->judul) . '-' . time();
        });
    }
    
    // Format file size
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return '-';
        $bytes = (int)$this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
    
    // Get icon based on file type
    public function getFileIconAttribute()
    {
        $icons = [
            'pdf' => '<i class="fas fa-file-pdf text-danger"></i>',
            'doc' => '<i class="fas fa-file-word text-primary"></i>',
            'docx' => '<i class="fas fa-file-word text-primary"></i>',
            'xls' => '<i class="fas fa-file-excel text-success"></i>',
            'xlsx' => '<i class="fas fa-file-excel text-success"></i>',
            'ppt' => '<i class="fas fa-file-powerpoint text-warning"></i>',
            'pptx' => '<i class="fas fa-file-powerpoint text-warning"></i>',
            'csv' => '<i class="fas fa-file-csv text-info"></i>',
            'jpg' => '<i class="fas fa-file-image text-secondary"></i>',
            'png' => '<i class="fas fa-file-image text-secondary"></i>',
            'zip' => '<i class="fas fa-file-archive text-dark"></i>',
        ];
        
        return $icons[$this->file_type] ?? '<i class="fas fa-file-alt text-secondary"></i>';
    }
    
    // Get badge color
    public function getCategoryBadgeAttribute()
    {
        $colors = [
            'profil' => 'primary',
            'program_kerja' => 'success',
            'laporan' => 'info',
            'surat' => 'warning',
            'peraturan' => 'danger',
            'lainnya' => 'secondary',
        ];
        
        return $colors[$this->kategori] ?? 'secondary';
    }
    
    // Increment download count
    public function incrementDownload()
    {
        $this->increment('download_count');
    }
    
    // Increment view count
    public function incrementView()
    {
        $this->increment('view_count');
    }
}