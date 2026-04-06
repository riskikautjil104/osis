<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['judul', 'gambar', 'deskripsi', 'kategori', 'tanggal', 'urutan', 'is_active'];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
        'urutan' => 'integer'
    ];

    public function getFormattedDateAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    public function getCategoryIconAttribute()
    {
        $icons = [
            'kegiatan' => '🎪',
            'prestasi' => '🏆',
            'seni' => '🎨',
            'olahraga' => '⚽',
            'upacara' => '🏫',
            'umum' => '📸'
        ];
        return $icons[$this->kategori] ?? '📸';
    }

    public function getCategoryColorAttribute()
    {
        $colors = [
            'kegiatan' => 'g1b',
            'prestasi' => 'g2b',
            'seni' => 'g3b',
            'olahraga' => 'g4b',
            'upacara' => 'g5b',
            'umum' => 'g6b'
        ];
        return $colors[$this->kategori] ?? 'g1b';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }
    
}