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
        Schema::create('products', function (Blueprint $table) {
           $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key to categories table
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade'); // Foreign key to subcategories table
            $table->string('name', 255); // VARCHAR(255) NOT NULL
            $table->string('slug', 255)->unique(); // VARCHAR(255) NOT NULL, UNIQUE
            $table->text('description')->nullable(); // LONGTEXT NULLABLE
            $table->string('short_description', 500)->nullable(); // VARCHAR(500) NULLABLE
            $table->string('sku', 100)->unique(); // VARCHAR(100) NOT NULL, UNIQUE
            $table->decimal('price', 10, 2); // DECIMAL(10,2) NOT NULL
            $table->decimal('sale_price', 10, 2)->nullable(); // DECIMAL(10,2) NULLABLE
            $table->decimal('cost_price', 10, 2)->nullable(); // DECIMAL(10,2) NULLABLE
            $table->integer('stock_quantity')->default(0); // INTEGER DEFAULT 0
            $table->integer('min_quantity')->default(1); // INTEGER DEFAULT 1
            $table->decimal('weight', 8, 2)->nullable(); // DECIMAL(8,2) NULLABLE
            $table->string('dimensions', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->boolean('is_active')->default(true); // BOOLEAN DEFAULT TRUE
            $table->boolean('is_featured')->default(false); // BOOLEAN DEFAULT FALSE
            $table->boolean('manage_stock')->default(true); // BOOLEAN DEFAULT TRUE (Manage stock flag)
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'on_backorder'])->default('in_stock'); // ENUM
            $table->string('image', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->json('gallery')->nullable(); // JSON NULLABLE
            $table->string('meta_title', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->text('meta_description')->nullable(); // TEXT NULLABLE
            $table->decimal('rating_average', 2, 1)->default(0.0); // DECIMAL(2,1) DEFAULT 0.0
            $table->integer('rating_count')->default(0); // INTEGER DEFAULT 0
            $table->timestamps(); // created_at and updated_at timestamps

             // Index frequently queried columns.
            $table->index(['category_id', 'subcategory_id']); // Composite index for category and subcategory.
            $table->index('is_active');
            $table->index('stock_status');
            $table->index('price');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
