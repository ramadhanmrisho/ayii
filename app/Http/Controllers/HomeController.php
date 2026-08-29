<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Solution;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Services\Settings;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Settings $settings): View
    {
        return view('home.index', [
            'settings' => $settings,
            'categories' => Category::query()->where('active', true)->where('featured', true)->orderBy('sort_order')->limit(9)->get(),
            'products' => Product::query()->published()->with(['category', 'brand', 'primaryImage'])->where('featured', true)->latest()->limit(8)->get(),
            'solutions' => Solution::query()->where('active', true)->where('featured', true)->orderBy('display_order')->limit(6)->get(),
            'projects' => Project::query()->where('featured', true)->latest()->limit(3)->get(),
            'brands' => Brand::query()->where('active', true)->where('featured', true)->orderBy('sort_order')->limit(10)->get(),
            'statistics' => Statistic::query()->where('active', true)->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::query()->where('active', true)->where('approved', true)->where('featured', true)->orderBy('sort_order')->limit(4)->get(),
        ]);
    }
}
