<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRfqRequest;
use App\Models\Product;
use App\Models\Rfq;
use App\Services\RfqReferenceGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(): View
    {
        return view('quotes.index', ['items' => session('quote.items', [])]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->active, 404);

        $items = session('quote.items', []);
        $items[$product->id] = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => ($items[$product->id]['quantity'] ?? 0) + max(1, $request->integer('quantity', 1)),
            'notes' => $items[$product->id]['notes'] ?? null,
        ];

        session(['quote.items' => $items]);

        return redirect()->route('quote.index')->with('status', 'Product added to quote list.');
    }

    public function remove(Product $product): RedirectResponse
    {
        $items = session('quote.items', []);
        unset($items[$product->id]);
        session(['quote.items' => $items]);

        return back()->with('status', 'Product removed from quote list.');
    }

    public function store(StoreRfqRequest $request, RfqReferenceGenerator $referenceGenerator): RedirectResponse
    {
        $items = $request->validated('items') ?: array_values(session('quote.items', []));

        if ($items === []) {
            return back()->withErrors(['items' => 'Add at least one product or describe your requirement in the message.'])->withInput();
        }

        $rfq = DB::transaction(function () use ($request, $items, $referenceGenerator) {
            $attachment = $request->file('attachment')?->store('rfq-attachments', 'public');

            $rfq = Rfq::create($request->safe()->except(['items', 'attachment']) + [
                'reference' => $referenceGenerator->generate(),
                'attachment' => $attachment,
            ]);

            foreach ($items as $item) {
                $rfq->items()->create([
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['product_name'],
                    'quantity' => $item['quantity'] ?? 1,
                    'notes' => $item['notes'] ?? null,
                ]);
            }

            return $rfq;
        });

        session()->forget('quote.items');

        return redirect()->route('quote.index')->with('status', "Your quotation request {$rfq->reference} has been submitted.");
    }
}
