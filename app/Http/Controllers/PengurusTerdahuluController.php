<?php

namespace App\Http\Controllers;

use App\Models\PengurusTerdahulu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengurusTerdahuluController extends Controller
{
    public function index()
    {
        $pengurus = PengurusTerdahulu::orderBy('periode', 'desc')->orderBy('urutan')->get();
        return view('dashboard.pengurus_terdahulu.index', compact('pengurus'));
    }

    public function create()
    {
        return view('dashboard.pengurus_terdahulu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'prestasi' => 'nullable|string',
            'urutan' => 'nullable|integer'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pengurus_terdahulu'), $filename);
            $data['foto'] = 'storage/pengurus_terdahulu/' . $filename;
        }

        PengurusTerdahulu::create($data);
        return redirect()->route('dashboard.pengurus_terdahulu')->with('success', 'Pengurus terdahulu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengurus = PengurusTerdahulu::findOrFail($id);
        return view('dashboard.pengurus_terdahulu.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = PengurusTerdahulu::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'prestasi' => 'nullable|string',
            'urutan' => 'nullable|integer'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pengurus->foto && file_exists(public_path($pengurus->foto))) {
                unlink(public_path($pengurus->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pengurus_terdahulu'), $filename);
            $data['foto'] = 'storage/pengurus_terdahulu/' . $filename;
        }

        $pengurus->update($data);
        return redirect()->route('dashboard.pengurus_terdahulu')->with('success', 'Pengurus terdahulu berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengurus = PengurusTerdahulu::findOrFail($id);
        if ($pengurus->foto && file_exists(public_path($pengurus->foto))) {
            unlink(public_path($pengurus->foto));
        }
        $pengurus->delete();
        return redirect()->route('dashboard.pengurus_terdahulu')->with('success', 'Pengurus terdahulu berhasil dihapus');
    }
}