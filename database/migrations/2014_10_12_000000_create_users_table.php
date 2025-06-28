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
        Schema::create('users', function (Blueprint $table) {
           $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->string('name', 255); // VARCHAR(255) NOT NULL
            $table->string('email', 255)->unique(); // VARCHAR(255) NOT NULL, UNIQUE
            $table->timestamp('email_verified_at')->nullable(); // TIMESTAMP NULLABLE
            $table->string('password', 255); // VARCHAR(255) NOT NULL
            $table->string('phone', 20)->nullable(); // VARCHAR(20) NULLABLE
            $table->text('address')->nullable(); // TEXT NULLABLE
            $table->string('city', 100)->nullable(); // VARCHAR(100) NULLABLE
            $table->string('postal_code', 20)->nullable(); // VARCHAR(20) NULLABLE
            $table->string('country', 100)->nullable(); // VARCHAR(100) NULLABLE
            $table->string('avatar', 255)->nullable(); // VARCHAR(255) NULLABLE
            $table->boolean('is_active')->default(true); // BOOLEAN DEFAULT TRUE
            $table->rememberToken(); // VARCHAR(100) NULLABLE
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
