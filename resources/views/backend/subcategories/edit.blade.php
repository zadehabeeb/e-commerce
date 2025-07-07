@extends('backend.layout.master')

@section('title', 'Edit Subcategory')

@section('content')
    <div class="container mt-4">
        <h2>Edit Subcategory</h2>

        <form action="{{ route('backend.subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Subcategory Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subcategory->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slug Field -->
            <div class="mb-3">
                <label for="slug" class="form-label">Subcategory Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $subcategory->slug) }}" required>
                @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Field -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $subcategory->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($subcategory->image)
                    <img src="{{ asset('storage/' . $subcategory->image) }}" alt="Image" width="100" class="mt-3">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Active Field -->
            <div class="mb-3">
                <label for="is_active" class="form-label">Active</label>
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }}>
            </div>

            <!-- Sort Order Field -->
            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $subcategory->sort_order) }}">
            </div>

            <!-- Meta Title Field -->
            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $subcategory->meta_title) }}">
            </div>

            <!-- Meta Description Field -->
            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $subcategory->meta_description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Subcategory</button>
            <a href="{{ route('backend.subcategories.index') }}" class="btn btn-secondary">Back to Subcategories</a>
        </form>
    </div>
@endsection
