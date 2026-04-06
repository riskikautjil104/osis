<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $fillable = ['nama', 'jabatan', 'foto', 'kelas', 'motto', 'warna_avatar', 'is_ketua', 'urutan', 'is_active'];

    protected $casts = [
        'is_ketua' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getAvatarColorClassAttribute()
    {
        return [
            'g' => 'avatar-bg-g',
            'a' => 'avatar-bg-a',
            'b' => 'avatar-bg-b',
            'p' => 'avatar-bg-p',
            't' => 'avatar-bg-t',
        ][$this->warna_avatar] ?? 'avatar-bg-g';
    }

    public function getInitialAttribute()
    {
        $words = explode(' ', $this->nama);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->nama, 0, 2));
    }
}