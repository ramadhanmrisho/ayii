<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('admin.brands.index', ['brands' => Brand::orderBy('sort_order')->orderBy('name')->paginate(20)]);
    }

    public function create(): View
    {
        return view('admin.brands.form', ['brand' => new Brand]);
    }

    public function store(StoreBrandRequest $request): RedirectResponse
    {
        Brand::create($this->payload($request));

        return redirect()->route('admin.brands.index')->with('status', 'Brand created.');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.form', compact('brand'));
    }

    public function update(StoreBrandRequest $request, Brand $brand): RedirectResponse
    {
        $brand->update($this->payload($request));

        return redirect()->route('admin.brands.index')->with('status', 'Brand updated.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $this->authorize('brands.manage');
        $brand->delete();

        return back()->with('status', 'Brand removed.');
    }

    private function payload(StoreBrandRequest $request): array
    {
        $data = $request->safe()->except('logo');
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['featured'] = $request->boolean('featured');
        $data['active'] = $request->boolean('active', true);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        return $data;
    }
}
