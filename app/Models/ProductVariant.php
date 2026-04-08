<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'quantity',
        'image',
        'created_at',
        'updated_at',
    ];

    /**
     * Relation avec la catégorie parente.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategorie::class, 'category_id');
    }

    /**
     * Relation avec les produits liés à cette variante.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'variant_id');
    }
    
    /**
     * Relation avec les numéros de châssis.
     */
    public function chassisNumbers()
    {
        return $this->hasMany(ChassisNumber::class, 'variant_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function brand()
    {
        return $this->category ? $this->category->brand : null;
    }
}
