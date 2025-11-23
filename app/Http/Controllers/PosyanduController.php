<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource with search, filter and pagination.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');           // search query (nama / alamat)
        $filterRt = $request->input('rt');  // filter RT
        $filterRw = $request->input('rw');  // filter RW

        $perPage = (int) $request->input('per_page', 12);

        $query = Posyandu::query();

        // search nama / alamat / rt / rw
        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%")
                    ->orWhere('rt', 'like', "%{$q}%")
                    ->orWhere('rw', 'like', "%{$q}%");
            });
        }

        if ($filterRt) {
            $query->where('rt', $filterRt);
        }

        if ($filterRw) {
            $query->where('rw', $filterRw);
        }

        $posyandus = $query->orderBy('id', 'desc')
                           ->paginate($perPage)
                           ->withQueryString();

        // for filter dropdowns
        $allRts = Posyandu::select('rt')->whereNotNull('rt')->distinct()->pluck('rt');
        $allRws = Posyandu::select('rw')->whereNotNull('rw')->distinct()->pluck('rw');

        return view('guest.posyandu.index', compact('posyandus', 'q', 'filterRt', 'filterRw', 'allRts', 'allRws'));
    }

    public function create()
    {
        return view('guest.posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:50',
            'media' => 'nullable|string|max:255', // plain text/url
        ]);

        Posyandu::create($request->only(['nama','alamat','rt','rw','kontak','media']));

        return redirect()->route('posyandu.index')->with('success', 'Posyandu berhasil ditambahkan.');
    }

    public function show(Posyandu $posyandu)
    {
        return view('guest.posyandu.show', compact('posyandu'));
    }

    public function edit(Posyandu $posyandu)
    {
        return view('guest.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:50',
            'media' => 'nullable|string|max:255',
        ]);

        $posyandu->update($request->only(['nama','alamat','rt','rw','kontak','media']));

        return redirect()->route('posyandu.index')->with('success', 'Posyandu berhasil diperbarui.');
    }

    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();
        return redirect()->route('posyandu.index')->with('success', 'Posyandu berhasil dihapus.');
    }
}
