<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategories::all();
        return view('backend.products.product-categories.index', compact('categories'));
    }
    public function show(ProductCategories $categories)
    {
        $categories = $categories->load('products');

        // Fetch the page style from the database based on the name '/product-categories'
        $pageStyle = Pagesstyle::where('name', '/product-categories')->first();

        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/products/Productcatergories/style/{$pageStyle->style}.blade.php");

            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.products.Productcatergories.style.{$pageStyle->style}", compact('categories'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.products.Productcatergories.style.style1", compact('categories'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.products.Productcatergories.style.style1", compact('categories'));
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
    
        ProductCategories::create([
            'category_name' => $request->category_name,
            'image' => $imageName,
            'description' => $request->description, // Include description field
        ]);
    
        return redirect()->route('product-categories.index')->with('success', 'Category created successfully.');
    }
    
    public function edit($id)
    {
        $category = ProductCategories::findOrFail($id);
        return view('backend.products.product-categories.edit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $category = ProductCategories::findOrFail($id);
    
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Store the uploaded file in the specified directory
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/general', $imageName);
            // Update the image name in the database
            $category->image = $imageName;
        }
    
        $category->category_name = $request->category_name;
        // Update the category description
        $category->description = $request->description;
        $category->save();
    
        return redirect()->route('product-categories.index')->with('success', 'Category updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('product-categories.index')->with('success', 'Category deleted successfully.');
    }
}
