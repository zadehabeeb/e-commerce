<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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

    // تفعيل الـ timestamps لتخزين التاريخ والوقت
    public $timestamps = true;
}
