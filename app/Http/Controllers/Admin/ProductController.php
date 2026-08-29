<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with(['category', 'brand'])->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', $this->formData(new Product));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $product = Product::create($this->payload($request));
            $this->syncSpecifications($product, $request->validated('specifications') ?? []);
            $this->storeImages($product, $request);
        });

        return redirect()->route('admin.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product): View
    {
        $product->load(['specifications', 'images']);

        return view('admin.products.form', $this->formData($product));
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($this->payload($request));
            $product->specifications()->delete();
            $this->syncSpecifications($product, $request->validated('specifications') ?? []);
            $this->storeImages($product, $request);
        });

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('products.delete');
        $product->delete();

        return back()->with('status', 'Product removed.');
    }

    private function formData(Product $product): array
    {
        return [
            'product' => $product,
            'categories' => Category::where('active', true)->orderBy('name')->get(),
            'brands' => Brand::where('active', true)->orderBy('name')->get(),
        ];
    }

    private function payload(StoreProductRequest $request): array
    {
        $data = $request->safe()->except(['images', 'specifications']);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['key_features'] = collect(preg_split('/\r\n|\r|\n/', $data['key_features'] ?? ''))->filter()->values()->all();
        foreach (['show_price', 'quote_only', 'featured', 'is_new', 'active'] as $field) {
            $data[$field] = $request->boolean($field);
        }
        $data['active'] = $request->boolean('active', true);

        return $data;
    }

    private function syncSpecifications(Product $product, array $specifications): void
    {
        foreach (array_values($specifications) as $index => $specification) {
            if (($specification['name'] ?? null) && ($specification['value'] ?? null)) {
                $product->specifications()->create($specification + ['sort_order' => $index + 1]);
            }
        }
    }

    private function storeImages(Product $product, StoreProductRequest $request): void
    {
        foreach ($request->file('images', []) as $index => $image) {
            $product->images()->create([
                'path' => $image->store('products', 'public'),
                'alt_text' => $product->name,
                'sort_order' => $index + 1,
                'is_primary' => ! $product->images()->exists(),
            ]);
        }
    }
}
