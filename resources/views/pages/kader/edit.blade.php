@extends('layouts.guest.app')

{{-- Pastikan Anda memiliki CDN Font Awesome atau library ikon yang Anda gunakan di layout utama --}}
{{-- Contoh: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> --}}

@section('content')
    <div class="w-full px-6 py-10 mx-auto min-h-screen flex justify-center items-start">
        <div class="w-full max-w-2xl">

            <header class="mb-8 p-6 bg-pink-600/90 rounded-xl shadow-xl">
                <div class="text-center text-white">
                    <h1 class="text-3xl font-extrabold mb-1 flex items-center justify-center gap-2">
                        <i class="fas fa-user-edit"></i> ✏️ Edit Kader Posyandu
                    </h1>
                    <h2 class="text-md font-light">
                        Perbarui data kader: <span
                            class="font-semibold">{{ $kader->warga->nama ?? 'Nama Warga Tidak Ditemukan' }}</span>
                    </h2>
                </div>
            </header>

            <div
                class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-4 border-pink-500 transform transition duration-500 hover:shadow-pink-300/50">

                <form action="{{ route('kaderposyandu.update', $kader->kader_id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                @foreach ($posyandu as $p)
                                    <option value="{{ $p->posyandu_id }}"
                                        {{ old('posyandu_id', $kader->posyandu_id) == $p->posyandu_id ? 'selected' : '' }}>
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
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}"
                                        {{ old('warga_id', $kader->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
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
                                value="{{ old('peran', $kader->peran) }}" required placeholder="Contoh: Ketua / Anggota">
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
                                class="w-full px-4 py-2 border-2 @error('mulai_tugas') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                                value="{{ old('mulai_tugas', $kader->mulai_tugas) }}" required>
                            @error('mulai_tugas')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Akhir Tugas (Date Input - Opsional) --}}
                        <div class="w-full px-2 mb-8">
                            <label for="akhir_tugas" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-calendar-times mr-1 text-pink-500"></i> Akhir Tugas
                                (Opsional)
                            </label>
                            <input type="date" name="akhir_tugas" id="akhir_tugas"
                                class="w-full px-4 py-2 border-2 @error('akhir_tugas') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                                value="{{ old('akhir_tugas', $kader->akhir_tugas) }}">
                            @error('akhir_tugas')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="flex justify-between space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('kaderposyandu.index') }}"
                            class="appvilla-btn w-full bg-white text-pink-600 border-2 border-pink-600 font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-50 transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i> Batal / Kembali
                        </a>

                        <button type="submit"
                            class="appvilla-btn w-full bg-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-sync-alt mr-2"></i> Update Data Kader
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
