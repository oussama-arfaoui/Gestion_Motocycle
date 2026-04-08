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
        Schema::create('chassis_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->decimal('total_price', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('store_id');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('chassis_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chassis_order_id');
            $table->unsignedBigInteger('chassis_number_id');
            $table->unsignedBigInteger('variant_id');
            $table->string('chassis_number');
            $table->string('model_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->string('location')->nullable();
            $table->timestamps();

            $table->index('chassis_order_id');
            $table->index('chassis_number_id');
            $table->index('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chassis_order_items');
        Schema::dropIfExists('chassis_orders');
    }
};
