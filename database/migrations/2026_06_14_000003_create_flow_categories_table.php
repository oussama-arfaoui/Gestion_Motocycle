<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('flow_categories')) {
            Schema::create('flow_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                // 'recette' (entrée d'argent) ou 'depense' (sortie d'argent)
                $table->string('type', 20)->default('recette');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            // Catégories initiales fournies par le client
            $now = date('Y-m-d H:i:s');
            $seed = [
                ['Accessoire', 'recette'],
                ['Recette huile', 'recette'],
                ["Recette main d'oeuvre huile", 'recette'],
                ["Recette main d'oeuvre reparation moto", 'recette'],
                ['Recette piece de rechange', 'recette'],
                ['Casque', 'recette'],
                ['Recette complementaire NR', 'recette'],
                ['Vente produit', 'recette'],
                ['Depense ouvrier', 'depense'],
                ['Depenses', 'depense'],
            ];

            $rows = [];
            foreach ($seed as $s) {
                $rows[] = [
                    'name'       => $s[0],
                    'type'       => $s[1],
                    'is_active'  => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('flow_categories')->insert($rows);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_categories');
    }
};
