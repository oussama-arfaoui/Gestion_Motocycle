<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffers extends Model
{
    use HasFactory;
    
    protected $fillable = ['carrier_id', 'title', 'description', 'requirements', 'location', 'status'];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
