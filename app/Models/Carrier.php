<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $table = 'careers';
    protected $fillable = ['title', 'description', 'requirements', 'location', 'status', 'time', 'is_job_offer', 'jobCategory_id','carrierCategory_id'];

    public function jobApplications()
    {
        return $this->hasMany(JobApplications::class);
    }
        // Define the relationship with the job category
        public function jobCategory()
        {
            return $this->belongsTo(JobCategories::class, 'jobCategory_id');
        }
    
        // Define the relationship with the carrier category
        public function carrierCategory()
        {
            return $this->belongsTo(CarrierCategories::class, 'carrierCategory_id');
        }
    

}
