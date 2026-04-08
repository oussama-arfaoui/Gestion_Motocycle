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
        Schema::create('chassis_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('chassis_number')->unique();
            $table->unsignedBigInteger('variant_id');
            $table->timestamps();
            
            $table->index('chassis_number');
            $table->index('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chassis_numbers');
    }
};
