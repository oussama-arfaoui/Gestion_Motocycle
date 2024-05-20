<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrierCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class CarrierCategoryController extends Controller
{
    public function index()
    {
        $carrierCategories = CarrierCategories::all();
        return view('backend.carrier.carrier-categories.index', compact('carrierCategories'));

    } 
        // Display the form to create a new carrier category
        public function create()
        {
            return view('backend.carrier.carrier-categories.create');
        }
          // Store a newly created carrier category in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Create a new carrier category instance
        $category = new CarrierCategories();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') ?? 'active'; // Adjust the default status as needed

        // Save the carrier category
        $category->save();

        return redirect()->route('carrier-categories.index')->with('success', 'Carrier Category created successfully.');
    }

    public function edit($id)
    {
        $carrierCategory = CarrierCategories::findOrFail($id);
        return view('backend.carrier.carrier-categories.edit', compact('carrierCategory'));
    }
    
    // Update the specified carrier category in storage
        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string|in:active,inactive',
            ]);

            // Find the carrier category by ID
            $category = CarrierCategories::findOrFail($id);

            // Update the fields
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status');

            // Save the changes
            $category->save();

            return redirect()->route('carrier-categories.index')->with('success', 'Carrier Category updated successfully.');
        }
        // Remove the specified carrier category from storage
        public function destroy($id)
        {
            // Find the carrier category by ID and delete it
            CarrierCategories::findOrFail($id)->delete();

            return redirect()->route('carrier-categories.index')->with('success', 'Carrier Category deleted successfully.');
        }

}