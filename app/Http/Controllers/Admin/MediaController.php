<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(Request $request): View
    {
        $media = Media::query()
            ->when($request->filled('search'), fn ($query) => $query->where('name', 'like', '%'.$request->string('search').'%'))
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request): RedirectResponse
    {
       // $this->authorize('media.upload');

        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimes:jpg,jpeg,png,webp,avif,pdf', 'max:8192'],
        ]);

        foreach ($request->file('files') as $file) {
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.Str::random(8);
            $path = $file->storeAs('media', $name.'.'.$file->extension(), 'public');
            $dimensions = str_starts_with((string) $file->getMimeType(), 'image/') ? @getimagesize($file->getRealPath()) : null;

            Media::create([
                'user_id' => $request->user()->id,
                'path' => $path,
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->extension(),
                'size' => $file->getSize(),
                'width' => $dimensions[0] ?? null,
                'height' => $dimensions[1] ?? null,
            ]);
        }

        return back()->with('status', 'Media uploaded.');
    }
}
