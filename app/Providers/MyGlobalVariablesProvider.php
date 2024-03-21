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
    'company_name' => 'Wirenext',
    'company_description' => 'Wirenext est votre partenaire de confiance pour la fourniture de solutions industrielles complètes et innovantes. Notre large gamme de produits et services répond aux besoins de divers secteurs d\'activité, vous garantissant efficacité, fiabilité et performance.',

    'page_title' => 'Wirenext - Votre partenaire de confiance pour l\'industrie',

    'contact_number' => '+123 465 789',
    'contact_whatsapp' => '+123 456 789',
    'contact_email' => 'info@wirenext.ma',
    'physical_address' => '123. Boulevard Avenue, 10548',

    'social_tiktok_link' => 'https://www.tiktok.com/wirenext',
    'social_facebook_link' => 'https://www.facebook.com/wirenext',
    'social_instagram_link' => 'https://www.instagram.com/wirenext',
    'social_linkedin_link' => 'https://www.linkedin.com/company/wirenext',
    'social_youtube_link' => 'https://www.youtube.com/company/wirenext',
];




    view()->share($dataToShare);
    }
}
