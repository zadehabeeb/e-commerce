@extends('frontend.layout.master')

@section('title', $product->name)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Product Image and Details Section -->
            <div class="col-md-6">
                <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
                
                <div class="additional-images mt-3">
                    @foreach($galleryImages as $image)
                        <img src="{{ $image }}" class="img-fluid" alt="Additional Image">
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p class="lead">${{ $product->price }}</p>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                </form>

                <!-- Add More Button -->
                <a href="{{ route('products.all') }}" class="btn btn-secondary mt-3">Add More Products</a>
            </div>
        </div>
    </div>
@endsection
