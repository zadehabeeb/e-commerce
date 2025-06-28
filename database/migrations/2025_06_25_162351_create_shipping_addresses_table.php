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
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY, AUTO_INCREMENT
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Foreign key to orders table
            $table->string('first_name', 100); // VARCHAR(100) NOT NULL (Recipient's first name)
            $table->string('last_name', 100); // VARCHAR(100) NOT NULL (Recipient's last name)
            $table->string('company', 100)->nullable(); // VARCHAR(100) NULLABLE (Company name)
            $table->string('address_line_1', 255); // VARCHAR(255) NOT NULL (Address line 1)
            $table->string('address_line_2', 255)->nullable(); // VARCHAR(255) NULLABLE (Address line 2)
            $table->string('city', 100); // VARCHAR(100) NOT NULL (City)
            $table->string('state', 100)->nullable(); // VARCHAR(100) NULLABLE (State/Province)
            $table->string('postal_code', 20); // VARCHAR(20) NOT NULL (Postal code)
            $table->string('country', 100); // VARCHAR(100) NOT NULL (Country)
            $table->string('phone', 20)->nullable(); // VARCHAR(20) NULLABLE (Phone number)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
