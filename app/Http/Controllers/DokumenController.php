<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function index(Request $request)
{
    // Logika pencarian (jika diperlukan sesuai form di blade)
    $query = Dokumen::query();
    
    if ($request->has('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    $dokumen = $query->orderBy('tanggal', 'desc')->paginate(9);
    
    // Kirim variabel tambahan yang dibutuhkan Blade
    $totalDokumen = Dokumen::count();
    $totalDownloads = Dokumen::sum('download_count');
    $kategoris = Dokumen::select('kategori')->distinct()->get();

    return view('dashboard.dokumen.index', compact(
        'dokumen', 
        'totalDokumen', 
        'totalDownloads', 
        'kategoris'
    ));
}
    
    public function create()
    {
        return view('dashboard.dokumen.create');
    }
    
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string',
        'tanggal' => 'required|date',
        'file' => 'required|file|max:10240',
    ]);
    
    $data = $request->all();
    
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        
        // 1. Ambil info file TERLEBIH DAHULU
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize(); // Ambil size di sini
        $filename = time() . '_' . Str::slug($request->judul) . '.' . $extension;
        
        // 2. Baru pindahkan filenya
        if (!file_exists(public_path('storage/dokumen'))) {
            mkdir(public_path('storage/dokumen'), 0777, true);
        }
        $file->move(public_path('storage/dokumen'), $filename);
        
        // 3. Masukkan ke array data
        $data['file_path'] = 'storage/dokumen/' . $filename;
        $data['file_type'] = strtolower($extension);
        $data['file_size'] = $fileSize; // Gunakan variabel yang sudah disimpan
    }
    
    Dokumen::create($data);
    return redirect()->route('dashboard.dokumen')->with('success', 'Dokumen berhasil ditambahkan');
}
    
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('dashboard.dokumen.edit', compact('dokumen'));
    }
    
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|max:10240',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($dokumen->file_path && file_exists(public_path($dokumen->file_path))) {
                unlink(public_path($dokumen->file_path));
            }
            
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $extension;
            $file->move(public_path('storage/dokumen'), $filename);
            
            $data['file_path'] = 'storage/dokumen/' . $filename;
            $data['file_type'] = strtolower($extension);
            $data['file_size'] = $file->getSize();
        }
        
        $dokumen->update($data);
        return redirect()->route('dashboard.dokumen')->with('success', 'Dokumen berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if ($dokumen->file_path && file_exists(public_path($dokumen->file_path))) {
            unlink(public_path($dokumen->file_path));
        }
        $dokumen->delete();
        return redirect()->route('dashboard.dokumen')->with('success', 'Dokumen berhasil dihapus');
    }
}