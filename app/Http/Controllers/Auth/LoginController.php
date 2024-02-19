<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Input;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    /**
     * Function for login
     */
    public function doLogin(Request $request)
    {
        $data = array(
            "email" => $request->input("email"),
            "password" => $request->input("password"),
        );
        if (!empty($data)) {
            $validate = Validator::make($data, [
                'email' => ['required', 'email'],
                'password' => ['required', ' min:8']
            ]);
            if ($validate->fails()) {
                return redirect('/login');
            } else {
                $credentials = $request->only('email', 'password');
                //dd(Auth::attempt($credentials));
                // attempt to do the login
                if (Auth::attempt($credentials)) {
                    // validation successful
                    // do whatever you want on success
                    $request->session()->regenerate();
                    if (Auth::user()->super_user == true) {
                        return redirect(RouteServiceProvider::ADMINHOME);
                    }
                    return redirect(RouteServiceProvider::HOME);
                } else {
                    // validation not successful, send back to form
                    return Redirect::to('login');
                }
            }
        }
    }
}
