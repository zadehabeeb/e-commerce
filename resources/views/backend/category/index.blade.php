@extends('backend.layout.master')

@section('title', 'Categories')

@section('content')
    <div class="container mt-4">
        <h2>Categories List</h2>

        <div class="mb-3">
            <a href="{{ route('backend.category.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

        @if($categories->isEmpty())
            <p>No categories found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('backend.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('backend.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
