<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // الأعمدة القابلة للتعبئة عبر الـ form
    protected $fillable = [
        'name',               // اسم الفئة الفرعية
        'slug',               // الـ slug
        'category_id',        // فئة رئيسية (category)
        'description',        // الوصف
        'image',              // الصورة
        'is_active',          // حالة الفئة (نشطة/غير نشطة)
        'sort_order',         // ترتيب العرض
        'meta_title',         // عنوان الـ meta
        'meta_description',   // وصف الـ meta
    ];

    // تحديد العلاقة مع Category (فئة رئيسية)
    public function category()
    {
        return $this->belongsTo(Category::class); // علاقة belongsTo مع Category
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // تأكد من أن `timestamps` مفعلة لتخزين التاريخ والوقت
    public $timestamps = true;
}
