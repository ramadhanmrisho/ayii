<?php

namespace App\Http\Controllers;

use App\Enums\PublicationStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request, Settings $settings): View
    {
        $selectedBrands = collect((array) $request->input('brand', []))->filter()->values();

        $products = Product::query()
            ->published()
            ->with(['category', 'brand', 'primaryImage'])
            ->when($request->filled('search'), function (Builder $query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function (Builder $query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhereHas('brand', fn (Builder $q) => $q->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('category', fn (Builder $q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($request->filled('category'), fn (Builder $query) => $query->whereHas('category', fn (Builder $q) => $q->where('slug', $request->string('category'))))
            ->when($selectedBrands->isNotEmpty(), fn (Builder $query) => $query->whereHas('brand', fn (Builder $q) => $q->whereIn('slug', $selectedBrands)))
            ->when($request->filled('availability'), fn (Builder $query) => $query->where('availability', $request->string('availability')))
            ->when($request->string('sort')->toString() === 'name_az', fn (Builder $query) => $query->orderBy('name'))
            ->when($request->string('sort')->toString() === 'name_za', fn (Builder $query) => $query->orderByDesc('name'))
            ->when($request->string('sort')->toString() === 'featured', fn (Builder $query) => $query->orderByDesc('featured')->latest())
            ->when(! in_array($request->string('sort')->toString(), ['name_az', 'name_za', 'featured'], true), fn (Builder $query) => $query->latest())
            ->paginate(12)
            ->withQueryString();

        return view('products.index', [
            'settings' => $settings,
            'products' => $products,
            'categories' => Category::query()
                ->where('active', true)
                ->withCount(['products' => fn (Builder $query) => $query->where('active', true)->where('publication_status', PublicationStatus::Published->value)])
                ->orderBy('name')
                ->get(),
            'brands' => Brand::query()
                ->where('active', true)
                ->withCount(['products' => fn (Builder $query) => $query->where('active', true)->where('publication_status', PublicationStatus::Published->value)])
                ->orderBy('name')
                ->get(),
            'selectedBrands' => $selectedBrands,
        ]);
    }

    public function show(Product $product, Settings $settings): View
    {
        abort_unless($product->active && $product->publication_status->value === 'published', 404);

        $product->load(['category', 'brand', 'images', 'specifications']);

        $related = Product::query()
            ->published()
            ->with(['category', 'brand', 'primaryImage'])
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'related', 'settings'));
    }
}
