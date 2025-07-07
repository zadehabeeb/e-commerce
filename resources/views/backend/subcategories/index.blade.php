@extends('backend.layout.master')

@section('title', 'Subcategories')

@section('content')
    <div class="container mt-4">
        <h2>Subcategories List</h2>

        <div class="mb-3">
            <a href="{{ route('backend.subcategories.create') }}" class="btn btn-primary">Add New Subcategory</a>
        </div>

        @if($subcategories->isEmpty())
            <p>No subcategories found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th>Sort Order</th>
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->slug }}</td>
                            <td>{{ $subcategory->description }}</td>
                            <td>{{ $subcategory->category->name }}</td> <!-- عرض اسم الفئة الرئيسية -->
                            <td>{{ $subcategory->is_active ? 'Active' : 'Inactive' }}</td> <!-- عرض حالة الفئة -->
                            <td>{{ $subcategory->sort_order }}</td> <!-- عرض ترتيب العرض -->
                            <td>{{ $subcategory->meta_title }}</td> <!-- عرض Meta Title -->
                            <td>{{ $subcategory->meta_description }}</td> <!-- عرض Meta Description -->
                            <td>{{ $subcategory->created_at->format('Y-m-d H:i:s') }}</td> <!-- عرض تاريخ الإنشاء -->
                            <td>{{ $subcategory->updated_at->format('Y-m-d H:i:s') }}</td> <!-- عرض تاريخ التحديث -->
                            <td>
                                <a href="{{ route('backend.subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('backend.subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
