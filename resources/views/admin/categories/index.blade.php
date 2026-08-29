<x-layouts.admin title="Categories - Ayii">
    <div class="flex items-center justify-between"><h1 class="font-display text-3xl font-extrabold">Categories</h1><x-button :href="route('admin.categories.create')">Add Category</x-button></div>
    <div class="mt-6 overflow-hidden rounded-md bg-white shadow-sm ring-1 ring-slate-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-ayii-navy text-white"><tr><th class="p-3">Name</th><th class="p-3">Parent</th><th class="p-3">Featured</th><th class="p-3">Active</th><th class="p-3"></th></tr></thead>
            <tbody class="divide-y divide-slate-200">
                @foreach ($categories as $category)
                    <tr><td class="p-3 font-semibold">{{ $category->name }}</td><td class="p-3">{{ $category->parent?->name }}</td><td class="p-3">{{ $category->featured ? 'Yes' : 'No' }}</td><td class="p-3">{{ $category->active ? 'Yes' : 'No' }}</td><td class="p-3 text-right"><a class="font-semibold text-ayii-orange" href="{{ route('admin.categories.edit', $category) }}">Edit</a></td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $categories->links() }}</div>
</x-layouts.admin>
