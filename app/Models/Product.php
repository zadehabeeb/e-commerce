<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // الأعمدة القابلة للتعبئة عبر الـ form
    protected $fillable = [
        'name',               // اسم المنتج
        'slug',               // الـ slug (عنوان URL)
        'sku',                // الكود التعريفي للمنتج
        'price',              // السعر
        'category_id',        // ID الفئة الرئيسية
        'subcategory_id',     // ID الفئة الفرعية
        'stock_quantity',     // الكمية المتاحة
        'description',        // الوصف
        'short_description', // الوصف المختصر
        'image',              // صورة المنتج
        'is_active',          // حالة المنتج (نشط أم لا)
        'sale_price',         // سعر التخفيض
        'meta_title',         // عنوان الـ Meta
        'meta_description',   // وصف الـ Meta
        'gallery',            // مجموعة صور إضافية
        'stock_status',       // حالة المخزون (في المخزون/نفد)
        'manage_stock',       // إدارة المخزون
        'is_featured',        // ما إذا كان المنتج مميزًا
        'dimensions',         // أبعاد المنتج
        'weight',             // وزن المنتج
        'min_quantity',       // الحد الأدنى للكمية
        'cost_price',         // سعر التكلفة
    ];

    // العلاقة مع Category (فئة رئيسية)
    public function category()
    {
        return $this->belongsTo(Category::class); // علاقة belongsTo مع Category
    }

    // العلاقة مع Subcategory (فئة فرعية)
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class); // علاقة belongsTo مع Subcategory
    }

    // تأكد من أن `timestamps` مفعلة لتخزين التاريخ والوقت
    public $timestamps = true;
}
