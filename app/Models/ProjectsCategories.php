<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsCategories extends Model
{
    use HasFactory;

    protected $table = "project_categories";

    protected $fillable = ['category_name', 'image', 'description'];

    public function projects()
    {
        return $this->hasMany(Projects::class, 'category_id'); // Specify the correct foreign key
    }
}
