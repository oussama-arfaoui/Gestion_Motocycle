<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyGlobalVariablesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $dataToShare = [
    'company_name' => 'Carbon-X',
    'company_description' => 'Welcome to Carbon-X. Build your website easily with our intuitive website builder. Whether you need a simple portfolio or a powerful e-commerce site, Carbon-X has you covered.',
    
    'page_title' => 'Welcome to Carbon-X - Your Website Building Solution',
    
    'contact_number' => '+123 456 7890',
    'contact_whatsapp' => '+123 456 7890',
    'contact_email' => 'info@carbonx.com',
    'physical_address' => '1234 Main Street, City, Country', 
    
    'social_facebook_link' => 'https://www.facebook.com/carbonx',
    'social_instagram_link' => 'https://www.instagram.com/carbonx',
    'social_tiktok_link' => 'https://www.tiktok.com/@carbonx',
    'social_linkedin_link' => 'https://www.linkedin.com/company/carbonx',
    'social_youtube_link' => 'https://www.youtube.com/company/carbonx',
];


    view()->share($dataToShare);
    }
}
