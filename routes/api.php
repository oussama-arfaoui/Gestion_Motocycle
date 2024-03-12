<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
 Laravel's API routes (api.php). However, API routes in Laravel are typically used for 
 returning structured data (such as JSON) rather than rendering HTML views.

If you want to display the products in an HTML view, you should use web routes 
(web.php) instead of API routes. Here's how you can modify your code
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

