<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     * Validates stock, uses the product’s current price (ignoring any client‑supplied price),
     * stores the item in the shopping_carts table, and updates the session cart.
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Ensure quantity is at least 1
        $quantity = max((int) $request->input('quantity', 1), 1);

        // Stock validation
        if ($product->stock_quantity < $quantity) {
            return back()->with('error', 'Insufficient stock for this product.');
        }

        // Use current price (sale price overrides normal price)
        $price = $product->sale_price ?? $product->price;
        $userId = auth()->id();

        // Check if item already exists in the user’s cart
        $cartItem = ShoppingCart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Adding to an existing item—validate stock again
            $newQuantity = $cartItem->quantity + $quantity;
            if ($product->stock_quantity < $newQuantity) {
                return back()->with('error', 'Insufficient stock to add this quantity.');
            }
            $cartItem->update([
                'quantity' => $newQuantity,
                'price'    => $price,
                'total'    => $newQuantity * $price,
            ]);
        } else {
            ShoppingCart::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $price,
                'total'      => $quantity * $price,
            ]);
        }

        // Update the session cart for legacy views
        $sessionCart = session()->get('cart', []);
        if (isset($sessionCart[$productId])) {
            $sessionCart[$productId]['quantity'] += $quantity;
            $sessionCart[$productId]['price']    = $price;
        } else {
            $sessionCart[$productId] = [
                'name'     => $product->name,
                'price'    => $price,
                'quantity' => $quantity,
                'image'    => $product->image,
            ];
        }
        session()->put('cart', $sessionCart);

        return redirect()->route('cart.index');
    }

    /**
     * Display the contents of the cart.
     * Deletes items older than two hours (using updated_at), recalculates totals using the
     * product’s current price, synchronizes the session cart, and returns the view.
     */
    public function index()
    {
        $userId = auth()->id();

        // Remove cart entries older than 2 hours (simple expiration policy)
        ShoppingCart::where('user_id', $userId)
            ->where('updated_at', '<=', now()->subHours(2))
            ->delete();

        // Retrieve cart items with related products
        $items = ShoppingCart::where('user_id', $userId)
            ->with('product')
            ->get();

        $sessionCart = [];
        $subtotal    = 0;

        foreach ($items as $item) {
            $product      = $item->product;
            $currentPrice = $product->sale_price ?? $product->price;

            // If the price has changed since it was stored, update DB and session
            if ($item->price != $currentPrice) {
                $item->update([
                    'price' => $currentPrice,
                    'total' => $currentPrice * $item->quantity,
                ]);
            }

            $sessionCart[$product->id] = [
                'name'     => $product->name,
                'price'    => $currentPrice,
                'quantity' => $item->quantity,
                'image'    => $product->image,
            ];

            $subtotal += $currentPrice * $item->quantity;
        }

        session()->put('cart', $sessionCart);

        return view('frontend.cart', [
            'cart'     => $sessionCart,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Remove a product from the cart.
     * Deletes the record from shopping_carts and updates the session cart.
     */
    public function remove($productId)
    {
        $userId = auth()->id();

        ShoppingCart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        $sessionCart = session()->get('cart', []);
        unset($sessionCart[$productId]);
        session()->put('cart', $sessionCart);

        return redirect()->route('cart.index');
    }

    /**
     * Update the quantity of a product in the cart.
     * Validates stock, updates the database record and session, and resets the timestamp
     * (so it won’t expire prematurely).
     */
    public function update(Request $request, $productId)
    {
        $userId   = auth()->id();
        $cartItem = ShoppingCart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = max((int) $request->input('quantity', 1), 1);
            $product     = $cartItem->product;

            // Validate stock
            if ($product->stock_quantity < $newQuantity) {
                return back()->with('error', 'Insufficient stock for this quantity.');
            }

            $currentPrice = $product->sale_price ?? $product->price;

            $cartItem->update([
                'quantity' => $newQuantity,
                'price'    => $currentPrice,
                'total'    => $currentPrice * $newQuantity,
            ]);

            // Update session cart
            $sessionCart = session()->get('cart', []);
            if (isset($sessionCart[$productId])) {
                $sessionCart[$productId]['quantity'] = $newQuantity;
                $sessionCart[$productId]['price']    = $currentPrice;
                session()->put('cart', $sessionCart);
            }
        }

        return redirect()->route('cart.index');
    }
}
