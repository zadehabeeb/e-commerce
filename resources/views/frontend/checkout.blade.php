@extends('frontend.layout.master')

@section('title', 'Checkout')

@section('content')
   <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
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
