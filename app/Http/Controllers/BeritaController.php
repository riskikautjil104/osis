<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->get();
        return view('dashboard.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('dashboard.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:berita',
            'konten' => 'required|string',
            'kategori' => 'required|in:Prestasi,Kegiatan,Lingkungan,Budaya',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/berita/' . $filename);
            Image::make($image)->fit(800, 500)->save($path);
            $data['gambar'] = 'storage/berita/' . $filename;
        }

        Berita::create($data);
        return redirect()->route('dashboard.berita')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('dashboard.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255|unique:berita,judul,' . $id,
            'konten' => 'required|string',
            'kategori' => 'required|in:Prestasi,Kegiatan,Lingkungan,Budaya',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && file_exists(public_path($berita->gambar))) {
                unlink(public_path($berita->gambar));
            }
            $image = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/berita/' . $filename);
            Image::make($image)->fit(800, 500)->save($path);
            $data['gambar'] = 'storage/berita/' . $filename;
        }

        $berita->update($data);
        return redirect()->route('dashboard.berita')->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && file_exists(public_path($berita->gambar))) {
            unlink(public_path($berita->gambar));
        }
        $berita->delete();
        return redirect()->route('dashboard.berita')->with('success', 'Berita berhasil dihapus');
    }
}