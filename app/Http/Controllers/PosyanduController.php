<?php
namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        // kolom yang boleh dicari
        $searchable = ['nama', 'alamat', 'rt', 'rw', 'kontak', 'media'];

        // ambil per_page dari query string (fallback 10)
        $perPage = (int) $request->input('per_page', 10);
        if ($perPage <= 0) {
            $perPage = 10;
        }

        $query = Posyandu::query();

        // pencarian
        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q, $searchable) {
                foreach ($searchable as $col) {
                    $sub->orWhere($col, 'like', "%{$q}%");
                }
            });
        }

        // filter RT / RW (jika diisi)
        if ($rt = $request->input('rt')) {
            $query->where('rt', $rt);
        }
        if ($rw = $request->input('rw')) {
            $query->where('rw', $rw);
        }

        $posyandu = $query->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString()
            ->onEachSide(1);

        return view('pages.posyandu.index', compact('posyandu'));
    }

    public function create()
    {
        $posyandu = Posyandu::all();
        $warga    = Warga::all();
        $jadwal   = JadwalPosyandu::all();

        return view('pages.posyandu.create', compact('posyandu', 'warga', 'jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt'     => 'nullable|string|max:10',
            'rw'     => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:50',
            'media'  => 'nullable|string|max:255',
        ]);

        Posyandu::create($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak', 'media']));

        return redirect()->route('posyandu.index')
            ->with('success', 'Posyandu berhasil ditambahkan.');
    }

    public function show(Posyandu $posyandu)
    {
        return view('pages.posyandu.show', compact('posyandu'));
    }

    public function edit(Posyandu $posyandu)
    {
        return view('pages.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt'     => 'nullable|string|max:10',
            'rw'     => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:50',
            'media'  => 'nullable|string|max:255',
        ]);

        $posyandu->update($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak', 'media']));

        return redirect()->route('posyandu.index')
            ->with('success', 'Posyandu berhasil diperbarui.');
    }

    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()->route('posyandu.index')
            ->with('success', 'Posyandu berhasil dihapus.');
    }
}
