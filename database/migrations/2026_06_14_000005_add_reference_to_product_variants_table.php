<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('product_variants') && !Schema::hasColumn('product_variants', 'reference')) {
            Schema::table('product_variants', function (Blueprint $table) {
                // Référence du produit pour les familles de type "ref" (même réf pour tous)
                $table->string('reference')->nullable()->after('tracking_type');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('product_variants', 'reference')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropColumn('reference');
            });
        }
    }
};
