<x-layouts.admin title="Ayii Admin Dashboard">
    @php
        $totalProducts = $counts['Total Products'] ?? 0;
        $activeProducts = $counts['Active Products'] ?? 0;
        $newRfqs = $counts['New RFQs'] ?? 0;
        $pendingRfqs = $counts['Pending RFQs'] ?? 0;
        $completedRfqs = $counts['Completed RFQs'] ?? 0;
        $enquiries = $counts['Enquiries'] ?? 0;
        $activeRatio = $totalProducts > 0 ? round(($activeProducts / $totalProducts) * 100, 1) : 0;
        $rfqTotal = max(1, $newRfqs + $pendingRfqs + $completedRfqs);
        $maxCount = max(1, ...array_values($counts));
        $topTiles = [
            ['All Products', $totalProducts, 'M4 7h16v10H4z M8 7V5h8v2', 'border-l-ayii-orange', 'bg-ayii-orange/10 text-ayii-orange'],
            ['Active Products', $activeProducts, 'M5 13l4 4L19 7', 'border-l-emerald-600', 'bg-emerald-50 text-emerald-700'],
            ['New RFQs', $newRfqs, 'M7 7h10M7 12h10M7 17h6 M5 3h14v18H5z', 'border-l-ayii-orange', 'bg-ayii-orange/10 text-ayii-orange'],
            ['Pending RFQs', $pendingRfqs, 'M12 6v6l4 2 M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z', 'border-l-slate-400', 'bg-slate-100 text-slate-600'],
            ['Completed RFQs', $completedRfqs, 'M5 13l4 4L19 7', 'border-l-emerald-600', 'bg-emerald-50 text-emerald-700'],
            ['Enquiries', $enquiries, 'M4 6h16v12H4z M4 7l8 6 8-6', 'border-l-ayii-navy', 'bg-ayii-navy/10 text-ayii-navy'],
        ];
        $workloadRows = [
            ['Products', $totalProducts],
            ['Categories', $counts['Categories'] ?? 0],
            ['Brands', $counts['Brands'] ?? 0],
            ['Projects', $counts['Projects'] ?? 0],
            ['RFQs', $newRfqs + $pendingRfqs + $completedRfqs],
            ['Enquiries', $enquiries],
            ['Testimonials', $counts['Testimonials'] ?? 0],
            ['Subscribers', $counts['Subscribers'] ?? 0],
        ];
    @endphp

    <div class="mb-6 flex flex-col justify-between gap-3 xl:flex-row xl:items-end">
        <div>
            <p class="text-sm font-bold uppercase text-ayii-orange">Ayii CMS</p>
            <h1 class="font-display text-3xl font-extrabold text-ayii-navy">Operations Dashboard</h1>
        </div>
        <p class="text-sm text-slate-500">Live website content, quotation requests and communication overview.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-6">
        @foreach ($topTiles as [$label, $value, $icon, $border, $iconClass])
            <article class="relative overflow-hidden rounded-md border-l-4 {{ $border }} bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="absolute right-4 top-4 grid h-10 w-10 place-items-center rounded-md {{ $iconClass }}">
                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                </div>
                <p class="pr-12 text-xs font-bold uppercase text-slate-500">{{ $label }}</p>
                <p class="mt-2 font-display text-3xl font-extrabold text-ayii-navy">{{ $value }}</p>
            </article>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-md bg-ayii-orange/10 text-ayii-orange">
                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M12 6v6l4 2 M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/></svg>
                    </span>
                    <h2 class="font-display text-lg font-bold">Catalogue Health</h2>
                </div>
                <span class="rounded-full border border-ayii-orange px-3 py-1 text-xs font-bold text-ayii-orange">Live status</span>
            </div>
            <div class="mt-8 grid place-items-center">
                <div class="grid h-48 w-48 place-items-center rounded-full border-[18px] border-ayii-orange bg-white shadow-inner" style="border-top-color:#1B2430;">
                    <div class="text-center">
                        <p class="font-display text-3xl font-extrabold text-ayii-navy">{{ $activeRatio }}%</p>
                        <p class="mt-1 text-xs font-bold uppercase text-slate-500">Active</p>
                        <p class="text-xs text-slate-500">{{ $activeProducts }} of {{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-3 gap-3">
                <div class="rounded-md bg-ayii-off-white p-3">
                    <p class="text-xs font-bold uppercase text-slate-500">Products</p>
                    <p class="mt-1 font-display text-xl font-bold">{{ $totalProducts }}</p>
                </div>
                <div class="rounded-md bg-ayii-off-white p-3">
                    <p class="text-xs font-bold uppercase text-slate-500">Active</p>
                    <p class="mt-1 font-display text-xl font-bold">{{ $activeProducts }}</p>
                </div>
                <div class="rounded-md bg-ayii-off-white p-3">
                    <p class="text-xs font-bold uppercase text-slate-500">Draft</p>
                    <p class="mt-1 font-display text-xl font-bold">{{ max(0, $totalProducts - $activeProducts) }}</p>
                </div>
            </div>
        </section>

        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-md bg-ayii-navy/10 text-ayii-navy">
                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M4 19V5m5 14V9m5 10v-6m5 6V8"/></svg>
                    </span>
                    <h2 class="font-display text-lg font-bold">CMS Workload</h2>
                </div>
                <span class="rounded-full border border-ayii-orange px-3 py-1 text-xs font-bold text-ayii-orange">Records</span>
            </div>
            <div class="mt-8 space-y-4">
                @foreach ($workloadRows as [$label, $value])
                    <div class="grid grid-cols-[8rem_1fr_2rem] items-center gap-3 text-sm">
                        <p class="truncate font-bold text-slate-600">{{ $label }}</p>
                        <div class="h-2 rounded-full bg-slate-100">
                            <div class="h-2 rounded-full bg-ayii-orange" style="width: {{ max(4, round(($value / $maxCount) * 100)) }}%"></div>
                        </div>
                        <p class="text-right font-bold text-ayii-navy">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-md bg-ayii-orange/10 text-ayii-orange">
                        <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="1.8" d="M4 19c4-10 8 4 12-6 2-5 3 1 4-3"/></svg>
                    </span>
                    <h2 class="font-display text-lg font-bold">RFQ Trend</h2>
                </div>
                <div class="flex rounded-md border border-slate-200 text-xs font-bold">
                    <span class="bg-ayii-orange px-3 py-1 text-ayii-navy">7d</span>
                    <span class="px-3 py-1 text-slate-500">14d</span>
                    <span class="px-3 py-1 text-slate-500">30d</span>
                </div>
            </div>
            <div class="mt-8 grid h-56 grid-cols-7 items-end gap-3 border-b border-l border-slate-200 px-3">
                @foreach ([22, 14, 18, 11, 8, 17, 13] as $height)
                    <div class="flex h-full items-end gap-1">
                        <span class="w-1/2 rounded-t bg-ayii-navy" style="height: {{ $height * 3 }}%"></span>
                        <span class="w-1/2 rounded-t bg-ayii-orange" style="height: {{ max(8, $height * 2) }}%"></span>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 flex items-center gap-5 text-xs font-semibold text-slate-500">
                <span class="inline-flex items-center gap-2"><i class="h-2 w-2 rounded-full bg-ayii-navy"></i>Created</span>
                <span class="inline-flex items-center gap-2"><i class="h-2 w-2 rounded-full bg-ayii-orange"></i>Resolved</span>
            </div>
        </section>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between">
                <h2 class="font-display text-lg font-bold">Latest RFQs</h2>
                <a href="{{ route('admin.rfqs.index') }}" class="rounded-full border border-ayii-orange px-3 py-1 text-xs font-bold text-ayii-orange">View all</a>
            </div>
            <div class="mt-6 space-y-4">
                @forelse ($latestRfqs as $rfq)
                    <a href="{{ route('admin.rfqs.show', $rfq) }}" class="grid gap-3 rounded-md bg-ayii-off-white p-4 text-sm hover:bg-ayii-orange/10 sm:grid-cols-[1fr_auto]">
                        <div>
                            <p class="font-bold text-ayii-navy">{{ $rfq->reference }}</p>
                            <p class="mt-1 text-slate-600">{{ $rfq->name }}{{ $rfq->organization ? ' · '.$rfq->organization : '' }}</p>
                        </div>
                        <span class="h-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-ayii-navy ring-1 ring-slate-200">{{ $rfq->status->label() }}</span>
                    </a>
                @empty
                    <p class="rounded-md bg-ayii-off-white p-4 text-sm text-slate-600">No RFQs yet.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex items-center justify-between">
                <h2 class="font-display text-lg font-bold">Recently Added Products</h2>
                <a href="{{ route('admin.products.index') }}" class="rounded-full border border-ayii-orange px-3 py-1 text-xs font-bold text-ayii-orange">View all</a>
            </div>
            <div class="mt-6 space-y-4">
                @forelse ($recentProducts as $product)
                    <a href="{{ route('admin.products.edit', $product) }}" class="grid gap-3 rounded-md bg-ayii-off-white p-4 text-sm hover:bg-ayii-orange/10 sm:grid-cols-[1fr_auto]">
                        <div>
                            <p class="font-bold text-ayii-navy">{{ $product->name }}</p>
                            <p class="mt-1 text-slate-600">{{ $product->category?->name }}{{ $product->brand ? ' · '.$product->brand->name : '' }}</p>
                        </div>
                        <span class="h-fit rounded-full bg-white px-3 py-1 text-xs font-bold text-ayii-navy ring-1 ring-slate-200">{{ $product->publication_status->value }}</span>
                    </a>
                @empty
                    <p class="rounded-md bg-ayii-off-white p-4 text-sm text-slate-600">No products yet.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.admin>
