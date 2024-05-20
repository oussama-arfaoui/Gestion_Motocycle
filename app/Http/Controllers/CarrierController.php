<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\CarrierCategories;
use App\Models\JobCategories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class CarrierController extends Controller

{
    public function index()
    {
        $carrier = Carrier::all();
        return view('backend.carrier.carrier.index', compact('carrier'));

    } 
    public function create()
    {
        $carriercategories = CarrierCategories::all();
        $jobcategories = JobCategories::all(); // Adjust this line according to your actual category model
        return view('backend.carrier.carrier.create', compact('jobcategories','carriercategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string',
            'time' => 'nullable|date',
            'is_job_offer' => 'boolean',
            'category_id' => 'required|exists:job_categories,id', // Ensure the job category exists
            'carrier_category_id' => 'required|exists:carrier_categories,id', // Ensure the carrier category exists
        ]);
    
        $carrier = new Carrier();
        $carrier->title = $request->title;
        $carrier->description = $request->description;
        $carrier->requirements = $request->requirements;
        $carrier->location = $request->location;
        $carrier->status = $request->status;
        $carrier->time = $request->time;
        $carrier->is_job_offer = $request->is_job_offer ? 1 : 0;
        $carrier->jobCategory_id = $request->category_id;
        $carrier->carrierCategory_id = $request->carrier_category_id;
        $carrier->save();
    
        return redirect()->route('carrier.index')->with('success', 'Carrier created successfully.');
    }

    public function edit($id)
    {
        $carrier = Carrier::findOrFail($id);
        $carriercategories = CarrierCategories::all();
        $jobcategories = JobCategories::all();
        return view('backend.carrier.carrier.edit', compact('carrier', 'jobcategories', 'carriercategories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string',
            'time' => 'nullable|date',
            'is_job_offer' => 'boolean',
            'category_id' => 'required|exists:job_categories,id',
            'carrier_category_id' => 'required|exists:carrier_categories,id',
        ]);

        $carrier = Carrier::findOrFail($id);
        $carrier->title = $request->title;
        $carrier->description = $request->description;
        $carrier->requirements = $request->requirements;
        $carrier->location = $request->location;
        $carrier->status = $request->status;
        $carrier->time = $request->time;
        $carrier->is_job_offer = $request->is_job_offer ? 1 : 0;
        $carrier->jobCategory_id = $request->category_id;
        $carrier->carrierCategory_id = $request->carrier_category_id;
        $carrier->save();

        return redirect()->route('carrier.index')->with('success', 'Carrier updated successfully.');
    }

    public function destroy($id)
    {
        $carrier = Carrier::findOrFail($id);
        $carrier->delete();
        return redirect()->route('carrier.index')->with('success', 'Carrier deleted successfully.');
    }
}