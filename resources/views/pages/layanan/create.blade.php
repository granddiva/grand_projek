@extends('layouts.app')

@section('content')

    <!-- 1. HEADER KHUSUS TAMBAH DATA -->
    <header class="appvilla-hero rounded-2xl mb-8 p-8 md:p-10">
        <div class="hero-bg-overlay"></div>
        <div class="text-center relative z-10 text-white">
            <i class="fas fa-plus-circle text-4xl mb-2 d-inline-block"></i>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-1 text-shadow-hero">
                Input Data Layanan Posyandu Baru
            </h1>
            <h2 class="text-md font-light">
                Masukkan detail pengukuran kesehatan balita untuk sesi hari ini.
            </h2>
        </div>
    </header>

    <!-- 2. FORM TAMBAH DATA DENGAN GAYA APP VILLA -->
    <section class="max-w-3xl mx-auto bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-8 border-pink-500">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 text-center">
            Formulir Pencatatan Data Balita
        </h3>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border border-red-300">
                <strong class="font-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Terjadi Kesalahan!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('layanan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Jadwal & Warga (ID Simulasi) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Jadwal ID --}}
                <div>
                    <label for="jadwal_id" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-calendar-check mr-1 text-pink-500"></i> ID Jadwal
                    </label>
                    <input type="number" name="jadwal_id" id="jadwal_id" value="{{ old('jadwal_id') }}"
                        placeholder="Contoh: 1 (ID Sesi Posyandu)" required
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150">
                </div>

                {{-- Warga ID --}}
                <div>
                    <label for="warga_id" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-user-tag mr-1 text-pink-500"></i> ID Warga / Balita
                    </label>
                    <input type="number" name="warga_id" id="warga_id" value="{{ old('warga_id') }}"
                        placeholder="Contoh: 101 (ID Balita)" required
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150">
                </div>
            </div>

            <!-- Berat & Tinggi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Berat --}}
                <div>
                    <label for="berat" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-weight-hanging mr-1 text-pink-500"></i> Berat Badan (kg) <span
                            class="text-red-500">*</span>
                    </label>
                    <input type="number" name="berat" id="berat" step="0.1" value="{{ old('berat') }}"
                        placeholder="Contoh: 4.5" required
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150">
                </div>

                {{-- Tinggi --}}
                <div>
                    <label for="tinggi" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-ruler-vertical mr-1 text-pink-500"></i> Tinggi Badan (cm) <span
                            class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tinggi" id="tinggi" value="{{ old('tinggi') }}" placeholder="Contoh: 55"
                        required
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150">
                </div>
            </div>

            {{-- Vitamin (Mengubah dari text input menjadi select) --}}
            <div>
                <label for="vitamin" class="block text-sm font-bold text-gray-700 mb-2">
                    <i class="fas fa-pills mr-1 text-pink-500"></i> Vitamin Diberikan
                </label>
                <select id="vitamin" name="vitamin"
                    class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-150">
                    <option value="Tidak Diberikan" {{ old('vitamin') == 'Tidak Diberikan' ? 'selected' : '' }}>Tidak
                        Diberikan</option>
                    <option value="Vitamin A" {{ old('vitamin') == 'Vitamin A' ? 'selected' : '' }}>Vitamin A</option>
                    <option value="Vitamin D" {{ old('vitamin') == 'Vitamin D' ? 'selected' : '' }}>Vitamin D</option>
                    <option value="Lainnya" {{ old('vitamin') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            {{-- Catatan Konseling --}}
            <div>
                <label for="konseling" class="block text-sm font-bold text-gray-700 mb-2">
                    <i class="fas fa-comment-dots mr-1 text-pink-500"></i> Catatan Konseling <span
                        class="text-red-500">*</span>
                </label>
                <textarea name="konseling" id="konseling" rows="4"
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-150"
                    placeholder="Catatan mengenai pertumbuhan anak, saran gizi, atau masalah yang ditemukan..." required>{{ old('konseling') }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-center space-x-4 pt-4">
                <a href="{{ route('layanan.index') }}"
                    class="bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-gray-400 transition duration-150 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit"
                    class="appvilla-btn rounded-full shadow-xl hover:scale-105 transform transition duration-300 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 px-6 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Data Layanan
                </button>
            </div>
        </form>
    </section>

@endsection
