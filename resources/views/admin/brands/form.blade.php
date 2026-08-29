<x-layouts.admin title="Brand - Ayii">
    <h1 class="font-display text-3xl font-extrabold">{{ $brand->exists ? 'Edit' : 'Add' }} Brand</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ $brand->exists ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" class="mt-6 rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @csrf
        @if($brand->exists) @method('PUT') @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input name="name" value="{{ old('name', $brand->name) }}" required placeholder="Name" class="rounded-md border border-slate-300 px-4 py-3">
            <input name="slug" value="{{ old('slug', $brand->slug) }}" placeholder="Slug" class="rounded-md border border-slate-300 px-4 py-3">
            <input name="website" value="{{ old('website', $brand->website) }}" placeholder="Website" class="rounded-md border border-slate-300 px-4 py-3">
            <input name="logo" type="file" class="rounded-md border border-slate-300 px-4 py-3">
            <textarea name="description" rows="4" placeholder="Description" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">{{ old('description', $brand->description) }}</textarea>
            <label><input type="checkbox" name="featured" value="1" @checked(old('featured', $brand->featured))> Featured</label>
            <label><input type="checkbox" name="active" value="1" @checked(old('active', $brand->active ?? true))> Active</label>
        </div>
        <div class="mt-6 flex justify-end">
            <x-button type="submit">Save Brand</x-button>
        </div>
    </form>
</x-layouts.admin>
