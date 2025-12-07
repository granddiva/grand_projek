@extends('layouts.app')

@section('content')
    <!-- KONTEN UTAMA -->
    <div class="w-full px-6 py-10 mx-auto min-h-screen flex justify-center items-start">
        <div class="w-full max-w-2xl">

            <!-- Header Halaman -->
            <header class="mb-8 p-6 bg-pink-600/90 rounded-xl shadow-xl">
                <div class="text-center text-white">
                    <h1 class="text-3xl font-extrabold mb-1">
                        Edit Akun User
                    </h1>
                    <h2 class="text-md font-light">
                        Perbarui data untuk user: <span class="font-semibold">{{ $user->name }}</span>
                    </h2>
                </div>
            </header>

            <!-- Card Formulir -->
            <div
                class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border-t-4 border-pink-500 transform transition duration-500 hover:shadow-pink-300/50">

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-user-circle mr-1 text-pink-500"></i> Nama
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-envelope mr-1 text-pink-500"></i> Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Input Role -->
                    <div class="mb-5">
                        <label for="role" class="block text-gray-700 font-bold mb-2 text-sm">
                            <i class="fas fa-user-tag mr-1 text-pink-500"></i> Role User
                        </label>

                        <select name="role" id="role"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            required>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="kader" {{ old('role', $user->role) == 'kader' ? 'selected' : '' }}>Kader
                            </option>
                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga
                            </option>
                        </select>

                        @error('role')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul Pembaruan Password -->
                    <div class="mt-8 mb-4 border-b border-pink-200 pb-2">
                        <p class="text-md font-bold text-gray-800">
                            <i class="fas fa-key mr-2 text-pink-500"></i> Pembaruan Password (Opsional)
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Isi kolom di bawah hanya jika Anda ingin mengganti password
                            user ini.</p>
                    </div>

                    <!-- Input Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-gray-700 font-bold mb-2 text-sm">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            placeholder="Biarkan kosong jika tidak ingin diubah">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2 text-sm">Konfirmasi
                            Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:ring-pink-500 focus:border-pink-500 transition duration-150 ease-in-out shadow-sm"
                            placeholder="Ketik ulang password baru">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between space-x-4">
                        <!-- Tombol Kembali (Abu-abu) -->
                        <a href="{{ route('user.index') }}"
                            class="appvilla-btn w-full bg-gray-500 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-gray-600 transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>

                        <!-- Tombol Update (Pink) -->
                        <button type="submit"
                            class="appvilla-btn w-full bg-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl transition duration-300 transform hover:scale-[1.01] flex items-center justify-center">
                            <i class="fas fa-sync-alt mr-2"></i> Update Data User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- AKHIR KONTEN UTAMA -->
@endsection
