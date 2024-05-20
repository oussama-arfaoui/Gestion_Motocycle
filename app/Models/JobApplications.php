<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    use HasFactory;
    
    protected $fillable = ['carrier_id', 'name', 'email', 'phone', 'cv', 'message', 'status'];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'career_id');
    }
}
