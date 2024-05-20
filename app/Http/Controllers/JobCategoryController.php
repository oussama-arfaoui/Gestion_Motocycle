<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplications;
use App\Models\JobOffers;
use App\Models\JobCategories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class JobCategoryController extends Controller
{

    public function index()
    {
        $jobcategories = JobCategories::all();
        return view('backend.job.job-categories.index', compact('jobcategories'));

    } 
    public function create()
    {
        return view('backend.job.job-categories.create');
    }     
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);
    
        // Create a new job category instance
        $category = new JobCategories();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') ?? 'active'; // Adjust the default status as needed
    
        // Save the job category
        $category->save();
    
        return redirect()->route('job-categories.index')->with('success', 'Job Category created successfully.');
    }
    public function edit($id)
    {
        $jobcategory = JobCategories::findOrFail($id);
        return view('backend.job.job-categories.edit', compact('jobcategory'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);
    
        // Find the job category
        $category = JobCategories::findOrFail($id);
        // Update the job category
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') ?? 'active'; // Adjust the default status as needed
        // Save the changes
        $category->save();
    
        return redirect()->route('job-categories.index')->with('success', 'Job Category updated successfully.');
    }
    
    public function destroy($id)
    {
        $category = JobCategories::findOrFail($id);
        $category->delete();
    
        return redirect()->route('job-categories.index')->with('success', 'Job Category deleted successfully.');
    }
        

}
