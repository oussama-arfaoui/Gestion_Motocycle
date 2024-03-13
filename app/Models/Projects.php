<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = "projects";

    protected $fillable = [
        'projects_title',
        'projects_subtitle',
        'projects_description',
        'status',
        'template',
        'seo_title',
        'category_id',        
        'images',
        'points',
        'characteristics',
        'attributes',
    ];  

    public function projectscategory()
    {
        return $this->belongsTo(ProjectsCategories::class, 'category_id');
    }

}
