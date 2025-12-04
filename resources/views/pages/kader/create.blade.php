@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-10 mx-auto min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl">

        {{-- HEADER --}}
        <header class="mb-8 p-6 bg-pink-600/90 rounded-xl shadow-xl">
            <div class="flex justify-between items-center text-white">
                <h1 class="text-3xl font-extrabold flex items-center gap-2">
                    <i class="fas fa-user-plus"></i> ➕ Tambah Kader Posyandu
                </h1>
                <a href="{{ route('kaderposyandu.index') }}"
                    class="text-sm font-semibold bg-pink-500/30 p-2 rounded-lg hover:bg-pink-500/50 transition">
                    <i class="fas fa-list-alt sm:mr-1"></i>
                    <span class="sm:inline ml-1">Daftar Kader</span>
                </a>
            </div>
        </header>

        {{-- FORM --}}
        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-4 border-pink-500">

            <p class="text-sm text-gray-500 mb-6 border-b pb-4">
                Semua kolom bertanda (<span class="text-red-500 font-bold">*</span>) wajib diisi.
            </p>

            <form action="{{ route('kaderposyandu.store') }}" method="POST">
                @csrf

                <div class="flex flex-wrap -mx-2">

                    {{-- POSYANDU --}}
                    <div class="w-full md:w-1/2 px-2 mb-5">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-house-medical-flag mr-1 text-pink-500"></i>
                            Posyandu <span class="text-red-500">*</span>
                        </label>

                        <select name="posyandu_id" required
                            class="w-full px-4 py-2 border-2 rounded-xl focus:ring-pink-500 focus:border-pink-500
                                   @error('posyandu_id') border-red-500 @else border-gray-300 @enderror">

                            <option value="" disabled selected>-- Pilih Posyandu --</option>

                            @foreach ($posyandu as $p)
                                {{-- FIXED: menggunakan $p->posyandu_id --}}
                                <option value="{{ $p->posyandu_id }}"
                                    {{ old('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach

                        </select>

                        @error('posyandu_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- WARGA --}}
                    <div class="w-full md:w-1/2 px-2 mb-5">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-user-circle mr-1 text-pink-500"></i>
                            Warga <span class="text-red-500">*</span>
                        </label>

                        <select name="warga_id" required
                            class="w-full px-4 py-2 border-2 rounded-xl focus:ring-pink-500 focus:border-pink-500
                                   @error('warga_id') border-red-500 @else border-gray-300 @enderror">

                            <option value="" disabled selected>-- Pilih Warga --</option>

                            @foreach ($warga as $w)
                                {{-- FIXED: menggunakan $w->warga_id --}}
                                <option value="{{ $w->warga_id }}"
                                    {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} (NIK: {{ $w->nik ?? 'N/A' }})
                                </option>
                            @endforeach

                        </select>

                        @error('warga_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PERAN --}}
                    <div class="w-full md:w-1/2 px-2 mb-5">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-medal mr-1 text-pink-500"></i>
                            Peran <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="peran" value="{{ old('peran') }}" required
                            placeholder="Contoh: Ketua / Anggota"
                            class="w-full px-4 py-2 border-2 rounded-xl focus:ring-pink-500 focus:border-pink-500
                                   @error('peran') border-red-500 @else border-gray-300 @enderror">

                        @error('peran')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- MULAI TUGAS --}}
                    <div class="w-full md:w-1/2 px-2 mb-5">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-calendar-check mr-1 text-pink-500"></i>
                            Mulai Tugas <span class="text-red-500">*</span>
                        </label>

                        <input type="date" name="mulai_tugas"
                            value="{{ old('mulai_tugas', date('Y-m-d')) }}" required
                            class="w-full px-4 py-2 border-2 rounded-xl focus:ring-pink-500 focus:border-pink-500
                                   @error('mulai_tugas') border-red-500 @else border-gray-300 @enderror">

                        @error('mulai_tugas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- AKHIR TUGAS --}}
                    <div class="w-full px-2 mb-5">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-calendar-times mr-1 text-pink-500"></i>
                            Akhir Tugas (Opsional)
                        </label>

                        <input type="date" name="akhir_tugas"
                            value="{{ old('akhir_tugas') }}"
                            class="w-full px-4 py-2 border-2 rounded-xl border-gray-300 focus:ring-pink-500 focus:border-pink-500">

                        <small class="text-gray-500">Kosongkan bila kader masih aktif.</small>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end mt-8 space-x-4 border-t pt-6">

                    <a href="{{ route('kaderposyandu.index') }}"
                        class="bg-white text-pink-600 border-2 border-pink-600 py-3 px-6 rounded-full shadow-lg hover:bg-pink-50 transition flex items-center">
                        <i class="fas fa-times-circle mr-2"></i> Batal
                    </a>

                    <button type="submit"
                        class="bg-pink-600 text-white py-3 px-6 rounded-full shadow-lg hover:bg-pink-700 transition flex items-center">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
@endsection
