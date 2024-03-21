<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Pagesstyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\GeneralSettings;

class SettingsController extends Controller
{
   
    public function indexgeneral_settings()
    {
        $general_settings = GeneralSettings::first(); // Assuming there's only one row for general settings
        return view('backend.Settings.general_settings.index', compact('general_settings'));
    }
    
    public function updateAllgeneral_settings(Request $request)
    {
        // Update or create the general settings
        GeneralSettings::updateOrCreate(
            [],
            [
                'logo' => $request->input('logo'),
                'favicon' => $request->input('favicon'),
                'login_screen_background' => $request->input('login_screen_background'),
                'title' => $request->input('title'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'updated_at' => now(),
            ]
        );
    
        // Redirect the user to the general settings index page
        return redirect()->route('general_settings.index')->with('success', 'General settings updated successfully.');
    }
    
    
    
    
    public function destroygeneral_settings($id)
    {
        $general_settings = GeneralSettings::findOrFail($id);
        $general_settings->delete();

        return redirect()->back()->with('success', 'Style deleted successfully.');
    }
   
   
   
    /**
     * Display a listing of the resource.
     */
    public function indexpagesstyle()
    {
        $pagesstyles = PagesStyle::all(); // Fetch all pages styles
        return view('backend.Settings.pages_style.index', compact('pagesstyles'));
    }
    public function updateAllPagesStyle(Request $request)
    {
        $styles = $request->input('styles');
        $newStyles = $request->input('newStyles');
    
        // Validate input data
        $validator = Validator::make($request->all(), [
            "styles.*.name" => ['required', 'string', 'max:255'],
            "styles.*.style" => ['required', 'string', 'max:255'],
            "newStyles.*.name" => ['nullable', 'string', 'max:255'],
            "newStyles.*.style" => ['nullable', 'string', 'max:255'],
        ]);
    
        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Update existing styles
        if ($styles) {
            foreach ($styles as $id => $data) {
                $pagesstyle = Pagesstyle::findOrFail($id);
                $pagesstyle->name = $data['name'];
                $pagesstyle->style = $data['style'];
                $pagesstyle->save();
            }
        }
    
        // Create new styles
        if ($newStyles) {
            foreach ($newStyles['name'] as $key => $name) {
                if (!empty($name)) {
                    Pagesstyle::create([
                        'name' => $name,
                        'style' => $newStyles['style'][$key]
                    ]);
                }
            }
        }
    
        // Redirect the user to the pagesstyle index page
        return redirect()->route('pagesstyle.index')->with('success', 'Styles updated successfully.');
    }
    
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroypagesstyle($id)
    {
        $pagesstyle = Pagesstyle::findOrFail($id);
        $pagesstyle->delete();

        return redirect()->back()->with('success', 'Style deleted successfully.');
    }
}
