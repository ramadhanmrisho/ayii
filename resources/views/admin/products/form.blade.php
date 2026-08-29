<x-layouts.admin title="Product - Ayii">
    <h1 class="font-display text-3xl font-extrabold">{{ $product->exists ? 'Edit' : 'Add' }} Product</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" class="mt-6 grid gap-6">
        @csrf
        @if($product->exists) @method('PUT') @endif
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="grid gap-4 md:grid-cols-2">
                <input name="name" value="{{ old('name', $product->name) }}" required placeholder="Name" class="rounded-md border border-slate-300 px-4 py-3">
                <input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Slug" class="rounded-md border border-slate-300 px-4 py-3">
                <select name="category_id" required class="rounded-md border border-slate-300 px-4 py-3"><option value="">Category</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)==$category->id)>{{ $category->name }}</option>@endforeach</select>
                <select name="brand_id" class="rounded-md border border-slate-300 px-4 py-3"><option value="">Brand</option>@foreach($brands as $brand)<option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id)==$brand->id)>{{ $brand->name }}</option>@endforeach</select>
                <input name="sku" value="{{ old('sku', $product->sku) }}" placeholder="SKU" class="rounded-md border border-slate-300 px-4 py-3">
                <input name="model" value="{{ old('model', $product->model) }}" placeholder="Model" class="rounded-md border border-slate-300 px-4 py-3">
                <input name="availability" value="{{ old('availability', $product->availability ?: 'Available') }}" required placeholder="Availability" class="rounded-md border border-slate-300 px-4 py-3">
                <select name="publication_status" class="rounded-md border border-slate-300 px-4 py-3"><option value="draft" @selected(old('publication_status', $product->publication_status?->value)==='draft')>Draft</option><option value="published" @selected(old('publication_status', $product->publication_status?->value)==='published')>Published</option><option value="archived">Archived</option></select>
                <textarea name="short_description" rows="3" placeholder="Short description" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">{{ old('short_description', $product->short_description) }}</textarea>
                <textarea name="description" rows="6" placeholder="Description" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">{{ old('description', $product->description) }}</textarea>
                <textarea name="key_features" rows="5" placeholder="One key feature per line" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">{{ old('key_features', implode("\n", $product->key_features ?? [])) }}</textarea>
                <input name="images[]" type="file" multiple class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">
                <label><input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured))> Featured</label>
                <label><input type="checkbox" name="is_new" value="1" @checked(old('is_new', $product->is_new))> New</label>
                <label><input type="checkbox" name="quote_only" value="1" @checked(old('quote_only', $product->quote_only ?? true))> Quote only</label>
                <label><input type="checkbox" name="active" value="1" @checked(old('active', $product->active ?? true))> Active</label>
            </div>
        </section>
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200" x-data="{ rows: {{ max(3, $product->specifications?->count() ?: 3) }} }">
            <h2 class="font-display text-xl font-bold">Specifications</h2>
            <template x-for="i in rows" :key="i">
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <input :name="`specifications[${i}][name]`" placeholder="Name" class="rounded-md border border-slate-300 px-4 py-3">
                    <input :name="`specifications[${i}][value]`" placeholder="Value" class="rounded-md border border-slate-300 px-4 py-3">
                </div>
            </template>
            <div class="mt-4 flex justify-end">
                <button type="button" @click="rows++" class="font-semibold text-ayii-orange">Add specification</button>
            </div>
        </section>
        <div class="flex justify-end">
            <x-button type="submit" class="w-fit">Save Product</x-button>
        </div>
    </form>
</x-layouts.admin>
