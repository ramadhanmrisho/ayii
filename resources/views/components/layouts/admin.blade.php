<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Ayii Admin' }}</title>
    <script>
        window.ayiiFlash = {
            success: @json(session('status')),
        };
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ayii-off-white font-sans text-ayii-navy antialiased">
    <div x-data="{ sidebar: false }" class="min-h-screen lg:flex">
        @include('admin.partials.sidebar')
        <div class="min-w-0 flex-1">
            @include('admin.partials.header')
            <main class="px-4 py-6 sm:px-6 lg:px-8">
                <x-alert />
                <div class="mt-4">{{ $slot }}</div>
            </main>
        </div>
    </div>
</body>
</html>
