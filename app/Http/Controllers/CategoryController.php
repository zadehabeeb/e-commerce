<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;


class CategoryController extends Controller
{  
      public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('backend.category.index');
    }
   


    // عرض الفئات (Read)
    // public function index()
    // {
    //     $categories = Category::all(); // استرجاع جميع الفئات
    //     return view('backend.category.index', compact('categories')); // إرسال البيانات إلى العرض
    // }

    // عرض نموذج إضافة فئة جديدة (Create)
    // public function create()
    // {
    //     return view('backend.category.create'); // عرض نموذج إضافة الفئة
    // }

    // // تخزين الفئة الجديدة (Store)
    // public function store(Request $request)
    // {
    //     // التحقق من صحة البيانات
    //     $request->validate([
    //         'name' => 'required|unique:categories',
    //         'slug' => 'required|unique:categories',
    //         'description' => 'nullable',
    //         'image' => 'nullable|image',
    //     ]);

    //     // إضافة الفئة إلى قاعدة البيانات
    //     Category::create([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //         'description' => $request->description,
    //         'image' => $request->image ? $request->image->store('categories') : null,
    //         'is_active' => $request->is_active ?? false,
    //         'sort_order' => $request->sort_order ?? 0,
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description,
    //     ]);

    //     // إعادة التوجيه إلى صفحة الفئات
    //     return redirect()->route('backend.category.index');
    // }

    // // عرض نموذج تعديل فئة (Edit)
    // public function edit($id)
    // {
    //     $category = Category::findOrFail($id); // العثور على الفئة باستخدام المعرف
    //     return view('backend.category.edit', compact('category')); // عرض النموذج مع البيانات
    // }

    // // تحديث الفئة (Update)
    // public function update(Request $request, $id)
    // {
    //     // التحقق من صحة البيانات
    //     $request->validate([
    //         'name' => 'required|unique:categories,name,' . $id,
    //         'slug' => 'required|unique:categories,slug,' . $id,
    //         'description' => 'nullable',
    //         'image' => 'nullable|image',
    //     ]);

    //     $category = Category::findOrFail($id); // العثور على الفئة باستخدام المعرف

    //     // تحديث بيانات الفئة
    //     $category->update([
    //         'name' => $request->name,
    //         'slug' => $request->slug,
    //         'description' => $request->description,
    //         'image' => $request->image ? $request->image->store('categories') : $category->image,
    //         'is_active' => $request->is_active ?? $category->is_active,
    //         'sort_order' => $request->sort_order ?? $category->sort_order,
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description,
    //     ]);

    //     // إعادة التوجيه إلى صفحة الفئات
    //     return redirect()->route('backend.category.index');
    // }

    // // حذف الفئة (Delete)
    // public function destroy($id)
    // {
    //     $category = Category::findOrFail($id); // العثور على الفئة باستخدام المعرف
    //     $category->delete(); // حذف الفئة من قاعدة البيانات

    //     // إعادة التوجيه إلى صفحة الفئات
    //     return redirect()->route('backend.category.index');
    // }
}
