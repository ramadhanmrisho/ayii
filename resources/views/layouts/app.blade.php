<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @inject('settings', 'App\Services\Settings')
    <title>{{ $title ?? $settings->get('seo.default_title', 'Ayii') }}</title>
    <meta name="description" content="{{ $description ?? $settings->get('seo.default_meta_description', '') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? $settings->get('seo.default_title', 'Ayii') }}">
    <meta property="og:description" content="{{ $description ?? $settings->get('seo.default_meta_description', '') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <script>
        window.ayiiFlash = {
            success: @json(session('status')),
        };
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased">
    <x-navbar />
    <main>
        {{ $slot }}
    </main>
    @php
        $whatsapp = preg_replace('/\D+/', '', $settings->get('contact.whatsapp', ''));
        $whatsappMessage = rawurlencode('Hello Ayii, I would like');
        $whatsappUrl = $whatsapp ? "https://wa.me/{$whatsapp}?text={$whatsappMessage}" : null;
    @endphp
    @if ($whatsappUrl && ! request()->routeIs('products.show'))
        <a href="{{ $whatsappUrl }}" class="fixed bottom-6 right-6 z-30 grid h-14 w-14 place-items-center rounded-full bg-green-500 text-white shadow-xl shadow-green-500/30 transition hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500" aria-label="Contact Ayii on WhatsApp">
            <svg aria-hidden="true" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2a9.86 9.86 0 0 0-8.5 14.83L2.3 22l5.31-1.2A9.87 9.87 0 1 0 12.04 2Zm5.74 14.15c-.24.68-1.4 1.3-1.96 1.38-.5.08-1.13.12-1.82-.12-.42-.13-.96-.31-1.65-.61-2.9-1.25-4.78-4.15-4.92-4.34-.14-.2-1.18-1.57-1.18-2.99 0-1.43.75-2.13 1.01-2.42.27-.3.58-.37.77-.37h.56c.18.01.42-.07.66.5.24.58.82 2.01.89 2.16.07.14.12.32.02.51-.09.2-.14.32-.29.5-.14.17-.3.38-.43.51-.14.14-.29.3-.12.58.17.29.75 1.23 1.6 1.99 1.1.98 2.03 1.29 2.32 1.43.29.15.46.12.63-.07.17-.2.72-.84.91-1.13.19-.29.39-.24.66-.15.26.1 1.68.8 1.97.94.29.15.48.22.55.34.08.12.08.7-.16 1.38Z"/></svg>
        </a>
    @endif
    <x-footer />
</body>
</html>
