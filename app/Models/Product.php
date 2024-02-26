<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    public function categories()
    {
        return $this->belongsToMany(ProductCategories::class, 'product_categories', 'product_id', 'category_id');
    }
    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id');
    }
}
?>