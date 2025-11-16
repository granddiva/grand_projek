<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Posyandu Digital - Realtime</title>

{{-- Catatan Layanan Warga User (untuk kebutuhan data dan autentikasi, jika diperlukan oleh JS) --}}
{{-- Anda bisa mengisi 'USER_ID_ANDA' ini secara dinamis dari Controller Laravel --}}
<meta name="user-id" content="USER_ID_ANDA">
<meta name="layanan-type" content="Catatan Layanan Posyandu Warga">

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

{{-- resources/views/partials/_navbar.blade.php --}}
<nav class="bg-pink-600 text-white shadow-xl fixed top-0 left-0 w-full z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">

        {{-- Judul Utama (Posisi Kiri) --}}
        <div class="flex items-center">
            <i class="fas fa-heartbeat text-2xl mr-3"></i>
            <span class="text-xl font-extrabold tracking-tight">POSYANDU DIGITAL</span>
        </div>

        {{-- Link Navigasi (Simulasi Navigasi Portal) --}}
        <div class="flex space-x-6 text-sm font-medium">
            {{-- Menggunakan switchView untuk kembali ke dashboard --}}
            <a href="{{ route('layanan.index') }}" onclick="switchView('dashboard'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-chart-line mr-1"></i> Dashboard
            </a>
            <a href="{{ route('warga.index') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-plus-circle mr-1"></i> Warga
            </a>
            <a href="{{ route('kaderposyandu.index') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-user mr-1"></i> Kader
            </a>
            <a href="{{ route('about') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-info-circle mr-1"></i> Tentang Aplikasi
            </a>

            <span class="opacity-75 hidden md:inline">|</span>
            <a href="{{ route('user.index') }}" class="hover:text-pink-200 transition duration-150 hidden md:inline">
                <i class="fas fa-user mr-1"></i> User
            </a>
        </div>
    </div>
</nav>

{{-- Jarak untuk konten di bawah navbar fixed --}}
<div class="pt-16"></div>
