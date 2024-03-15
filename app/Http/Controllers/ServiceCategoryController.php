<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::all();
        return view('backend.services.service-categories.index', compact('categories'));
    }
    
    public function show(ServiceCategory $servicescategories)
    {
        // Load the associated services
        $services = $servicescategories->services;
        
        // Fetch the page style from the database based on the name '/services-categories'
        $pageStyle = Pagesstyle::where('name', '/service-categories')->first();
        
        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/services/servicescategory/{$pageStyle->style}.blade.php");
            
            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.services.servicescategory.{$pageStyle->style}", compact('servicescategories', 'services'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.services.servicescategory.style1", compact('servicescategories', 'services'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.services.servicescategory.style1", compact('servicescategories', 'services'));
        }
    }

    public function create()
    {
        return view('backend.services.service-categories.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string|max:255',
        ]);
    
        // Check if validation fails
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
    
        // Create a new service category instance and save it
        ServiceCategory::create([
            'category_name' => $request->category_name,
            'image' => $imageName,
            'description' => $request->description,
        ]);
    
        // Redirect to the index page with success message
        return redirect()->route('service-categories.index')->with('success', 'Service category created successfully.');
    }

  
public function edit($id)
{
    // Find the service category by its id
    $category = ServiceCategory::findOrFail($id);

    // Return the edit view with the found category data
    return view('backend.services.service-categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'category_name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        'description' => 'required|string|max:255',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the service category by its id
    $category = ServiceCategory::findOrFail($id);

    // Check if an image is uploaded
    if ($request->hasFile('image')) {
        // Store the uploaded file in the specified directory
        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images/general', $imageName, 'public');
        // Update the category's image field
        $category->image = $imageName;
    }

    // Update the category's other fields
    $category->category_name = $request->category_name;
    $category->description = $request->description;

    // Save the updated category
    $category->save();

    // Redirect back to the index page with success message
    return redirect()->route('service-categories.index')->with('success', 'Service category updated successfully.');
}

public function destroy($id)
{
    // Find the service category by its id
    $category = ServiceCategory::findOrFail($id);

    // Delete the category
    $category->delete();

    // Redirect back to the index page with success message
    return redirect()->route('service-categories.index')->with('success', 'Service category deleted successfully.');
}

}
