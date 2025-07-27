<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
//frontend
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use Laratrust\Middleware\Role;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Login Routes
Route::get('/admin/login', [AdminLoginController::class, 'create'])
    ->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store'])
    ->name('admin.login.submit');

// Group all admin routes under a single prefix and middleware
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin') // remove the extra /admin prefix from individual paths
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('backend.dashboard');

        // Category Routes (resourceful)
        Route::resource('categories', CategoryController::class)
            ->names('backend.categories');

            

        // Subcategory Routes (resourceful)
        Route::resource('subcategories', SubcategoryController::class)
            ->names('backend.subcategories');

        // Product Routes (resourceful)
        Route::resource('products', ProductController::class)
            ->names('backend.products');
    });





// Public Route (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Route (Dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    
});


require __DIR__ . '/auth.php';





Route::get('/index', function () {
    return view('frontend.index');
});




   Route::middleware(['auth'])->group(function () {
     Route::get('/products', [FrontendProductController::class, 'showAllProducts'])->name('products.all');
     Route::get('/product/{product}', [FrontendProductController::class, 'showProductDetails'])->name('product.details');
     Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
     Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
     Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
     Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});
require __DIR__ . '/auth.php';