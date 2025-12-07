@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-home text-pink-500 mr-2"></i> Data Posyandu
            </h2>
            <p class="text-sm text-gray-500">Kelola data posyandu — cari, filter RT/RW, dan navigasi halaman.</p>
        </div>

        <a href="{{ route('posyandu.create') }}" class="bg-pink-600 text-white px-4 py-2 rounded-full shadow hover:bg-pink-700">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Posyandu
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-white bg-green-600 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search + Filters --}}
    <form method="GET" class="mb-4 flex flex-wrap gap-3 items-center">
        <input type="text" name="q" value="{{ request('q') ?? $q ?? '' }}"
               placeholder="Cari nama, alamat, RT, RW..."
               class="px-4 py-2 border rounded w-80" />

        <select name="rt" class="px-3 py-2 border rounded">
            <option value="">Filter RT</option>
            @foreach($allRts as $rt)
                <option value="{{ $rt }}" {{ (string) ($filterRt ?? request('rt')) === (string)$rt ? 'selected' : '' }}>
                    {{ $rt }}
                </option>
            @endforeach
        </select>

        <select name="rw" class="px-3 py-2 border rounded">
            <option value="">Filter RW</option>
            @foreach($allRws as $rw)
                <option value="{{ $rw }}" {{ (string) ($filterRw ?? request('rw')) === (string)$rw ? 'selected' : '' }}>
                    {{ $rw }}
                </option>
            @endforeach
        </select>



        <select name="per_page" class="px-3 py-2 border rounded">
            <option value="6" {{ request('per_page')==6 ? 'selected' : '' }}>6</option>
            <option value="12" {{ request('per_page')==12 ? 'selected' : '' }}>12</option>
            <option value="24" {{ request('per_page')==24 ? 'selected' : '' }}>24</option>
        </select>

        <div class="flex gap-2">
            <button class="px-4 py-2 bg-pink-600 text-white rounded">Terapkan</button>
            <a href="{{ route('posyandu.index') }}" class="px-4 py-2 border rounded">Reset</a>
        </div>
    </form>

    {{-- Grid list --}}
    @if ($posyandus->isEmpty())
        <div class="text-center p-12 bg-pink-50 rounded">
            <i class="fas fa-box-open text-5xl mb-3 text-pink-400"></i>
            <p class="text-lg text-pink-600">Belum ada data posyandu.</p>
            <a href="{{ route('posyandu.create') }}" class="mt-4 inline-block px-4 py-2 bg-pink-600 text-white rounded">Tambah Posyandu</a>
        </div>
    @else
        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posyandus as $item)
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-pink-400">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold">{{ $item->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($item->alamat, 90) }}</p>
                        </div>
                        {{-- media (plain text) --}}
                        @if($item->media)
                            <div class="text-sm text-gray-400">{{ Str::limit($item->media, 20) }}</div>
                        @endif
                    </div>

                    <div class="mt-4 text-sm text-gray-700">
                        <div><strong>RT:</strong> {{ $item->rt ?? '-' }} | <strong>RW:</strong> {{ $item->rw ?? '-' }}</div>
                        <div class="mt-1"><strong>Kontak:</strong> {{ $item->kontak ?? '-' }}</div>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('posyandu.edit', $item) }}" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>

                        <form action="{{ route('posyandu.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- pagination --}}
        <div class="mt-6">
            {{ $posyandus->links() }}
        </div>
    @endif
</div>
@endsection
