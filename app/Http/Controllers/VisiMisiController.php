<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('dashboard.visimisi.index', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string'
        ]);

        $visiMisi = VisiMisi::first();
        if (!$visiMisi) {
            $visiMisi = new VisiMisi();
        }
        
        $visiMisi->visi = $request->visi;
        $visiMisi->misi = $request->misi;
        $visiMisi->save();
        
        return redirect()->route('dashboard.visimisi')->with('success', 'Visi & Misi berhasil diupdate');
    }
}