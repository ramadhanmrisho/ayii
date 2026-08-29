<x-layouts.admin title="Category - Ayii">
    <h1 class="font-display text-3xl font-extrabold">{{ $category->exists ? 'Edit' : 'Add' }} Category</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="mt-6 rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="grid gap-4 md:grid-cols-2">
            <input name="name" value="{{ old('name', $category->name) }}" required placeholder="Name" class="rounded-md border border-slate-300 px-4 py-3">
            <input name="slug" value="{{ old('slug', $category->slug) }}" placeholder="Slug" class="rounded-md border border-slate-300 px-4 py-3">
            <select name="parent_id" class="rounded-md border border-slate-300 px-4 py-3"><option value="">No parent</option>@foreach($parents as $parent)<option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id)==$parent->id)>{{ $parent->name }}</option>@endforeach</select>
            <input name="sort_order" type="number" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="rounded-md border border-slate-300 px-4 py-3">
            <input name="image" type="file" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">
            <textarea name="description" rows="4" placeholder="Description" class="rounded-md border border-slate-300 px-4 py-3 md:col-span-2">{{ old('description', $category->description) }}</textarea>
            <label><input type="checkbox" name="featured" value="1" @checked(old('featured', $category->featured))> Featured</label>
            <label><input type="checkbox" name="active" value="1" @checked(old('active', $category->active ?? true))> Active</label>
        </div>
        <x-button type="submit" class="mt-6">Save Category</x-button>
    </form>
</x-layouts.admin>
