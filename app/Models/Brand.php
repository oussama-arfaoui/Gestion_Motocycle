<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'brand_img', 'reference'];

    // Brand has many categories (models)
    public function categories()
    {
        return $this->hasMany(ProductCategorie::class, 'brand_id');
    }

    // Brand has many variants through categories
    public function variants()
    {
        return $this->hasManyThrough(ProductVariant::class, ProductCategorie::class, 'brand_id', 'category_id', 'id', 'id');
    }
}
