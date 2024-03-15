<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('backend.services.services.index', compact('services'));
    }


    public function show(Service $service)
    {
        // Eager load the 'category' relationship
        $service->load('category');
        
        // Fetch the page style from the database based on the name '/services'
        $pageStyle = Pagesstyle::where('name', '/services')->first();
        
        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/services/servicesdetails/{$pageStyle->style}.blade.php");
            
            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.services.servicesdetails.{$pageStyle->style}", compact('service'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.services.servicesdetails.style1", compact('service'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.services.servicesdetails.style1", compact('service'));
        }
    }
    
    



    public function create()
    {
        $servicecategories = ServiceCategory::all();
        return view('backend.services.services.create', compact('servicecategories'));
    }
    
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'service_title' => 'required|string|max:191',
            'service_subtitle' => 'required|string|max:191',
            'service_description' => 'required|string',
            'status' => 'required|string|max:60',
            'template' => 'required|string|max:191',
            'seo_title' => 'required|string|max:191',
            'category_id' => 'required|exists:service_categories,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    
        // Create a new service instance
        $service = new Service();
        $service->service_title = $request->input('service_title');
        $service->service_subtitle = $request->input('service_subtitle');
        $service->service_description = $request->input('service_description');
        $service->status = $request->input('status');
        $service->template = $request->input('template');
        $service->seo_title = $request->input('seo_title');
        $service->category_id = $request->input('category_id');
        $service->images = json_encode($imageNames);
        $service->points = json_encode(explode(PHP_EOL, $request->input('points')));
        $service->characteristics = $request->input('characteristics');
        $service->attributes = json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')));
    
        // Save the service
        $service->save();
    
        // Redirect the user to the services index page
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        // Find the service by its ID
        $service = Service::findOrFail($id);
        // Retrieve all service categories
        $servicecategories = ServiceCategory::all();
        // Return the view with the service data and service categories
        return view('backend.services.services.edit', compact('service', 'servicecategories'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'service_title' => 'required|string|max:191',
            'service_subtitle' => 'required|string|max:191',
            'service_description' => 'required|string|max:191',
            'status' => 'required|string|max:60',
            'template' => 'required|string|max:191',
            'seo_title' => 'required|string|max:191',
            'category_id' => 'required|exists:service_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    
        // Find the service by its ID
        $service = Service::findOrFail($id);
    
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('Images/general', 'public');
                $imageNames[] = basename($imageName);
            }
        } else {
            // Keep the existing images if no new images are uploaded
            $imageNames = json_decode($service->images, true);
        }
    
        // Update the service instance
        $service->update([
            'service_title' => $request->input('service_title'),
            'service_subtitle' => $request->input('service_subtitle'),
            'service_description' => $request->input('service_description'),
            'status' => $request->input('status'),
            'template' => $request->input('template'),
            'seo_title' => $request->input('seo_title'),
            'category_id' => $request->input('category_id'),
            'images' => json_encode($imageNames),
            'points' => json_encode(explode(PHP_EOL, $request->input('points'))),
            'characteristics' => $request->input('characteristics'),
            'attributes' => json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')))
        ]);
    
        // Redirect the user to the services index page
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
{
    // Find the service by its ID
    $service = Service::findOrFail($id);

    // Delete the service
    $service->delete();

    // Redirect the user to the services index page with a success message
    return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
}
}
