<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProkerController extends Controller
{
    public function index()
    {
        $proker = Proker::orderBy('created_at', 'desc')->get();
        return view('dashboard.proker.index', compact('proker'));
    }
    
    public function create()
    {
        return view('dashboard.proker.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tempat' => 'nullable|string',
            'penanggung_jawab' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'progress' => 'integer|min:0|max:100',
            'status' => 'required|in:rencana,berjalan,selesai,tertunda',
            'anggaran' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama_program) . '.' . $file->getClientOriginalExtension();
            
            if (!file_exists(public_path('storage/proker'))) {
                mkdir(public_path('storage/proker'), 0777, true);
            }
            
            $file->move(public_path('storage/proker'), $filename);
            $data['foto'] = 'storage/proker/' . $filename;
        }
        
        Proker::create($data);
        return redirect()->route('dashboard.proker')->with('success', 'Program kerja berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $proker = Proker::findOrFail($id);
        return view('dashboard.proker.edit', compact('proker'));
    }
    
    public function update(Request $request, $id)
    {
        $proker = Proker::findOrFail($id);
        
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'tujuan' => 'nullable|string',
            'sasaran' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tempat' => 'nullable|string',
            'penanggung_jawab' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'progress' => 'integer|min:0|max:100',
            'status' => 'required|in:rencana,berjalan,selesai,tertunda',
            'anggaran' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            if ($proker->foto && file_exists(public_path($proker->foto))) {
                unlink(public_path($proker->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama_program) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/proker'), $filename);
            $data['foto'] = 'storage/proker/' . $filename;
        }
        
        $proker->update($data);
        return redirect()->route('dashboard.proker')->with('success', 'Program kerja berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $proker = Proker::findOrFail($id);
        if ($proker->foto && file_exists(public_path($proker->foto))) {
            unlink(public_path($proker->foto));
        }
        $proker->delete();
        return redirect()->route('dashboard.proker')->with('success', 'Program kerja berhasil dihapus');
    }
}