<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $fillable = ['category_name', 'image',]; // Added fillable property

    // Your other model code...
}
