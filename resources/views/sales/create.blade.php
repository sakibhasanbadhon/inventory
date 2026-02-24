@extends('layouts.app')

@section('title', 'New Sale')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 text-dark">
    <div>
        <h2 class="fw-bold mb-0">Record New Sale</h2>
        <p class="text-secondary mb-0">Complete a transaction and update inventory</p>
    </div>
</div>

<form method="POST" action="{{ route('sales.store') }}" id="saleForm">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4 animate-fade-in">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Transaction Details</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Select Product</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="search" style="width: 18px;"></i>
                                </span>
                                <select name="product_id" class="form-select border-start-0 @error('product_id') is-invalid @enderror" required id="productSelect">
                                    <option value="">Choose a product...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                                data-price="{{ $product->selling_price }}"
                                                data-stock="{{ $product->current_stock }}">
                                            {{ $product->name }} (Stock: {{ $product->current_stock }}) — ৳{{ number_format($product->selling_price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('product_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="layers" style="width: 18px;"></i>
                                </span>
                                <input type="number" name="quantity" class="form-control border-start-0 @error('quantity') is-invalid @enderror" required min="1" id="quantity" placeholder="Units">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Transaction Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="calendar" style="width: 18px;"></i>
                                </span>
                                <input type="date" name="transaction_date" class="form-control border-start-0" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Discount Amount (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" name="discount" class="form-control border-start-0" value="0" min="0" id="discount">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Paid Amount (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" name="paid" class="form-control border-start-0" required min="0" id="paid" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-5 py-3 shadow-lg">
                    <i data-lucide="check-circle"></i> Complete & Mark as Paid
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-light border px-4">
                    Discard
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top animate-fade-in" style="top: 100px; z-index: 10;">
                <div class="card-header border-0 pt-4 px-4 bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                    <h5 class="fw-bold mb-0">Bill Summary</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary align-middle"><i data-lucide="minus" class="d-inline me-1" style="width:14px"></i> Subtotal</span>
                        <span class="fw-bold">৳<span id="subtotal">0.00</span></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-danger">
                        <span class="text-secondary align-middle"><i data-lucide="tag" class="d-inline me-1" style="width:14px"></i> Discount</span>
                        <span class="fw-bold">- ৳<span id="discount_view">0.00</span></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary align-middle"><i data-lucide="plus" class="d-inline me-1" style="width:14px"></i> VAT (5%)</span>
                        <span class="fw-bold">৳<span id="vat">0.00</span></span>
                    </div>
                    <hr class="my-4 opacity-10">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 fw-bold mb-0">Grand Total</span>
                        <span class="h5 fw-bold mb-0 text-primary">৳<span id="total">0.00</span></span>
                    </div>
                    
                    <div class="bg-light p-3 rounded-4">
                        <div class="d-flex justify-content-between text-warning">
                            <span class="small fw-bold">DUE AMOUNT</span>
                            <span class="small fw-bold">৳<span id="due">0.00</span></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 p-4 text-center">
                    <p class="small text-secondary mb-0">Please verify all details before submitting.</p>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('productSelect').addEventListener('change', calculate);
    document.getElementById('quantity').addEventListener('input', calculate);
    document.getElementById('discount').addEventListener('input', calculate);
    document.getElementById('paid').addEventListener('input', calculate);

    function calculate() {
        const productEl = document.getElementById('productSelect');
        const price = parseFloat(productEl.selectedOptions[0]?.dataset.price || 0);
        const qty = parseFloat(document.getElementById('quantity').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const paid = parseFloat(document.getElementById('paid').value) || 0;

        const subtotal = price * qty;
        const vat = subtotal * 0.05;
        const total = subtotal - discount + vat;
        const due = total - paid;

        document.getElementById('subtotal').innerText = subtotal.toLocaleString(undefined, {minimumFractionDigits: 2});
        document.getElementById('discount_view').innerText = discount.toLocaleString(undefined, {minimumFractionDigits: 2});
        document.getElementById('vat').innerText = vat.toLocaleString(undefined, {minimumFractionDigits: 2});
        document.getElementById('total').innerText = total.toLocaleString(undefined, {minimumFractionDigits: 2});
        document.getElementById('due').innerText = due.toLocaleString(undefined, {minimumFractionDigits: 2});
    }
    
    lucide.createIcons();
</script>
@endsection