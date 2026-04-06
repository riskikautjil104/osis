<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutan = Sambutan::orderBy('created_at', 'desc')->get();
        return view('dashboard.sambutan.index', compact('sambutan'));
    }
    
    public function create()
    {
        return view('dashboard.sambutan.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'nama_ketua' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama_ketua) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/sambutan'), $filename);
            $data['foto'] = 'storage/sambutan/' . $filename;
        }
        
        // Set active lainnya menjadi false jika ini active
        if ($request->has('is_active') && $request->is_active) {
            Sambutan::where('is_active', true)->update(['is_active' => false]);
        }
        
        Sambutan::create($data);
        return redirect()->route('dashboard.sambutan')->with('success', 'Sambutan berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        return view('dashboard.sambutan.edit', compact('sambutan'));
    }
    
    public function update(Request $request, $id)
    {
        $sambutan = Sambutan::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'nama_ketua' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            if ($sambutan->foto && file_exists(public_path($sambutan->foto))) {
                unlink(public_path($sambutan->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama_ketua) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/sambutan'), $filename);
            $data['foto'] = 'storage/sambutan/' . $filename;
        }
        
        // Set active lainnya menjadi false jika ini active
        if ($request->has('is_active') && $request->is_active) {
            Sambutan::where('id', '!=', $id)->where('is_active', true)->update(['is_active' => false]);
        }
        
        $sambutan->update($data);
        return redirect()->route('dashboard.sambutan')->with('success', 'Sambutan berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        if ($sambutan->foto && file_exists(public_path($sambutan->foto))) {
            unlink(public_path($sambutan->foto));
        }
        $sambutan->delete();
        return redirect()->route('dashboard.sambutan')->with('success', 'Sambutan berhasil dihapus');
    }
}