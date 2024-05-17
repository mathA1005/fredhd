<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-white">
<!-- Sidebar -->
<div class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen fixed top-0 h-full">
    <div class="p-4">
        <!-- Logo -->
        <a class="text-xl font-semibold text-gray-900 dark:text-white" href="{{ url('/admin') }}">
            <img src="{{ asset('storage/picture/fred.png') }}" alt="Admin" class="inline-block h-26 w-26 mr-2">
        </a>
        <!-- End Logo -->
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ url('admin') }}"
           class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            Dashboard
        </a>
        <a href="{{ url('/admin/rooms/') }}"
           class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            Rooms
        </a>
        <a href="{{ url('/admin/options') }}"
           class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            Options
        </a>
        <a href="{{ url('/admin/faqs') }}"
           class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            FAQS
        </a>
        <a href="{{ url('admin/contacts') }}"
           class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg">
            Contacts
        </a>
        <!-- Ajoutez d'autres liens ici -->
    </nav>
</div>

<!-- Main Content -->
<div class="flex-1 p-4 ml-64">
    @yield('content')
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
</body>
</html>
