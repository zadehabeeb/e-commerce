<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
       
    protected $table = 'categories'; // تحديد
    // تحديد الأعمدة التي يمكن تعبئتها عبر الـ form
    
    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'image', 
        'is_active', 
        'sort_order', 
        'meta_title', 
        'meta_description'
    ];
             public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    // products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // تفعيل الـ timestamps لتخزين التاريخ والوقت
    public $timestamps = true;
}
