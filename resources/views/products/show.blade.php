<x-layouts.app :title="$product->seo_title ?: $product->name">
    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2">
            <div x-data="{ image: '{{ $product->images->first()?->path }}' }">
                <div class="aspect-square rounded-md bg-ayii-off-white">
                    @if ($product->images->isNotEmpty())
                        <img :src="'/storage/' + image" alt="{{ $product->name }}" class="h-full w-full rounded-md object-cover">
                    @else
                        <div class="grid h-full place-items-center font-display text-3xl font-bold">{{ $product->name }}</div>
                    @endif
                </div>
                <div class="mt-4 grid grid-cols-5 gap-3">
                    @foreach ($product->images as $image)
                        <button @click="image = '{{ $image->path }}'" class="aspect-square rounded-md border border-slate-200 bg-white">
                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->alt_text ?: $product->name }}" class="h-full w-full rounded-md object-cover">
                        </button>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="text-sm font-bold uppercase text-ayii-orange">{{ $product->category?->name }}</p>
                <h1 class="mt-3 font-display text-4xl font-extrabold">{{ $product->name }}</h1>
                <div class="mt-5 grid gap-2 text-sm text-slate-600">
                    <p><strong>Brand:</strong> {{ $product->brand?->name ?: 'Not specified' }}</p>
                    <p><strong>Model:</strong> {{ $product->model ?: 'Not specified' }}</p>
                    <p><strong>Availability:</strong> {{ $product->availability }}</p>
                    <p><strong>Warranty:</strong> {{ $product->warranty ?: 'Contact Ayii' }}</p>
                </div>
                <p class="mt-6 leading-7 text-slate-700">{{ $product->description ?: $product->short_description }}</p>
                @if ($product->key_features)
                    <ul class="mt-6 list-disc space-y-2 pl-5 text-slate-700">
                        @foreach ($product->key_features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-8 flex flex-wrap gap-3">
                    <form method="POST" action="{{ route('quote.add', $product) }}">
                        @csrf
                        <x-button type="submit">Request a Quote</x-button>
                    </form>
                    @php
                        $whatsapp = preg_replace('/\D+/', '', $settings->get('contact.whatsapp', ''));
                        $productLabel = trim("{$product->name} {$product->model}");
                        $whatsappMessage = rawurlencode("Hello Ayii, I would like more information/a quotation for {$productLabel}.");
                        $whatsappUrl = $whatsapp ? "https://wa.me/{$whatsapp}?text={$whatsappMessage}" : null;
                    @endphp
                    @if ($whatsappUrl)
                        <x-button href="{{ $whatsappUrl }}" variant="secondary">WhatsApp Us</x-button>
                    @endif
                </div>
                @if ($product->specifications->isNotEmpty())
                    <div class="mt-10">
                        <h2 class="font-display text-2xl font-bold">Specifications</h2>
                        <dl class="mt-4 divide-y divide-slate-200 rounded-md border border-slate-200">
                            @foreach ($product->specifications as $specification)
                                <div class="grid gap-2 p-4 sm:grid-cols-3">
                                    <dt class="font-semibold">{{ $specification->name }}</dt>
                                    <dd class="sm:col-span-2">{{ $specification->value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if ($whatsappUrl)
        <a href="{{ $whatsappUrl }}" class="fixed bottom-6 right-6 z-30 grid h-14 w-14 place-items-center rounded-full bg-green-500 text-white shadow-xl shadow-green-500/30 transition hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500" aria-label="Request product information on WhatsApp">
            <svg aria-hidden="true" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2a9.86 9.86 0 0 0-8.5 14.83L2.3 22l5.31-1.2A9.87 9.87 0 1 0 12.04 2Zm5.74 14.15c-.24.68-1.4 1.3-1.96 1.38-.5.08-1.13.12-1.82-.12-.42-.13-.96-.31-1.65-.61-2.9-1.25-4.78-4.15-4.92-4.34-.14-.2-1.18-1.57-1.18-2.99 0-1.43.75-2.13 1.01-2.42.27-.3.58-.37.77-.37h.56c.18.01.42-.07.66.5.24.58.82 2.01.89 2.16.07.14.12.32.02.51-.09.2-.14.32-.29.5-.14.17-.3.38-.43.51-.14.14-.29.3-.12.58.17.29.75 1.23 1.6 1.99 1.1.98 2.03 1.29 2.32 1.43.29.15.46.12.63-.07.17-.2.72-.84.91-1.13.19-.29.39-.24.66-.15.26.1 1.68.8 1.97.94.29.15.48.22.55.34.08.12.08.7-.16 1.38Z"/></svg>
        </a>
    @endif
</x-layouts.app>
