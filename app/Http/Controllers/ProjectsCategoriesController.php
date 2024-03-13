<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsCategories;
use Illuminate\Support\Facades\Validator;
use App\Models\Projects;
use Illuminate\Support\Facades\Storage;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ProjectsCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectscategories = ProjectsCategories::all();
        return view('backend.projects.project-categories.index', compact('projectscategories'));
    }

    public function showall()
    {
                    // Load all categories along with their associated projects
        $categories = ProjectsCategories::with('projects')->get();
            
              // Fetch the page style from the database based on the name '/projects-categories-list'
        $pageStyle = Pagesstyle::where('name', '/projects-categories-list')->first();
        
        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/projects/Project_categories_list/{$pageStyle->style}.blade.php");
            
            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.projects.Project_categories_list.{$pageStyle->style}",compact('categories'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.projects.Project_categories_list.style1",compact('categories'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.projects.Project_categories_list.style1", compact('categories'));
        }
    }   
    
    public function show($categoryId)
    {
        // Load the project category
        $projectscategory = ProjectsCategories::findOrFail($categoryId);
        
        // Load the associated projects
        $projects = $projectscategory->projects;
        
        // Fetch the page style from the database based on the name '/projects-categories'
        $pageStyle = Pagesstyle::where('name', '/projects-categories')->first();
        
        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/projects/Projectslist/{$pageStyle->style}.blade.php");
            
            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.projects.Projectslist.{$pageStyle->style}", compact('projectscategory', 'projects'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.projects.Projectslist.style1", compact('projectscategory', 'projects'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.projects.Projectslist.style1", compact('projectscategory', 'projects'));
        }
    }
    
    

    public function create()
    {
        return view('backend.projects.project-categories.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Store the uploaded file in the specified directory
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/general', $imageName, 'public');
    
        } else {
            // Default image name if no image is uploaded
            $imageName = 'default.jpg'; // Adjust as needed
        }
    
        ProjectsCategories::create([
            'category_name' => $request->category_name,
            'image' => $imageName,
            'description' => $request->description, // Include description field
        ]);
    
        return redirect()->route('projects-categories.index')->with('success', 'Category created successfully.');
    }
    public function edit($id)
{
    $projectscategories = ProjectsCategories::findOrFail($id);
    return view('backend.projects.project-categories.edit', compact('projectscategories'));
}

public function update(Request $request, $id)
{
    $projectscategories = ProjectsCategories::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'category_name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        'description' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($request->hasFile('image')) {
        // Store the uploaded file in the specified directory
        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images/general', $imageName, 'public');

        // Delete previous image if exists
        if ($projectscategories->image !== 'default.jpg') {
            Storage::disk('public')->delete('images/general/' . $projectscategories->image);
        }
        $projectscategories->image = $imageName;
    }

    $projectscategories->update([
        'category_name' => $request->category_name,
        'description' => $request->description, // Include description field
    ]);

    return redirect()->route('projects-categories.index')->with('success', 'Category updated successfully.');
}
public function destroy($id)
{
    // Retrieve the project
    $projectCategory = ProjectsCategories::findOrFail($id);

    // Delete the project images if they exist
    if ($projectCategory->images) {
        $images = json_decode($projectCategory->images, true);
        foreach ($images as $image) {
            Storage::disk('public')->delete('Images/general/' . $image);
        }
    }

    // Delete the project
    $projectCategory->delete();

    // Redirect the user to the project index page
    return redirect()->route('projects.index')->with('success', 'Category deleted successfully.');
}


}
