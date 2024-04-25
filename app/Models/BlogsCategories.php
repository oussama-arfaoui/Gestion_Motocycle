<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsCategories extends Model
{
    protected $table = 'blog_categories';
    use HasFactory;
    protected $fillable = ['parent_id', 'name', 'description', 'image', 'order', 'status'];

}
