<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\ProjectsCategories; // Add this line to import the ProductCategories model
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Projects::all(); // Use Eloquent ORM to retrieve all products
        $user = User::find(1);
        return view('backend.projects.projects.index')
            ->with('projects', $projects)
            ->with('user', $user);
    }

    public function show(Projects $projects)
    {
        return view('frontend.pages.projects_details', compact('project'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $projectscategories = ProjectsCategories::all(); // Retrieve all product categories
        return view('backend.projects.projects.create', ['projectscategories' => $projectscategories]);
    }
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'projects_title' => 'required|string|max:191',
            'projects_subtitle' => 'required|string|max:191',
            'projects_description' => 'required|string|max:191',
            'status' => 'required|string|max:60',
            'template' => 'required|string|max:191',
            'seo_title' => 'required|string|max:191',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:project_categories,id',
            'points' => 'nullable|string',
            'characteristics' => 'nullable|string',
            'attributes.name' => 'nullable|array',
            'attributes.value' => 'nullable|array',
            'attributes.name.*' => 'nullable|string',
            'attributes.value.*' => 'nullable|string',
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('Images/general', 'public');
                $imageNames[] = basename($imageName);
            }
        } else {
            $imageNames[] = 'default.jpg';
        }
    
        // Create a new project instance
        $project = new Projects();
        $project->projects_title = $request->input('projects_title');
        $project->projects_subtitle = $request->input('projects_subtitle');
        $project->projects_description = $request->input('projects_description');
        $project->status = $request->input('status');
        $project->template = $request->input('template');
        $project->seo_title = $request->input('seo_title');
        $project->category_id = $request->input('category_id');
        $project->images = json_encode($imageNames);
        $project->points = json_encode(explode(PHP_EOL, $request->input('points')));
        $project->characteristics = $request->input('characteristics');
        $project->attributes = json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')));
    
        // Save the project
        $project->save();
    
        // Redirect the user to the projects index page
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }
    public function edit($id)
    {
        //
        $project = Projects::findOrFail($id);
        $projectscategories = ProjectsCategories::all();
        $user = User::find(1);
        return view('backend.projects.projects.edit', compact('project', 'projectscategories', 'user'));
    }

    public function update(Request $request, $id)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'projects_title' => 'required|string|max:191',
            'projects_subtitle' => 'required|string|max:191',
            'projects_description' => 'required|string|max:191',
            'status' => 'required|string|max:60',
            'template' => 'required|string|max:191',
            'seo_title' => 'required|string|max:191',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:project_categories,id',
            'points' => 'nullable|string',
            'characteristics' => 'nullable|string',
            'attributes.name' => 'nullable|array',
            'attributes.value' => 'nullable|array',
            'attributes.name.*' => 'nullable|string',
            'attributes.value.*' => 'nullable|string',
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Find the project by its ID
        $project = Projects::findOrFail($id);
    
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('Images/general', 'public');
                $imageNames[] = basename($imageName);
            }
        } else {
            // Use existing image names if no new images uploaded
            $imageNames = json_decode($project->images, true) ?? [];
        }
    
        // Update project attributes
        $project->projects_title = $request->input('projects_title');
        $project->projects_subtitle = $request->input('projects_subtitle');
        $project->projects_description = $request->input('projects_description');
        $project->status = $request->input('status');
        $project->template = $request->input('template');
        $project->seo_title = $request->input('seo_title');
        $project->category_id = $request->input('category_id');
        $project->images = json_encode($imageNames);
        $project->points = json_encode(explode(PHP_EOL, $request->input('points')));
        $project->characteristics = $request->input('characteristics');
        $project->attributes = json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')));
    
        // Save the updated project
        $project->save();
    
        // Redirect the user to the projects index page
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }
    public function destroy($id)
    {
        // Retrieve the project
        $project = Projects::findOrFail($id);
    
        // Delete the project images
        $images = json_decode($project->images, true);
        foreach ($images as $image) {
            Storage::disk('public')->delete('Images/general/' . $image);
        }
    
        // Delete the project
        $project->delete();
    
        // Redirect the user to the project index page
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }


}

