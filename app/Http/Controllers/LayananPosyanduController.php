<?php

namespace App\Http\Controllers;

use App\Models\LayananPosyandu;
use Illuminate\Http\Request;

class LayananPosyanduController extends Controller
{
    public function index()
    {
        $layanans = LayananPosyandu::latest()->get();

        $total = $layanans->count();
        $rataBerat = $layanans->avg('berat') ?? 0;
        $rataTinggi = $layanans->avg('tinggi') ?? 0;
        $totalVitamin = $layanans->where('vitamin', '!=', 'Tidak Diberikan')->count();

        return view('pages.posyandu.index', compact(
            'layanans',
            'total',
            'rataBerat',
            'rataTinggi',
            'totalVitamin'
        ));
    }

    public function create()
    {
        return view('pages.posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|numeric',
            'warga_id' => 'required|numeric',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'vitamin' => 'required|string|max:100',
            'konseling' => 'required|string|max:255',
        ]);

        LayananPosyandu::create([
            'jadwal_id' => $request->jadwal_id,
            'warga_id' => $request->warga_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'vitamin' => $request->vitamin,
            'konseling' => $request->konseling,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Data layanan posyandu berhasil ditambahkan!');
    }

    public function edit($layanan_id)
    {
        $layanan = LayananPosyandu::findOrFail($layanan_id);

        return view('pages.posyandu.edit', compact('layanan'));
    }

    public function update(Request $request, $layanan_id)
    {
        $layanan = LayananPosyandu::findOrFail($layanan_id);

        $request->validate([
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'vitamin' => 'required|string|max:100',
            'konseling' => 'required|string|max:255',
        ]);

        $layanan->update([
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'vitamin' => $request->vitamin,
            'konseling' => $request->konseling,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Data layanan posyandu berhasil diperbarui!');
    }

    public function destroy($layanan_id)
    {
        $layanan = LayananPosyandu::findOrFail($layanan_id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Data layanan posyandu berhasil dihapus!');
    }
}
