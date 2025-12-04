<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Posyandu Digital - Realtime</title>
    @include('layouts.css')
    {{-- START: CUT & PASTE KE resources/views/partials/_header.blade.php --}}
    @include('layouts.header')
    {{-- END: CUT & PASTE KE resources/views/partials/_header.blade.php --}}

</head>

<body class="p-4 md:p-8">

    {{-- START: INI ADALAH FILE resources/views/index.blade.php --}}
    {{-- BARIS DI ATAS BARIS INI AKAN MENJADI resources/views/layouts/app.blade.php (Bagian atas) --}}

    @yield('content')
    {{-- BARIS DI ATAS BARIS INI ADALAH BAGIAN KONTEN UTAMA (YANG AKAN DIMASUKKAN KE @yield('content') DI app.blade.php) --}}
    {{-- END: INI ADALAH FILE resources/views/index.blade.php --}}


    {{-- START: CUT & PASTE KE resources/views/partials/_footer_js.blade.php --}}
    @include('layouts.js')
    @include('layouts.footer')
    {{-- END: CUT & PASTE KE resources/views/partials/_footer_js.blade.php --}}

</body>

</html>
