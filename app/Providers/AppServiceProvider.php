<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategories;
use App\Models\Testimonial;

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
            View::composer('frontend.shortcodes.products_categories_list.style.style1', function ($view) {
                $categorys = ProductCategories::all();
                $view->with('categorys', $categorys);
            });
            // Retrieve categories data and pass it to the view
            View::composer('frontend.shortcodes.testimonials.style.style1', function ($view) {
                $testimonialss = Testimonial::all();
                $view->with('testimonialss', $testimonialss);
            });            
    }
}
