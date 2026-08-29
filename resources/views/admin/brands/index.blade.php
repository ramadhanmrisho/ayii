<x-layouts.admin title="Brands - Ayii">
    <div class="flex items-center justify-between"><h1 class="font-display text-3xl font-extrabold">Brands</h1><x-button :href="route('admin.brands.create')">Add Brand</x-button></div>
    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @foreach ($brands as $brand)
            <div class="rounded-md bg-white p-5 shadow-sm ring-1 ring-slate-200"><h2 class="font-display text-xl font-bold">{{ $brand->name }}</h2><p class="mt-2 text-sm text-slate-600">{{ $brand->website }}</p><a href="{{ route('admin.brands.edit', $brand) }}" class="mt-4 inline-block font-semibold text-ayii-orange">Edit</a></div>
        @endforeach
    </div>
    <div class="mt-6">{{ $brands->links() }}</div>
</x-layouts.admin>
