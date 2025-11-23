<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        // ambil input search & filter
        $search = $request->input('search');
        $filter_gender = $request->input('gender');

        $wargas = Warga::query()

            // pencarian
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%");
            })

            // filter jenis kelamin
            ->when($filter_gender, function ($q) use ($filter_gender) {
                $q->where('jenis_kelamin', $filter_gender);
            })

            ->orderBy('warga_id', 'desc')
            ->paginate(12)  // pagination
            ->withQueryString();

        return view('guest/warga.index', compact('wargas', 'search', 'filter_gender'));
    }

    public function create()
    {
        return view('guest/warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|unique:wargas,nik|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('guest/warga.edit', compact('warga'));
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
