<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = DB::table('products')
            ->get() ;
        $user = User::find(1);
        return view('backend.products.products.index')
            ->with('products', $products)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.products.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = array(
            "product_name" => $request->input("product_name"),
            "product_description" => $request->input("product_description"),
            "status" => $request->input("status"),
            "template" => $request->input("template"),
            "seo_title" => $request->input("seo_title"), 
        );

        //$route_image = $data["image"];

        if (!empty($data)) {
            $validate = Validator::make($data, [
                "product_name" => ['required', 'string', 'max:255'],
                "product_description" => ['required', 'string', 'max:255'],
            ]);

            /*$validate_2 = Validator::make($data, [
                'image' => ['file', 'mimes:jpg,jpeg,png', 'max:30720'],
            ]);*/
    
            if ($validate->fails()) {
                return redirect('/products')
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

                    $product = new Product();
                    $product->product_name = $data["product_name"];
                    $product->product_description = $data["product_description"];
                    $product->status = $data["status"];
                    $product->template = $data["template"];
                    $product->seo_title = $data["seo_title"];

                    //$product->image = $route_image;
                    $product->save();
        
                    return redirect('/products');
                //}
                
            }
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = DB::table('products')->find($id) ;
        $user = User::find(1);
        return view('backend.products.products.edit')
            ->with('product', $product)
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
            "product_name" => $request->input("product_name"),
            "product_description" => $request->input("product_description"),
            "status" => $request->input("status"),
            "image"=>$request->file("image"),
            "template" => $request->input("template"),
            "seo_title" => $request->input("seo_title"), 
        );

        //$route_image = $data["image"];

        if (!empty($data)) {
            $validate = Validator::make($data, [
                "product_name" => ['required', 'string', 'max:255'],
                "product_description" => ['required', 'string', 'max:255'],
            ]);

            /*$validate_2 = Validator::make($data, [
                'image' => ['file', 'mimes:jpg,jpeg,png', 'max:30720'],
            ]);*/
    
            if ($validate->fails()) {
                return redirect('/products')
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

                    $product = Product::get($data["id"]);

                    $product->product_name = $data["product_name"];
                    $product->product_description = $data["product_description"];
                    $product->status = $data["status"];
                    $product->template = $data["template"];
                    $product->seo_title = $data["seo_title"];

                    //$product->image = $route_image;
                    $product->save();
        
                    return redirect('/products');
                //}
                
            }
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $deleted = Product::destroy($id);
        if($deleted){
            log("succes");
        } else{
            log("error");
        }
    }
}
