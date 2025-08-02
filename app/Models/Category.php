<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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
     protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
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
    // Auto-generate slug from name if not provided
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
      // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for inactive categories
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    
    // تفعيل الـ timestamps لتخزين التاريخ والوقت
    public $timestamps = true;
}
