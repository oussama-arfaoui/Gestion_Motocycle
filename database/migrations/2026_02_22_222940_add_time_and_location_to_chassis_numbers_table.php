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
        Schema::table('chassis_numbers', function (Blueprint $table) {
            $table->date('date')->nullable()->after('variant_id');
            $table->string('location')->default('DEPOT')->after('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chassis_numbers', function (Blueprint $table) {
            $table->dropColumn(['date', 'location']);
        });
    }
};
