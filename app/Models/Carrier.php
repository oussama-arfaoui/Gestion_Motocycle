<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $table = 'careers';
    protected $fillable = ['title', 'description', 'requirements', 'location', 'status', 'is_job_offer'];

    public function jobApplications()
    {
        return $this->hasMany(JobApplications::class);
    }
}
