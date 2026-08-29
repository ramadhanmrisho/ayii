<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Enquiry;
use App\Services\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Settings $settings): View
    {
        return view('contact.index', compact('settings'));
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        Enquiry::create($request->validated());

        return back()->with('status', 'Your enquiry has been sent. Ayii will contact you shortly.');
    }
}
