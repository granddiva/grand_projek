<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Models\KaderPosyandu;

class KaderPosyanduController extends Controller
{
    public function index()
    {
        $kader = KaderPosyandu::with(['posyandu', 'warga'])->get();
        return view('pages.kader.index', compact('kader'));
    }

    public function create()
    {
        $posyandu = Posyandu::all();
        $warga = Warga::all();

        return view('pages.kader.create', compact('posyandu', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,id',
            'warga_id' => 'required|exists:warga,id',
            'peran' => 'required|string',
            'mulai_tugas' => 'nullable|date',
            'akhir_tugas' => 'nullable|date',
        ]);

        KaderPosyandu::create($request->all());

        return redirect()
            ->route('kaderposyandu.index')
            ->with('success', 'Kader berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kader = KaderPosyandu::findOrFail($id);
        $posyandu = Posyandu::all();
        $warga = Warga::all();

        return view('pages.kader.edit', compact('kader', 'posyandu', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $kader = KaderPosyandu::findOrFail($id);

        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,id',
            'warga_id' => 'required|exists:warga,id',
            'peran' => 'required|string',
            'mulai_tugas' => 'nullable|date',
            'akhir_tugas' => 'nullable|date',
        ]);

        $kader->update($request->all());

        return redirect()
            ->route('kaderposyandu.index')
            ->with('success', 'Kader berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KaderPosyandu::destroy($id);

        return redirect()
            ->route('kaderposyandu.index')
            ->with('success', 'Kader berhasil dihapus.');
    }
}
