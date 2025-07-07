<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FrontendProductController extends Controller
{
    public function showAllProducts()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('frontend.index', compact('products'));
    }
    public function showProductDetails(Product $product)
    {
        // Load additional images if available in the JSON format
        $galleryImages = json_decode($product->gallery, true); // Assuming 'gallery' field is JSON

        // Pass the product and images to the view
        return view('frontend.product-details', compact('product', 'galleryImages'));
    }
}

