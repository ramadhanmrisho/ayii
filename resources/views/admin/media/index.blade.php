<x-layouts.admin title="Media - Ayii">
    <h1 class="font-display text-3xl font-extrabold">Media Library</h1>
    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.media.store') }}" class="mt-6 rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @csrf
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <input type="file" name="files[]" multiple required class="rounded-md border border-slate-300 px-4 py-3">
            <x-button type="submit">Upload</x-button>
        </div>
    </form>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 md:grid-cols-4">
        @foreach ($media as $item)
            <div class="rounded-md bg-white p-3 shadow-sm ring-1 ring-slate-200">
                @if (str_starts_with($item->mime_type, 'image/'))
                    <img src="{{ Storage::url($item->path) }}" alt="{{ $item->alt_text ?: $item->name }}" class="aspect-video w-full rounded-md object-cover">
                @else
                    <div class="grid aspect-video place-items-center rounded-md bg-ayii-off-white font-semibold">PDF</div>
                @endif
                <p class="mt-3 truncate text-sm font-semibold">{{ $item->original_name }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $media->links() }}</div>
</x-layouts.admin>
