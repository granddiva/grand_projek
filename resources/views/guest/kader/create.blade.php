@extends('layouts.guest.app')

{{-- Pastikan Anda memiliki CDN Font Awesome atau library ikon yang Anda gunakan di layout utama --}}
{{-- Contoh: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> --}}

@section('content')
    {{-- Menggunakan min-h-screen dan items-start agar konten berada di bagian atas layar --}}
    <div class="w-full px-6 py-10 mx-auto min-h-screen flex justify-center items-start">
        <div class="w-full max-w-2xl">

            {{-- Mengganti Judul dan Warna sesuai konteks "Tambah Kader Posyandu" --}}
            <header class="mb-8 p-6 bg-pink-600/90 rounded-xl shadow-xl">
                <div class="flex justify-between items-center text-white">
                    <h1 class="text-3xl font-extrabold flex items-center gap-2">
                        <i class="fas fa-user-plus"></i> ➕ Tambah Kader Posyandu
                    </h1>
                    <a href="{{ route('kaderposyandu.index') }}"
                        class="text-sm font-semibold transition-all ease-nav-brand text-pink-100 hover:text-white dark:text-white dark:hover:text-gray-300 flex items-center bg-pink-500/30 p-2 rounded-lg hover:bg-pink-500/50">
                        <i class="fas fa-list-alt sm:mr-1"></i>
                        <span class="sm:inline ml-1">Daftar Kader</span>
                    </a>
                </div>
            </header>

            {{-- Menggunakan warna background dan border pink sesuai tema --}}
            <div
                class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-4 border-pink-500 transform transition duration-500 hover:shadow-pink-300/50">

                <p class="text-sm text-gray-500 mb-6 border-b pb-4">
                    Isi data anggota baru Posyandu. Semua kolom bertanda (<span class="text-red-500 font-bold">*</span>)
                    wajib diisi.
                </p>

                <form action="{{ route('kaderposyandu.store') }}" method="POST">
                    @csrf

                    <div class="flex flex-wrap -mx-2">
                        {{-- Posyandu (Select Box) --}}
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="posyandu_id" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-house-medical-flag mr-1 text-pink-500"></i> Posyandu <span
                                    class="text-red-500">*</span>
                            </label>
                            <select name="posyandu_id" id="posyandu_id"
                                class="w-full px-4 py-2 border-2 @error('posyandu_id') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                                required>
                                <option value="" disabled {{ old('posyandu_id') ? '' : 'selected' }}>
                                    -- Pilih Posyandu --</option>
                                @foreach ($posyandu as $p)
                                    <option value="{{ $p->posyandu_id }}"
                                        {{ old('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('posyandu_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Warga (Select Box) --}}
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="warga_id" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-user-circle mr-1 text-pink-500"></i> Warga <span
                                    class="text-red-500">*</span>
                            </label>
                            <select name="warga_id" id="warga_id"
                                class="w-full px-4 py-2 border-2 @error('warga_id') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                                required>
                                <option value="" disabled {{ old('warga_id') ? '' : 'selected' }}>--
                                    Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}"
                                        {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }} (NIK: {{ $w->nik ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Peran (Text Input) --}}
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="peran" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-medal mr-1 text-pink-500"></i> Peran <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="peran" id="peran"
                                class="w-full px-4 py-2 border-2 @error('peran') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                                value="{{ old('peran') }}" required placeholder="Contoh: Ketua / Anggota / Bendahara">
                            @error('peran')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Mulai Tugas (Date Input) --}}
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="mulai_tugas" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-calendar-check mr-1 text-pink-500"></i> Mulai Tugas <span
                                    class="text-red-500">*</span>
                            </label>
                            <input type="date" name="mulai_tugas" id="mulai_tugas"
                                class="w-full px-4 py-2 border-2 @error('mulai_tugas') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                                value="{{ old('mulai_tugas', date('Y-m-d')) }}" required>
                            @error('mulai_tugas')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Akhir Tugas (Date Input - Opsional) --}}
                        <div class="w-full px-2 mb-5">
                            <label for="akhir_tugas" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-calendar-times mr-1 text-pink-500"></i> Akhir Tugas
                                (Opsional)
                            </label>
                            <input type="date" name="akhir_tugas" id="akhir_tugas"
                                class="w-full px-4 py-2 border-2 @error('akhir_tugas') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                                value="{{ old('akhir_tugas') }}">
                            @error('akhir_tugas')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                            <small class="block text-gray-500 mt-1">Kosongkan jika kader masih aktif bertugas.</small>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 space-x-4 border-t pt-6">
                        <a href="{{ route('kaderposyandu.index') }}"
                            class="appvilla-btn inline-block bg-white text-pink-600 border-2 border-pink-600 font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-50 transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-times-circle mr-2"></i> Batal / Kembali
                        </a>

                        <button type="submit"
                            class="appvilla-btn inline-block bg-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
