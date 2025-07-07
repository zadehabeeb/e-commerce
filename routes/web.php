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
Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store'])->name('admin.login.submit');

// Protect Admin Routes with 'auth' and 'role:admin' middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('
#
', [AdminController::class, 'index'])->name('backend.dashboard');

    // Category Routes
    Route::get('/categories', action: [CategoryController::class, 'index'])->name('backend.category.index'); // عرض قائمة الفئات
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('backend.category.create'); // عرض نموذج إضافة فئة جديدة
    Route::post('/categories', [CategoryController::class, 'store'])->name('backend.category.store'); // تخزين الفئة الجديدة
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('backend.category.edit'); // عرض نموذج تعديل فئة
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('backend.category.update'); // تحديث الفئة
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('backend.category.destroy'); // حذف الفئة


    // Subcategory Routes
    Route::get('/subcategories', action: [SubcategoryController::class, 'index'])->name('backend.subcategories.index'); // عرض جميع الفئات الفرعية
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('backend.subcategories.create'); // عرض نموذج إضافة فئة فرعية جديدة
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('backend.subcategories.store'); // تخزين الفئة الفرعية الجديدة
    Route::get('/subcategories/{id}/edit', [SubcategoryController::class, 'edit'])->name('backend.subcategories.edit'); // عرض نموذج تعديل فئة فرعية
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update'])->name('backend.subcategories.update'); // تحديث الفئة الفرعية
    Route::delete('/subcategories/{id}', [SubcategoryController::class, 'destroy'])->name('backend.subcategories.destroy'); // حذف الفئة الفرعية


    // Product Routes
    Route::get('/product', action: [ProductController::class, 'index'])->name('backend.products.index'); // عرض جميع المنتجات
    Route::get('/product/create', [ProductController::class, 'create'])->name('backend.products.create'); // عرض نموذج إضافة منتج جديد
    Route::post('/products', [ProductController::class, 'store'])->name('backend.products.store'); // تخزين المنتج الجديد
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('backend.products.edit'); // عرض نموذج تعديل منتج
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('backend.products.update'); // تحديث المنتج
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('backend.products.destroy'); // حذف المنتج
});





// Public Route (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Route (Dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';





Route::get('/index', function () {
    return view('frontend.index');
});



Route::get('/products', [FrontendProductController::class, 'showAllProducts'])->name('products.all');

Route::get('/product/{product}', [FrontendProductController::class, 'showProductDetails'])->name('product.details');

Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
