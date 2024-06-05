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
    'company_name' => 'HIGH TURBO SERVICES',
    'company_description' => 'Nous avons l’immense plaisir de vous soumettre notre offre de prestation de services dans les secteurs d’activités mentionnés ci-dessous : 

    Climatisation,
    Froid, 
    Ventilation et Extraction 
    Gamme Résidentielle et Commerciale
    Gamme Industrielle et Spécifique ADF - ATEX
    ',

    'page_title' => 'HIGH TURBO SERVICES - Optimisez vos systèmes de climatisation',

    'contact_number_1' => '+212 701 26 85 80',
    'contact_number_2' => '+212 701 26 85 80',
    'contact_whatsapp_1' => '+212 633 26 85 86',
    'contact_whatsapp_2' => '+212 633 26 85 86',
    'contact_email_1' => 'hturboservices@gmail.com',
    'contact_email_2' => 'hturboservices@gmail.com',
    'physical_address' => 'Rue 5 N122, 1ere Etg Hay Al Qods, Sidi Bernoussi – Casa',

    'social_facebook_link' => 'https://www.facebook.com/',
    'social_twitter_link' => 'https://www.twitter.com/',
    'social_instagram_link' => 'https://www.instagram.com/',
    'social_linkedin_link' => 'https://www.linkedin.com/company/',
    'social_youtube_link' => 'https://www.youtube.com/',
    'social_tiktok_link' => 'https://www.tiktok.com/',

];




    view()->share($dataToShare);
    }
}
