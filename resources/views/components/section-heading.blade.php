@props(['eyebrow' => null, 'title', 'description' => null])

<div {{ $attributes->merge(['class' => 'mx-auto max-w-3xl text-center']) }}>
    @if ($eyebrow)
        <p class="mb-3 text-sm font-bold uppercase text-ayii-orange">{{ $eyebrow }}</p>
    @endif
    <h2 class="font-display text-3xl font-extrabold text-ayii-navy md:text-4xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-4 text-base leading-7 text-slate-600">{{ $description }}</p>
    @endif
</div>
