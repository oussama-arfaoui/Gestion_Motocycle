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
    'company_name' => 'Globten',
    'company_description' => 'Globten Company Description Comes Later From the CEO',

    'page_title' => 'Globten - Your Official Partner for X and Y',

    'contact_number_1' => '+123 465 789',
    'contact_number_2' => '+123 465 789',
    'contact_whatsapp_1' => '+123 465 789',
    'contact_whatsapp_2' => '+123 456 789',
    'contact_email_1' => 'info@globten.ma',
    'contact_email_2' => 'info@globten.com',
    'physical_address' => '72 Route Chanel, Paris, France',

    'social_facebook_link' => 'https://www.facebook.com/globten',
    'social_twitter_link' => 'https://www.twitter.com/globten',
    'social_instagram_link' => 'https://www.instagram.com/globten',
    'social_linkedin_link' => 'https://www.linkedin.com/company/globten',
    'social_youtube_link' => 'https://www.youtube.com/globten',
    'social_tiktok_link' => 'https://www.tiktok.com/globten',

];




    view()->share($dataToShare);
    }
}
