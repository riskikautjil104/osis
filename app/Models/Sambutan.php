<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    protected $table = 'sambutan';
    protected $fillable = ['judul', 'konten', 'foto', 'nama_ketua', 'jabatan', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function getExcerptAttribute()
    {
        return strlen(strip_tags($this->konten)) > 150 
            ? substr(strip_tags($this->konten), 0, 150) . '...' 
            : strip_tags($this->konten);
    }
}