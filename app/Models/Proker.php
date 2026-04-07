<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Proker extends Model
{
    protected $table = 'proker';
    protected $fillable = [
        'nama_program', 'slug', 'kategori', 'deskripsi', 'tujuan', 'sasaran',
        'tanggal_mulai', 'tanggal_selesai', 'tempat', 'penanggung_jawab',
        'foto', 'progress', 'status', 'anggaran', 'dokumentasi', 
        'is_featured', 'is_published'
    ];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'progress' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'dokumentasi' => 'array'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($proker) {
            $proker->slug = Str::slug($proker->nama_program) . '-' . time();
        });
    }
    
    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'rencana' => '<span class="badge bg-secondary"><i class="fas fa-calendar-alt me-1"></i> Rencana</span>',
            'berjalan' => '<span class="badge bg-primary"><i class="fas fa-play me-1"></i> Berjalan</span>',
            'selesai' => '<span class="badge bg-success"><i class="fas fa-check me-1"></i> Selesai</span>',
            'tertunda' => '<span class="badge bg-warning"><i class="fas fa-pause me-1"></i> Tertunda</span>',
        ];
        return $badges[$this->status] ?? '<span class="badge bg-secondary">' . $this->status . '</span>';
    }
    
    // Accessor untuk progress bar
    public function getProgressBarAttribute()
    {
        $color = 'bg-success';
        if ($this->progress < 30) $color = 'bg-danger';
        elseif ($this->progress < 70) $color = 'bg-warning';
        
        return '<div class="progress" style="height: 8px;">
                    <div class="progress-bar ' . $color . '" role="progressbar" 
                         style="width: ' . $this->progress . '%" 
                         aria-valuenow="' . $this->progress . '" 
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>';
    }
    
    // Accessor untuk kategori icon
    public function getCategoryIconAttribute()
    {
        $icons = [
            'pendidikan' => '📚',
            'kewirausahaan' => '💼',
            'olahraga' => '⚽',
            'seni_budaya' => '🎨',
            'lingkungan' => '🌿',
            'sosial' => '🤝',
            'keagamaan' => '🕌',
            'lainnya' => '📋',
        ];
        return $icons[$this->kategori] ?? '📋';
    }
    
    // Accessor untuk durasi
    public function getDurasiAttribute()
    {
        if (!$this->tanggal_selesai) return 'Berlangsung';
        
        $mulai = $this->tanggal_mulai;
        $selesai = $this->tanggal_selesai;
        $diff = $mulai->diffInDays($selesai);
        
        if ($diff < 30) return $diff . ' hari';
        if ($diff < 365) return round($diff / 30) . ' bulan';
        return round($diff / 365) . ' tahun';
    }
}