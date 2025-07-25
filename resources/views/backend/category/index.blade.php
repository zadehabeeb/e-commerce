@extends('backend.layout.master')

@section('title', 'Categories')

@section('content')



      {{ $dataTable->table() }}





    {{-- <div class="container mt-4">
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
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $category->sort_order }}</td>
                    <td>{{ $category->meta_title }}</td>
                    <td>{{ $category->meta_description }}</td>
                    <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td> <!-- تنسيق التاريخ -->
                    <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td> <!-- تنسيق التاريخ -->
                    <td>
                        <a href="{{ route('backend.category.edit', $category->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('backend.category.destroy', $category->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div> --}}
    <!-- DataTable for Categories -->









@endsection

@push('script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
{{-- <script src="{{asset('assets/js/backend/category.js')}}"></script> --}}
@endpush
