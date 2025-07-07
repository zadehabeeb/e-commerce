<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        // Get the product from the database
        $product = Product::findOrFail($productId);
        
        // Get the cart from the session (or initialize an empty array if not set)
        $cart = session()->get('cart', []);

        // Ensure the quantity is at least 1 (minimum quantity check)
        $quantity = $request->quantity >= 1 ? $request->quantity : 1;

        // If the product is already in the cart, increase the quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // If the product is not in the cart, add it with the selected quantity
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        // Update the session with the new cart data
        session()->put('cart', $cart);

        // Redirect to the cart page
        return redirect()->route('cart.index');
    }

    public function index()
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);

        // Calculate the cart subtotal (total price of all products in the cart)
        $subtotal = collect($cart)->sum(function ($product) {
            return $product['price'] * $product['quantity'];
        });

        // Pass the cart and subtotal to the view
        return view('frontend.cart', compact('cart', 'subtotal'));
    }

    public function remove($productId)
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);
        
        // Remove the product from the cart
        unset($cart[$productId]);

        // Update the session with the new cart data
        session()->put('cart', $cart);

        // Redirect to the cart page
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $productId)
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$productId])) {
            // Update the quantity of the product
            $cart[$productId]['quantity'] = $request->quantity >= 1 ? $request->quantity : 1; // Ensure quantity is at least 1
        }

        // Update the session with the modified cart
        session()->put('cart', $cart);

        // Redirect back to the cart page
        return redirect()->route('cart.index');
    }
}
