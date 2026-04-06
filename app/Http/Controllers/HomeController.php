<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\VisiMisi;
use App\Models\PengurusTerdahulu;

class HomeController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::where('is_active', true)->orderBy('urutan')->get();
        $agenda = Agenda::where('tanggal', '>=', now()->subDays(7))->orderBy('tanggal')->limit(6)->get();
        $berita = Berita::where('is_published', true)->orderBy('tanggal', 'desc')->limit(4)->get();
        $galeri = Galeri::where('is_active', true)->orderBy('urutan')->orderBy('tanggal', 'desc')->limit(9)->get();
        $visiMisi = VisiMisi::first();
        $pengurusTerdahulu = PengurusTerdahulu::orderBy('periode', 'desc')->limit(8)->get();
        
        $stats = [
            'pengurus' => Pengurus::where('is_active', true)->count(),
            'program' => Agenda::where('status', 'segera')->count(),
            'prestasi' => Berita::where('kategori', 'Prestasi')->count(),
        ];
        
        return view('home.index', compact('pengurus', 'agenda', 'berita', 'galeri', 'visiMisi', 'pengurusTerdahulu', 'stats'));
    }
}