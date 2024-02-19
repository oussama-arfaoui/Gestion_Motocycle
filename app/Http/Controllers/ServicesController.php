<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = DB::table('bs_services')->get() ;
        $user = User::find(1);
        return view('backend.services.services.index')
            ->with('services', $services)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.services.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = array(
            "service_name" => $request->input("service_name"),
            "service_description" => $request->input("service_description"),
            "content" => $request->input("content"),
            "is_featured" => $request->input("is_featured"),
            "image" => $request->input("image"),
            "status" => $request->input("status"),
        );

        //$route_image = $data["image"];

        if (!empty($data)) {
            $validate = Validator::make($data, [
                "service_name" => ['required', 'string', 'max:255'],
                "service_description" => ['required', 'string', 'max:255'],
            ]);

            /*$validate_2 = Validator::make($data, [
                'image' => ['file', 'mimes:jpg,jpeg,png', 'max:30720'],
            ]);*/
    
            if ($validate->fails()) {
                return redirect('/services')
                    ->withInput();
            } else {
                /*if ($validate_2->fails()) {
                    return redirect('/admin/blogs')
                        ->withInput();
                } else {
                    /*if($route_image != ''){
                        $directory = "uploads/img/blogs";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/blog_image_".$random.".".$data["image"]->guessExtension();
                        move_uploaded_file($data["image"]->getPathName(), $route_image);
                    } */

                    
                    $service = new Service();
                    $service->service_name = $data["service_name"];
                    $service->service_description = $data["service_description"];
                    $service->content = $data["content"];
                    $service->is_featured = $data["is_featured"];
                    $service->image = $data["image"];
                    $service->status = $data["status"];

                    //$service->image = $route_image;
                    $service->save();
        
                    return redirect('/services');
                //}
                
            }
        }
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
        //
        $service = DB::table('bs_services')->find($id) ;
        $user = User::find(1);
        return view('backend.services.services.edit')
            ->with('service', $service)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $data = array(
            "id" => $request->input("id"),
            "service_name" => $request->input("service_name"),
            "service_description" => $request->input("service_description"),
            "content" => $request->input("content"),
            "is_featured" => $request->input("is_featured"),
            "image" => $request->input("image"),
            "status" => $request->input("status"),
        );

        //$route_image = $data["image"];

        if (!empty($data)) {
            $validate = Validator::make($data, [
                "service_name" => ['required', 'string', 'max:255'],
                "service_description" => ['required', 'string', 'max:255'],
            ]);

            /*$validate_2 = Validator::make($data, [
                'image' => ['file', 'mimes:jpg,jpeg,png', 'max:30720'],
            ]);*/
    
            if ($validate->fails()) {
                return redirect('/services')
                    ->withInput();
            } else {
                /*if ($validate_2->fails()) {
                    return redirect('/admin/blogs')
                        ->withInput();
                } else {
                    /*if($route_image != ''){
                        $directory = "uploads/img/blogs";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/blog_image_".$random.".".$data["image"]->guessExtension();
                        move_uploaded_file($data["image"]->getPathName(), $route_image);
                    } */

                    
                    $service = Service::get($data["id"]);

                    $service->service_name = $data["service_name"];
                    $service->service_description = $data["service_description"];
                    $service->content = $data["content"];
                    $service->is_featured = $data["is_featured"];
                    $service->image = $data["image"];
                    $service->status = $data["status"];

                    //$service->image = $route_image;
                    $service->save();
        
                    return redirect('/services');
                //}
                
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleted = Service::destroy($id);
        if($deleted){
            log("succes");
        } else{
            log("error");
        }
    }
}
