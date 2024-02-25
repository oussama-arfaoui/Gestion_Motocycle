<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the uploaded file
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('storage/general'), $imageName);

        // Return the path to the uploaded image
        return '/storage/general/' . $imageName;
    }
}
