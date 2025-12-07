<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Posyandu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Sistem Posyandu</h1>

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                <strong>Gagal Login!</strong> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">


            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-200"
                    placeholder="contoh@domain.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-200"
                    placeholder="Masukkan password">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition">
                MASUK
            </button>
        </form>
    </div>

</body>

</html>
