@extends('layouts.guest.app')

@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Edit Posyandu</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (isset($existingMedia) && count($existingMedia))
            <div class="mb-4">
                <label class="font-medium text-sm">Media Saat Ini:</label>
                <div class="grid grid-cols-3 gap-3 mt-2">
                    @foreach ($existingMedia as $m)
                        <div class="border rounded p-2">
                            @if (Str::contains($m->mime_type, 'image'))
                                <img src="{{ asset('storage/media/' . $m->file_name) }}"
                                    class="h-24 w-full object-cover rounded">
                            @else
                                <a href="{{ asset('storage/media/' . $m->file_name) }}" class="text-blue-600 underline"
                                    target="_blank">
                                    {{ $m->file_name }}
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <form action="{{ route('posyandu.update', $posyandu) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Nama Posyandu</label>
                <input type="text" name="nama" value="{{ old('nama', $posyandu->nama) }}" required
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Alamat</label>
                <textarea name="alamat" required class="w-full border px-3 py-2 rounded" rows="3">{{ old('alamat', $posyandu->alamat) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">RT</label>
                    <input type="text" name="rt" value="{{ old('rt', $posyandu->rt) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">RW</label>
                    <input type="text" name="rw" value="{{ old('rw', $posyandu->rw) }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">Kontak (opsional)</label>
                <input type="text" name="kontak" value="{{ old('kontak', $posyandu->kontak) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Media (URL atau nama file — opsional)</label>
                <input type="text" name="media" value="{{ old('media', $posyandu->media) }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Upload Media Baru (opsional, bisa multiple)</label>
                <input type="file" name="files[]" multiple class="w-full border px-3 py-2 rounded">
                <p class="text-xs text-gray-500 mt-1">File baru akan ditambahkan, file lama tidak terhapus otomatis.</p>
            </div>

            <div>
                <button class="px-4 py-2 bg-pink-600 text-white rounded">Update</button>
                <a href="{{ route('posyandu.index') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>
@endsection
