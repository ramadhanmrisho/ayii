<aside class="fixed inset-y-0 left-0 z-30 flex w-80 -translate-x-full bg-white shadow-xl ring-1 ring-slate-200 transition lg:static lg:translate-x-0 lg:shadow-none" :class="{ 'translate-x-0': sidebar }">
    <div class="flex w-16 flex-col items-center bg-ayii-navy py-4 text-white">
        <a href="{{ route('admin.dashboard') }}" class="mb-8 grid h-10 w-10 place-items-center rounded-md bg-ayii-orange font-display text-lg font-extrabold text-ayii-navy">A</a>
        @php
            $modules = [
                ['CMS', 'M3 5h18M3 12h18M3 19h18'],
                ['Catalog', 'M4 7h16v10H4z M8 7V5h8v2'],
                ['Sales', 'M5 19V5m5 14V9m5 10v-6m5 6V8'],
                ['Media', 'M4 6h16v12H4z M8 14l2-2 3 3 3-4 4 5'],
                ['Users', 'M16 21v-2a4 4 0 0 0-8 0v2 M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8'],
                ['Settings', 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8 M4 12h2m12 0h2M12 4v2m0 12v2'],
            ];
        @endphp
        <div class="flex flex-1 flex-col items-center gap-3">
            @foreach ($modules as [$label, $path])
                <a href="{{ route('admin.dashboard') }}" class="group grid place-items-center gap-1 text-center text-[11px] font-semibold text-white/80 hover:text-ayii-orange" title="{{ $label }}">
                    <span class="grid h-9 w-9 place-items-center rounded-md border border-white/10 group-hover:border-ayii-orange group-hover:bg-white/10">
                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/></svg>
                    </span>
                    <span>{{ $label }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="flex min-w-0 flex-1 flex-col">
        <div class="flex h-20 items-center justify-between border-b border-slate-200 px-6">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="font-display text-3xl font-extrabold text-ayii-navy">Ayii</a>
                <p class="mt-1 text-sm font-medium text-ayii-orange">Your Partner of Choice</p>
            </div>
            <button class="rounded-md p-2 text-ayii-navy lg:hidden" @click="sidebar = false" aria-label="Close admin menu">×</button>
        </div>
        <nav class="space-y-6 overflow-y-auto px-5 py-6 text-sm">
            @php
                $groups = [
                    'Dashboard' => [['Dashboard', route('admin.dashboard'), 'dashboard.view', 'M4 13h6V4H4v9Zm10 7h6V4h-6v16ZM4 20h6v-4H4v4Z']],
                    'Catalog' => [['Products', route('admin.products.index'), 'products.view', 'M4 7h16v10H4z'], ['Categories', route('admin.categories.index'), 'categories.manage', 'M4 5h7v7H4z M13 5h7v7h-7z M4 14h7v5H4z M13 14h7v5h-7z'], ['Brands', route('admin.brands.index'), 'brands.manage', 'M12 3l8 4v10l-8 4-8-4V7l8-4Z']],
                    'Sales' => [['Quotation Requests', route('admin.rfqs.index'), 'rfqs.view', 'M7 7h10M7 12h10M7 17h6 M5 3h14v18H5z']],
                    'Communication' => [['Enquiries', route('admin.enquiries.index'), 'enquiries.view', 'M4 6h16v12H4z M4 7l8 6 8-6']],
                    'Media' => [['Media Library', route('admin.media.index'), 'media.view', 'M4 6h16v12H4z M8 14l2-2 3 3 3-4 4 5']],
                    'Settings' => [['General', route('admin.settings.edit'), 'settings.manage', 'M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8 M4 12h2m12 0h2M12 4v2m0 12v2']],
                ];
            @endphp
            @foreach ($groups as $group => $links)
                <div>
                    <p class="px-3 text-xs font-bold uppercase text-slate-400">{{ $group }}</p>
                    <div class="mt-2 space-y-1">
                        @foreach ($links as [$label, $url, $permission, $icon])
                            @can($permission)
                                <a href="{{ $url }}" class="flex items-center gap-3 rounded-md px-3 py-2.5 font-semibold text-slate-700 hover:bg-ayii-orange/10 hover:text-ayii-navy">
                                    <svg aria-hidden="true" class="h-5 w-5 text-ayii-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                                    {{ $label }}
                                </a>
                            @endcan
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>
    </div>
</aside>
