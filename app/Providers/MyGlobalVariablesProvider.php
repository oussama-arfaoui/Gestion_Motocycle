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
    'company_name' => 'Carbon',
    'company_description' => 'Carbon is your trusted partner for providing comprehensive and innovative website building solutions. Our wide range of products and services caters to the needs of various industries, ensuring efficiency, reliability, and performance.',

    'page_title' => 'Carbon - Your Trusted Partner for Website Building',

    'contact_number_1' => '+123 465 789',
    'contact_number_2' => '+123 465 789',
    'contact_whatsapp_1' => '+123 456 789',
    'contact_whatsapp_2' => '+123 456 789',
    'contact_email_1' => 'info@carbon.com',
    'contact_email_2' => 'info@carbon.com',
    'physical_address' => '123 Boulevard Avenue, 10548',

    'social_facebook_link' => 'https://www.facebook.com/carbon',
    'social_twitter_link' => 'https://www.twitter.com/carbon',
    'social_instagram_link' => 'https://www.instagram.com/carbon',
    'social_linkedin_link' => 'https://www.linkedin.com/company/carbon',
    'social_youtube_link' => 'https://www.youtube.com/carbon',
    'social_tiktok_link' => 'https://www.tiktok.com/carbon',

];




    view()->share($dataToShare);
    }
}
