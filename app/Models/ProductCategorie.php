<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategorie extends Model
{
    protected $fillable = [
        'name',
        'reference',
        'parent_id',
        'brand_id',
        'categorie_img',
        'store_id',
        'created_by',
    ];

    // Relationship to parent category
    public function parent()
    {
        return $this->belongsTo(ProductCategorie::class, 'parent_id');
    }

    // Relationship to child categories
    public function children()
    {
        return $this->hasMany(ProductCategorie::class, 'parent_id');
    }

    // Relationship to brand
    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'category_id');
    }
}

