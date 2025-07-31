<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method'   => 'required|string|max:50',
        ]);

        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'You must be logged in to place an order.');
        }

        $cartItems = ShoppingCart::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            // Validate stock and compute total
            foreach ($cartItems as $item) {
                $product = $item->product;
                if (!$product || $product->stock_quantity < $item->quantity) {
                    throw new \Exception("Insufficient stock for {$product->name}.");
                }
                $currentPrice = $product->sale_price ?? $product->price;
                $total       += $currentPrice * $item->quantity;
            }

            // Simulate payment (replace with real gateway)
            if (!$this->processPayment($total, $validated['payment_method'])) {
                throw new \Exception('Payment processing failed.');
            }

            // Generate unique order number to satisfy NOT NULL constraint:contentReference[oaicite:2]{index=2}
            $orderNumber = strtoupper(uniqid('ORD-'));

            // Create order
            $order = Order::create([
                // 'user_id'          => $user->id,
                // 'order_number'     => $orderNumber,
                'total_amount'     => $total,
                'status'           => 'paid',
                'payment_status'   => 'paid',
                // 'payment_method'   => $validated['payment_method'],
                'shipping_address' => $validated['shipping_address'],
                'transaction_id'   => Str::uuid(),
            ]);

            // Create order items and update stock
            foreach ($cartItems as $item) {
                $product      = $item->product;
                $currentPrice = $product->sale_price ?? $product->price;
                $quantity     = $item->quantity;
                OrderItem::create([
                    // 'order_id'     => $order->id,
                    'product_id'   => $product->id,
                    'product_name' => $product->name,
                    'product_sku'  => $product->sku,
                    'quantity'     => $quantity,
                    'price'        => $currentPrice,
                    'total'        => $currentPrice * $quantity,
                ]);
                $product->decrement('stock_quantity', $quantity);
            }

            DB::commit();
            ShoppingCart::where('user_id', $user->id)->delete();
            Session::forget('cart');

            return redirect('/index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed. '.$e->getMessage());
        }
    }

    protected function processPayment(float $amount, string $method): bool
    {
        return true; // replace with actual payment gateway integration
    }
}
