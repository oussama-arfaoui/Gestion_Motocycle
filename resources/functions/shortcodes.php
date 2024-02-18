<?php

function getShortcodeTypes() {
    return [

        'Hero' => [
            'name' => 'Hero',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.Hero.admin-config', // Just the view identifier       
        ],
        'Category_Overview' => [
            'name' => 'Category_Overview',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.Category_Overview.admin-config', // Just the view identifier       
        ],
        'About_Sections' => [
            'name' => 'About_Sections',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.About_Sections.admin-config', // Just the view identifier       
        ],
        // Add other shortcode types here if needed
    ];
}
function getShortcodeindex() {
    return [

        'Hero' => [
            'name' => 'Hero',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.Hero.index', // Just the view identifier 
            'attributes' => ['title', 'subtitle', 'description', 'button_primary_label', 'style'],      
        ],
        'Category_Overview' => [
            'name' => 'Category_Overview',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.Category_Overview.index', // Just the view identifier 
            'attributes' => ['title', 'subtitle', 'category_ids', 'style'],      
        ],
        'About_Sections' => [
            'name' => 'About_Sections',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.About_Sections.index', // Just the view identifier 
            'attributes' => ['title', 'subtitle', 'description', 'image', 'style'],      
        ],
        // Add other shortcode types here if needed
    ];
}

;
