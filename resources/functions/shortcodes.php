<?php

function getShortcodeTypes() {
    return [

        /// Globals

        'page_banner' => [
            'name' => 'page_banner', 
            'view' => 'frontend.shortcodes.page_banner.admin-config',     
        ],


        /// Homepage

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
        'about_overview' => [
            'name' => 'about_overview', 
            'view' => 'frontend.shortcodes.about_overview.admin-config',     
        ],
        'gallery_overview' => [
            'name' => 'gallery_overview', 
            'view' => 'frontend.shortcodes.gallery_overview.admin-config',     
        ],
        'homepage_cta' => [
            'name' => 'homepage_cta', 
            'view' => 'frontend.shortcodes.homepage_cta.admin-config',     
        ],

        //  Contact Page

        
    'contact_information' => [
        'name' => 'contact_information',
        'view' => 'frontend.shortcodes.contact_information.admin-config',
    ],
    
    'contact_form' => [
        'name' => 'contact_form',
        'view' => 'frontend.shortcodes.contact_form.admin-config',
    ],
    

    // Actualités, Blog, News
    
    
    'featured_article' => [
        'name' => 'featured_article',
        'view' => 'frontend.shortcodes.featured_article.admin-config',
    ],
    
    'articles_list' => [
        'name' => 'articles_list',
        'view' => 'frontend.shortcodes.articles_list.admin-config',
    ],
    
    // catalogue /products
    
    'category_with_examples' => [
        'name' => 'category_with_examples',
        'view' => 'frontend.shortcodes.category_with_examples.admin-config',
    ],
    
    
    'products_list' => [
        'name' => 'products_list',
        'view' => 'frontend.shortcodes.products_list.admin-config',
    ],
    
    // select catalogue /products
    
    'products_categories_list' => [
        'name' => 'products_categories_list',
        'view' => 'frontend.shortcodes.products_categories_list.admin-config',
    ],

    // testimonials

    'testimonials' => [
        'name' => 'testimonials',
        'view' => 'frontend.shortcodes.testimonials.admin-config',
    ],

    ];
}

function getShortcodeindex() {
    return [

        // GLOBALS

        'page_banner' => [
            'name' => 'page_banner',
            'view' => 'frontend.shortcodes.page_banner.index', 
            'attributes' => [ 'title', 'description','style']      
        ],

        // Homepage

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
        'about_overview' => [
            'name' => 'about_overview',
            'view' => 'frontend.shortcodes.about_overview.index', 
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'node_title_1' , 'node_description_1', 'node_title_2' , 'node_description_2','node_title_3' , 'node_description_3','node_title_4' , 'node_description_4','style']      
        ],
        'gallery_overview' => [
            'name' => 'gallery_overview',
            'view' => 'frontend.shortcodes.gallery_overview.index', 
            'attributes' => ['section_tag', 'title', 'description', 'primary_button_label',
            'project_title_1' , 'project_description_1', 'project_period_1', 'project_number_of_doors_1', 'project_location_1', 'project_date_1' ,
            'project_title_2' , 'project_description_2', 'project_period_2', 'project_number_of_doors_2', 'project_location_2', 'project_date_2' ,
            'project_title_3' , 'project_description_3', 'project_period_3', 'project_number_of_doors_3', 'project_location_3', 'project_date_3' ,
            'project_title_4' , 'project_description_4', 'project_period_4', 'project_number_of_doors_4', 'project_location_4', 'project_date_4' ,
            'project_title_5' , 'project_description_5', 'project_period_5', 'project_number_of_doors_5', 'project_location_5', 'project_date_5' ,
            'style']
        ],
        'homepage_cta' => [
            'name' => 'homepage_cta',
            'view' => 'frontend.shortcodes.homepage_cta.index', 
            'attributes' => [ 'title', 'description', 'primary_button_label','style']      
        ],
        
        // Contact

        
    'contact_information' => [
        'name' => 'contact_information',
        'view' => 'frontend.shortcodes.contact_information.index',
        'attributes' => ['title', 'description', 'primary_button_label', 'secondary_button_label',
        'node_title_1', 'node_title_2', 'node_title_3',
        'node_description_1', 'node_description_2', 'node_description_3',
        'style']
    ],

    
    'contact_form' => [
        'name' => 'contact_form',
        'view' => 'frontend.shortcodes.contact_form.index',
        'attributes' => ['title', 'description','style']
    ],

    // Actuality, Blog, News
    
    
    'featured_article' => [
        'name' => 'featured_article',
        'view' => 'frontend.shortcodes.featured_article.index',
        'attributes' => ['title', 'article_title', 'article_description', 'article_button','style']
    ],
    'articles_list' => [
        'name' => 'articles_list',
        'view' => 'frontend.shortcodes.articles_list.index',
        'attributes' => ['title', 'article_title', 'article_description', 'article_button','style']
    ],
    
    // Catalogue / Products
    
    'category_with_examples' => [
        'name' => 'category_with_examples',
        'view' => 'frontend.shortcodes.category_with_examples.index',
        'attributes' => ['primary_button_link', 'product_name_1', 'product_name_2', 'product_name_3', 'sell_button', 'tag_1', 'tag_2', 'category_link','style']
    ],
    
    
    'products_list' => [
        'name' => 'products_list',
        'view' => 'frontend.shortcodes.products_list.index',
        'attributes' => ['title','style']
    ],
    
        // select Catalogue / Products
    
        'products_categories_list' => [
            'name' => 'products_categories_list',
            'view' => 'frontend.shortcodes.products_categories_list.index',
            'attributes' => ['categories','style']
        ],

    // testimonials

        'testimonials' => [
            'name' => 'testimonials',
            'view' => 'frontend.shortcodes.testimonials.index',
            'attributes' => ['title', 'description', 'testimonials','style']
        ],
        
    ];
};
