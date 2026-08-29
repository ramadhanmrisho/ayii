<header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
        <button class="rounded-md p-2 text-ayii-navy lg:hidden" @click="sidebar = true" aria-label="Open admin menu">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <div>
            <p class="text-xs font-bold uppercase text-ayii-orange">Administration CMS</p>
            <p class="font-display text-lg font-bold">Ayii Corporate Website</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="hidden rounded-md border border-slate-200 px-3 py-2 text-sm font-semibold hover:border-ayii-orange hover:text-ayii-orange sm:inline-flex">View Website</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="rounded-md bg-ayii-navy px-3 py-2 text-sm font-semibold text-white hover:bg-black">Logout</button>
            </form>
        </div>
    </div>
</header>
