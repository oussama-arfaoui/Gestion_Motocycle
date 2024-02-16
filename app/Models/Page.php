<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content', 'user_id', 'image', 'template', 'description', 'status'];
    
    public function slug()
    {
        return $this->hasOne(Slug::class, 'reference_id'); // Assuming 'reference_id' is the foreign key name
    }
}
