<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\AccountingEntry;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function create()
    {
        $products = Product::where('current_stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->current_stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock!']);
        }

        // Calculations
        $subtotal = $product->selling_price * $request->quantity;
        $discount = $request->discount ?? 0;
        $vat = $subtotal * 0.05; // 5% VAT
        $total = $subtotal - $discount + $vat;
        $due = $total - $request->paid;

        // Create transaction
        $transaction = Transaction::create([
            'product_id' => $product->id,
            'type' => 'sale',
            'quantity' => $request->quantity,
            'unit_price' => $product->selling_price,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'vat' => $vat,
            'total' => $total,
            'paid' => $request->paid,
            'due' => $due,
            'transaction_date' => $request->transaction_date,
        ]);

        // Update stock
        $product->updateStock($request->quantity, 'out');

        // Create accounting entries (optional – journal)
        $this->createJournalEntries($transaction, $product);

        return redirect()->route('sales.create')
            ->with('success', 'Sale recorded successfully.');
    }

    private function createJournalEntries($transaction, $product)
    {
        // Cost of Goods Sold (COGS) = purchase_price * quantity
        $cogs = $product->purchase_price * $transaction->quantity;

        // Debit entries
        AccountingEntry::create([
            'transaction_id' => $transaction->id,
            'account' => 'Cash',
            'type' => 'debit',
            'amount' => $transaction->paid,
        ]);
        if ($transaction->due > 0) {
            AccountingEntry::create([
                'transaction_id' => $transaction->id,
                'account' => 'Accounts Receivable',
                'type' => 'debit',
                'amount' => $transaction->due,
            ]);
        }
        AccountingEntry::create([
            'transaction_id' => $transaction->id,
            'account' => 'Cost of Goods Sold',
            'type' => 'debit',
            'amount' => $cogs,
        ]);

        // Credit entries
        AccountingEntry::create([
            'transaction_id' => $transaction->id,
            'account' => 'Sales Revenue',
            'type' => 'credit',
            'amount' => $transaction->subtotal,
        ]);
        AccountingEntry::create([
            'transaction_id' => $transaction->id,
            'account' => 'VAT Payable',
            'type' => 'credit',
            'amount' => $transaction->vat,
        ]);
        AccountingEntry::create([
            'transaction_id' => $transaction->id,
            'account' => 'Inventory',
            'type' => 'credit',
            'amount' => $cogs,
        ]);
    }
}