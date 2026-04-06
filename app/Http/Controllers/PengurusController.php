<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::orderBy('urutan')->get();
        return view('dashboard.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('dashboard.pengurus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'motto' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'warna_avatar' => 'required|in:g,a,b,p,t',
            'is_ketua' => 'boolean',
            'urutan' => 'integer'
        ]);

        $data = $request->all();
        
        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!file_exists(public_path('storage/pengurus'))) {
                mkdir(public_path('storage/pengurus'), 0777, true);
            }
            
            // Simpan file
            $file->move(public_path('storage/pengurus'), $filename);
            $data['foto'] = 'storage/pengurus/' . $filename;
        }

        Pengurus::create($data);
        return redirect()->route('dashboard.pengurus')->with('success', 'Pengurus berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('dashboard.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'motto' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'warna_avatar' => 'required|in:g,a,b,p,t',
            'is_ketua' => 'boolean',
            'urutan' => 'integer'
        ]);

        $data = $request->all();
        
        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pengurus->foto && file_exists(public_path($pengurus->foto))) {
                unlink(public_path($pengurus->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!file_exists(public_path('storage/pengurus'))) {
                mkdir(public_path('storage/pengurus'), 0777, true);
            }
            
            // Simpan file
            $file->move(public_path('storage/pengurus'), $filename);
            $data['foto'] = 'storage/pengurus/' . $filename;
        }

        $pengurus->update($data);
        return redirect()->route('dashboard.pengurus')->with('success', 'Pengurus berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        
        // Hapus file foto
        if ($pengurus->foto && file_exists(public_path($pengurus->foto))) {
            unlink(public_path($pengurus->foto));
        }
        
        $pengurus->delete();
        return redirect()->route('dashboard.pengurus')->with('success', 'Pengurus berhasil dihapus');
    }
}