<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = ['judul', 'slug', 'konten', 'gambar', 'kategori', 'tanggal', 'views', 'is_published'];

    protected $casts = [
        'tanggal' => 'date',
        'is_published' => 'boolean',
    ];

    public function getExcerptAttribute()
    {
        return strlen(strip_tags($this->konten)) > 100 
            ? substr(strip_tags($this->konten), 0, 100) . '...' 
            : strip_tags($this->konten);
    }

    public function getFormattedDateAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    public function getCategoryIconAttribute()
    {
        return [
            'Prestasi' => '🏆',
            'Kegiatan' => '🎓',
            'Lingkungan' => '🌊',
            'Budaya' => '🎭',
        ][$this->kategori] ?? '📰';
    }

    public function getCategoryColorAttribute()
    {
        return [
            'Prestasi' => 'bi1',
            'Kegiatan' => 'bi2',
            'Lingkungan' => 'bi3',
            'Budaya' => 'bi4',
        ][$this->kategori] ?? 'bi1';
    }
    
    public function incrementViews()
    {
        $this->increment('views');
    }
}