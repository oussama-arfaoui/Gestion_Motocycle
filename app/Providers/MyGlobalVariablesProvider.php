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
    'company_name' => 'Green Storage Company',
    'company_description' => 'Green Storage Company is Description Comes Later',

    'page_title' => 'Green Storage Company - Your Official Partner for Green Storage',

    'contact_number_1' => '0662686263',
    'contact_number_2' => '+123 465 789',
    'contact_whatsapp_1' => '0662686263',
    'contact_whatsapp_2' => '+123 456 789',
    'contact_email_1' => 'info@gsc.ma',
    'contact_email_2' => 'info@gsc.com',
    'physical_address' => '12 RUE SARIA BEN ZOUNAIM ETG 3 APPT 3 PALMIER CASABLANCA',

    'social_facebook_link' => 'https://www.facebook.com/gsc',
    'social_twitter_link' => 'https://www.twitter.com/gsc',
    'social_instagram_link' => 'https://www.instagram.com/gsc',
    'social_linkedin_link' => 'https://www.linkedin.com/company/gsc',
    'social_youtube_link' => 'https://www.youtube.com/gsc',
    'social_tiktok_link' => 'https://www.tiktok.com/gsc',

];




    view()->share($dataToShare);
    }
}
