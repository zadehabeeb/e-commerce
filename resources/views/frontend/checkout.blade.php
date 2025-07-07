@extends('frontend.layout.master')

@section('title', 'Checkout')

@section('content')
    <div class="container mt-4">
        <h2>Checkout</h2>

        <!-- Checkout Form -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf  <!-- CSRF Token for security -->
            
            <!-- Shipping Information -->
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            
            <!-- Payment Information -->
            <div class="form-group">
                <label for="payment">Payment Method</label>
                <select name="payment" id="payment" class="form-control" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success mt-3">Complete Order</button>
        </form>
    </div>
@endsection
