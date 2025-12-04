<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $gender = $request->input('gender');

        $wargas = Warga::query()

            // Pencarian (nama / nik)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                });
            })

            // Filter jenis kelamin
            ->when($gender, function ($query) use ($gender) {
                $query->where('jenis_kelamin', $gender);
            })

            ->orderBy('warga_id', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('pages.warga.index', compact('wargas', 'search', 'gender'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'            => 'required|string|unique:wargas,nik|max:16',
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'alamat'         => 'required|string',
            'no_hp'          => 'nullable|string|max:15',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:wargas,nik,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil dihapus.');
    }
}
