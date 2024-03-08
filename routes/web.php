<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortcodeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;


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
//Route::get('/', function () {
//    return view('auth.login');
//});
Route::redirect('/', '/accueil');


// Route::get('/home', function () {
//     return view('welcome');
// });

// Route::get('/product-details', function () {
//     return view('frontend.pages.product_details');
// });



/************************
    * ADMIN ROUTES
************************/
Route::namespace('Admin')->middleware(['auth', 'superuser'])->group(function () {
    //Route::get('/admin-home', function () { return view('welcome');} );
    Route::get('/dashboard', [DashboardController::class, 'index']);

    /************************
        * PRODUCTS ROUTES
    ************************/
    Route::get('/admin/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/admin/product', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/admin/product', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/admin/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/admin/product/edit', [ProductsController::class, 'update'])->name('product.update');
    Route::delete('/admin/product/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    /************************
     * PRODUCT CATEGORIES ROUTES
     ************************/
    Route::get('/admin/product-categories', [ProductCategoriesController::class, 'index'])->name('product-categories.index');
    Route::get('/admin/product-categories/create', [ProductCategoriesController::class, 'create'])->name('product-categories.create');
    Route::post('/admin/product-categories/store', [ProductCategoriesController::class, 'store'])->name('product-categories.store');
    Route::get('/admin/product-categories/{id}/edit', [ProductCategoriesController::class, 'edit'])->name('product-categories.edit');
    Route::put('/admin/product-categories/{id}', [ProductCategoriesController::class, 'update'])->name('product-categories.update');
    Route::delete('/admin/product-categories/{id}', [ProductCategoriesController::class, 'destroy'])->name('product-categories.destroy');




    /************************
        * SERVICES ROUTES
    ************************/
    Route::get('/admin/services', [ServicesController::class, 'index']);
    Route::get('/admin/service', [ServicesController::class, 'create']);
    Route::post('/admin/service', [ServicesController::class, 'store']);
    Route::get('/admin/service/{id}/edit', [ServicesController::class, 'edit'])->name('service.edit');
    Route::post('/admin/service/edit', [ServicesController::class, 'update']);
    Route::post('/admin/service/{id}/delete', [ServicesController::class, 'destroy'])->name('service.delete');

        /************************
        * Pages ROUTES
        ************************/

    Route::resource('pages', PageController::class);
    Route::get('/admin/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/admin/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/admin/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/admin/admin/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

        /************************
        * media ROUTES
        ************************/


    Route::get('/admin/media', [ImageController::class, 'index'])->name('media.index');
    Route::get('/admin/media/upload', [ImageController::class, 'showUploadForm'])->name('media.uploadForm');
    Route::post('/admin/media/upload', [ImageController::class, 'upload'])->name('media.upload');

 /************************
     * brands ROUTES
     ************************/

     Route::get('/admin/brands', [BrandsController::class, 'index'])->name('brands.index');
     Route::get('/admin/brands/create', [BrandsController::class, 'create'])->name('brands.create');
     Route::post('/admin/brands/store', [BrandsController::class, 'store'])->name('brands.store');
     Route::get('/admin/brands/{id}/edit', [BrandsController::class, 'edit'])->name('brands.edit');
     Route::put('/admin/brands/{id}', [BrandsController::class, 'update'])->name('brands.update');
     Route::delete('/admin/brands/{id}', [BrandsController::class, 'destroy'])->name('brands.destroy');

 /************************
     * testimonials ROUTES
     ************************/

     Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
     Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
     Route::post('/admin/testimonials/store', [TestimonialController::class, 'store'])->name('testimonials.store');
     Route::get('/admin/testimonials/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
     Route::put('/admin/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
     Route::delete('/admin/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');



 /************************
     * shortcode_generator ROUTES
     ************************/


     Route::get('/admin/shortcode_generator', function () {
        return view('backend.generator.shortcode_generator');
    })->name('shortcode_generator');
    

});



    /************************ ****************************************
        * ************************ publig routing  ************************
    ************************ ****************************************/

    /************************
        * Slug ROUTES
    ************************/


    Route::get('/{slug}', 'App\Http\Controllers\SlugController@showBySlug')->name('pages.showBySlug');
    
    /************************
        * products ROUTES
    ************************/

    Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
        /************************
        * ProductCategories ROUTES
    ************************/

    Route::get('/product-categories/{categories}', [ProductCategoriesController::class, 'show'])->name('product-categories.show');

        /************************
            * ShortCode ROUTES
        ************************/

    // Route for handling shortcodes
    Route::get('/{shortcode}', [ShortcodeController::class, 'handleShortcode'])->name('shortcode.handle');
    Route::get('/get-shortcode-config/{shortcodeType}', function ($shortcodeType) {
        // Render the Blade view corresponding to the selected shortcode type
        return view($shortcodeType);
});
