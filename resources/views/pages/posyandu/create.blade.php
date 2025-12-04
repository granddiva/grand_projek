@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Tambah Posyandu</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posyandu.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nama Posyandu</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" required class="w-full border px-3 py-2 rounded" rows="3">{{ old('alamat') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">RT</label>
                <input type="text" name="rt" value="{{ old('rt') }}" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium">RW</label>
                <input type="text" name="rw" value="{{ old('rw') }}" class="w-full border px-3 py-2 rounded">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Kontak (opsional)</label>
            <input type="text" name="kontak" value="{{ old('kontak') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block text-sm font-medium">Media (URL atau nama file — opsional)</label>
            <input type="text" name="media" value="{{ old('media') }}" class="w-full border px-3 py-2 rounded" placeholder="https://... or filename.jpg">
        </div>

        <div>
            <button class="px-4 py-2 bg-pink-600 text-white rounded">Simpan</button>
            <a href="{{ route('posyandu.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection
