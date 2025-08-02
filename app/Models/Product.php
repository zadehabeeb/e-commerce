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

    protected $casts = [
        'is_active'      => 'boolean',
        'manage_stock'   => 'boolean',
        'is_featured'    => 'boolean',
        'gallery'        => 'array',
        'stock_quantity' => 'integer',
        'min_quantity'   => 'integer',
        'price'          => 'decimal:2',
        'sale_price'     => 'decimal:2',
        'cost_price'     => 'decimal:2',
        'dimensions'     => 'array',      // new cast
        'weight'         => 'decimal:2',  // new cast
    ];
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price ?? 0, 2);
    }

    public function getFormattedSalePriceAttribute(): string
    {
        $salePrice = $this->sale_price ?? $this->price;
        return number_format($salePrice ?? 0, 2);
    }

    public function setPriceAttribute($value): void
    {
        $this->attributes['price'] = $this->sanitizePrice($value);
    }

    public function setSalePriceAttribute($value): void
    {
        $this->attributes['sale_price'] = $this->sanitizePrice($value);
    }

    public function setCostPriceAttribute($value): void
    {
        $this->attributes['cost_price'] = $this->sanitizePrice($value);
    }

    protected function sanitizePrice($value): float
    {
        if (is_null($value)) {
            return 0.00;
        }
        // remove non‑numeric characters and round
        $clean = preg_replace('/[^\\d\\.]/', '', (string)$value);
        return round((float)$clean, 2);
    }
        /* Query Scopes */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_status', 'in_stock');
    }

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

    public function orderItems() 
    { 
    return $this->hasMany(OrderItem::class); 
    } 
    


    
    public $timestamps = true;
}
