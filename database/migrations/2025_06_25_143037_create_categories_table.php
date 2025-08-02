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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->string('name', 255)->unique(); // VARCHAR(255) NOT NULL
            $table->string('slug', 255)->unique(); // VARCHAR(255) NOT NULL, UNIQUE
            $table->text('description')->nullable(); // TEXT NULLABLE
            $table->string('image', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->boolean('is_active')->default(true); // BOOLEAN DEFAULT TRUE
            $table->integer('sort_order')->default(0); // INTEGER DEFAULT 0
            $table->string('meta_title', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->text('meta_description')->nullable(); // TEXT NULLABLE
            $table->timestamps(); // created_at and updated_at timestamps
            $table->index('slug');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
