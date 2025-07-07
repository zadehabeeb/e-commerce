@extends('backend.layout.master')

@section('title', 'Edit Product')

@section('content')
    <div class="container mt-4">
        <h2>Edit Product</h2>

        <form action="{{ route('backend.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Slug Field -->
            <div class="mb-3">
                <label for="slug" class="form-label">Product Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product SKU -->
            <div class="mb-3">
                <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                @error('sku')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price Field -->
            <div class="mb-3">
                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stock Quantity Field -->
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                @error('stock_quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Short Description Field -->
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea class="form-control" id="short_description" name="short_description">{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            <!-- Image Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="100" class="mt-3">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Field -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subcategory Field -->
            <div class="mb-3">
                <label for="subcategory_id" class="form-label">Subcategory <span class="text-danger">*</span></label>
                <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('subcategory_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Is Active Field -->
            <div class="mb-3">
                <label for="is_active" class="form-label">Is Active</label>
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            </div>

            <!-- Manage Stock Field -->
            <div class="mb-3">
                <label for="manage_stock" class="form-label">Manage Stock</label>
                <input type="checkbox" id="manage_stock" name="manage_stock" value="1" {{ old('manage_stock', $product->manage_stock) ? 'checked' : '' }}>
            </div>

            <!-- Sale Price Field -->
            <div class="mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
            </div>

            <!-- Stock Status Field -->
            <div class="mb-3">
                <label for="stock_status" class="form-label">Stock Status <span class="text-danger">*</span></label>
                <select class="form-control" id="stock_status" name="stock_status" required>
                    <option value="in_stock" {{ old('stock_status', $product->stock_status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="out_of_stock" {{ old('stock_status', $product->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
                @error('stock_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Product</button>
            <a href="{{ route('backend.products.index') }}" class="btn btn-secondary">Back to Products</a>
        </form>
    </div>
@endsection
