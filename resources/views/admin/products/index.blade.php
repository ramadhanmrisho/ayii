<x-layouts.admin title="Products - Ayii">
    <div class="flex items-center justify-between"><h1 class="font-display text-3xl font-extrabold">Products</h1><x-button :href="route('admin.products.create')">Add Product</x-button></div>
    <div class="mt-6 overflow-hidden rounded-md bg-white shadow-sm ring-1 ring-slate-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-ayii-navy text-white"><tr><th class="p-3">Product</th><th class="p-3">Category</th><th class="p-3">Brand</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($products as $product)
                    <tr><td class="p-3 font-semibold">{{ $product->name }}</td><td class="p-3">{{ $product->category?->name }}</td><td class="p-3">{{ $product->brand?->name }}</td><td class="p-3">{{ $product->publication_status->value }}</td><td class="p-3 text-right"><a class="font-semibold text-ayii-orange" href="{{ route('admin.products.edit', $product) }}">Edit</a></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
</x-layouts.admin>
