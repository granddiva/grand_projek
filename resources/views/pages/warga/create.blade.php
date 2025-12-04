@extends('layouts.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="w-full px-6 py-6 mx-auto">

        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 sm:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="font-bold text-slate-800">Form Input Data Warga</h5>
                            <a href="{{ route('warga.index') }}"
                                class="text-sm font-semibold transition-all text-pink-600 hover:text-pink-800">
                                <i class="fa fa-list-alt sm:mr-1"></i>
                                <span class="sm:inline">Daftar Warga</span>
                            </a>
                        </div>

                        <form action="{{ route('warga.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="nik" class="block mb-2 text-sm font-medium text-slate-700">NIK</label>
                                <input type="text" name="nik" id="nik"
                                    class="text-sm ease w-full leading-5.6 relative block rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder:text-gray-500 focus:border-pink-500 focus:outline-none focus:shadow-primary-outline focus:transition-shadow"
                                    placeholder="Masukkan NIK warga" value="{{ old('nik') }}" required>
                                @error('nik')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama" class="block mb-2 text-sm font-medium text-slate-700">Nama
                                    Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    class="text-sm ease w-full leading-5.6 relative block rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder:text-gray-500 focus:border-pink-500 focus:outline-none focus:shadow-primary-outline focus:transition-shadow"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-slate-700">Jenis
                                    Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="text-sm ease w-full leading-5.6 relative block rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder:text-gray-500 focus:border-pink-500 focus:outline-none focus:shadow-primary-outline focus:transition-shadow"
                                    required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="block mb-2 text-sm font-medium text-slate-700">Alamat
                                    Lengkap</label>
                                <textarea name="alamat" id="alamat" rows="3"
                                    class="text-sm ease w-full leading-5.6 relative block rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder:text-gray-500 focus:border-pink-500 focus:outline-none focus:shadow-primary-outline focus:transition-shadow"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="no_hp" class="block mb-2 text-sm font-medium text-slate-700">Nomor
                                    HP</label>
                                <input type="text" name="no_hp" id="no_hp"
                                    class="text-sm ease w-full leading-5.6 relative block rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder:text-gray-500 focus:border-pink-500 focus:outline-none focus:shadow-primary-outline focus:transition-shadow"
                                    placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-block px-8 py-2 mr-2 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-pink-600 hover:bg-pink-700 hover:shadow-xs hover:-translate-y-px">
                                    Simpan Warga
                                </button>
                                <a href="{{ route('warga.index') }}"
                                    class="inline-block px-8 py-2 text-xs font-bold leading-normal text-center text-slate-700 capitalize transition-all ease-in rounded-lg shadow-md bg-gray-200 hover:shadow-xs hover:-translate-y-px">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END MAINCONTENT -->
@endsection
