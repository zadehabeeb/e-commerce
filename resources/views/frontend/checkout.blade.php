@extends('frontend.layout.master')

@section('title', 'Checkout')

@section('content')
   <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <!-- Display Cart Items -->
    <h4>Cart Summary</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->product->price, 2) }}</td>
                <td>{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                @php
                    $totalAmount += $item->product->price * $item->quantity;
                @endphp
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display Total Amount -->
    <h4>Total: ${{ number_format($totalAmount, 2) }}</h4>

    <!-- Shipping Information -->
    <div class="form-group">
        <label for="shipping_address">Shipping Address</label>
        <textarea name="shipping_address" id="shipping_address"
                  class="form-control" required></textarea>
    </div>

    <!-- Payment Information -->
    <div class="form-group">
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method"
                class="form-control" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success mt-3">Complete Order</button>
</form>
@endsection
