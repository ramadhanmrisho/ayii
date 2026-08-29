<x-layouts.admin title="{{ $rfq->reference }}">
    <h1 class="font-display text-3xl font-extrabold">{{ $rfq->reference }}</h1>
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:col-span-2">
            <h2 class="font-display text-xl font-bold">Customer</h2>
            <div class="mt-4 grid gap-2 text-sm"><p>{{ $rfq->name }}</p><p>{{ $rfq->organization }}</p><p>{{ $rfq->phone }}</p><p>{{ $rfq->email }}</p><p>{{ $rfq->message }}</p></div>
            <h2 class="mt-8 font-display text-xl font-bold">Items</h2>
            <div class="mt-4 space-y-3">@foreach($rfq->items as $item)<div class="rounded-md bg-ayii-off-white p-3"><p class="font-semibold">{{ $item->product_name }}</p><p class="text-sm">Quantity: {{ $item->quantity }}</p></div>@endforeach</div>
        </section>
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.rfqs.update', $rfq) }}" class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            @csrf @method('PUT')
            <h2 class="font-display text-xl font-bold">Workflow</h2>
            <select name="status" class="mt-4 w-full rounded-md border border-slate-300 px-4 py-3">@foreach(App\Enums\RfqStatus::cases() as $status)<option value="{{ $status->value }}" @selected($rfq->status === $status)>{{ $status->label() }}</option>@endforeach</select>
            <select name="assigned_to" class="mt-4 w-full rounded-md border border-slate-300 px-4 py-3"><option value="">Unassigned</option>@foreach($users as $user)<option value="{{ $user->id }}" @selected($rfq->assigned_to===$user->id)>{{ $user->name }}</option>@endforeach</select>
            <textarea name="internal_notes" rows="5" class="mt-4 w-full rounded-md border border-slate-300 px-4 py-3" placeholder="Internal notes">{{ $rfq->internal_notes }}</textarea>
            <input type="file" name="quotation_file" class="mt-4 w-full rounded-md border border-slate-300 px-4 py-3">
            <div class="mt-4 flex justify-end">
                <x-button type="submit">Update RFQ</x-button>
            </div>
        </form>
    </div>
</x-layouts.admin>
