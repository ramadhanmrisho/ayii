<x-layouts.app title="Request a Quote - Ayii">
    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <x-section-heading eyebrow="Request a Quote" title="Tell Ayii What You Need" />
                <form method="POST" action="{{ route('quote.store') }}" enctype="multipart/form-data" class="mt-8 grid gap-5">
                    @csrf
                    <x-alert />
                    <div class="grid gap-5 md:grid-cols-2">
                        <input name="name" value="{{ old('name') }}" placeholder="Full name" required class="rounded-md border border-slate-300 px-4 py-3">
                        <input name="organization" value="{{ old('organization') }}" placeholder="Organization" class="rounded-md border border-slate-300 px-4 py-3">
                        <input name="email" value="{{ old('email') }}" placeholder="Email" required class="rounded-md border border-slate-300 px-4 py-3">
                        <input name="phone" value="{{ old('phone') }}" placeholder="Phone" required class="rounded-md border border-slate-300 px-4 py-3">
                        <input name="location" value="{{ old('location') }}" placeholder="Location" class="rounded-md border border-slate-300 px-4 py-3">
                        <input name="required_delivery_date" type="date" value="{{ old('required_delivery_date') }}" class="rounded-md border border-slate-300 px-4 py-3">
                    </div>
                    <textarea name="message" rows="5" placeholder="Message or product requirements" class="rounded-md border border-slate-300 px-4 py-3">{{ old('message') }}</textarea>
                    <input name="attachment" type="file" class="rounded-md border border-slate-300 px-4 py-3">
                    @foreach ($items as $index => $item)
                        <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $item['product_id'] }}">
                        <input type="hidden" name="items[{{ $index }}][product_name]" value="{{ $item['product_name'] }}">
                        <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                    @endforeach
                    <x-button type="submit">Submit RFQ</x-button>
                </form>
            </div>
            <aside class="rounded-md bg-ayii-off-white p-6">
                <h2 class="font-display text-xl font-bold">Quote List</h2>
                <div class="mt-5 space-y-4">
                    @forelse ($items as $item)
                        <div class="rounded-md bg-white p-4">
                            <p class="font-semibold">{{ $item['product_name'] }}</p>
                            <p class="text-sm text-slate-600">Quantity: {{ $item['quantity'] }}</p>
                            <form method="POST" action="{{ route('quote.remove', $item['product_id']) }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm font-semibold text-red-700">Remove</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-slate-600">Add products from the catalogue or describe your requirements in the message.</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </section>
</x-layouts.app>
