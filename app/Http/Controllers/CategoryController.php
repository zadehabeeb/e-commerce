<?php
namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Http\Resources\Backend\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{  
      public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('backend.category.index');
    }

    // عرض نموذج إضافة فئة جديدة (Create)

 public function create()
    {
        try {
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Failed!',
                'message' => 'An error occurred .',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            Category::create($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Created!',
                'message' => 'category created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Created Failed!',
                'message' => 'Something went wrong while creating the category: ',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // عرض نموذج تعديل فئة (Edit)
        public function edit(Category $category)
    {
        try {
            return response()->json([
                'category' => new CategoryResource($category),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'title' => 'Fetch Category Failed!',
                'message' => 'An error occurred while fetching the category data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // تحديث الفئة (Update)
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();
            $category->update($validatedData);
            DB::commit();

            return response()->json([
                'success' => true,
                'title' => 'Updated!',
                'message' => 'category updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'title' => 'Update Failed',
                'message' => 'Something went wrong while updating the category',
                'error' => $e->getMessage()

            ], 500);
        }
    }


 //  delete category
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'title' => 'Deleted!',
                'message' => 'Category has been deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Failed',
                'message' => 'Something went wrong while deleting the category',
                'error' => $e->getMessage()
            ], 500);
        }
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
