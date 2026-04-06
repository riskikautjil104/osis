<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengurusTerdahulu extends Model
{
    protected $table = 'pengurus_terdahulu';
    protected $fillable = ['nama', 'jabatan', 'periode', 'foto', 'prestasi', 'urutan'];

    public function getInitialAttribute()
    {
        $words = explode(' ', $this->nama);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->nama, 0, 2));
    }
}