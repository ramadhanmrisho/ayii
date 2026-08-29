<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RfqStatus;
use App\Http\Controllers\Controller;
use App\Models\Rfq;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RfqController extends Controller
{
    public function index(): View
    {
        return view('admin.rfqs.index', ['rfqs' => Rfq::with(['items', 'assignee'])->latest()->paginate(20)]);
    }

    public function show(Rfq $rfq): View
    {
        return view('admin.rfqs.show', ['rfq' => $rfq->load(['items.product', 'assignee']), 'users' => User::where('active', true)->orderBy('name')->get()]);
    }

    public function update(Request $request, Rfq $rfq): RedirectResponse
    {
        $this->authorize('rfqs.update');

        $data = $request->validate([
            'status' => ['required', Rule::enum(RfqStatus::class)],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'internal_notes' => ['nullable', 'string', 'max:5000'],
            'quotation_file' => ['nullable', 'file', 'mimes:pdf', 'max:8192'],
        ]);

        if ($request->hasFile('quotation_file')) {
            $data['quotation_file'] = $request->file('quotation_file')->store('quotations', 'public');
        }

        $rfq->update($data);

        return back()->with('status', 'RFQ updated.');
    }
}
