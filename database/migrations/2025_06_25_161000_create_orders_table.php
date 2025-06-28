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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->string('order_number', 50)->unique(); // VARCHAR(50) NOT NULL, UNIQUE (Order number)
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('pending'); // ENUM
            $table->decimal('total_amount', 10, 2); // DECIMAL(10,2) NOT NULL (Total order amount)
            $table->decimal('tax_amount', 10, 2)->default(0.00); // DECIMAL(10,2) DEFAULT 0.00 (Tax amount)
            $table->decimal('shipping_amount', 10, 2)->default(0.00); // DECIMAL(10,2) DEFAULT 0.00 (Shipping cost)
            $table->decimal('discount_amount', 10, 2)->default(0.00); // DECIMAL(10,2) DEFAULT 0.00 (Discount amount)
            $table->string('currency', 3)->default('USD'); // VARCHAR(3) DEFAULT 'USD' (Currency code)
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending'); // ENUM (Payment status)
            $table->string('payment_method', 50)->nullable(); // VARCHAR(50) NULLABLE (Payment method)
            $table->text('notes')->nullable(); // TEXT NULLABLE (Order notes)
            $table->timestamp('shipped_at')->nullable(); // TIMESTAMP NULLABLE (Shipping timestamp)
            $table->timestamp('delivered_at')->nullable(); // TIMESTAMP NULLABLE (Delivery timestamp)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
