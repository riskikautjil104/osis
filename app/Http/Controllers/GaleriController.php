<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('urutan')->orderBy('tanggal', 'desc')->get();
        return view('dashboard.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('dashboard.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:kegiatan,prestasi,seni,olahraga,upacara,umum',
            'tanggal' => 'required|date',
            'urutan' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/galeri/' . $filename);
            Image::make($image)->fit(600, 600)->save($path, 85);
            $data['gambar'] = 'storage/galeri/' . $filename;
        }
        
        $data['urutan'] = $request->urutan ?? 0;
        $data['is_active'] = $request->has('is_active');
        
        Galeri::create($data);
        
        return redirect()->route('dashboard.galeri')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('dashboard.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
{
    $galeri = Galeri::findOrFail($id);
    
    $request->validate([
        'judul' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'deskripsi' => 'nullable|string',
        'kategori' => 'required|in:kegiatan,prestasi,seni,olahraga,upacara,umum',
        'tanggal' => 'required|date',
        'urutan' => 'nullable|integer',
        'is_active' => 'boolean'
    ]);

    $data = $request->all();
    
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama
        if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
            unlink(public_path($galeri->gambar));
        }
        
        // Upload gambar baru
        $image = $request->file('gambar');
        $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
        $path = public_path('storage/galeri/' . $filename);
        
        // Gunakan copy langsung jika Image intervention error
        copy($image->getPathname(), $path);
        $data['gambar'] = 'storage/galeri/' . $filename;
    }
    
    $data['urutan'] = $request->urutan ?? 0;
    $data['is_active'] = $request->has('is_active');
    
    $galeri->update($data);
    
    return redirect()->route('dashboard.galeri')->with('success', 'Galeri berhasil diupdate');
}

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
            unlink(public_path($galeri->gambar));
        }
        $galeri->delete();
        
        return redirect()->route('dashboard.galeri')->with('success', 'Galeri berhasil dihapus');
    }
}