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
use App\Http\Controllers\OdooIntegrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsCategoriesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BlogsCategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesesi
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/************************
 * odoo
 ************************/
Route::get('/projects-categories-list', [ProjectsCategoriesController::class, 'showall'])->name('projects-categories.showall');
Route::get('/products_list', [OdooIntegrationController::class, 'showProducts']);

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

    Route::redirect('/admin', '/admin/home');
    
     /************************
        * PRODUCTS ROUTES
    ************************/
    Route::get('/admin/home', [HomeController::class, 'index'])->name('home.index');

    /************************
        * PRODUCTS ROUTES
    ************************/
    Route::get('/admin/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/admin/product', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/admin/product', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/admin/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
    Route::put('/admin/product/{id}', [ProductsController::class, 'update'])->name('product.update');
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
     * services ROUTES 
     ************************/
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/admin/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    /************************
     * Services CATEGORIES ROUTES
     ************************/
    Route::get('/admin/service-categories', [ServiceCategoryController::class, 'index'])->name('service-categories.index');
    Route::get('/admin/service-categories/create', [ServiceCategoryController::class, 'create'])->name('service-categories.create');
    Route::post('/admin/service-categories/store', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
    Route::get('/admin/service-categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('service-categories.edit');
    Route::put('/admin/service-categories/{id}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
    Route::delete('/admin/service-categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');



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
     * Projects/Portfolio ROUTES
     ************************/
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/admin/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/admin/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/admin/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/admin/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        /************************
     * Projects CATEGORIES ROUTES
     ************************/
    Route::get('/admin/projects-categories', [ProjectsCategoriesController::class, 'index'])->name('projects-categories.index');
    Route::get('/admin/projects-categories/create', [ProjectsCategoriesController::class, 'create'])->name('projects-categories.create');
    Route::post('/admin/projects-categories/store', [ProjectsCategoriesController::class, 'store'])->name('projects-categories.store');
    Route::get('/admin/projects-categories/{id}/edit', [ProjectsCategoriesController::class, 'edit'])->name('projects-categories.edit');
    Route::put('/admin/projects-categories/{id}', [ProjectsCategoriesController::class, 'update'])->name('projects-categories.update');
    Route::delete('/admin/projects-categories/{id}', [ProjectsCategoriesController::class, 'destroy'])->name('projects-categories.destroy');
        /************************
 /************************
     * shortcode_generator ROUTES
     ************************/


     Route::get('/admin/shortcode_generator', function () {
        return view('backend.generator.shortcode_generator');
    })->name('shortcode_generator');  

     Route::get('/admin/shortcode_editor', function () {
        return view('backend.generator.shortcode_editor');
    })->name('shortcode_editor');  
    
     
     /************************* Settings ROUTES************************/
                 /************************
             * general_settings ROUTES
             ************************/
            Route::get('/admin/general_settings', [SettingsController::class, 'indexgeneral_settings'])->name('general_settings.index');
            Route::put('/admin/general_settings', [SettingsController::class, 'updateAllgeneral_settings'])->name('general_settings.updateAll');
            Route::delete('/admin/general_settings/{id}', [SettingsController::class, 'destroygeneral_settings'])->name('general_settings.destroy');

            /************************
             * pagesstyle ROUTES
             ************************/

            Route::get('/admin/pagesstyle', [SettingsController::class, 'indexpagesstyle'])->name('pagesstyle.index');
            Route::put('/admin/pagesstyle', [SettingsController::class, 'updateAllPagesStyle'])->name('pagesstyle.updateAll');
            Route::delete('/admin/pagesstyle/{id}', [SettingsController::class, 'destroypagesstyle'])->name('pagesstyle.destroy');

    /************************
     * blogs ROUTES 
     ************************/
    Route::get('/admin/blogs', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('/admin/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/admin/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/admin/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::put('/admin/blogs/{id}', [BlogsController::class, 'update'])->name('blogs.update');
    Route::delete('/admin/blogs/{id}', [BlogsController::class, 'destroy'])->name('blogs.destroy');
    /************************
     * blogs CATEGORIES ROUTES
     ************************/
    Route::get('/admin/blogs-categories', [BlogsCategoryController::class, 'index'])->name('blogs-categories.index');
    Route::get('/admin/blogs-categories/create', [BlogsCategoryController::class, 'create'])->name('blogs-categories.create');
    Route::post('/admin/blogs-categories/store', [BlogsCategoryController::class, 'store'])->name('blogs-categories.store');
    Route::get('/admin/blogs-categories/{id}/edit', [BlogsCategoryController::class, 'edit'])->name('blogs-categories.edit');
    Route::put('/admin/blogs-categories/{id}', [BlogsCategoryController::class, 'update'])->name('blogs-categories.update');
    Route::delete('/admin/blogs-categories/{id}', [BlogsCategoryController::class, 'destroy'])->name('blogs-categories.destroy');



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
        * projects ROUTES
    ************************/

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
        /************************
        * projects-categories ROUTES
    ************************/

    Route::get('/projects-categories/{projectscategories}', [ProjectsCategoriesController::class, 'show'])->name('projects-categories.show');

        /************************
        * services ROUTES
    ************************/

    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
        /************************
        * service-categories ROUTES
    ************************/
   
    Route::get('/service-categories/{servicescategories}', [ServiceCategoryController::class, 'show'])->name('service-categories.show');

        /************************
        * BLOGS ROUTES
    ************************/

    Route::get('/services/{service}', [BlogsController::class, 'show'])->name('blogs.show');
        /************************
        * BLOGS-categories ROUTES
    ************************/
   
    Route::get('/service-categories/{servicescategories}', [BlogsCategoryController::class, 'show'])->name('blogs-categories.show');

        /************************
            * ShortCode ROUTES
        ************************/

    // Route for handling shortcodes
    Route::get('/{shortcode}', [ShortcodeController::class, 'handleShortcode'])->name('shortcode.handle');
    Route::get('/get-shortcode-config/{shortcodeType}', function ($shortcodeType) {
        // Render the Blade view corresponding to the selected shortcode type
        return view($shortcodeType);


        
});
