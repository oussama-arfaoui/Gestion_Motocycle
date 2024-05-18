<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrierCategories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Pagesstyle;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;


class CarrierCategoryController extends Controller
{
    public function index()
    {
        $carrierCategories = CarrierCategories::all();
        return view('backend.carrier.carrier-categories.index', compact('carrierCategories'));

    } 
}