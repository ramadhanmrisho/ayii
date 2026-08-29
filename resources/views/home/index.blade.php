<x-layouts.app>
    @php
        $asset = fn (string $name) => asset("build/image/{$name}");
        $categoryCards = [
            ['Computers & Laptops', 'ICT & Computing', 'laptop.jpg'],
            ['Printers & Scanners', 'Office & Institutional Equipment', 'printer.png'],
            ['Security Systems', 'Networking & Communication', 'cctv.png'],
            ['Networking Solutions', 'Networking & Communication', 'switch.png'],
            ['Home Electronics', 'Consumer Electronics', 'tv.png'],
            ['Power Solutions', 'Power & Generators', 'generator.png'],
        ];
        $trust = [
            ['Quality Products', 'We source from trusted global brands to ensure durability.', 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z M9 12l2 2 4-5'],
            ['Reliable Supply', 'Timely delivery and consistent stock availability.', 'M3 7h11v8H3z M14 10h3l3 3v2h-6z M7 19a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z M17 19a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z'],
            ['Competitive Pricing', 'Affordable solutions without compromising quality.', 'M20 12 12 20 4 12l8-8 8 8Z M12 8h.01'],
            ['Professional Support', 'Our team is always ready to support your needs.', 'M4 13v-1a8 8 0 1 1 16 0v1 M6 13h2v5H6z M16 13h2v5h-2z M9 19h6'],
        ];
        $serviceHighlights = [
            ['Trusted Brands', 'Quality products from global leaders', 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z M9 12l2 2 4-5'],
            ['Nationwide Delivery', 'Fast and secure delivery across Tanzania', 'M3 7h11v8H3z M14 10h3l3 3v2h-6z'],
            ['After Sales Service', 'Installation, maintenance and technical support', 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8 M4 12h2m12 0h2M12 4v2m0 12v2'],
            ['Custom Solutions', 'Tailored solutions for your business needs', 'M16 11a4 4 0 1 0-8 0 M4 21a8 8 0 0 1 16 0'],
        ];
        $slideAsset = fn (string $name) => asset("build/slides/{$name}");
        $heroSlides = [
            ['banner1.jpeg', 'Ayii technology solutions banner'],
            ['banner2.jpeg', 'Ayii product supply banner'],
            ['banner1.jpeg', 'Ayii ICT and electronics banner'],
            ['banner4.jpeg', 'Ayii business solutions banner'],
            ['banner1.jpeg', 'Ayii service delivery banner'],
        ];
    @endphp

    <section class="relative overflow-hidden bg-ayii-navy pt-10 pb-2 text-white">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 30%, #F5A623 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="grid min-h-[520px] w-full items-center lg:grid-cols-12">
            <div class="relative z-10 min-h-[360px] lg:col-span-12 lg:min-h-[500px]">
                <div class="ayii-hero-carousel relative h-full overflow-hidden border-b-[10px] border-ayii-orange bg-ayii-navy shadow-2xl lg:min-h-[500px]">
                    @foreach ($heroSlides as [$image, $alt])
                        <div class="ayii-hero-slide absolute inset-0">
                            <img src="{{ $slideAsset($image) }}" alt="{{ $alt }}" class="h-full w-full object-contain">
                        </div>
                    @endforeach

                    <div class="absolute bottom-5 right-5 flex gap-2" aria-label="Hero image carousel controls">
                        @foreach ($heroSlides as $slide)
                            <span class="ayii-hero-dot h-2.5 rounded-full bg-white/80"></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#1B2430] px-2 py-2 sm:px-6 lg:px-4">
        <div class="w-full">
            <div class="text-center">
                <h2 class="font-display text-2xl font-extrabold uppercase text-white">Shop By Category</h2>
                <span class="mx-auto mt-3 block h-1 w-14 bg-ayii-orange"></span>
            </div>
            <div class="mt-8 overflow-hidden">
                <div class="ayii-category-marquee flex w-max gap-5 py-2 hover:[animation-play-state:paused]">
                    @for ($loopIndex = 0; $loopIndex < 2; $loopIndex++)
                        @foreach ($categoryCards as [$label, $categoryName, $image])
                            @php($category = $categories->firstWhere('name', $categoryName))
                            <article class="w-[17rem] shrink-0 rounded-md border border-slate-200 bg-white p-4 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                <a href="{{ route('products.index', $category ? ['category' => $category->slug] : []) }}" class="mb-4 inline-flex w-full items-center justify-center gap-2 rounded-md bg-ayii-orange px-3 py-2 text-xs font-extrabold uppercase text-ayii-navy transition hover:bg-[#d98f12]">
                                    View Products <span aria-hidden="true">→</span>
                                </a>
                                <div class="grid h-28 place-items-center">
                                    <img src="{{ $asset($image) }}" alt="{{ $label }}" class="max-h-24 w-full object-contain">
                                </div>
                                <h3 class="mt-3 min-h-10 font-display text-sm font-bold text-ayii-navy">{{ $label }}</h3>
                            </article>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <section class="bg-ayii-orange py-7">
        @php($marqueeItems = collect($trust)->merge($serviceHighlights))
        <div class="w-full overflow-hidden bg-white shadow-sm ring-1 ring-slate-200">
            <div class="ayii-marquee flex w-max gap-0 py-3 hover:[animation-play-state:paused]">
                @for ($loopIndex = 0; $loopIndex < 2; $loopIndex++)
                    @foreach ($marqueeItems as [$title, $copy, $icon])
                        <article class="flex w-[22rem] shrink-0 items-center gap-5 border-r border-slate-200 px-6 py-3">
                            <span class="grid h-16 w-16 shrink-0 place-items-center rounded-full bg-ayii-orange/10 text-ayii-orange">
                                <svg aria-hidden="true" class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                            </span>
                            <div>
                                <h2 class="font-display text-lg font-bold text-ayii-navy">{{ $title }}</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-600">{{ $copy }}</p>
                            </div>
                        </article>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-14 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-bold uppercase text-ayii-orange">Featured Products</p>
                    <h2 class="mt-2 font-display text-3xl font-extrabold text-ayii-navy">Ready for Homes, Businesses and Institutions</h2>
                </div>
                <x-button :href="route('products.index')" variant="secondary">View Catalogue</x-button>
            </div>
            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($products->take(3) as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="col-span-full rounded-md bg-ayii-off-white p-6 text-center text-slate-600">Featured products will appear here after they are published in the CMS.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.app>
