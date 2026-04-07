<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\VisiMisi;
use App\Models\PengurusTerdahulu;
use Illuminate\Http\Request;
use App\Models\Sambutan;
use App\Models\Dokumen;
use App\Models\Proker;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil 3 data terbaru untuk masing-masing section
        $pengurus = Pengurus::where('is_active', true)->orderBy('urutan')->limit(3)->get();
        $agenda = Agenda::where('tanggal', '>=', now()->subDays(7))->orderBy('tanggal')->limit(3)->get();
        $berita = Berita::where('is_published', true)->orderBy('tanggal', 'desc')->limit(3)->get();
        $galeri = Galeri::where('is_active', true)->orderBy('urutan')->orderBy('tanggal', 'desc')->limit(6)->get();
        $visiMisi = VisiMisi::first();
        $pengurusTerdahulu = PengurusTerdahulu::orderBy('periode', 'desc')->limit(4)->get();
        $sambutan = Sambutan::where('is_active', true)->first();
        
        $stats = [
            'pengurus' => Pengurus::where('is_active', true)->count(),
            'program' => Agenda::where('status', 'segera')->count(),
            'prestasi' => Berita::where('kategori', 'Prestasi')->count(),
        ];
        
        return view('public.home', compact('pengurus', 'agenda', 'berita', 'galeri', 'visiMisi', 'pengurusTerdahulu', 'stats', 'sambutan'));
    }
    
    public function pengurus()
    {
        $pengurus = Pengurus::where('is_active', true)->orderBy('urutan')->get();
        return view('public.pengurus', compact('pengurus'));
    }
    
    public function agenda()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);
        return view('public.agenda', compact('agenda'));
    }
    
    public function berita()
    {
        $berita = Berita::where('is_published', true)->orderBy('tanggal', 'desc')->paginate(9);
        return view('public.berita', compact('berita'));
    }
    
    public function beritaDetail($id, $slug)
    {
        $berita = Berita::where('id', $id)->where('slug', $slug)->firstOrFail();
        $berita->incrementViews();
        
        // Ambil berita terkait (3 berita terbaru lainnya)
        $beritaTerkait = Berita::where('is_published', true)
            ->where('id', '!=', $id)
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();
        
        return view('public.berita-detail', compact('berita', 'beritaTerkait'));
    }
    
    public function galeri()
    {
        $galeri = Galeri::where('is_active', true)->orderBy('urutan')->orderBy('tanggal', 'desc')->paginate(12);
        
        // Group by kategori untuk filter
        $kategoris = Galeri::where('is_active', true)
            ->select('kategori')
            ->distinct()
            ->get();
        
        return view('public.galeri', compact('galeri', 'kategoris'));
    }
    
    public function pengurusTerdahulu()
    {
        $pengurus = PengurusTerdahulu::orderBy('periode', 'desc')->orderBy('urutan')->paginate(12);
        
        // Ambil list periode untuk filter
        $periodes = PengurusTerdahulu::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->get();
        
        return view('public.pengurus-terdahulu', compact('pengurus', 'periodes'));
    }
    // Tambahkan method ini di PublicController

public function dokumen()
{
    $kategori = request('kategori', 'all');
    $search = request('search');
    
    $query = Dokumen::where('is_published', true);
    
    if ($kategori != 'all') {
        $query->where('kategori', $kategori);
    }
    
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }
    
    $dokumen = $query->orderBy('tanggal', 'desc')->paginate(12);
    $kategoris = Dokumen::select('kategori')->distinct()->get();
    $totalDokumen = Dokumen::where('is_published', true)->count();
    $totalDownloads = Dokumen::where('is_published', true)->sum('download_count');
    
    return view('public.dokumen', compact('dokumen', 'kategoris', 'totalDokumen', 'totalDownloads'));
}

public function dokumenDetail($id, $slug)
{
    $dokumen = Dokumen::where('id', $id)->where('slug', $slug)->firstOrFail();
    $dokumen->incrementView();
    
    $dokumenTerkait = Dokumen::where('is_published', true)
        ->where('id', '!=', $id)
        ->where('kategori', $dokumen->kategori)
        ->limit(4)
        ->get();
    
    return view('public.dokumen-detail', compact('dokumen', 'dokumenTerkait'));
}

public function dokumenDownload($id)
{
    $dokumen = Dokumen::findOrFail($id);
    $dokumen->incrementDownload();
    
    $filePath = public_path($dokumen->file_path);
    
    if (file_exists($filePath)) {
        return response()->download($filePath, $dokumen->judul . '.' . $dokumen->file_type);
    }
    
    return redirect()->back()->with('error', 'File tidak ditemukan');
}

// Export data dokumen ke CSV/Excel
public function dokumenExport($format)
{
    $dokumen = Dokumen::where('is_published', true)->orderBy('tanggal', 'desc')->get();
    
    if ($format == 'csv') {
        $filename = 'data-dokumen-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($handle, ['No', 'Judul', 'Kategori', 'File Type', 'Download Count', 'View Count', 'Tanggal']);
        
        foreach ($dokumen as $index => $item) {
            fputcsv($handle, [
                $index + 1,
                $item->judul,
                $item->kategori,
                strtoupper($item->file_type),
                $item->download_count,
                $item->view_count,
                $item->tanggal->format('d/m/Y')
            ]);
        }
        
        fclose($handle);
        
        return response()->stream(function() use ($handle) {
            // Stream sudah di-handle
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    
    // Untuk Excel, kita gunakan output HTML yang bisa di-copy ke Excel
    if ($format == 'excel') {
        $html = '<table border="1">';
        $html .= '<tr><th>No</th><th>Judul</th><th>Kategori</th><th>File Type</th><th>Download Count</th><th>View Count</th><th>Tanggal</th></tr>';
        foreach ($dokumen as $index => $item) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . $item->judul . '</td>';
            $html .= '<td>' . $item->kategori . '</td>';
            $html .= '<td>' . strtoupper($item->file_type) . '</td>';
            $html .= '<td>' . $item->download_count . '</td>';
            $html .= '<td>' . $item->view_count . '</td>';
            $html .= '<td>' . $item->tanggal->format('d/m/Y') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        
        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="data-dokumen-' . date('Y-m-d') . '.xls"',
        ]);
    }
}
public function proker()
{
    $kategori = request('kategori', 'all');
    $status = request('status', 'all');
    
    $query = Proker::where('is_published', true);
    
    if ($kategori != 'all') {
        $query->where('kategori', $kategori);
    }
    
    if ($status != 'all') {
        $query->where('status', $status);
    }
    
    $proker = $query->orderByRaw("FIELD(status, 'berjalan', 'rencana', 'tertunda', 'selesai')")
                    ->orderBy('tanggal_mulai', 'asc')
                    ->paginate(9);
    
    $kategoris = Proker::select('kategori')->distinct()->get();
    $prokerUnggulan = Proker::where('is_published', true)
                            ->where('is_featured', true)
                            ->limit(3)
                            ->get();
    
    $stats = [
        'total' => Proker::where('is_published', true)->count(),
        'berjalan' => Proker::where('is_published', true)->where('status', 'berjalan')->count(),
        'selesai' => Proker::where('is_published', true)->where('status', 'selesai')->count(),
        'rencana' => Proker::where('is_published', true)->where('status', 'rencana')->count(),
    ];
    
    return view('public.proker', compact('proker', 'kategoris', 'prokerUnggulan', 'stats'));
}

public function prokerDetail($id, $slug)
{
    $proker = Proker::where('id', $id)->where('slug', $slug)->firstOrFail();
    
    $prokerTerkait = Proker::where('is_published', true)
        ->where('id', '!=', $id)
        ->where('kategori', $proker->kategori)
        ->limit(3)
        ->get();
    
    return view('public.proker-detail', compact('proker', 'prokerTerkait'));
}
public function filosofiLogo()
{
    return view('public.filosofi-logo');
}
}