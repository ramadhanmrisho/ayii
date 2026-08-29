<x-layouts.admin title="RFQs - Ayii">
    <h1 class="font-display text-3xl font-extrabold">Quotation Requests</h1>
    <div class="mt-6 overflow-hidden rounded-md bg-white shadow-sm ring-1 ring-slate-200">
        <table class="w-full text-left text-sm"><thead class="bg-ayii-navy text-white"><tr><th class="p-3">Reference</th><th class="p-3">Customer</th><th class="p-3">Products</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead><tbody class="divide-y divide-slate-200">@foreach($rfqs as $rfq)<tr><td class="p-3 font-semibold">{{ $rfq->reference }}</td><td class="p-3">{{ $rfq->name }}<br><span class="text-slate-500">{{ $rfq->email }}</span></td><td class="p-3">{{ $rfq->items->count() }}</td><td class="p-3">{{ $rfq->status->label() }}</td><td class="p-3 text-right"><a href="{{ route('admin.rfqs.show', $rfq) }}" class="font-semibold text-ayii-orange">View</a></td></tr>@endforeach</tbody></table>
    </div>
    <div class="mt-6">{{ $rfqs->links() }}</div>
</x-layouts.admin>
