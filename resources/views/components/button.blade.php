@props(['href' => null, 'variant' => 'primary', 'type' => 'button'])

@php
    $classes = [
        'primary' => 'bg-ayii-orange text-ayii-navy hover:bg-[#d98f12] focus-visible:outline-ayii-orange',
        'navy' => 'bg-ayii-navy text-white hover:bg-black focus-visible:outline-ayii-navy',
        'secondary' => 'border border-ayii-navy text-ayii-navy hover:bg-ayii-navy hover:text-white focus-visible:outline-ayii-navy',
        'ghost' => 'text-ayii-navy hover:text-ayii-orange focus-visible:outline-ayii-orange',
    ][$variant] ?? '';
@endphp

@if ($href)
    <a {{ $attributes->merge(['href' => $href, 'class' => "inline-flex items-center justify-center gap-2 rounded-md px-5 py-3 text-sm font-bold uppercase tracking-normal transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 {$classes}"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => "inline-flex items-center justify-center gap-2 rounded-md px-5 py-3 text-sm font-bold uppercase tracking-normal transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 {$classes}"]) }}>
        {{ $slot }}
    </button>
@endif
