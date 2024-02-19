<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShortcodeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/************************
 * AUTH ROUTING
 ************************/

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'destroy'])
    ->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);

Route::post('/logout', [LogoutController::class, 'doLogout']);

Route::post('/forgot-password', [ForgotPasswordLinkController::class, 'store']);
Route::post('/forgot-password/{token}', [ForgotPasswordController::class, 'reset']);




/************************
 * PUBLIC ROUTES
 ************************/
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('welcome');
});



/************************
    * ADMIN ROUTES
************************/
Route::namespace('Admin')->middleware(['auth', 'superuser'])->group(function () {
    //Route::get('/admin-home', function () { return view('welcome');} );
    Route::get('/dashboard', [DashboardController::class, 'index']);

    /************************
        * PRODUCTS ROUTES
    ************************/
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/product', [ProductsController::class, 'create']);
    Route::post('/product', [ProductsController::class, 'store']);
    Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/product/edit', [ProductsController::class, 'update']);
    Route::post('/product/{id}/delete', [ProductsController::class, 'destroy'])->name('product.delete');


    /************************
        * SERVICES ROUTES
    ************************/
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service', [ServicesController::class, 'create']);
    Route::post('/service', [ServicesController::class, 'store']);
    Route::get('/service/{id}/edit', [ServicesController::class, 'edit'])->name('service.edit');
    Route::post('/service/edit', [ServicesController::class, 'update']);
    Route::post('/service/{id}/delete', [ServicesController::class, 'destroy'])->name('service.delete');

        /************************
        * Pages ROUTES
        ************************/

Route::resource('pages', PageController::class);

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

});





    /************************
        * Slug ROUTES
    ************************/


Route::get('/{slug}', 'App\Http\Controllers\SlugController@showBySlug')->name('pages.showBySlug');

    /************************
        * ShortCode ROUTES
    ************************/

// Route for handling shortcodes
Route::get('/{shortcode}', [ShortcodeController::class, 'handleShortcode'])->name('shortcode.handle');
Route::get('/get-shortcode-config/{shortcodeType}', function ($shortcodeType) {
    // Render the Blade view corresponding to the selected shortcode type
    return view($shortcodeType);
});