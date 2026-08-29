<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::with('parent')->orderBy('sort_order')->orderBy('name')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.form', ['category' => new Category, 'parents' => Category::orderBy('name')->get()]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $this->payload($request);
        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category created.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.form', [
            'category' => $category,
            'parents' => Category::whereKeyNot($category->id)->orderBy('name')->get(),
        ]);
    }

    public function update(StoreCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($this->payload($request));

        return redirect()->route('admin.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('categories.manage');
        $category->delete();

        return back()->with('status', 'Category removed.');
    }

    private function payload(StoreCategoryRequest $request): array
    {
        $data = $request->safe()->except('image');
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['featured'] = $request->boolean('featured');
        $data['active'] = $request->boolean('active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        return $data;
    }
}
