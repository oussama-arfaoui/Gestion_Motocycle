<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategories;
use App\Models\Testimonial;
use App\Models\Brand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            // Retrieve categories data and pass it to the view
            //for ProductCategories
            View::composer('frontend.shortcodes.products_categories_list.style.style1', function ($view) {
                $categorys = ProductCategories::all();
                $view->with('categorys', $categorys);
            });
            View::composer('frontend.shortcodes.products_categories_list.style.style2', function ($view) {
                $categorys = ProductCategories::all();
                $view->with('categorys', $categorys);
            });
            
            // Retrieve categories data and pass it to the view
             //for Testimonial
            View::composer('frontend.shortcodes.testimonials.style.style1', function ($view) {
                $testimonialss = Testimonial::all();
                $view->with('testimonialss', $testimonialss);
            });   
            View::composer('frontend.shortcodes.testimonials.style.style2', function ($view) {
                $testimonialss = Testimonial::all();
                $view->with('testimonialss', $testimonialss);
            });    
            View::composer('frontend.shortcodes.testimonials.style.style3', function ($view) {
                $testimonialss = Testimonial::all();
                $view->with('testimonialss', $testimonialss);
            });    

              //for brands           
            View::composer('frontend.shortcodes.brands.style.style1', function ($view) {
                $Brandss = Brand::all();
                $view->with('Brandss', $Brandss);
            });   
            View::composer('frontend.shortcodes.brands.style.style2', function ($view) {
                $Brandss = Brand::all();
                $view->with('Brandss', $Brandss);
            });   
            View::composer('frontend.shortcodes.brands.style.style3', function ($view) {
                $Brandss = Brand::all();
                $view->with('Brandss', $Brandss);
            });   
            View::composer('frontend.shortcodes.brands.style.style4', function ($view) {
                $Brandss = Brand::all();
                $view->with('Brandss', $Brandss);
            });   



    }
}
