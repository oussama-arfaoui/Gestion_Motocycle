<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplications;
use App\Models\JobOffers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class JobapplicationController extends Controller

{
    public function index()
    {
        $jobApplications = JobApplications::all();
        return view('backend.job.jobapplications.index', compact('jobApplications'));

    } 
}