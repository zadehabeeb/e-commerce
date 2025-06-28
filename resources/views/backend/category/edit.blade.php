@extends('backend.layout.master')

@section('title', 'Edit Category')

@section('content')
    <div class="container mt-4">
        <h2>Edit Category</h2>

        <form action="{{ route('backend.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Category Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="mt-3" width="150">
                @endif
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Active</label>
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}">
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $category->meta_description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Category</button>
            <a href="{{ route('backend.category.index') }}" class="btn btn-secondary">Back to Categories</a>
        </form>
    </div>
@endsection
