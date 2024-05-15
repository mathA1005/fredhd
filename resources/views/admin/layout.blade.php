<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-white">
<!-- Sidebar -->
<div class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen">
    <div class="p-4">
        <!-- Logo -->
        <a class="text-xl font-semibold text-gray-900 dark:text-white" href="{{ url('/admin') }}">
            Admin
        </a>
        <!-- End Logo -->
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ url('admin') }}" class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2 4 4 8-8 5 5"></path>
            </svg>
            Dashboard
        </a>
        <a href="{{ url('/admin/rooms/') }}" class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4.002 4.002 0 019 15h6a4.002 4.002 0 013.879 2.804M9 7h6M5 11h14"></path>
            </svg>
            Rooms
        </a>
        <a href="{{ url('/admin/options') }}" class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0-6v2m6.364-2.364L18.364 15m0-6.364L15 9M12 3v2m0 6v2m6.364 2.364L18.364 15m0-6.364L15 9M12 3v2m0 6v2m-6.364-2.364L5.636 9m0 6.364L9 15M3 12h18"></path>
            </svg>
            Options
        </a>
        <a href="{{ url('/admin/faqs') }}" class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0-6v2m6.364-2.364L18.364 15m0-6.364L15 9M12 3v2m0 6v2m6.364 2.364L18.364 15m0-6.364L15 9M12 3v2m0 6v2m-6.364-2.364L5.636 9m0 6.364L9 15M3 12h18"></path>
            </svg>
            FAQS
        </a>
        <!-- Ajoutez d'autres liens ici -->
    </nav>
</div>

<!-- Main Content -->
<div class="flex-1 p-4">
    @yield('content')
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>
