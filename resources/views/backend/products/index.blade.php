{{-- @extends('backend.layout.master')

@section('title', 'Products')

@section('content')
    <div class="container mt-4">
        <h2>Products List</h2>

        <div class="mb-3">
            <a href="{{ route('backend.products.create') }}" class="btn btn-primary">Add New Product</a>
        </div>

        @if($products->isEmpty())
            <p>No products found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Actions</th>
                        <th>More Info</th> <!-- جديد لإظهار الحقول الإضافية -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->subcategory->name }}</td>

                            <!-- هذه الحقول المخفية بدايةً -->
                            <td id="more-info-{{ $product->id }}" class="more-info" style="display: none;">
                                <p>Description: {{ $product->description }}</p>
                                <p>Sale Price: {{ $product->sale_price }}</p>
                                <p>Stock Status: {{ $product->stock_status }}</p>
                                <p>Meta Title: {{ $product->meta_title }}</p>
                                <p>Meta Description: {{ $product->meta_description }}</p>
                                <p>Is Featured: {{ $product->is_featured ? 'Yes' : 'No' }}</p>
                                <p>Created At: {{ $product->created_at->format('Y-m-d H:i:s') }}</p> <!-- عرض Created At -->
                                <p>Updated At: {{ $product->updated_at->format('Y-m-d H:i:s') }}</p> <!-- عرض Updated At -->
                            </td>

                            <!-- Actions: Edit and Delete -->
                            <td>
                                <a href="{{ route('backend.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('backend.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>

                            <!-- More Button -->
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="toggleMoreInfo({{ $product->id }})">More</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        // JavaScript function to toggle more info
        function toggleMoreInfo(productId) {
            var moreInfoRow = document.getElementById("more-info-" + productId);
            if (moreInfoRow.style.display === "none" || moreInfoRow.style.display === "") {
                moreInfoRow.style.display = "table-row"; // Show the row
            } else {
                moreInfoRow.style.display = "none"; // Hide the row
            }
        }
    </script>
@endsection --}}

@extends('backend.layout.master')

@push('css')
@endpush


@section('content')
  <div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0">Products</h2>
                    </div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-warning text-white create-product-btn"
                                data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bx bx-layer-plus"></i> insert
                        </button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive" style="max-height: calc(100vh - 14.5rem); overflow-y: auto;">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Edit Modal --}}
    @include('backend.products.partials.editmodal')

    {{-- Create Modal --}}
    @include('backend.products.partials.createmodal')

    
@endsection


@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ asset('assets/product.js') }}"></script>
@endpush
