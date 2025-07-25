<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\SubcategoryDataTable;

class SubcategoryController extends Controller
{


      public function index(SubcategoryDataTable $datatable)
    {
        return $datatable->render('backend.subcategories.index');
    }
   
    // // عرض جميع الفئات الفرعية
    // public function index()
    // {
    //     $subcategories = Subcategory::all(); // جلب جميع الفئات الفرعية
    //     return view('backend.subcategories.index', compact('subcategories')); // عرض الفئات الفرعية
    // }

    // // عرض نموذج إضافة فئة فرعية جديدة
    // public function create()
    // {
    //     $categories = Category::all(); // جلب جميع الفئات الرئيسية
    //     return view('backend.subcategories.create', compact('categories')); // عرض نموذج إضافة الفئة الفرعية
    // }

    // // تخزين الفئة الفرعية الجديدة
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:subcategories',
    //         'slug' => 'required|unique:subcategories',
    //         'category_id' => 'required|exists:categories,id',
    //         'description' => 'nullable',
    //         'image' => 'nullable|image',
    //         'is_active' => 'nullable|boolean',
    //         'sort_order' => 'nullable|integer',
    //         'meta_title' => 'nullable|string',
    //         'meta_description' => 'nullable|string',
    //     ]);

    //     // إضافة الفئة الفرعية إلى قاعدة البيانات
    //     Subcategory::create([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //         'category_id' => $request->category_id,
    //         'description' => $request->description,
    //         'image' => $request->image ? $request->image->store('subcategories') : null,
    //         'is_active' => $request->is_active ?? false,
    //         'sort_order' => $request->sort_order ?? 0,
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description,
    //     ]);

    //     return redirect()->route('backend.subcategories.index'); // إعادة التوجيه بعد الحفظ
    // }

    // // عرض نموذج تعديل فئة فرعية
    // public function edit($id)
    // {
    //     $subcategory = Subcategory::findOrFail($id); // العثور على الفئة الفرعية باستخدام المعرف
    //     $categories = Category::all(); // جلب جميع الفئات الرئيسية
    //     return view('backend.subcategories.edit', compact('subcategory', 'categories')); // عرض النموذج مع البيانات
    // }

    // // تحديث الفئة الفرعية
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:subcategories,name,' . $id,
    //         'slug' => 'required|unique:subcategories,slug,' . $id,
    //         'category_id' => 'required|exists:categories,id',
    //         'description' => 'nullable',
    //         'image' => 'nullable|image',
    //         'is_active' => 'nullable|boolean',
    //         'sort_order' => 'nullable|integer',
    //         'meta_title' => 'nullable|string',
    //         'meta_description' => 'nullable|string',
    //     ]);

    //     $subcategory = Subcategory::findOrFail($id); // العثور على الفئة الفرعية باستخدام المعرف

    //     // تحديث بيانات الفئة الفرعية
    //     $subcategory->update([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //         'category_id' => $request->category_id,
    //         'description' => $request->description,
    //         'image' => $request->image ? $request->image->store('subcategories') : $subcategory->image,
    //         'is_active' => $request->is_active ?? $subcategory->is_active,
    //         'sort_order' => $request->sort_order ?? $subcategory->sort_order,
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description,
    //     ]);

    //     return redirect()->route('backend.subcategories.index'); // إعادة التوجيه بعد التحديث
    // }

    // // حذف الفئة الفرعية
    // public function destroy($id)
    // {
    //     $subcategory = Subcategory::findOrFail($id); // العثور على الفئة الفرعية باستخدام المعرف
    //     $subcategory->delete(); // حذف الفئة الفرعية من قاعدة البيانات

    //     return redirect()->route('backend.subcategories.index'); // إعادة التوجيه بعد الحذف
    // }
}
