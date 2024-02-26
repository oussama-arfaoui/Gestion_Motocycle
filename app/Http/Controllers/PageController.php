<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Slug;

// Include the shortcodes file
require_once __DIR__ . '/../../../resources/functions/shortcodes.php';
class PageController extends Controller
{
    protected $shortcodeTypes;

    public function __construct()
    {
        // Retrieve the shortcode types and assign them to $shortcodeTypes in the constructor
        $this->shortcodeTypes = getShortcodeTypes();
    }

    public function index()
    {
        $pages = Page::all();
        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.pages.create', ['shortcodeTypes' => $this->shortcodeTypes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:slugs,key',
            // Add validation rules for other fields if needed
        ]);
    
        // Create a new Page instance
        $page = new Page([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $request->image,
            'template' => $request->template,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    
        // Set user_id if needed, assuming you have authentication set up
        $page->user_id = auth()->id();
    
        // Save the page
        $page->save();
    
        // Create a new Slug entry
        $slug = new Slug([
            'key' => $request->slug,
            'reference_id' => $page->id,
            'reference_type' => 'App\Models\Page',
            'prefix' => null,
        ]);
    
        // Save the slug
        $slug->save();
    
        // Redirect back to the index page with a success message
        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }
    
    

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.pages.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        
        return view('backend.pages.edit', ['shortcodeTypes' => $this->shortcodeTypes, 'page' => $page]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            // Add validation rules for other fields if needed
        ]);
    
        // Find the page by ID
        $page = Page::findOrFail($id);
    
        // Update the page attributes
        $page->name = $request->name;
        $page->content = $request->content;
        $page->image = $request->image;
        $page->template = $request->template;
        $page->description = $request->description;
        $page->status = $request->status;
    
        // Optionally, you may want to update the user_id if you're associating pages with users
        // $page->user_id = auth()->id();
    
        // Save the updated page
        $page->save();
    
        // Update the associated slug if it exists
        if ($page->slug) {
            $page->slug->update([
                'key' => $request->slug,
            ]);
        }
    
        // Redirect back to the index page with a success message
        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }
    
    

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        
        // Delete the associated slug entry
        $slugEntry = Slug::where('reference_id', $id)
                        ->where('reference_type', 'App\\Models\\Page')
                        ->delete();
    
        // Delete the page
        $page->delete();
    
        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }
    
}
