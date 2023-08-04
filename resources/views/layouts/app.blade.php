<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>M-Assistance | Weather</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.topbar')
    <div class="logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
    </div>
    @yield('content')
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>