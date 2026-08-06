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
        if (Schema::hasTable('product_variants') && !Schema::hasColumn('product_variants', 'tracking_type')) {
            Schema::table('product_variants', function (Blueprint $table) {
                // 'chassis' => chaque numéro est unique (ex: moto / VIN)
                // 'ref'     => référence partagée, les doublons sont autorisés (ex: huile, accessoire)
                $table->string('tracking_type', 20)->default('chassis')->after('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('product_variants') && Schema::hasColumn('product_variants', 'tracking_type')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropColumn('tracking_type');
            });
        }
    }
};
