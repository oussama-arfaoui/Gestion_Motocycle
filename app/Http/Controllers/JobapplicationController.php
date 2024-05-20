<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplications;
use App\Models\JobOffers;
use App\Models\Carrier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator facade
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class JobapplicationController extends Controller

{
    public function index()
    {
        $jobApplications = JobApplications::with('carrier')->get();
        return view('backend.job.jobapplications.index', compact('jobApplications'));
    }
    public function create()
    {
        $carriers = Carrier::all();
        return view('backend.job.jobapplications.create', compact('carriers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf|max:10240', // 10 MB maximum file size
            'message' => 'nullable|string',
            'career_id' => 'required|exists:careers,id', // Ensure the career exists
        ]);
    
        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Generate a unique name for the PDF file
            $cvName = uniqid() . '.' . $request->file('cv')->getClientOriginalExtension();
            // Store the PDF file in the 'public/pdf/CV' directory
            $cvPath = $request->file('cv')->storeAs('pdf/CV', $cvName, 'public');
        } else {
            $cvPath = null;
        }
    
        $job = new JobApplications();
        $job->career_id = $request->career_id;
        $job->name = $request->name;
        $job->email = $request->email;
        $job->phone = $request->phone;
        $job->cv = $cvPath;
        $job->message = $request->message;
        $job->status = $request->status;
        $job->save();

        return redirect()->route('jobapplication.index')->with('success', 'Job application submitted successfully.');
    }


    public function userstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf|max:10240', // 10 MB maximum file size
            'message' => 'nullable|string',
            'career_id' => 'required|exists:careers,id', // Ensure the career exists
        ]);
    
        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Generate a unique name for the PDF file
            $cvName = uniqid() . '.' . $request->file('cv')->getClientOriginalExtension();
            // Store the PDF file in the 'public/pdf/CV' directory
            $cvPath = $request->file('cv')->storeAs('pdf/CV', $cvName, 'public');
        } else {
            $cvPath = null;
        }
    
        $job = new JobApplications();
        $job->career_id = $request->career_id;
        $job->name = $request->name;
        $job->email = $request->email;
        $job->phone = $request->phone;
        $job->cv = $cvPath;
        $job->message = $request->message;
        $job->status = $request->status;
        $job->save();
    // Set success message
    Session::flash('success', 'Job application submitted successfully.');

    // Redirect back to the previous page
    return back();
    }



    public function edit($id)
    {
        $jobApplication = JobApplications::findOrFail($id);
        $carriers = Carrier::all();
        return view('backend.job.jobapplications.edit', compact('jobApplication', 'carriers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cv' => 'nullable|file|mimes:pdf|max:10240', // 10 MB maximum file size
            'message' => 'nullable|string',
            'career_id' => 'required|exists:careers,id', // Ensure the career exists
        ]);

        $job = JobApplications::findOrFail($id);

        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Delete the old CV if exists
            if ($job->cv) {
                Storage::disk('public')->delete($job->cv);
            }

            // Generate a unique name for the PDF file
            $cvName = uniqid() . '.' . $request->file('cv')->getClientOriginalExtension();
            // Store the PDF file in the 'public/pdf/CV' directory
            $cvPath = $request->file('cv')->storeAs('pdf/CV', $cvName, 'public');
            $job->cv = $cvPath;
        }

        $job->career_id = $request->career_id;
        $job->name = $request->name;
        $job->email = $request->email;
        $job->phone = $request->phone;
        $job->message = $request->message;
        $job->status = $request->status;
        $job->save();

        return redirect()->route('jobapplication.index')->with('success', 'Job application updated successfully.');
    }

    public function destroy($id)
    {
        $job = JobApplications::findOrFail($id);

        // Delete the CV file if exists
        if ($job->cv) {
            Storage::disk('public')->delete($job->cv);
        }

        $job->delete();

        return redirect()->route('jobapplication.index')->with('success', 'Job application deleted successfully.');
    }
}