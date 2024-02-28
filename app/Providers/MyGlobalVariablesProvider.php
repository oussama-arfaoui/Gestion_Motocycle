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
        'company_name' => 'Mobinardo',
        'page_title' => 'Mobinardo - Votre Boutique de Mobilité',
        'contact_number' => '+212652800991',
        'contact_whatsapp' => '0652800991',
        'contact_email' => 'contact@newdoors.ma',
    ];

    view()->share($dataToShare);
    }
}
