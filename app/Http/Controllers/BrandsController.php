<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade

class BrandsController extends Controller
{
    public function index()
    {
        // Retrieve all brands from the database
        $brands = Brand::all();

        // Return the view with the brands data
        return view('backend.brands.index', compact('brands'));
    }

    public function create()
    {
        // Return the view for creating a new brand
        return view('backend.brands.create');
    }


    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file types and size
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('Images/general', 'public'); // Use 'public' disk
                $imageNames[] = basename($imageName);
            }
        } else {
            $imageNames[] = 'default.jpg'; // Default image name if no image is uploaded
        }
    
        // Create a new Brand instance
        $brand = new Brand();
        $brand->name = $request->input("name");
        $brand->link = $request->input("link");
        $brand->image = json_encode($imageNames); // Save the image filenames to the database
    
        // Save the product
        $brand->save();
    
        // Redirect the user to the Brand index page
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }
    
    public function edit($id)
    {
        // Retrieve the brand by its ID

        // Return the view for editing the brand
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data

        // Update the brand in the database

        // Redirect back with a success message
    }

    public function destroy($id)
    {
        // Find the brand by its ID and delete it from the database

        // Redirect back with a success message
    }
}
