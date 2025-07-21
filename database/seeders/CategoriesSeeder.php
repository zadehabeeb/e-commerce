<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'description' => 'A wide range of smartphones including Android and iOS devices.',
                'image' => 'smartphones.jpg',
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => 'Smartphones - E-commerce',
                'meta_description' => 'Explore our selection of the latest smartphones from top brands.',
                'created_at' => '2025-07-02 23:02:39',
                'updated_at' => '2025-07-02 23:02:39',
            ],
            [
                'name' => 'Computers',
                'slug' => 'computers',
                'description' => 'Laptops, desktops, and all-in-one computers for all your needs.',
                'image' => 'computers.jpg',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Computers - E-commerce',
                'meta_description' => 'Find the best laptops, desktops, and accessories for your computing needs.',
                'created_at' => '2025-07-02 23:02:39',
                'updated_at' => '2025-07-02 23:02:39',
            ],
            [
                'name' => 'Gaming Devices',
                'slug' => 'gaming-devices',
                'description' => 'Gaming consoles, accessories, and gear for the ultimate gaming experience.',
                'image' => 'gaming_devices.jpg',
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Gaming Devices - E-commerce',
                'meta_description' => 'Shop for the latest gaming consoles and accessories from leading brands.',
                'created_at' => '2025-07-02 23:02:39',
                'updated_at' => '2025-07-02 23:02:39',
            ],
        ]);
    }
}
