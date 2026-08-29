@props(['product'])

<article class="group flex h-full flex-col overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">
    <div class="relative aspect-[16/10] overflow-hidden bg-ayii-off-white">
        <a href="{{ route('products.show', $product) }}" class="block h-full">
            @if ($product->primaryImage)
                <img src="{{ Storage::url($product->primaryImage->path) }}" alt="{{ $product->primaryImage->alt_text ?: $product->name }}" class="h-full w-full object-cover" loading="lazy">
            @else
                <div class="flex h-full items-center justify-center px-6 text-center font-display text-lg font-bold text-slate-500">{{ $product->name }}</div>
            @endif
        </a>
        @if ($product->featured)
            <span class="absolute left-4 top-4 rounded-full bg-ayii-orange px-3 py-1 text-xs font-extrabold uppercase text-ayii-navy shadow-sm">Featured</span>
        @endif
        <span class="absolute right-4 top-4 rounded-full px-3 py-1 text-sm font-bold shadow-sm {{ $product->quote_only ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }}">
            {{ $product->quote_only ? 'Quote Only' : $product->availability }}
        </span>
        @if ($product->is_new)
            <span class="absolute left-4 top-4 rounded-full bg-ayii-navy px-3 py-1 text-xs font-extrabold uppercase text-white shadow-sm {{ $product->featured ? 'translate-y-9' : '' }}">New</span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-5">
        <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
            <span class="rounded-full bg-slate-100 px-3 py-1 font-semibold text-slate-600">{{ $product->brand?->name ?: 'Ayii' }}</span>
            <span aria-hidden="true">·</span>
            <span class="font-medium">{{ $product->category?->name }}</span>
        </div>
        <a href="{{ route('products.show', $product) }}" class="mt-3 block">
            <h3 class="font-display text-xl font-bold leading-snug text-ayii-navy">{{ $product->name }}</h3>
        </a>
        @if ($product->model)
            <p class="mt-2 text-sm text-slate-500">Model: {{ $product->model }}</p>
        @endif
        <p class="mt-3 line-clamp-2 min-h-12 text-base leading-6 text-slate-600">{{ $product->short_description }}</p>

        <div class="mt-auto grid grid-cols-2 gap-3 pt-6">
            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center gap-2 rounded-md border-2 border-ayii-navy px-4 py-3 text-sm font-extrabold text-ayii-navy transition hover:bg-ayii-navy hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ayii-navy">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
                Details
            </a>
            <form method="POST" action="{{ route('quote.add', $product) }}">
                @csrf
                <button class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-ayii-orange px-4 py-3 text-sm font-extrabold text-ayii-navy transition hover:bg-[#d98f12] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ayii-orange">
                    <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14 M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/></svg>
                    Add Quote
                </button>
            </form>
        </div>
    </div>
</article>
