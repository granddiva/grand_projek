@extends('layouts.guest.app')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">

            <!-- Header -->
            <header class="rounded-2xl mb-8 p-8 bg-pink-600/90 shadow-xl text-white text-center">
                <i class="fas fa-users-cog text-4xl mb-2"></i>
                <h1 class="text-3xl font-extrabold">Manajemen Akun Pengguna</h1>
                <p class="text-sm opacity-90">Kelola semua akun pengguna sistem Posyandu di sini.</p>
            </header>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="px-4 py-3 mb-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg shadow-md">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Bar Kontrol -->
            <div class="flex justify-between mb-6">

                <!-- Form Search + Filter -->
                <form method="GET" class="flex gap-2">

                    <!-- Search -->
                    <input type="text" name="search" placeholder="Cari nama atau email..."
                        value="{{ $search }}"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">

                    <!-- Filter -->
                    <select name="filter"
                        class="px-4 py-2 border rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Semua Domain</option>
                        <option value="gmail" {{ $filter == 'gmail' ? 'selected' : '' }}>Gmail</option>
                        <option value="yahoo" {{ $filter == 'yahoo' ? 'selected' : '' }}>Yahoo</option>
                        <option value="outlook" {{ $filter == 'outlook' ? 'selected' : '' }}>Outlook</option>
                    </select>

                    <!-- Tombol -->
                    <button class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700">
                        Terapkan
                    </button>
                </form>

                <!-- Tombol Tambah -->
                <a href="{{ route('user.create') }}"
                    class="bg-pink-600 text-white px-5 py-2 rounded-full shadow-lg hover:bg-pink-700 flex items-center">
                    <i class="fa fa-plus-circle mr-2"></i> Tambah User Baru
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white shadow-xl rounded-xl border-t-4 border-pink-500">
                <div class="p-6 overflow-x-auto">

                    <table class="w-full table-auto border-collapse">
                        <thead class="bg-pink-500 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left font-bold">No</th>
                                <th class="py-3 px-4 text-left font-bold">Nama</th>
                                <th class="py-3 px-4 text-left font-bold">Email</th>
                                <th class="py-3 px-4 text-center font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $i => $user)
                                <tr class="border-b border-gray-200 hover:bg-pink-50">
                                    <td class="py-3 px-4">{{ $users->firstItem() + $i }}</td>
                                    <td class="py-3 px-4 font-semibold text-gray-800">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="py-3 px-4 text-center">

                                        <div class="flex justify-center gap-3">

                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="px-3 py-1.5 text-xs text-white bg-fuchsia-500 rounded-full hover:bg-fuchsia-600">
                                                <i class="fa fa-edit mr-1"></i> Edit
                                            </a>

                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1.5 text-xs text-white bg-red-600 rounded-full hover:bg-red-700">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">
                                        <i class="fas fa-box-open mr-1"></i> Belum ada user.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- PAGINATION -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
