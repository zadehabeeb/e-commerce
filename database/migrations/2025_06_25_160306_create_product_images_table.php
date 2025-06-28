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
        Schema::create('product_images', function (Blueprint $table) {
           $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products table
            $table->string('image_path', 255); // VARCHAR(255) NOT NULL
            $table->string('alt_text', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->boolean('is_primary')->default(false); // BOOLEAN DEFAULT FALSE
            $table->integer('sort_order')->default(0); // INTEGER DEFAULT 0
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
