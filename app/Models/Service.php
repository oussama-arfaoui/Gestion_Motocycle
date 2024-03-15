<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_title',
        'service_subtitle',
        'service_description',
        'status',
        'template',
        'seo_title',
        'category_id',
        'images',
        'points',
        'characteristics',
        'attributes',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
