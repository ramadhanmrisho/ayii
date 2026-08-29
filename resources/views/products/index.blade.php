<x-layouts.app title="Product Catalogue - Ayii">
    @php
        $selectedCategory = $categories->firstWhere('slug', request('category'));
        $totalPublished = $categories->sum('products_count');
    @endphp

    <section class="bg-ayii-navy px-4 py-10 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <nav class="text-sm text-slate-300" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-ayii-orange">Home</a>
                <span class="mx-2 text-slate-500">/</span>
                <span class="font-semibold text-ayii-orange">Products</span>
            </nav>
            <h1 class="mt-5 font-display text-4xl font-extrabold">Product Catalogue</h1>
            <p class="mt-3 max-w-3xl text-base leading-7 text-slate-300">Browse Ayii's full range of electronics, ICT equipment, appliances, power solutions and assistive technologies.</p>
        </div>
    </section>

    <section class="bg-ayii-off-white px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[17rem_1fr]">
            <aside class="h-fit rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <h2 class="font-display text-lg font-bold">Filters</h2>
                    <span class="grid h-6 w-6 place-items-center rounded-full bg-ayii-orange text-xs font-bold text-ayii-navy">{{ request()->hasAny(['category', 'brand', 'search']) ? 1 : 0 }}</span>
                </div>

                <div class="mt-6">
                    <p class="text-xs font-bold uppercase tracking-normal text-ayii-navy">Categories</p>
                    <div class="mt-4 space-y-1">
                        <a href="{{ route('products.index', request()->except('category')) }}" class="flex items-center justify-between rounded-md px-3 py-2 text-sm font-semibold {{ request('category') ? 'text-ayii-navy hover:bg-ayii-orange/10' : 'bg-ayii-orange text-ayii-navy' }}">
                            <span>All Categories</span>
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs">{{ $totalPublished }}</span>
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}" class="flex items-center justify-between rounded-md px-3 py-2 text-sm font-semibold {{ request('category') === $category->slug ? 'bg-ayii-orange text-ayii-navy' : 'text-ayii-navy hover:bg-ayii-orange/10' }}">
                                <span class="truncate">{{ $category->name }}</span>
                                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs">{{ $category->products_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="mt-7 border-t border-slate-200 pt-6">
                    <p class="text-xs font-bold uppercase tracking-normal text-ayii-navy">Brands</p>
                    <form method="GET" class="mt-4 space-y-3">
                        @foreach (request()->except(['brand', 'page']) as $key => $value)
                            @if (is_array($value))
                                @foreach ($value as $nestedValue)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $nestedValue }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        @foreach ($brands as $brand)
                            <label class="flex items-center justify-between gap-3 text-sm">
                                <span class="flex min-w-0 items-center gap-3">
                                    <input type="checkbox" name="brand[]" value="{{ $brand->slug }}" @checked($selectedBrands->contains($brand->slug)) onchange="this.form.submit()" class="rounded border-slate-300 text-ayii-orange focus:ring-ayii-orange">
                                    <span class="truncate">{{ $brand->name }}</span>
                                </span>
                                <span class="text-xs text-slate-500">{{ $brand->products_count }}</span>
                            </label>
                        @endforeach
                    </form>
                </div>
            </aside>

            <div>
                <form method="GET" class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    @foreach ($selectedBrands as $brand)
                        <input type="hidden" name="brand[]" value="{{ $brand }}">
                    @endforeach
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="grid gap-3 md:grid-cols-[1fr_11rem_auto_auto]">
                        <label class="relative">
                            <span class="sr-only">Search products</span>
                            <svg aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/></svg>
                            <input name="search" value="{{ request('search') }}" placeholder="Search products, brands, SKUs..." class="w-full rounded-md border border-slate-300 py-3 pl-11 pr-4 text-sm focus:border-ayii-orange focus:outline-none focus:ring-2 focus:ring-ayii-orange/20">
                        </label>
                        <select name="sort" onchange="this.form.submit()" class="rounded-md border border-slate-300 px-4 py-3 text-sm font-medium focus:border-ayii-orange focus:outline-none focus:ring-2 focus:ring-ayii-orange/20">
                            <option value="newest">Newest First</option>
                            <option value="featured" @selected(request('sort') === 'featured')>Featured</option>
                            <option value="name_az" @selected(request('sort') === 'name_az')>Name A-Z</option>
                            <option value="name_za" @selected(request('sort') === 'name_za')>Name Z-A</option>
                        </select>
                        <div class="flex rounded-md border border-slate-300 p-1">
                            <button type="button" class="grid h-10 w-10 place-items-center rounded bg-ayii-navy text-white" aria-label="Grid view">
                                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/></svg>
                            </button>
                            <button type="button" class="grid h-10 w-10 place-items-center rounded text-slate-500" aria-label="List view">
                                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-end whitespace-nowrap px-2 text-sm font-medium text-slate-600">{{ $products->total() }} products found</div>
                    </div>
                </form>

                @if ($selectedCategory || $selectedBrands->isNotEmpty() || request('search'))
                    <div class="mt-5 flex flex-wrap gap-3">
                        @if ($selectedCategory)
                            <a href="{{ route('products.index', request()->except(['category', 'page'])) }}" class="inline-flex items-center gap-2 rounded-full bg-ayii-navy px-4 py-2 text-sm font-semibold text-white">{{ $selectedCategory->name }} <span aria-hidden="true">×</span></a>
                        @endif
                        @foreach ($selectedBrands as $brandSlug)
                            @php($brand = $brands->firstWhere('slug', $brandSlug))
                            @if ($brand)
                                <a href="{{ route('products.index', array_merge(request()->except(['brand', 'page']), ['brand' => $selectedBrands->reject(fn ($slug) => $slug === $brandSlug)->values()->all()])) }}" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-ayii-navy ring-1 ring-slate-200">{{ $brand->name }} <span aria-hidden="true">×</span></a>
                            @endif
                        @endforeach
                        @if (request('search'))
                            <a href="{{ route('products.index', request()->except(['search', 'page'])) }}" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-ayii-navy ring-1 ring-slate-200">Search: {{ request('search') }} <span aria-hidden="true">×</span></a>
                        @endif
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-full bg-slate-200 px-4 py-2 text-sm font-semibold text-ayii-navy">Clear all</a>
                    </div>
                @endif

                <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="rounded-lg bg-white p-10 text-center shadow-sm ring-1 ring-slate-200 md:col-span-2 xl:col-span-3">
                            <h2 class="font-display text-2xl font-bold text-ayii-navy">No products match your search.</h2>
                            <p class="mt-3 text-slate-600">Adjust filters or request a custom quotation from Ayii.</p>
                            <x-button :href="route('quote.index')" class="mt-6">Request a Quote</x-button>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">{{ $products->links() }}</div>
            </div>
        </div>
    </section>
</x-layouts.app>
