<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Desa</title>

    {{-- Auto Load CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/volt.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/notyf.min.css') }}">
</head>

<body class="bg-light">

    <main class="vh-100 d-flex align-items-center justify-content-center">
        @yield('content')
    </main>

    {{-- Auto Load JS --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/notyf.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

</body>
</html>
