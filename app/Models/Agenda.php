<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $fillable = ['judul', 'tanggal', 'waktu', 'tempat', 'deskripsi', 'status', 'kategori', 'is_featured'];

    protected $casts = [
        'tanggal' => 'date',
        'is_featured' => 'boolean',
    ];

    public function getFormattedDateAttribute()
    {
        return $this->tanggal->format('d');
    }

    public function getFormattedMonthAttribute()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        return $months[$this->tanggal->month - 1];
    }

    public function getStatusClassAttribute()
    {
        return [
            'segera' => 'urgent',
            'berlangsung' => 'upcoming',
            'selesai' => 'done',
        ][$this->status] ?? 'upcoming';
    }
    
    public function getStatusTextAttribute()
    {
        return [
            'segera' => 'Segera',
            'berlangsung' => 'Berlangsung',
            'selesai' => 'Selesai',
        ][$this->status] ?? 'Segera';
    }
    
    public function getStatusBadgeClassAttribute()
    {
        return [
            'segera' => 'bg-warning',
            'berlangsung' => 'bg-success',
            'selesai' => 'bg-secondary',
        ][$this->status] ?? 'bg-warning';
    }
}