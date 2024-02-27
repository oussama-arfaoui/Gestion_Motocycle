<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $fillable = ['category_name', 'image', 'description',]; // Added fillable property
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    // Your other model code...
}
