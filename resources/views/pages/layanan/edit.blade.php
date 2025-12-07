@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4 text-xs text-gray-500">
        <!-- Menampilkan ID Warga yang sedang diedit -->
        <span class="text-lg font-semibold text-gray-800">
            <i class="fas fa-user-tag mr-2 text-pink-500"></i> Data Warga: {{ $warga->nama ?? 'N/A' }}
        </span>
        <span>
            User ID: <span id="user-id-display" class="font-mono font-bold text-gray-700">Memuat...</span>
        </span>
    </div>

    <!-- 1. HEADER KHUSUS EDIT -->
    <header class="appvilla-hero rounded-2xl mb-8 p-8 md:p-10">
        <div class="hero-bg-overlay"></div>
        <div class="text-center relative z-10 text-white">
            <i class="fas fa-edit text-4xl mb-2 d-inline-block"></i>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-1 text-shadow-hero">
                Ubah Catatan Layanan Posyandu
            </h1>
            <h2 class="text-md font-light">
                Perbarui data pengukuran kesehatan untuk **{{ $warga->nama ?? 'Warga' }}**.
            </h2>
        </div>
    </header>

    <!-- 2. FORM EDIT DENGAN GAYA APP VILLA -->
    <section class="max-w-3xl mx-auto bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-8 border-pink-500">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 text-center">
            Detail Pengukuran Tanggal: {{ \Carbon\Carbon::parse($layanan->tanggal)->format('d M Y') }}
        </h3>

        <form action="{{ route('layanan.update', $layanan) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ID Warga (ReadOnly - Informasi) -->
            <div class="mb-5">
                <label for="warga_id_display" class="block text-gray-700 text-sm font-bold mb-2">
                    ID Warga / Nama Balita
                </label>
                <input type="text" id="warga_id_display"
                    value="{{ $warga->warga_id ?? 'N/A' }} - {{ $warga->nama ?? 'Warga' }}"
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-500 leading-tight bg-gray-100 cursor-not-allowed"
                    readonly>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Berat --}}
                <div class="mb-5">
                    <label for="berat" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fas fa-weight-hanging mr-1 text-pink-500"></i> Berat (kg) <span
                            class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.1" name="berat" id="berat"
                        value="{{ old('berat', $layanan->berat) }}" placeholder="Contoh: 5.5"
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150"
                        required>
                    @error('berat')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tinggi --}}
                <div class="mb-5">
                    <label for="tinggi" class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fas fa-ruler-vertical mr-1 text-pink-500"></i> Tinggi (cm) <span
                            class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tinggi" id="tinggi" value="{{ old('tinggi', $layanan->tinggi) }}"
                        placeholder="Contoh: 60"
                        class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-150"
                        required>
                    @error('tinggi')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Vitamin (Mengubah dari text input menjadi select) --}}
            <div class="mb-5">
                <label for="vitamin" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-pills mr-1 text-pink-500"></i> Vitamin Diberikan
                </label>
                <select id="vitamin" name="vitamin"
                    class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-150">
                    @php
                        $options = ['Tidak Diberikan', 'Vitamin A', 'Vitamin D', 'Lainnya'];
                        $currentValue = old('vitamin', $layanan->vitamin);
                    @endphp
                    @foreach ($options as $option)
                        <option value="{{ $option }}" {{ $currentValue == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('vitamin')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Konseling --}}
            <div class="mb-6">
                <label for="konseling" class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-comment-dots mr-1 text-pink-500"></i> Catatan/Konseling <span
                        class="text-red-500">*</span>
                </label>
                <textarea name="konseling" id="konseling" rows="4"
                    placeholder="Catatan hasil pengukuran, saran gizi, atau masalah yang ditemukan."
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-150"
                    required>{{ old('konseling', $layanan->konseling) }}</textarea>
                @error('konseling')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end pt-4 space-x-4">
                <a href="{{ route('layanan.index') }}"
                    class="bg-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-full hover:bg-gray-400 transition duration-150 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
                <button type="submit"
                    class="appvilla-btn rounded-full shadow-xl hover:scale-105 transform transition duration-300 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 px-6 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </section>
@endsection
