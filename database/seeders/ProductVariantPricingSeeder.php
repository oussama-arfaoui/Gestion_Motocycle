<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductVariantPricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer toutes les variantes de produits
        $variants = ProductVariant::all();
        
        if ($variants->isEmpty()) {
            $this->command->info('Aucune variante de produit trouvée.');
            return;
        }
        
        $updatedCount = 0;
        
        foreach ($variants as $variant) {
            // Générer un prix aléatoire entre 10 000 et 80 000 DH
            $price = rand(10000, 80000);
            
            // Mettre à jour le prix de la variante
            $variant->price = $price;
            $variant->save();
            
            $updatedCount++;
            
            $this->command->info("Variante '{$variant->name}' mise à jour avec un prix de {$price} DH");
        }
        
        $this->command->info("Mise à jour terminée : {$updatedCount} variantes de produits ont reçu des prix.");
    }
}
