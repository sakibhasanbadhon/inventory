@extends('layouts.app')

@section('title', 'Financial Analytics')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Financial Analytics</h2>
        <p class="text-secondary mb-0">Review your business performance and transactions</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-light border">
            <i data-lucide="printer"></i> Print Report
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i data-lucide="filter"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Main Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card shadow-sm border-0">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i data-lucide="trending-up"></i>
            </div>
            <div>
                <p class="text-secondary small mb-1 fw-medium">Total Sales</p>
                <h4 class="fw-bold mb-0">৳{{ number_format($totalSales, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm border-0">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i data-lucide="check-circle"></i>
            </div>
            <div>
                <p class="text-secondary small mb-1 fw-medium">Total Paid</p>
                <h4 class="fw-bold mb-0">৳{{ number_format($totalPaid, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm border-0">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i data-lucide="clock"></i>
            </div>
            <div>
                <p class="text-secondary small mb-1 fw-medium">Total Due</p>
                <h4 class="fw-bold mb-0 text-warning">৳{{ number_format($totalDue, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm border-0">
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i data-lucide="pie-chart"></i>
            </div>
            <div>
                <p class="text-secondary small mb-1 fw-medium">Gross Profit</p>
                <h4 class="fw-bold mb-0 text-info">৳{{ number_format($grossProfit, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                 <div class="text-secondary opacity-50"><i data-lucide="tag" style="width:32px; height:32px"></i></div>
                 <div>
                    <h6 class="text-secondary mb-1">Total Discount</h6>
                    <h5 class="fw-bold mb-0">৳{{ number_format($totalDiscount, 2) }}</h5>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                 <div class="text-secondary opacity-50"><i data-lucide="percent" style="width:32px; height:32px"></i></div>
                 <div>
                    <h6 class="text-secondary mb-1">Total VAT</h6>
                    <h5 class="fw-bold mb-0">৳{{ number_format($totalVAT, 2) }}</h5>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                 <div class="text-secondary opacity-50"><i data-lucide="shopping-bag" style="width:32px; height:32px"></i></div>
                 <div>
                    <h6 class="text-secondary mb-1">COGS</h6>
                    <h5 class="fw-bold mb-0">৳{{ number_format($cogs, 2) }}</h5>
                 </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-5">
    <h4 class="fw-bold mb-4">Daily Breakdown</h4>
    <div class="table-container shadow-sm border-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Transactions</th>
                    <th>Sales</th>
                    <th>Discount</th>
                    <th>VAT</th>
                    <th>Paid</th>
                    <th class="text-end">Due</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daily as $day)
                <tr>
                    <td class="fw-medium">{{ \Carbon\Carbon::parse($day->date)->format('M d, Y') }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $day->transactions }}</span></td>
                    <td class="fw-bold">৳{{ number_format($day->total_sales, 2) }}</td>
                    <td class="text-secondary">৳{{ number_format($day->total_discount, 2) }}</td>
                    <td class="text-secondary">৳{{ number_format($day->total_vat, 2) }}</td>
                    <td class="text-success">৳{{ number_format($day->total_paid, 2) }}</td>
                    <td class="text-end text-danger fw-bold">৳{{ number_format($day->total_due, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div>
    <h4 class="fw-bold mb-4">Transaction Details</h4>
    <div class="table-container shadow-sm border-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th class="text-end">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr>
                    <td class="small text-secondary">{{ \Carbon\Carbon::parse($t->transaction_date)->format('M d, H:i') }}</td>
                    <td class="fw-bold">{{ $t->product->name }}</td>
                    <td>{{ $t->quantity }}</td>
                    <td>৳{{ number_format($t->unit_price, 2) }}</td>
                    <td>৳{{ number_format($t->subtotal, 2) }}</td>
                    <td class="fw-bold">৳{{ number_format($t->total, 2) }}</td>
                    <td class="text-end">
                        @if($t->due > 0)
                            <span class="badge bg-warning bg-opacity-10 text-dark">Due: ৳{{ number_format($t->due, 2) }}</span>
                        @else
                            <span class="badge bg-success bg-opacity-10 text-success">Paid</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection