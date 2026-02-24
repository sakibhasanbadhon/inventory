@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-5">
    <h1 class="fw-bold text-dark mb-2">Welcome to InventoryPro</h1>
    <p class="text-secondary fs-5">Your complete solution for inventory management and sales tracking.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm animate-fade-in" style="animation-delay: 0.1s">
            <div class="card-body p-4 text-center">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 16px;">
                    <i data-lucide="package" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="fw-bold mb-2">Product Management</h4>
                <p class="text-secondary small mb-4">View, add, and manage your inventory items and stock levels.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary w-100 py-2">
                    Manage Products
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm animate-fade-in" style="animation-delay: 0.2s">
            <div class="card-body p-4 text-center">
                <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 16px;">
                    <i data-lucide="shopping-cart" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="fw-bold mb-2">New Transaction</h4>
                <p class="text-secondary small mb-4">Quickly record a new sale and generate bills for your customers.</p>
                <a href="{{ route('sales.create') }}" class="btn btn-success w-100 py-2 text-white border-0" style="background-color: var(--success)">
                    Record a Sale
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm animate-fade-in" style="animation-delay: 0.3s">
            <div class="card-body p-4 text-center">
                <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 16px;">
                    <i data-lucide="bar-chart-3" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="fw-bold mb-2">Business Reports</h4>
                <p class="text-secondary small mb-4">Analyze your profits, sales, and financial performance over time.</p>
                <a href="{{ route('reports.index') }}" class="btn btn-info w-100 py-2 text-white border-0" style="background-color: var(--info)">
                    View Reports
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-lg overflow-hidden animate-fade-in" style="animation-delay: 0.4s">
    <div class="row g-0">
        <div class="col-md-8 p-5">
            <h3 class="fw-bold mb-3">Professional Inventory Tracking</h3>
            <p class="text-secondary mb-4">InventoryPro helps you keep track of your stock levels in real-time. Every sale automatically deducts from your stock, ensuring you never oversell and always know when to restock.</p>
            <div class="row g-3">
                <div class="col-sm-6 d-flex align-items-center gap-2">
                    <i data-lucide="check" class="text-success" style="width: 20px;"></i>
                    <span class="fw-medium">Real-time stock updates</span>
                </div>
                <div class="col-sm-6 d-flex align-items-center gap-2">
                    <i data-lucide="check" class="text-success" style="width: 20px;"></i>
                    <span class="fw-medium">Automated profit analysis</span>
                </div>
                <div class="col-sm-6 d-flex align-items-center gap-2">
                    <i data-lucide="check" class="text-success" style="width: 20px;"></i>
                    <span class="fw-medium">VAT and Discount calculation</span>
                </div>
                <div class="col-sm-6 d-flex align-items-center gap-2">
                    <i data-lucide="check" class="text-success" style="width: 20px;"></i>
                    <span class="fw-medium">Due payment tracking</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center p-5">
            <i data-lucide="layout" class="text-primary opacity-25" style="width: 200px; height: 200px;"></i>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection
