@extends('layouts.app')

@section('content')
    <!-- KONTEN UTAMA -->
    <div class="w-full px-6 py-10 mx-auto min-h-screen flex justify-center items-start">
        <div class="w-full max-w-2xl">

            <!-- Header Halaman -->
            <header class="mb-8 p-6 bg-pink-600/90 rounded-xl shadow-xl">
                <div class="flex justify-between items-center text-white">
                    <h1 class="text-3xl font-extrabold">
                        Form Pendaftaran User Baru
                    </h1>
                    <!-- Link ke Daftar User -->
                    <a href="{{ route('user.index') }}"
                        class="text-sm font-semibold transition-all ease-nav-brand text-pink-100 hover:text-white dark:text-white dark:hover:text-gray-300 flex items-center bg-pink-500/30 p-2 rounded-lg hover:bg-pink-500/50">
                        <i class="fa fa-list-alt sm:mr-1"></i>
                        <span class="sm:inline ml-1">Daftar User</span>
                    </a>
                </div>
            </header>

            <!-- Card Formulir -->
            <div
                class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-4 border-pink-500 transform transition duration-500 hover:shadow-pink-300/50">

                <!-- Form Store User -->
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-user-circle mr-1 text-pink-500"></i> Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                            placeholder="Contoh: Grandiva" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-envelope mr-1 text-pink-500"></i> Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                            placeholder="Contoh: grand@example.com" required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Role User -->
                    <div class="mb-5">
                        <label for="role" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-user-tag mr-1 text-pink-500"></i> Role User
                        </label>

                        <select name="role" id="role"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kader" {{ old('role') == 'kader' ? 'selected' : '' }}>Kader</option>
                            <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                        </select>

                        @error('role')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields (Menggunakan Grid/Row untuk tampilan 2 kolom) -->
                    <div class="flex flex-wrap -mx-2 mt-8">
                        <!-- Password -->
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="password" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-lock mr-1 text-pink-500"></i> Password
                            </label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                                placeholder="Masukkan password" required>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="w-full md:w-1/2 px-2 mb-5">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2 text-sm">
                                <i class="fas fa-check-double mr-1 text-pink-500"></i> Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm placeholder:text-gray-400"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end mt-6 space-x-4">
                        <!-- Tombol Batal (Abu-abu) -->
                        <a href="{{ route('user.index') }}"
                            class="appvilla-btn inline-block bg-gray-500 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-gray-600 transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-times-circle mr-2"></i> Batal
                        </a>

                        <!-- Tombol Simpan (Pink) -->
                        <button type="submit"
                            class="appvilla-btn inline-block bg-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--AKHIR KONTEN UTAMA -->
@endsection
