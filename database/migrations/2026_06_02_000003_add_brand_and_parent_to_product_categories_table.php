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
        Schema::table('product_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('product_categories', 'brand_id')) {
                $table->unsignedBigInteger('brand_id')->nullable()->after('name');
                $table->index('brand_id');
            }
            if (!Schema::hasColumn('product_categories', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('brand_id');
                $table->index('parent_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            if (Schema::hasColumn('product_categories', 'brand_id')) {
                $table->dropColumn('brand_id');
            }
            if (Schema::hasColumn('product_categories', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
        });
    }
};
