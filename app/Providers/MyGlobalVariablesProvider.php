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
    'company_name' => 'SAMP - Société d\'Accompagnement Marocaine Productive',
    'company_description' => 'Bienvenue chez SAMP. Trouvez des solutions complètes pour vos besoins industriels. Que vous recherchiez des fournitures industrielles, des outils spécialisés, ou des services de maintenance et de création de machines sur mesure, SAMP est là pour vous accompagner.',

    'page_title' => 'Bienvenue chez SAMP - Votre Partenaire en Solutions Industrielles',

    'contact_number' => '+123 456 7890',
    'contact_whatsapp' => '+123 456 7890',
    'contact_email' => 'info@samp.ma',
    'physical_address' => '1234 Rue Principale, Ville, Pays',

    'social_tiktok_link' => 'https://www.tiktok.com/samp',
    'social_facebook_link' => 'https://www.facebook.com/samp',
    'social_instagram_link' => 'https://www.instagram.com/samp',
    'social_linkedin_link' => 'https://www.linkedin.com/company/samp',
    'social_youtube_link' => 'https://www.youtube.com/company/samp',
];




    view()->share($dataToShare);
    }
}
