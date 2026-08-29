@inject('settings', 'App\Services\Settings')

<header x-data="{ open: false }" class="bg-white shadow-sm">
    <div class="bg-ayii-navy text-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-2 text-sm sm:px-6 lg:px-8">
            <span class="inline-flex items-center gap-2 font-semibold">
                <svg aria-hidden="true" class="h-4 w-4 text-ayii-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 2l2 5 5 .5-3.8 3.4 1.1 5.1L12 13.4 7.7 16l1.1-5.1L5 7.5 10 7l2-5Z"/></svg>
                {{ $settings->get('general.tagline', 'Your Partner of Choice') }}
            </span>
            <span class="flex flex-wrap items-center gap-4">
                <span class="inline-flex items-center gap-2"><svg aria-hidden="true" class="h-4 w-4 text-ayii-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.7.6 2.5a2 2 0 0 1-.4 2.1L8 9.6a16 16 0 0 0 6.4 6.4l1.3-1.3a2 2 0 0 1 2.1-.4 12 12 0 0 0 2.5.6 2 2 0 0 1 1.7 2Z"/></svg>{{ $settings->get('contact.phone') }}</span>
                <span class="hidden h-4 w-px bg-white/40 sm:block"></span>
                <span class="inline-flex items-center gap-2"><svg aria-hidden="true" class="h-4 w-4 text-ayii-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z M4 7l8 6 8-6"/></svg>{{ $settings->get('contact.email') }}</span>
            </span>
        </div>
    </div>
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8" aria-label="Main navigation">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('build/image/logo.png') }}" alt="Ayii logos" class="h-20 w-39 object-contain object-left">
        </a>
        <button class="rounded-md p-2 text-ayii-navy md:hidden" @click="open = ! open" aria-label="Toggle navigation">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <div class="hidden items-center gap-4 text-sm font-bold md:flex">
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('home') }}">
                <svg
                    aria-hidden="true"
                    class="h-5 w-5 text-[#1B2430]"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round" >
                    <path d="M3 10.5 12 3l9 7.5" />
                    <path d="M5 9.5V21h14V9.5" />
                    <path d="M9 21v-7h6v7" />
                </svg>
                Home</a>
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('about.index') }}"><svg aria-hidden="true" class="h-5 w-5 text-[#1B2430]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M16 11a4 4 0 1 0-8 0M4 21a8 8 0 0 1 16 0"/></svg>About Us</a>
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('products.index') }}"><svg aria-hidden="true" class="h-5 w-5 text-[#1B2430]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M12 3 4 7v10l8 4 8-4V7l-8-4Z M4 7l8 4 8-4 M12 11v10"/></svg>Products</a>
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('solutions.index') }}"><svg aria-hidden="true" class="h-5 w-5 text-[#1B2430]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M9 18h6M10 22h4M12 2a7 7 0 0 0-4 12c1 .8 1.5 1.6 1.7 3h4.6c.2-1.4.7-2.2 1.7-3A7 7 0 0 0 12 2Z"/></svg>Solutions</a>
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('projects.index') }}"><svg aria-hidden="true" class="h-5 w-5 text-[#1B2430]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M10 6V4h4v2h6v14H4V6h6Z M4 11h16"/></svg>Projects</a>
            <a class="inline-flex items-center gap-2 rounded-md bg-[#F5A623] px-4 py-3 text-white transition hover:bg-[#d98f12]" href="{{ route('contact.index') }}"><svg aria-hidden="true" class="h-5 w-5 text-[#1B2430]" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/></svg>Contact</a>
            <x-button :href="route('quote.index')" class="!text-white">Request a Quote <span aria-hidden="true">→</span></x-button>
        </div>
    </nav>
    <div x-show="open" x-cloak class="border-t border-slate-200 bg-ayii-orange px-4 py-4 md:hidden">
        <div class="grid gap-3 text-sm font-semibold">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about.index') }}">About Us</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('solutions.index') }}">Solutions</a>
            <a href="{{ route('projects.index') }}">Projects</a>
            <a href="{{ route('contact.index') }}">Contact</a>
            <x-button :href="route('quote.index')">Request a Quote</x-button>
        </div>
    </div>
</header>
