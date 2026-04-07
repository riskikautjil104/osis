<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $fillable = [
        'nama', 'email', 'no_hp', 'subjek', 'pesan', 
        'status', 'balasan', 'dibaca_pada'
    ];
    
    protected $casts = [
        'dibaca_pada' => 'datetime',
    ];
    
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'belum_dibaca' => '<span class="badge bg-danger"><i class="fas fa-envelope me-1"></i> Belum Dibaca</span>',
            'sudah_dibaca' => '<span class="badge bg-warning"><i class="fas fa-eye me-1"></i> Sudah Dibaca</span>',
            'dibalas' => '<span class="badge bg-success"><i class="fas fa-reply-all me-1"></i> Sudah Dibalas</span>',
        ];
        return $badges[$this->status] ?? $badges['belum_dibaca'];
    }
}