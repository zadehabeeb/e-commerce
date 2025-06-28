@extends('backend.layout.master')

@section('title', 'Add New Category')

@section('content')
    <div class="container mt-4">
        <h2>Add New Category</h2>

        <form action="{{ route('backend.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Category Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Active</label>
                <input type="checkbox" id="is_active" name="is_active" value="1" checked>
            </div>

            <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title">
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Save Category</button>
            <a href="{{ route('backend.category.index') }}" class="btn btn-secondary">Back to Categories</a>
        </form>
    </div>
@endsection
