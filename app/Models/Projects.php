<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = "projects";

    public function projectscategories()
    {
        return $this->belongsToMany(ProjectsCategories::class, 'project_categories', 'project_id', 'category_id');
    }
    public function projectscategory()
    {
        return $this->belongsTo(ProjectsCategories::class, 'category_id');
    }
}
?>