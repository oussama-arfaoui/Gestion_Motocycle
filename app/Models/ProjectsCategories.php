<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsCategories extends Model
{
    use HasFactory;
    protected $table = "project_categories";
    protected $fillable = ['category_name', 'image', 'description',]; // Added fillable property
    
    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_categories', 'category_id', 'project_id');
    }
    // Your other model code...
}
