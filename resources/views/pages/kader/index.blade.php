@extends('layouts.app')

@section('content')
    <!-- Pastikan Anda memuat Font Awesome dan Tailwind CSS di layout utama (layouts.guest.app) -->

    <!-- KONTEN UTAMA -->
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3">

                <!-- 1. HEADER HALAMAN (PINK) -->
                <!-- Menggunakan background yang lebih solid untuk header data -->
                <header class="rounded-2xl mb-8 p-8 md:p-10 bg-pink-600/90 shadow-2xl">
                    <div class="text-center relative z-10 text-white">
                        <!-- Menggunakan Ikon yang lebih spesifik untuk Kader/Tenaga Kesehatan -->
                        <i class="fas fa-user-nurse text-4xl mb-2 inline-block"></i>
                        <h1 class="text-3xl md:text-4xl font-extrabold mb-1 text-shadow-hero">
                            Data Kader Posyandu
                        </h1>
                        <h2 class="text-md font-light">
                            Daftar lengkap kader yang bertugas di berbagai Posyandu.
                        </h2>
                    </div>
                </header>

                <!-- 2. BAGIAN NOTIFIKASI & TOMBOL AKSI -->
                <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

                    <!-- Notifikasi Sukses -->
                    @if (session('success'))
                        <div class="relative px-4 py-3 text-sm flex-grow mr-4 text-green-800 bg-green-100 border border-green-400 rounded-lg shadow-md w-full md:w-auto"
                            role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                        </div>
                    @elseif (session('error'))
                        <!-- Notifikasi Error -->
                        <div class="relative px-4 py-3 text-sm flex-grow mr-4 text-red-800 bg-red-100 border border-red-400 rounded-lg shadow-md w-full md:w-auto"
                            role="alert">
                            <i class="fas fa-times-circle mr-2"></i>
                            <span class="block sm:inline font-semibold">{{ session('error') }}</span>
                        </div>
                    @else
                        <!-- Spacer jika tidak ada notifikasi -->
                        <div class="hidden md:block"></div>
                    @endif

                    <!-- Tombol Aksi -->
                    <div class="flex gap-3 w-full md:w-auto justify-end">
                        <!-- Tombol Tambah Kader -->
                        <a href="{{ route('kaderposyandu.create') }}"
                            class="bg-pink-600 text-white font-semibold py-2.5 px-5 rounded-full shadow-lg hover:bg-pink-700 transition duration-300 transform hover:scale-105 flex items-center whitespace-nowrap text-sm">
                            <i class="fa fa-plus-circle mr-2"></i> Tambah Kader
                        </a>
                        <!-- Tombol Kembali -->
                        <a href="{{ route('layanan.index') }}"
                            class="bg-white text-pink-600 border border-pink-500 font-semibold py-2.5 px-5 rounded-full shadow-lg hover:bg-pink-50 transition duration-300 transform hover:scale-105 flex items-center whitespace-nowrap text-sm">
                            <i class="fa fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>

                <!-- 3. CARD UTAMA UNTUK TABEL DATA KADER -->
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-2xl rounded-2xl border-t-4 border-pink-500 bg-clip-border">
                    <div class="flex-auto p-6">
                        <div class="overflow-x-auto rounded-xl">
                            <table class="w-full min-w-full table-auto border-collapse">
                                <!-- Table Head (PINK) -->
                                <thead class="bg-pink-500 text-white shadow-md">
                                    <tr>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-left uppercase rounded-tl-xl border-b-2 border-pink-400">
                                            No</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-left uppercase border-b-2 border-pink-400">
                                            Nama Kader</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-left uppercase border-b-2 border-pink-400">
                                            Posyandu</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-center uppercase border-b-2 border-pink-400">
                                            Peran</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-left uppercase border-b-2 border-pink-400">
                                            Mulai Tugas</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-left uppercase border-b-2 border-pink-400">
                                            Akhir Tugas</th>
                                        <th
                                            class="py-3 px-4 text-xs font-bold text-center uppercase rounded-tr-xl border-b-2 border-pink-400">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    @forelse ($kader as $index => $k)
                                        <tr
                                            class="border-b border-gray-200 hover:bg-pink-50/50 transition-colors duration-200 ease-in-out">
                                            <td class="py-3 px-4 text-sm text-gray-700 font-medium">
                                                {{ $index + 1 }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-900 font-semibold">
                                                {{ $k->warga->nama }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">
                                                {{ $k->posyandu->nama }}</td>
                                            <td class="py-3 px-4 text-sm text-center font-bold text-pink-600">
                                                {{ $k->peran }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($k->mulai_tugas)->format('d F Y') }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">
                                                {{ $k->akhir_tugas ? \Carbon\Carbon::parse($k->akhir_tugas)->format('d F Y') : '-' }}
                                            </td>

                                            <!-- Kolom Aksi -->
                                            <td class="py-3 px-4 text-center text-sm">
                                                <div class="flex justify-center items-center space-x-3">

                                                    <!-- Tombol Edit (Orange, diubah menjadi Fuchsia/Pink yang lebih solid) -->
                                                    <a href="{{ route('kaderposyandu.edit', $k->kader_id) }}"
                                                        class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-pink-500 rounded-full shadow-md hover:bg-pink-600 transition duration-150 ease-in-out transform hover:scale-105">
                                                        <i class="fa fa-edit mr-1"></i> Edit
                                                    </a>

                                                    <!-- Tombol Hapus (Tetap Merah untuk aksi destruktif) -->
                                                    <form action="{{ route('kaderposyandu.destroy', $k->kader_id) }}"
                                                        method="POST" class="inline-block"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kader: {{ $k->warga->nama }}? Aksi ini tidak dapat dibatalkan.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-red-600 rounded-full shadow-md hover:bg-red-700 transition duration-150 ease-in-out transform hover:scale-105">
                                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="py-8 text-center text-base font-medium text-gray-500 bg-pink-50 rounded-b-xl">
                                                <i class="fas fa-box-open mr-2"></i> Belum ada data kader posyandu yang
                                                tercatat. Silahkan tambahkan kader baru.
                                                <a href="{{ route('kaderposyandu.create') }}"
                                                    class="text-pink-600 font-bold ml-1 hover:underline">
                                                    Tambahkan Kader Pertama
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- AKHIR KONTEN UTAMA -->
@endsection
