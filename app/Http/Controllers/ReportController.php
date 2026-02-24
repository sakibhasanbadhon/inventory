<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', now()->endOfMonth()->toDateString());

        $transactions = Transaction::with('product')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->get();

        // Totals
        $totalSales = $transactions->sum('total');
        $totalDiscount = $transactions->sum('discount');
        $totalVAT = $transactions->sum('vat');
        $totalPaid = $transactions->sum('paid');
        $totalDue = $transactions->sum('due');

        // Cost of Goods Sold (COGS) = sum of purchase_price * quantity for each sale
        $cogs = $transactions->sum(function ($t) {
            return $t->product->purchase_price * $t->quantity;
        });

        $grossProfit = $totalSales - $totalVAT - $cogs; // Sales net of VAT minus COGS

        // Daily breakdown
        $daily = Transaction::selectRaw('DATE(transaction_date) as date, 
            COUNT(*) as transactions,
            SUM(total) as total_sales,
            SUM(discount) as total_discount,
            SUM(vat) as total_vat,
            SUM(paid) as total_paid,
            SUM(due) as total_due')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('reports.index', compact(
            'startDate', 'endDate',
            'totalSales', 'totalDiscount', 'totalVAT', 'totalPaid', 'totalDue',
            'cogs', 'grossProfit', 'daily', 'transactions'
        ));
    }
}