<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    use HasFactory;
    protected $fillable = ['category_id', 'title', 'content', 'image', 'views', 'status'];

    public function category()
    {
        return $this->belongsTo(BlogsCategories::class, 'category_id');
    }
}
