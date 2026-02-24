@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-light border-0 shadow-sm rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="arrow-left" style="width: 20px;"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Edit Product</h2>
                <p class="text-secondary mb-0">Update information for <span class="text-primary">{{ $product->name }}</span></p>
            </div>
        </div>

        <div class="card border-0 shadow-lg animate-fade-in">
            <div class="card-header border-0 pt-4 px-4 bg-transparent">
                <h5 class="fw-bold mb-0">Product Details</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12 text-center mb-2">
                             @if($product->image)
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-4 shadow-sm border" style="width: 120px; height: 120px; object-fit: cover;">
                                    <span class="position-absolute bottom-0 end-0 bg-primary text-white p-1 rounded-circle shadow-sm" style="transform: translate(25%, 25%)">
                                        <i data-lucide="camera" style="width: 14px; height: 14px;"></i>
                                    </span>
                                </div>
                             @else
                                <div class="bg-light rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px; border: 2px dashed #e2e8f0;">
                                    <i data-lucide="image" class="text-muted" style="width: 32px; height: 32px;"></i>
                                </div>
                             @endif
                        </div>

                        <div class="col-12">
                            <label for="name" class="form-label">Product Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="package" style="width: 18px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">Update Image <small class="text-secondary">(Leave blank to keep current)</small></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="image" style="width: 18px;"></i>
                                </span>
                                <input type="file" class="form-control border-start-0 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            </div>
                            @error('image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="purchase_price" class="form-label">Purchase Price (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" step="0.01" class="form-control border-start-0 @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                            </div>
                            @error('purchase_price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="selling_price" class="form-label">Selling Price (৳)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">৳</span>
                                <input type="number" step="0.01" class="form-control border-start-0 @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required>
                            </div>
                            @error('selling_price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Opening Stock</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="archive" style="width: 18px;"></i>
                                </span>
                                <input type="number" class="form-control border-start-0 bg-light" value="{{ $product->opening_stock }}" readonly disabled title="Opening stock cannot be changed after creation">
                            </div>
                            <small class="text-muted">Initial stock level when created.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Current Stock</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-secondary">
                                    <i data-lucide="layers" style="width: 18px;"></i>
                                </span>
                                <input type="number" class="form-control border-start-0 @if($product->current_stock <= 10) bg-danger bg-opacity-10 text-danger @else bg-light @endif" value="{{ $product->current_stock }}" readonly disabled>
                            </div>
                            <small class="text-muted">Updated automatically by sales.</small>
                        </div>

                        <hr class="my-4 opacity-10">

                        <div class="col-12 d-flex gap-3 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i data-lucide="save"></i> Update Changes
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