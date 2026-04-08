<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChassisNumber extends Model
{
    protected $fillable = [
        'chassis_number',
        'variant_id',
        'date',
        'location',
    ];

    /**
     * Relation avec la variante (famille).
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    /**
     * Accès à la marque via la variante.
     */
    public function brand()
    {
        return $this->variant ? $this->variant->brand : null;
    }

    /**
     * Accès au modèle (catégorie) via la variante.
     */
    public function category()
    {
        return $this->variant ? $this->variant->category : null;
    }
}
