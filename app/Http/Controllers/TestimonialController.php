<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('backend.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.testimonials.create');
    }



    
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'job_description' => 'nullable|string|max:255',
            'job_location' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size for a single image
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('Images/general', 'public'); // Use 'public' disk
        }
    
        // Create a new Testimonial instance
        $testimonial = new Testimonial();
        $testimonial->name = $request->input('name');
        $testimonial->subtitle = $request->input('subtitle');
        $testimonial->job_description = $request->input('job_description');
        $testimonial->job_location = $request->input('job_location');
        $testimonial->testimonial = $request->input('testimonial');
        $testimonial->image = basename($imageName); // Save the image filename to the database
    
        // Save the testimonial
        $testimonial->save();
    
        // Redirect the user to the Testimonial index page
        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }
    

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'job_description' => 'nullable|string|max:255',
            'job_location' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow null or image file type and size for a single image
        ]);

        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the testimonial
        $testimonial = Testimonial::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($testimonial->image) {
                // Delete the old image from storage
                Storage::disk('public')->delete('Images/general/' . $testimonial->image);
            }
            // Store the new image
            $imageName = $request->file('image')->store('Images/general', 'public');
            // Update the image field in the testimonial
            $testimonial->image = basename($imageName);
        }

        // Update other fields
        $testimonial->name = $request->input('name');
        $testimonial->subtitle = $request->input('subtitle');
        $testimonial->job_description = $request->input('job_description');
        $testimonial->job_location = $request->input('job_location');
        $testimonial->testimonial = $request->input('testimonial');

        // Save the testimonial
        $testimonial->save();

        // Redirect the user to the Testimonial index page
        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        // Find the brand by its ID
        $testimonial = Testimonial::find($id);
    
        // Check if the brand exists
        if (!$testimonial) {
            return redirect()->route('testimonials.index')->with('error', 'Brand not found.');
        }
    
        // Delete the brand from the database
        $testimonial->delete();
    
        // Redirect back with a success message
        return redirect()->route('testimonials.index')->with('success', 'Brand deleted successfully.');
    }
}
