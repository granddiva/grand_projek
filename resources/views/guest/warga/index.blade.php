@extends('layouts.guest.app')

@section('content')
<div class="w-full bg-gray-50 min-h-screen px-6 py-6 mx-auto pt-24">

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-white bg-pink-600 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col mb-6 bg-white shadow-xl rounded-2xl">

                {{-- HEADER --}}
                <header class="appvilla-hero rounded-2xl mb-8 p-8 md:p-10 bg-pink-600/90 shadow-xl">
                    <div class="text-center text-white">
                        <i class="fas fa-users-cog text-4xl mb-2"></i>
                        <h1 class="text-3xl md:text-4xl font-extrabold">
                            Manajemen Akun Warga
                        </h1>
                        <h2 class="text-md font-light">
                            Kelola semua data warga di sini.
                        </h2>
                    </div>
                </header>

                {{-- Filter & Search --}}
                <form method="GET" class="mb-6 px-6 flex flex-wrap gap-3">
                    <input type="text" name="search"
                        value="{{ request('search') }}"
                        class="px-4 py-2 border rounded-lg"
                        placeholder="Cari nama / NIK ...">

                    <select name="gender" class="px-4 py-2 border rounded-lg">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>

                    <button
                        class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">
                        Terapkan
                    </button>
                </form>

                {{-- Tombol Tambah --}}
                <a href="{{ route('warga.create') }}"
                    class="ml-6 px-4 py-2 text-sm font-bold text-white bg-pink-600 rounded-lg hover:bg-pink-700">
                    Tambah Warga
                </a>
            </div>

            {{-- GRID --}}
            <div class="p-6">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    @forelse ($wargas as $warga)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all border border-gray-100">
                        <div class="p-6">

                            {{-- Header --}}
                            <div class="flex items-center mb-4 space-x-4">
                                <div
                                    class="h-14 w-14 rounded-full bg-gradient-to-br from-pink-500 to-pink-700 flex items-center justify-center text-white text-lg font-bold shadow-md">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-slate-800">
                                        {{ $warga->nama }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        NIK: {{ $warga->nik }}
                                    </p>
                                </div>
                            </div>

                            {{-- Tags --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-0.5 text-xs rounded-full bg-pink-100 text-pink-800">
                                    {{ $warga->jenis_kelamin }}
                                </span>

                                @if ($warga->no_hp)
                                <span class="px-2 py-0.5 text-xs rounded-full bg-fuchsia-100 text-fuchsia-800">
                                    {{ $warga->no_hp }}
                                </span>
                                @endif

                                <span class="px-2 py-0.5 text-xs rounded-full bg-rose-100 text-rose-800">
                                    {{ Str::limit($warga->alamat, 25) }}
                                </span>
                            </div>

                            {{-- Aksi --}}
                            <div class="flex justify-between pt-3 border-t border-gray-100">
                                <a href="{{ route('warga.edit', $warga) }}"
                                    class="text-xs font-semibold text-pink-600 hover:text-pink-800">
                                    <i class="fa fa-edit mr-1"></i> Edit
                                </a>

                                <form action="{{ route('warga.destroy', $warga) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data {{ $warga->nama }}?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-xs font-semibold text-red-600 hover:text-red-800">
                                        <i class="fa fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        Tidak ada data ditemukan.
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $wargas->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
