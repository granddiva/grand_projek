<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Models\KaderPosyandu;

class KaderPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data dan menamainya $kader (bukan $data)
        $kader = KaderPosyandu::with(['posyandu', 'warga'])->get();

        // Mengirimkan variabel $kader ke view
        return view('guest/kader.index', compact('kader')); // <-- Perubahan di sini
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posyandu = Posyandu::all();
        $warga = Warga::all();
        return view('guest/kader.create', compact('posyandu', 'warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required',
            'warga_id' => 'required',
            'peran' => 'required'
        ]);

        KaderPosyandu::create($request->all());
        return redirect()->route('kader.index')->with('success', 'Kader berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kader = KaderPosyandu::findOrFail($id);
        $posyandu = Posyandu::all();
        $warga = Warga::all();
        return view('guest/kader.edit', compact('kader', 'posyandu', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kader = KaderPosyandu::findOrFail($id);
        $kader->update($request->all());
        return redirect()->route('kader.index')->with('success', 'Data kader diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KaderPosyandu::destroy($id);
        return redirect()->route('kader.index')->with('success', 'Data kader dihapus!');
    }
}
