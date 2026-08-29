@props(['category'])

<a href="{{ route('products.index', ['category' => $category->slug]) }}" class="rounded-md bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-md">
    <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-ayii-orange/15 text-ayii-orange">
        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </span>
    <h3 class="mt-4 font-display text-lg font-bold text-ayii-navy">{{ $category->name }}</h3>
    <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">{{ $category->description }}</p>
</a>
