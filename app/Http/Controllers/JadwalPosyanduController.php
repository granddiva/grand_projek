<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPosyandu::with('posyandu')->latest()->get();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $posyandu = Posyandu::all();
        return view('jadwal.create', compact('posyandu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        JadwalPosyandu::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jadwal = JadwalPosyandu::with('posyandu')->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandu = Posyandu::all();

        return view('jadwal.edit', compact('jadwal', 'posyandu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JadwalPosyandu::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
