<?php

function getShortcodeTypes() {
    return [

        'hero_slider' => [
            'name' => 'hero_slider',
            'view' => 'frontend.shortcodes.hero_slider.admin-config',    
        ],
        'brands' => [
            'name' => 'brands',  
            'view' => 'frontend.shortcodes.brands.admin-config',  
        ],
        'category_overview' => [
            'name' => 'category_overview', 
            'view' => 'frontend.shortcodes.category_overview.admin-config',     
        ],


    ];
}

function getShortcodeindex() {
    return [

        'hero_slider' => [
            'name' => 'hero_slider',
 
            'view' => 'frontend.shortcodes.hero_slider.index', 
            'attributes' =>['title', 'description', 'button_primary_label','style']      
        ],
        'brands' => [
            'name' => 'brands',
            'view' => 'frontend.shortcodes.brands.index', 
            'attributes' => ['style']      
        ],
        'category_overview' => [
            'name' => 'category_overview',
            'view' => 'frontend.shortcodes.category_overview.index', 
            'attributes' => ['section_tag', 'title', 'description', 'primary_button_label', 'category_title_1' , 'category_description_1', 'category_button_1','category_title_2' , 'category_description_2', 'category_button_2','style']      
        ],
        
    ];
}

;
