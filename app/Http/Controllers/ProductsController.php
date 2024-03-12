<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategories; // Add this line to import the ProductCategories model
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all(); // Use Eloquent ORM to retrieve all products
        $user = User::find(1);
        return view('backend.products.products.index')
            ->with('products', $products)
            ->with('user', $user);
    }

    public function show(Product $product)
    {
        // Fetch the page style from the database based on the name '/products'
        $pageStyle = Pagesstyle::where('name', '/products')->first();

        if ($pageStyle) {
            // Define the path to the style file
            $styleFilePath = resource_path("views/frontend/pages/products/Productdetails/style/{$pageStyle->style}.blade.php");

            // Check if the style file exists
            if (File::exists($styleFilePath)) {
                // Render the view using the dynamic style
                return view("frontend.pages.products.Productdetails.style.{$pageStyle->style}", compact('product'));
            } else {
                // Default to a fallback style if the specified style file does not exist
                return view("frontend.pages.products.Productdetails.style.style1", compact('product'));
            }
        } else {
            // Default to a fallback style if no style is found in the database
            return view("frontend.pages.products.Productdetails.style.style1", compact('product'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = ProductCategories::all(); // Retrieve all product categories
        return view('backend.products.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'template' => 'required|string|max:255',
            'seo_title' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
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
    
            // Create a new product instance
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_description = $request->input('product_description');
            $product->status = $request->input('status');
            $product->template = $request->input('template');
            $product->seo_title = $request->input('seo_title');
            $product->category_id = $request->input('categories')[0]; // Assuming only one category is selected
            $product->images = json_encode($imageNames);
            $product->points = json_encode(explode(PHP_EOL, $request->input('points')));
            $product->characteristics = $request->input('characteristics');
            $product->attributes = json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')));

            // Save the product
            $product->save();
    
        // Redirect the user to the products index page
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = ProductCategories::all();
        $user = User::find(1);
        return view('backend.products.products.edit', compact('product', 'categories', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Retrieve the product
        $product = Product::findOrFail($id);
    
        // Validate input data
        $validator = Validator::make($request->all(), [
            "product_name" => ['required', 'string', 'max:255'],
            "product_description" => ['required', 'string', 'max:255'],
            "status" => ['required', 'string', 'max:255'],
            "template" => ['required', 'string', 'max:255'],
            "seo_title" => ['required', 'string', 'max:255'],
            "images.*" => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Adjust validation as needed
            "categories" => ['required', 'array'], // Categories must be an array
            "points" => ['nullable', 'string'], // Add validation for points if needed
            "characteristics" => ['nullable', 'string'], // Add validation for characteristics if needed
            // Remove validation for fixed attributes
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Find the product by its ID
        $product = Product::findOrFail($id);
    
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->store('Images/general', 'public');
                $imageNames[] = basename($imageName);
            }
        } else {
            // Use existing image names if no new images uploaded
            $imageNames = json_decode($product->images, true) ?? [];
        }
    
        // Update products attributes
        $product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->status = $request->input('status');
        $product->template = $request->input('template');
        $product->seo_title = $request->input('seo_title');
        $product->category_id = $request->input('categories')[0];
        $product->images = json_encode($imageNames);
        $product->points = json_encode(explode(PHP_EOL, $request->input('points')));
        $product->characteristics = $request->input('characteristics');
        $product->attributes = json_encode(array_combine($request->input('attributes.name'), $request->input('attributes.value')));
    
        // Save the updated products
        $product->save();
    
        // Redirect the user to the products index page
        return redirect()->route('products.index')->with('success', 'Products updated successfully.');
    }
    
    
    public function destroy($id)
    {
        // Retrieve the product
        $product = Product::findOrFail($id);
    
        // Delete the product images
        $images = json_decode($product->images, true);
        foreach ($images as $image) {
            Storage::disk('public')->delete('Images/general/' . $image);
        }
    
        // Delete the product
        $product->delete();
    
        // Redirect the user to the products index page
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

