<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogsCategories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade

class BlogsController extends Controller
{

    public function index()
    {
        $blogs = Blogs::all();
        return view('backend.blogs.blogs.index', compact('blogs'));

    } 
          
    public function create()
    {
        $categories = BlogsCategories::all();
        return view('backend.blogs.blogs.create', compact('categories'));
       
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

        // Create a new blog instance
        $blog = new Blogs();
        $blog->category_id = $request->input('category_id');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->image = json_encode($imageNames);
        $blog->views = $request->input('views');
        $blog->status = $request->input('status');
    
        // Save the new blog
        $blog->save();
    
        // Redirect the user to the blogs index page
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }
    
    

    public function show($id)
    {
        $blog = Blogs::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $categories = BlogsCategories::all(); // Assuming you need categories for editing
        return view('backend.blogs.blogs.edit', compact('blog', 'categories'));
    }
    

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|max:255',
            // Add validation rules for other fields
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('blogs.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
    
        // Find the blog by its ID
        $blog = Blogs::findOrFail($id);
        
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
        
    
        // Update other fields
        $blog->category_id = $request->input('category_id');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->image = json_encode($imageNames);
        $blog->views = $request->input('views');
        $blog->status = $request->input('status');
    
        // Save the updated blog
        $blog->save();
    
        // Redirect the user to the blogs index page
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
    
    

    public function destroy($id)
    {
        // Find the blog by its ID
        $blog = Blogs::findOrFail($id);


        // Delete the associated images (if any)
        if ($blog->image) {
            $images = json_decode($blog->image, true);
            foreach ($images as $image) {
                Storage::disk('public')->delete('Images/general/' . $image);
            }
        }
        
        // Delete the blog category
        $blog->delete();
        
        // Redirect the user to the blogs index page
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
    
}
