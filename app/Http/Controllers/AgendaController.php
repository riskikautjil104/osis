<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->get();
        return view('dashboard.agenda.index', compact('agenda'));
    }

    public function create()
    {
        return view('dashboard.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:segera,berlangsung,selesai',
            'kategori' => 'required|in:Akademik,Seni,Olahraga,Lingkungan,Sosial,Lainnya',
            'is_featured' => 'boolean'
        ]);

        Agenda::create($request->all());
        return redirect()->route('dashboard.agenda')->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('dashboard.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:segera,berlangsung,selesai',
            'kategori' => 'required|in:Akademik,Seni,Olahraga,Lingkungan,Sosial,Lainnya',
            'is_featured' => 'boolean'
        ]);

        $agenda->update($request->all());
        return redirect()->route('dashboard.agenda')->with('success', 'Agenda berhasil diupdate');
    }

    public function destroy($id)
    {
        Agenda::findOrFail($id)->delete();
        return redirect()->route('dashboard.agenda')->with('success', 'Agenda berhasil dihapus');
    }
}