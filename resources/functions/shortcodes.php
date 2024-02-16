<?php

function getShortcodeTypes() {
    return [

        'Hero' => [
            'name' => 'Hero',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.hero.admin-config', // Just the view identifier       
        ],

        // Add other shortcode types here if needed
    ];
}
function getShortcodeindex() {
    return [

        'Hero' => [
            'name' => 'Hero',
            //'view' => view('frontend.shortcodes.hero.admin-config'),   
            'view' => 'frontend.shortcodes.hero.index', // Just the view identifier 
            'attributes' => ['title', 'subtitle', 'description', 'button_primary_label'],      
        ],

        // Add other shortcode types here if needed
    ];
}

;
