<?php

namespace App\Http\Controllers;

use App\Models\Slug;
use App\Models\Page;
use Illuminate\Http\Request;




class SlugController extends Controller
{
    public function showBySlug($slug)
    {
        // Retrieve the page based on the slug
        $slugEntry = Slug::where('key', $slug)->first();

        // If no slug is found, return a default page
        if (!$slugEntry) {
            // Render a default page
            return view('frontend.layouts.default');
        }

        // Get the corresponding page using the relationship defined in the Slug model
        $page = $slugEntry->page;

        // Pass the page content to the view
        return view('frontend.layouts.default', compact('page'));
    }

  
}
