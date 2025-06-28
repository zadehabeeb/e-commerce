<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Foreign key to orders table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products table
            $table->string('product_name', 255); // VARCHAR(255) NOT NULL (Product name at time of order)
            $table->string('product_sku', 100); // VARCHAR(100) NOT NULL (Product SKU at time of order)
            $table->integer('quantity'); // INTEGER NOT NULL (Item quantity)
            $table->decimal('price', 10, 2); // DECIMAL(10,2) NOT NULL (Item price at time of order)
            $table->decimal('total', 10, 2); // DECIMAL(10,2) NOT NULL (Total price: quantity × price)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
