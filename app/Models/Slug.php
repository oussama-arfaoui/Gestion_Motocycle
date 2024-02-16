<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'reference_id', 'reference_type', 'prefix'];
    
        // In your Slug model
        public function page()
        {
            return $this->belongsTo(Page::class, 'reference_id');
        }

}
