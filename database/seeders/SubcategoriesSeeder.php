<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('subcategories')->insert([
            [
                'category_id' => 6,
                'name' => 'Android Phones',
                'slug' => 'android-phones',
                'description' => 'A wide range of Android smartphones from top brands.',
                'image' => 'https://images.unsplash.com/photo-1685062428479-e310b7851de5?q=80&w=580&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => 'Android Phones - E-commerce',
                'meta_description' => 'Explore the latest Android smartphones from Samsung, Google, OnePlus, and more.',
            ],
            [
                'category_id' => 6,
                'name' => 'iOS Phones',
                'slug' => 'ios-phones',
                'description' => 'Latest iOS smartphones from Apple, including iPhone 14, iPhone 13, and more.',
                'image' => 'https://t1.gstatic.com/images?q=tbn:ANd9GcSjoU2lZ2eJX3aCMfiFDt39uRNcDu9W7pTKcyZymE2iKa7IOVaI',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'iOS Phones - E-commerce',
                'meta_description' => 'Shop for the newest iPhone models with advanced features and top performance.',
            ],
            [
                'category_id' => 7,
                'name' => 'Laptops',
                'slug' => 'laptops',
                'description' => 'High-performance laptops for work, gaming, and everyday use.',
                'image' => 'https://images.unsplash.com/photo-1519671976378-bf9b42b8a25e',
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => 'Laptops - E-commerce',
                'meta_description' => 'Explore a wide variety of laptops from brands like Apple, Dell, Lenovo, and more.',
            ],
            [
                'category_id' => 7,
                'name' => 'Desktop PCs',
                'slug' => 'desktop-pcs',
                'description' => 'Powerful desktop PCs for home and office use.',
                'image' => 'https://images.unsplash.com/photo-1583221070818-35154042d5d8',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Desktop PCs - E-commerce',
                'meta_description' => 'Shop for desktop PCs from top manufacturers like Apple, HP, and ASUS.',
            ],
            [
                'category_id' => 8,
                'name' => 'Gaming Consoles',
                'slug' => 'gaming-consoles',
                'description' => 'Explore the latest gaming consoles from PlayStation, Xbox, Nintendo, and more.',
                'image' => 'image',
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => 'Gaming Consoles - E-commerce',
                'meta_description' => 'Find the newest gaming consoles including PlayStation 5, Xbox Series X, and more.',
            ],
            [
                'category_id' => 8,
                'name' => 'Gaming Accessories',
                'slug' => 'gaming-accessories',
                'description' => 'Gaming accessories such as controllers, headsets, and gaming chairs for an enhanced experience.',
                'image' => 'images',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Gaming Accessories - E-commerce',
                'meta_description' => 'Shop for gaming accessories like controllers, headsets, and gaming chairs from leading brands.',
            ],
        ]);
    }
}
