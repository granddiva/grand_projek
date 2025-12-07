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
            <a href="{{ route('posyandu.index') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-hospital mr-1"></i> Posyandu
            </a>
            <a href="{{ route('warga.index') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-plus-circle mr-1"></i> Warga
            </a>
            <a href="{{ route('kaderposyandu.index') }}" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-user mr-1"></i> Kader
            </a>
            <a href="#" onclick="switchView('form'); return false;"
                class="hover:text-pink-200 transition duration-150">
                <i class="fas fa-info-circle mr-1"></i> Tentang Aplikasi
            </a>

            <span class="opacity-75 hidden md:inline">|</span>
            {{-- USER DROPDOWN --}}
            <div class="relative hidden md:block">
                <button id="userDropdownBtn" class="hover:text-pink-200 transition duration-150 flex items-center">
                    <i class="fas fa-user mr-1"></i> {{ Auth::user()->name ?? 'User' }}
                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                </button>

                {{-- Dropdown --}}
                <div id="userDropdownMenu"
                    class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg py-2 hidden z-50">

                    {{-- Last Login --}}
                    <div class="px-4 py-2 text-sm font-semibold text-gray-900">
                        Last Login
                    </div>
                    <div class="px-4 pb-2 text-xs text-gray-600 border-b">
                        {{ session('last_login') ?? 'Belum ada data' }}
                    </div>

                    {{-- Lihat Data User --}}
                    <a href="{{ route('user.index') }}"
                        class="block px-4 py-2 text-sm hover:bg-pink-50 hover:text-pink-600 transition">
                        <i class="fas fa-users mr-2"></i>
                        Daftar User
                    </a>

                    {{-- Logout --}}
                    {{-- Penerapan Auth::check, jika user tidak login tidak bisa logout --}}
                    @if(Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-pink-50 hover:text-pink-600 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                    @endif

                </div>
            </div>



        </div>
    </div>
</nav>

{{-- Jarak untuk konten di bawah navbar fixed --}}
<div class="pt-16"></div>
<script>
    const btn = document.getElementById("userDropdownBtn");
    const menu = document.getElementById("userDropdownMenu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    // klik di luar area untuk menutup dropdown
    document.addEventListener("click", (e) => {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
</script>
