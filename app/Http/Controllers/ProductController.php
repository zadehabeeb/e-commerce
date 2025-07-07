<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index()
    {
        $products = Product::all(); // جلب جميع المنتجات
        return view('backend.products.index', compact('products'));
    }

    // عرض نموذج إضافة منتج جديد
    public function create()
    {
        $categories = Category::all(); // جلب جميع الفئات
        $subcategories = Subcategory::all(); // جلب جميع الفئات الفرعية
        return view('backend.products.create', compact('categories', 'subcategories'));
    }

    // تخزين المنتج الجديد
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|unique:products,name|max:255',  // حقل name يجب أن يكون مطلوبًا وفريدًا
            'slug' => 'required|unique:products,slug|max:255',  // حقل slug يجب أن يكون مطلوبًا وفريدًا
            'sku' => 'required|unique:products,sku|max:255',    // حقل sku يجب أن يكون مطلوبًا وفريدًا
            'price' => 'required|numeric|min:0',                // حقل السعر يجب أن يكون مطلوبًا وأن يكون رقميًا
            'category_id' => 'required|exists:categories,id',   // التحقق من وجود category_id في جدول categories
            'subcategory_id' => 'required|exists:subcategories,id', // التحقق من وجود subcategory_id في جدول subcategories
            'stock_quantity' => 'integer|min:0',       // التحقق من الكمية المتاحة
            'description' => 'nullable|string',
            'short_description' => 'nullable|string', // حقل short_description اختياري
            'image' => 'nullable|image|max:2048',    // التحقق من رفع صورة
            'is_active' => 'nullable|boolean',        // التحقق من قيمة is_active
            'sale_price' => 'nullable|numeric|min:0', // سعر الخصم (اختياري)
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'gallery' => 'nullable|array', // صور إضافية (اختياري)
            'stock_status' => 'string|in:in_stock,out_of_stock', // حالة المخزون
            'manage_stock' => 'boolean', // إدارة المخزون
            'is_featured' => 'nullable|boolean',  // ما إذا كان المنتج مميزًا
            'dimensions' => 'nullable|string',   // أبعاد المنتج
            'weight' => 'nullable|numeric',      // وزن المنتج
            'min_quantity' => 'nullable|integer|min:1', // الحد الأدنى للكمية
            'cost_price' => 'nullable|numeric|min:0',   // سعر تكلفة المنتج
        ]);
         

        // إضافة المنتج إلى قاعدة البيانات
        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'image' => $request->image ? $request->image->store('products') : null,
            'is_active' => $request->is_active ?? false,
            'sale_price' => $request->sale_price,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'gallery' => $request->gallery,
            'stock_status' => $request->stock_status,
            'manage_stock' => $request->manage_stock,
            'is_featured' => $request->is_featured ?? false,
            'dimensions' => $request->dimensions,
            'weight' => $request->weight,
            'min_quantity' => $request->min_quantity,
            'cost_price' => $request->cost_price,
        ]);

        return redirect()->route('backend.products.index'); // إعادة التوجيه بعد الحفظ
    }

    // عرض نموذج تعديل منتج
    public function edit($id)
    {
        $product = Product::findOrFail($id); // العثور على المنتج باستخدام المعرف
        $categories = Category::all(); // جلب جميع الفئات
        $subcategories = Subcategory::all(); // جلب جميع الفئات الفرعية
        return view('backend.products.edit', compact('product', 'categories', 'subcategories'));
    }

    // تحديث المنتج
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|unique:products,name,' . $id . '|max:255',  // حقل name يجب أن يكون مطلوبًا وفريدًا
            'slug' => 'required|unique:products,slug,' . $id . '|max:255',  // حقل slug يجب أن يكون مطلوبًا وفريدًا
            'sku' => 'required|unique:products,sku,' . $id . '|max:255',    // حقل sku يجب أن يكون مطلوبًا وفريدًا
            'price' => 'required|numeric|min:0',                // حقل السعر يجب أن يكون مطلوبًا وأن يكون رقميًا
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'stock_quantity' => 'integer|min:0',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string', // حقل short_description اختياري
            'image' => 'nullable|image|max:2048',    // التحقق من رفع صورة
            'is_active' => 'nullable|boolean',        // التحقق من قيمة is_active
            'sale_price' => 'nullable|numeric|min:0', // سعر الخصم (اختياري)
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'gallery' => 'nullable|array', // صور إضافية (اختياري)
            'stock_status' => 'string|in:in_stock,out_of_stock', // حالة المخزون
            'manage_stock' => 'boolean', // إدارة المخزون
            'is_featured' => 'nullable|boolean',  // ما إذا كان المنتج مميزًا
            'dimensions' => 'nullable|string',   // أبعاد المنتج
            'weight' => 'nullable|numeric',      // وزن المنتج
            'min_quantity' => 'nullable|integer|min:1', // الحد الأدنى للكمية
            'cost_price' => 'nullable|numeric|min:0',   // سعر تكلفة المنتج
        ]);

        $product = Product::findOrFail($id);

        // تحديث المنتج
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'image' => $request->image ? $request->image->store('products') : $product->image,
            'is_active' => $request->is_active ?? $product->is_active,
            'sale_price' => $request->sale_price,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'gallery' => $request->gallery,
            'stock_status' => $request->stock_status,
            'manage_stock' => $request->manage_stock,
            'is_featured' => $request->is_featured ?? $product->is_featured,
            'dimensions' => $request->dimensions,
            'weight' => $request->weight,
            'min_quantity' => $request->min_quantity,
            'cost_price' => $request->cost_price,
        ]);

        return redirect()->route('backend.products.index'); // إعادة التوجيه بعد التحديث
    }

    // حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // العثور على المنتج باستخدام المعرف
        $product->delete(); // حذف المنتج من قاعدة البيانات

        return redirect()->route('backend.products.index'); // إعادة التوجيه بعد الحذف
    }
  
   
}
