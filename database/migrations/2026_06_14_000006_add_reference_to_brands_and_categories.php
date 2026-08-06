<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('brands') && !Schema::hasColumn('brands', 'reference')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->string('reference')->nullable()->after('name');
            });
        }
        if (Schema::hasTable('product_categories') && !Schema::hasColumn('product_categories', 'reference')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->string('reference')->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('brands', 'reference')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->dropColumn('reference');
            });
        }
        if (Schema::hasColumn('product_categories', 'reference')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->dropColumn('reference');
            });
        }
    }
};
