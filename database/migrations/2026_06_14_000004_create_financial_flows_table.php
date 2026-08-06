<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('financial_flows')) {
            Schema::create('financial_flows', function (Blueprint $table) {
                $table->id();
                $table->date('date');
                $table->string('designation');
                $table->unsignedBigInteger('flow_category_id')->nullable();
                // recette / depense (copié de la catégorie pour faciliter les agrégats)
                $table->string('type', 20)->default('recette');
                $table->string('payment_mode', 50)->nullable();
                $table->decimal('amount', 12, 2)->default(0);
                $table->string('reference')->nullable();
                // 'manual' (saisie) ou 'sale' (généré par une vente POS)
                $table->string('source', 20)->default('manual');
                $table->unsignedBigInteger('chassis_order_id')->nullable();
                $table->unsignedBigInteger('chassis_order_item_id')->nullable();
                // pour les lignes liées à une vente : coût et prix de vente (calcul bénéfice)
                $table->decimal('purchase_price', 12, 2)->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->unsignedBigInteger('store_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->index('flow_category_id');
                $table->index('chassis_order_id');
                $table->index('date');
                $table->index('type');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_flows');
    }
};
