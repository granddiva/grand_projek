<?php
namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Media;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu!');
        }
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

        $posyandu = $query->orderBy('posyandu_id', 'desc')
            ->paginate($perPage)
            ->withQueryString()
            ->onEachSide(1);

        $allRts = Posyandu::select('rt')->distinct()->pluck('rt')->filter()->values();
        $allRws = Posyandu::select('rw')->distinct()->pluck('rw')->filter()->values();

        return view('pages.posyandu.index', [
            'posyandus' => $posyandu,
            'allRts'    => $allRts,
            'allRws'    => $allRws,
            'q'         => $request->input('q'),
            'filterRt'  => $request->input('rt'),
            'filterRw'  => $request->input('rw'),
        ]);
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
            'nama'    => 'required|string|max:255',
            'alamat'  => 'required|string',
            'rt'      => 'nullable|string|max:10',
            'rw'      => 'nullable|string|max:10',
            'kontak'  => 'nullable|string|max:50',

            // multiple files
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf|max:5000',
        ]);

        // 1. Simpan posyandu dulu
        $posyandu = Posyandu::create($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']));

        // 2. Handle multiple file upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $i => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/media', $filename);

                Media::create([
                    'ref_table'  => 'posyandu',
                    'ref_id'     => $posyandu->posyandu_id,
                    'file_name'  => $filename,
                    'caption'    => null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i + 1,

                ]);
            }
        }

        return redirect()->route('posyandu.index')
            ->with('success', 'Posyandu berhasil ditambahkan.');
    }

    public function show(Posyandu $posyandu)
    {
        $media = Media::where('ref_table', 'posyandu')
            ->where('ref_id', $posyandu->posyandu_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.posyandu.show', compact('posyandu', 'media'));
    }

    public function edit(Posyandu $posyandu)
    {
        $existingMedia = Media::where('ref_table', 'posyandu')
            ->where('ref_id', $posyandu->posyandu_id)
            ->get();

        return view('pages.posyandu.edit', compact('posyandu', 'existingMedia'));
    }

    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'alamat'  => 'required|string',
            'rt'      => 'nullable|string|max:10',
            'rw'      => 'nullable|string|max:10',
            'kontak'  => 'nullable|string|max:50',

            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf|max:5000',
        ]);

        $posyandu->update($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']));

        // Tambah file baru jika diupload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $i => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/media', $filename);

                Media::create([
                    'ref_table'  => 'posyandu',
                    'ref_id'     => $posyandu->posyandu_id,
                    'file_name'  => $filename,
                    'caption'    => null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $i + 1,

                ]);
            }
        }

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
