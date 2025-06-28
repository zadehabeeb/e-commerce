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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->string('code', 50)->unique(); // VARCHAR(50) NOT NULL, UNIQUE (Coupon code)
            $table->enum('type', ['fixed', 'percentage']); // ENUM('fixed', 'percentage') NOT NULL (Discount type)
            $table->decimal('value', 10, 2); // DECIMAL(10,2) NOT NULL (Discount value)
            $table->decimal('minimum_amount', 10, 2)->nullable(); // DECIMAL(10,2) NULLABLE (Minimum order amount for coupon to apply)
            $table->integer('usage_limit')->nullable(); // INTEGER NULLABLE (Usage limit per coupon)
            $table->integer('used_count')->default(0); // INTEGER DEFAULT 0 (How many times the coupon has been used)
            $table->boolean('is_active')->default(true); // BOOLEAN DEFAULT TRUE (Coupon status)
            $table->timestamp('starts_at')->nullable(); // TIMESTAMP NULLABLE (Coupon start date)
            $table->timestamp('expires_at')->nullable(); // TIMESTAMP NULLABLE (Coupon expiry date)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
