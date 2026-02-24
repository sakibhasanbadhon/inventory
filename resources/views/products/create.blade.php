@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-light border-0 shadow-sm rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="arrow-left" style="width: 20px;"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Add New Product</h2>
                <p class="text-secondary mb-0">Create a new item in your inventory</p>
            </div>
        </div>

        <div class="card border-0 shadow-lg animate-fade-in">
            <div class="card-header border-0 pt-4 px-4 bg-transparent">
                <h5 class="fw-bold mb-0">New Product Information</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label">Product Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="package" style="width: 18px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Premium Coffee Beans" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">Product Image</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="image" style="width: 18px;"></i>
                                </span>
                                <input type="file" class="form-control border-start-0 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            </div>
                            <small class="text-muted">Upload a clear photo of the product (Max: 2MB).</small>
                            @error('image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="purchase_price" class="form-label">Purchase Price (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" step="0.01" class="form-control border-start-0 @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" required placeholder="0.00">
                            </div>
                            @error('purchase_price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="selling_price" class="form-label">Selling Price (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" step="0.01" class="form-control border-start-0 @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" required placeholder="0.00">
                            </div>
                            @error('selling_price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="opening_stock" class="form-label">Initial Stock Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="archive" style="width: 18px;"></i>
                                </span>
                                <input type="number" class="form-control border-start-0 @error('opening_stock') is-invalid @enderror" id="opening_stock" name="opening_stock" value="{{ old('opening_stock') }}" required placeholder="0">
                            </div>
                            <small class="text-muted">How many units do you have right now?</small>
                            @error('opening_stock')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="col-12 d-flex gap-3 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i data-lucide="plus-circle"></i> Create Product
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-light border px-4">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection