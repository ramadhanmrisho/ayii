<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RfqStatus;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Project;
use App\Models\Rfq;
use App\Models\Subscriber;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'Total Products' => Product::count(),
                'Active Products' => Product::where('active', true)->count(),
                'Categories' => Category::count(),
                'Brands' => Brand::count(),
                'Projects' => Project::count(),
                'New RFQs' => Rfq::where('status', RfqStatus::New->value)->count(),
                'Pending RFQs' => Rfq::whereIn('status', [RfqStatus::New->value, RfqStatus::UnderReview->value])->count(),
                'Completed RFQs' => Rfq::where('status', RfqStatus::Completed->value)->count(),
                'Enquiries' => Enquiry::count(),
                'Testimonials' => Testimonial::count(),
                'Subscribers' => Subscriber::count(),
            ],
            'latestRfqs' => Rfq::with('items')->latest()->limit(6)->get(),
            'recentEnquiries' => Enquiry::latest()->limit(6)->get(),
            'recentProducts' => Product::with(['category', 'brand'])->latest()->limit(6)->get(),
        ]);
    }
}
