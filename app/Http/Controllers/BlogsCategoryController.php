<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogsCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogsCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogsCategories::all();
        return view('backend.blogs.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = BlogsCategories::all();
        return view('backend.blogs.blog-categories.create', compact('categories'));
    }
    

    public function store(Request $request)
    {
        
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
    
        // Create a new blog category instance
        $category = new BlogsCategories();
        $category->parent_id = $request->input('parent_id');
        $category->name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->image = json_encode($imageNames);
        $category->order = $request->input('order') ?? 0;
        $category->status = $request->input('status') ?? 'published';
    
        // Save the blog category
        $category->save();
    
        // Redirect the user to the blog categories index page
        return redirect()->route('blogs-categories.index')->with('success', 'Blog Category created successfully.');
    }
    

    public function show($id)
    {
        $category = BlogsCategories::findOrFail($id);
        return view('backend.blogs.blog-categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = BlogsCategories::findOrFail($id);
        $categories = BlogsCategories::all(); // You might not need this line, depending on your requirements
        return view('backend.blogs.blog-categories.edit', compact('category', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        // Find the blog category by its ID
        $category = BlogsCategories::findOrFail($id);
        
        // Handle image upload for multiple images
        $imageNames = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $imageName = $image->store('Images/general', 'public');
                $imageNames[] = basename($imageName);
            }
        } else {
            $imageNames[] = 'default.jpg';
        }
        
        // Update the category details
        $category->parent_id = $request->input('parent_id');
        $category->name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->image = json_encode($imageNames);
        $category->order = $request->input('order') ?? 0;
        $category->status = $request->input('status') ?? 'published';
        
        // Save the updated blog category
        $category->save();
        
        // Redirect the user to the blog categories index page
        return redirect()->route('blogs-categories.index')->with('success', 'Blog Category updated successfully.');
    }
    

    public function destroy($id)
    {
        // Find the blog category by its ID
        $category = BlogsCategories::findOrFail($id);
        
        // Delete the associated images (if any)
        if ($category->image) {
            $images = json_decode($category->image, true);
            foreach ($images as $image) {
                Storage::disk('public')->delete('Images/general/' . $image);
            }
        }
        
        // Delete the blog category
        $category->delete();
        
        // Redirect the user to the blog categories index page
        return redirect()->route('blogs-categories.index')->with('success', 'Blog Category deleted successfully.');
    }
    
}
