@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Products Inventory</h2>
        <p class="text-secondary mb-0">Manage and track your product stock levels</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i data-lucide="plus"></i> Add New Product
    </a>
</div>

<div class="table-container animate-fade-in shadow-lg">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width: 80px;">S.I</th>
                <th style="width: 100px;">Image</th>
                <th>Product Name</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Current Stock</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td class="text-secondary fw-medium">#{{ $product->id }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-3 shadow-sm border" style="width: 48px; height: 48px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border" style="width: 48px; height: 48px;">
                            <i data-lucide="image" class="text-muted" style="width: 18px;"></i>
                        </div>
                    @endif
                </td>
                <td>
                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                </td>
                <td><span class="text-secondary small">৳</span>{{ number_format($product->purchase_price, 2) }}</td>
                <td><span class="text-secondary small">৳</span>{{ number_format($product->selling_price, 2) }}</td>
                <td>
                    @if($product->current_stock <= 10)
                        <span class="badge badge-stock-low">
                            <i data-lucide="alert-triangle" class="d-inline-block align-text-bottom" style="width:14px"></i>
                            {{ $product->current_stock }} Low Stock
                        </span>
                    @else
                        <span class="badge badge-stock-ok">
                            {{ $product->current_stock }} In Stock
                        </span>
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-light text-info" title="View Details">
                            <i data-lucide="eye" style="width:16px"></i>
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-light text-warning" title="Edit Product">
                            <i data-lucide="edit-3" style="width:16px"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete Product">
                                <i data-lucide="trash-2" style="width:16px"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="p-5 text-center text-secondary">
                    <i data-lucide="package-search" class="mb-3 d-block mx-auto text-muted" style="width:48px; height:48px;"></i>
                    <p class="mb-0">No products found in the database.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    // Refresh icons for dynamically added content if any
    lucide.createIcons();
</script>
@endsection