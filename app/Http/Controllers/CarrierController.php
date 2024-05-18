<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\CarrierCategories;
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
}