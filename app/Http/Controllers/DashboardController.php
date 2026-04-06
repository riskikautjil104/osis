<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalPengurus' => Pengurus::count(),
            'totalAgenda' => Agenda::count(),
            'totalBerita' => Berita::count(),
            'totalGaleri' => Galeri::count(),
            'recentAgenda' => Agenda::latest()->limit(5)->get(),
            'recentBerita' => Berita::latest()->limit(5)->get(),
        ]);
    }
}