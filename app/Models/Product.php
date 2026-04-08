<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'variant_id',
        'name',
        'SKU',
        'price',
        'image',
        'created_at',
        'updated_at',
    ];

    /**
     * Relation vers la variante parente.
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    /**
     * Relation pratique pour accéder à la catégorie via la variante.
     */
    public function category()
    {
        return $this->variant->category ?? null;
    }
}
