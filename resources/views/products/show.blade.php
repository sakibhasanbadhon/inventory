@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('products.index') }}" class="btn btn-light border-0 shadow-sm rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="arrow-left" style="width: 20px;"></i>
                </a>
                <div>
                    <h2 class="fw-bold mb-0">Product Details</h2>
                    <p class="text-secondary mb-0">Information about #{{ $product->id }}</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                    <i data-lucide="edit-3"></i> Edit Product
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-lg animate-fade-in overflow-hidden">
            <div class="card-header bg-primary py-4 px-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 p-1 rounded-4 shadow-sm overflow-hidden" style="width: 80px; height: 80px;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover rounded-3">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                <i data-lucide="package" style="width: 32px; height: 32px;"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-white fw-bold mb-0">{{ $product->name }}</h3>
                        <span class="badge bg-white bg-opacity-20 text-black rounded-pill mt-2 px-3">
                            Current Stock: {{ $product->current_stock }} Units
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <td class="ps-4 py-4 text-secondary w-25"><i data-lucide="hash" class="me-2" style="width:16px"></i> Product ID</td>
                                <td class="fw-bold py-4">PRD-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4 text-secondary"><i data-lucide="tag" class="me-2" style="width:16px"></i> Purchase Price</td>
                                <td class="fw-bold py-4 text-danger">৳{{ number_format($product->purchase_price, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4 text-secondary"><i data-lucide="trending-up" class="me-2" style="width:16px"></i> Selling Price</td>
                                <td class="fw-bold py-4 text-success">৳{{ number_format($product->selling_price, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4 text-secondary"><i data-lucide="archive" class="me-2" style="width:16px"></i> Opening Stock</td>
                                <td class="fw-bold py-4">{{ $product->opening_stock }} Units</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4 text-secondary"><i data-lucide="calendar" class="me-2" style="width:16px"></i> Date Added</td>
                                <td class="fw-bold py-4">{{ $product->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-4 text-secondary"><i data-lucide="refresh-cw" class="me-2" style="width:16px"></i> Last Updated</td>
                                <td class="fw-bold py-4 border-0">{{ $product->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light p-4 border-0">
                <div class="d-flex align-items-center gap-2">
                    <i data-lucide="info" class="text-info" style="width: 20px;"></i>
                    <p class="mb-0 small text-secondary">Prices are in Bangladeshi Taka (৳). Stock is updated automatically upon transactions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection