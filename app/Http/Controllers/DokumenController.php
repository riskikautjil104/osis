<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::orderBy('tanggal', 'desc')->get();
        return view('dashboard.dokumen.index', compact('dokumen'));
    }
    
    public function create()
    {
        return view('dashboard.dokumen.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'required|file|max:10240',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $extension;
            
            // Buat folder jika belum ada
            if (!file_exists(public_path('storage/dokumen'))) {
                mkdir(public_path('storage/dokumen'), 0777, true);
            }
            
            $file->move(public_path('storage/dokumen'), $filename);
            
            $data['file_path'] = 'storage/dokumen/' . $filename;
            $data['file_type'] = strtolower($extension);
            $data['file_size'] = $file->getSize();
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