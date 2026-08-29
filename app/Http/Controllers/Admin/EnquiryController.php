<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EnquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(): View
    {
        return view('admin.enquiries.index', ['enquiries' => Enquiry::latest()->paginate(20)]);
    }

    public function update(Request $request, Enquiry $enquiry): RedirectResponse
    {
        $this->authorize('enquiries.update');
        $enquiry->update($request->validate(['status' => ['required', Rule::enum(EnquiryStatus::class)]]));

        return back()->with('status', 'Enquiry updated.');
    }
}
