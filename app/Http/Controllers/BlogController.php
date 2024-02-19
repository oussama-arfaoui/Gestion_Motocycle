<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

     /************************************
     * FUNCTION TO SHOW THE BLOGS
     ************************************/
    public function index()
    {
        $blogs = DB::table('blogs')
            ->orderBy('order', 'asc')
            ->get() ;
        $user = User::find(1);
        return view('backend.blogs.blogs.index')
            ->with('blogs', $blogs)
            ->with('user', $user);
    }

    /************************************
     * FUNCTION TO CREATE A BLOG
     ************************************/
        public function store(Request $request)
        {
            // GET THE DATA VALUE  
            $data = array(
                "title" => $request->input("title"),
                "content" => $request->input("content"),
            );

            $route_image = $data["image"];

            if (!empty($data)) {
                $validate = Validator::make($data, [
                    "title" => ['required', 'string', 'max:255'],
                    "content" => ['required', 'string', 'max:255'],
                ]);

                $validate_2 = Validator::make($data, [
                    'image' => ['file', 'mimes:jpg,jpeg,png', 'max:30720'],
                ]);
        
                if ($validate->fails()) {
                    return redirect('/admin/blogs')
                        ->withInput();
                } else {
                    if ($validate_2->fails()) {
                        return redirect('/admin/blogs')
                            ->withInput();
                    } else {
                        if($route_image != ''){
                            $directory = "uploads/img/blogs";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }   
                            $random = mt_rand(10,9999);
                            $route_image = $directory."/blog_image_".$random.".".$data["image"]->guessExtension();
                            move_uploaded_file($data["image"]->getPathName(), $route_image);
                        } 

                        $blog = new Blog();
                        $blog->title = $data["title"];
                        $blog->content = $data["content"];
                        $blog->image = $route_image;
                        $blog->save();
            
                        return redirect('/admin/blogs');
                    }
                    
                }
            } else {
                return redirect('/admin/blogs');
            }
        }


    /************************************
     * FUNCTION TO SHOW AN BLOG
     ************************************/
    public function show($id)
    {
        $blog = Blog::find($id);
        $user = User::find(1);
        if($blog != null){
            return view('admin.pages.blogs.single')
                ->with('blog', $blog)
                ->with('user', $user);
        } else {
            return redirect('/admin/blogs');
        }
    }

    /************************************
     * FUNCTION TO UPDATE AN BLOG
     ************************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "title" => $request->input("title"),
            "content" => $request->input("content"),
        );
    
        if (!empty($data)) {
            $validate = Validator::make($data, [
                "title" => ['required', 'string', 'max:255'],
                "content" => ['required', 'string', 'max:255'],
            ]);
    
            if ($validate->fails()) {
                return redirect('/admin/blogs')
                        ->withInput();
            } else {
                $data_new = array(
                    "title" => $data['title'],
                    "content" => $data['content'],
                );
                Blog::where("id", $id)->update($data_new);
                return redirect('/admin/blogs');
            }
        } else {
            return redirect('/admin/blogs');
        }
    }


    /************************************
     * FUNCTION TO DELETE AN BLOG
     ************************************/
    public function destroy($id, Blog $blog)
    {
        $validate = Blog::where("id", $id)->get();
        if(!empty($validate)){
            $type = $validate[0]['type'];
            Blog::where("id", $validate[0]['id'])->delete();
            $blogs = DB::table('blogs')
                ->orderBy('order', 'asc')
                ->get() ;
            $i = 1;
            foreach ($blogs as $blog):
                $data_new = array(
                    "order"=>$i,
                );
                Blog::where("id", $blog->id)->update($data_new);
                $i++;
            endforeach;
            return redirect('/admin/blogs');
        } else {
            return redirect('/admin/blogs');
        }
    }

}

?>