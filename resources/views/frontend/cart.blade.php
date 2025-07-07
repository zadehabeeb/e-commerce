@extends('frontend.layout.master')

@section('title', 'Your Cart')

@section('content')
    <div class="container mt-4">
        <h2>Your Cart</h2>
        
        @if(session('cart') && count(session('cart')) > 0)
            <div class="row">
                @foreach(session('cart') as $productId => $product)
                    <div class="col-md-4">
                        <div class="cart-item">
                            <img src="{{ $product['image'] }}" class="img-fluid" alt="{{ $product['name'] }}">
                            <h5>{{ $product['name'] }}</h5>
                            <p>${{ $product['price'] }}</p>
                            <p>Quantity: {{ $product['quantity'] }}</p>

                            <!-- Update Quantity Form -->
                            <form action="{{ route('cart.update', $productId) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" class="form-control" style="width: 80px; display: inline-block;">
                                <button type="submit" class="btn btn-warning">Update Quantity</button>
                            </form>

                            <!-- Remove Product from Cart -->
                            <form action="{{ route('cart.remove', $productId) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Subtotal -->
            
            <div class="mt-4">
                <h4>Cart Subtotal: ${{ $subtotal }}</h4>
                <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
            </div>

            <!-- Add More Products Button -->
            <div class="mt-4">
                <a href="{{ route('products.all') }}" class="btn btn-secondary">Add More Products</a>
            </div>
        @else
            <p>Your cart is empty!</p>
             <div class="mt-4">
                <a href="{{ route('products.all') }}" class="btn btn-secondary">Add More Products</a>
            </div>
        @endif
    </div>
@endsection
