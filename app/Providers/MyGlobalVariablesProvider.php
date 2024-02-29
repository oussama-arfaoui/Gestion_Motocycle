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
        'company_name' => 'Mobi Nardo',
        'company_description' => 'Mobi Nardo propose une large gamme de vélos, gadgets et accessoires de mobilité pour toute la famille. Qualité, choix et service client exceptionnel sont au rendez-vous pour des déplacements en toute sécurité et style.',
        
        'page_title' => 'Mobi Nardo - Votre Boutique de Mobilité',
        
        'contact_number' => '+212 664351312',
        'contact_whatsapp' => '+212 664351312',
        'contact_email' => 'contact@mobinardo.ma',
        'physical_address' => 'Lotissement mysane bouskoura 816/1 zone industrielle oulad saleh', 
        
        'social_facebook_link' => '#',
        'social_instagram_link' => '#',
        'social_tiktok_link' => '#',
        'social_linkedin_link' => '#',
    ];

    view()->share($dataToShare);
    }
}
