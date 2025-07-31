<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // الأعمدة القابلة للتعبئة عبر الـ form
    protected $fillable = [
        'name',              
        'slug',              
        'sku',                
        'price',            
        'category_id',        
        'subcategory_id',    
        'stock_quantity',     
        'description',       
        'short_description', 
        'image',              
        'is_active',          
        'sale_price',        
        'meta_title',        
        'meta_description',   
        'gallery',            
        'stock_status',       
        'manage_stock',       
        'is_featured',        
        'dimensions',        
        'weight',             
        'min_quantity',       
        'cost_price',       
    ];

    // العلاقة مع Category 
    public function category()
    {
        return $this->belongsTo(Category::class); // علاقة belongsTo مع Category
    }

    // العلاقة مع Subcategory 
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class); // علاقة belongsTo مع Subcategory
    }
    // immage
      public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    
    public $timestamps = true;
}
