<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $files = Storage::files('/public/Images/general');
        $fileNames = array_map('basename', $files); // Extracting filenames from file paths
        return view('backend.media.index', compact('fileNames'));
    }
    public function showUploadForm()
    {
        return view('backend.media.upload');
    }
    
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Store the uploaded file in the specified directory
        $imageName = time().'.'.$request->image->extension();  
        $request->image->storeAs('Images/general', $imageName, 'public'); // Use 'public' disk
    
        // Redirect back to the media index page
        return redirect()->route('media.index');
    }
    
    
    
    
    
}
