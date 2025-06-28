<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


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


require __DIR__.'/auth.php';

Route::get('/categories', [CategoryController::class, 'index'])->name('backend.category.index'); // عرض قائمة الفئات

Route::get('/categories/create', [CategoryController::class, 'create'])->name('backend.category.create'); // عرض نموذج إضافة فئة جديدة

Route::post('/categories', [CategoryController::class, 'store'])->name('backend.category.store'); // تخزين الفئة الجديدة

Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('backend.category.edit'); // عرض نموذج تعديل فئة

Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('backend.category.update'); // تحديث الفئة

Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('backend.category.destroy'); // حذف الفئة