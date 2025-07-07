@extends('frontend.layout.master')

@section('title', 'All Products') <!-- Set page title dynamically -->

@section('content')
    <div class="container mt-4">
        <h2>All Products</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <!-- Product Image -->
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">

                        <div class="card-body">
                            <!-- Link to Product Details Page -->
                            <h5 class="card-title">
                                <a href="{{ route('product.details', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <p class="card-text">${{ $product->price }}</p>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf

                                <!-- Quantity Input (default value is 1) -->
                                <div class="form-group">
                                    <label for="quantity{{ $product->id }}">Quantity</label>
                                    <input type="number" name="quantity" id="quantity{{ $product->id }}" value="1" min="1" class="form-control" style="width: 80px; display: inline-block;">
                                </div>

                                <!-- Add to Cart Button -->
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
