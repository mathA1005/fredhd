<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{-- mettre un app de variable dans le title --}}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-full">
@if (Session::has('error'))
    <x-notifications.toast type="error"/>
@endif
@if (Session::has('success'))
    <x-notifications.toast type="success"/>
@endif
<x-nav.nav/>

<!-- Page Content -->
<main class="w-full">
    @yield('content')
</main>

<x-footer/>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>
