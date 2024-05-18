<?php

function getShortcodeTypes() {
    return [

        /// Globals

        'page_banner' => [
            'name' => 'page_banner', 
            'view' => 'frontend.shortcodes.page_banner.admin-config',     
        ],
        
    'banner_message' => [
        'name' => 'banner_message',
        'view' => 'frontend.shortcodes.banner_message.admin-config',
    ],
    


        /// Homepage

        'hero_slider' => [
            'name' => 'hero_slider',
            'view' => 'frontend.shortcodes.hero_slider.admin-config',    
        ],
        'hero_section' => [
            'name' => 'hero_section',
            'view' => 'frontend.shortcodes.hero_section.admin-config',
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
        'about_extension' => [
            'name' => 'about_extension',
            'view' => 'frontend.shortcodes.about_extension.admin-config',
        ],
        'product_overview' => [
            'name' => 'product_overview',
            'view' => 'frontend.shortcodes.product_overview.admin-config',
        ],
        'why_choose_us' => [
            'name' => 'why_choose_us',
            'view' => 'frontend.shortcodes.why_choose_us.admin-config',
        ],
        'testimonials' => [
        'name' => 'testimonials',
        'view' => 'frontend.shortcodes.testimonials.admin-config',
    ],
    
    'office_politics' => [
        'name' => 'office_politics',
        'view' => 'frontend.shortcodes.office_politics.admin-config',
    ],
    
    
    'history_through_years' => [
        'name' => 'history_through_years',
        'view' => 'frontend.shortcodes.history_through_years.admin-config',
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
    'contact_hero' => [
        'name' => 'contact_hero',
        'view' => 'frontend.shortcodes.contact_hero.admin-config',
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

    
    'products_categories_list' => [
        'name' => 'products_categories_list',
        'view' => 'frontend.shortcodes.products_categories_list.admin-config',
    ],

    'service_categories_list' => [
        'name' => 'service_categories_list',
        'view' => 'frontend.shortcodes.service_categories_list.admin-config',
    ],

    /// About 

    'word_from_director' => [
        'name' => 'word_from_director',
        'view' => 'frontend.shortcodes.word_from_director.admin-config',
    ],
    'meet_the_team' => [
        'name' => 'meet_the_team',
        'view' => 'frontend.shortcodes.meet_the_team.admin-config',
    ],
        'mission_value_vision' => [
            'name' => 'mission_value_vision',
            'view' => 'frontend.shortcodes.mission_value_vision.admin-config',
        ],
    
    
    /// Services

    
    'double_screen' => [
        'name' => 'double_screen',
        'view' => 'frontend.shortcodes.double_screen.admin-config',
    ],
    
    'projects' => [
        'name' => 'projects',  
        'view' => 'frontend.shortcodes.projects.admin-config',  
    ],


    'threed_scene' => [
        'name' => 'threed_scene',
        'view' => 'frontend.shortcodes.threed_scene.admin-config',
    ],
        
    'custom_module' => [
        'name' => 'custom_module',
        'view' => 'frontend.shortcodes.custom_module.admin-config',
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
        
        'banner_message' => [
            'name' => 'banner_message',
            'view' => 'frontend.shortcodes.banner_message.index',
            'attributes' => ['title', 'path','style']
        ],
        

        // Homepage

        
        
        'hero_slider' => [
            'name' => 'hero_slider',
            'view' => 'frontend.shortcodes.hero_slider.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'keyword', 'primary_button_label', 'primary_button_link', 'secondary_button_label', 'secondary_button_link' ,'style']
        ],
        'hero_section' => [
            'name' => 'hero_section',
            'view' => 'frontend.shortcodes.hero_section.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'secondary_button_label','style']
        ],
        'brands' => [
            'name' => 'brands',
            'view' => 'frontend.shortcodes.brands.index', 
            'attributes' => ['Brands','style']      
        ],
        'category_overview' => [
            'name' => 'category_overview',
            'view' => 'frontend.shortcodes.category_overview.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'primary_button_link', 'secondary_button_label', 'secondary_button_link', 'keyword', 'node_icon_1', 'node_title_1', 'node_description_1', 'node_icon_2', 'node_title_2', 'node_description_2', 'node_icon_3', 'node_title_3', 'node_description_3', 'node_icon_4', 'node_title_4', 'node_description_4', 'category_title_1', 'category_description_1', 'category_button_1', 'category_link_1', 'category_title_2', 'category_description_2', 'category_button_2', 'category_link_2', 'category_title_3', 'category_description_3', 'category_button_3', 'category_link_3', 'category_title_4', 'category_description_4', 'category_button_4', 'category_link_4','style']
        ],
        'about_overview' => [
            'name' => 'about_overview',
            'view' => 'frontend.shortcodes.about_overview.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'primary_button_link', 'secondary_button_label', 'secondary_button_link', 'keyword', 'node_icon_1', 'node_title_1', 'node_description_1', 'node_icon_2', 'node_title_2', 'node_description_2', 'node_icon_3', 'node_title_3', 'node_description_3', 'node_icon_4', 'node_title_4', 'node_description_4','style']
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
        'about_extension' => [
            'name' => 'about_extension',
            'view' => 'frontend.shortcodes.about_extension.index',
            'attributes' => ['title', 'description', 'node_title_1', 'node_description_1', 'node_title_2', 'node_description_2', 'node_title_3', 'node_description_3', 'node_title_4', 'node_description_4','style']
        ],
        
        'product_overview' => [
            'name' => 'product_overview',
            'view' => 'frontend.shortcodes.product_overview.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 
            'primary_button_label', 'secondary_button_label', 'ternary_button_label', 
            'node_icon_1', 'node_title_1', 'node_description_1',
            'node_icon_2', 'node_title_2', 'node_description_2',
            'node_icon_3', 'node_title_3', 'node_description_3',
            'node_icon_4', 'node_title_4', 'node_description_4',
            'style']
        ],
        'why_choose_us' => [
            'name' => 'why_choose_us',
            'view' => 'frontend.shortcodes.why_choose_us.index',
            'attributes' => ['section_tag', 'title', 'description', 'primary_button_label', 'node_icon_1', 'node_title_1', 'node_description_1', 'node_icon_2', 'node_title_2', 'node_description_2', 'node_icon_3', 'node_title_3', 'node_description_3', 'node_icon_4', 'node_title_4', 'node_description_4','style']
        ],
        'testimonials' => [
            'name' => 'testimonials',
            'view' => 'frontend.shortcodes.testimonials.index',
            'attributes' => ['title', 'description', 'testimonials','style']
        ],
        
    
        'office_politics' => [
            'name' => 'office_politics',
            'view' => 'frontend.shortcodes.office_politics.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'title_1', 'description_1', 'title_2', 'description_2', 'keyword', 'list_icon', 'list_node_1', 'list_node_2', 'list_node_3', 'list_node_4', 'list_node_5', 'list_node_6', 'list_node_7', 'list_node_8', 'list_node_9', 'list_node_10','style']
        ],
        
        
        
        'history_through_years' => [
            'name' => 'history_through_years',
            'view' => 'frontend.shortcodes.history_through_years.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'primary_button_link', 'secondary_button_label', 'secondary_button_link', 'keyword', 'year_1', 'year_event_title_1', 'year_event_description_1', 'year_2', 'year_event_title_2', 'year_event_description_2', 'year_3', 'year_event_title_3', 'year_event_description_3', 'year_4', 'year_event_title_4', 'year_event_description_4', 'year_5', 'year_event_title_5', 'year_event_description_5', 'year_6', 'year_event_title_6', 'year_event_description_6', 'year_7', 'year_event_title_7', 'year_event_description_7', 'year_8', 'year_event_title_8', 'year_event_description_8', 'year_9', 'year_event_title_9', 'year_event_description_9', 'year_10', 'year_event_title_10', 'year_event_description_10','style']
        ],
        
        
        
        
        // Contact

        
    'contact_information' => [
            'name' => 'contact_information',
            'view' => 'frontend.shortcodes.contact_information.index',
            'attributes' => ['section_tag', 'title', 'subtitle', 'description', 'primary_button_label', 'primary_button_link', 'secondary_button_label', 'secondary_button_link', 'keyword', 'node_icon_1', 'node_title_1', 'node_description_1', 'node_icon_2', 'node_title_2', 'node_description_2', 'node_icon_3', 'node_title_3', 'node_description_3', 'node_icon_4', 'node_title_4', 'node_description_4', 'extra_info_1', 'extra_info_2', 'extra_info_3', 'extra_info_4','style']
        ],
    'contact_form' => [
        'name' => 'contact_form',
        'view' => 'frontend.shortcodes.contact_form.index',
        'attributes' => ['title', 'description','style']
    ],
        'contact_hero' => [
            'name' => 'contact_hero',
            'view' => 'frontend.shortcodes.contact_hero.index',
            'attributes' => ['title', 'description', 'primary_action', 'secondary_action','style']
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
    
        'products_categories_list' => [
            'name' => 'products_categories_list',
            'view' => 'frontend.shortcodes.products_categories_list.index',
            'attributes' => ['categories','style']
        ],

        'service_categories_list' => [
            'name' => 'service_categories_list',
            'view' => 'frontend.shortcodes.service_categories_list.index',
            'attributes' => ['title', 'description', 'service_title_1', 'services_description_1', 'service_title_2', 'services_description_2', 'service_title_3', 'services_description_3', 'service_title_4', 'services_description_4', 'service_title_5', 'services_description_5','style']
        ],
        // About

        
        'word_from_director' => [
            'name' => 'word_from_director',
            'view' => 'frontend.shortcodes.word_from_director.index',
            'attributes' => ['section_tag', 'title', 'description', 'name_tag','style']
        ],
        'meet_the_team' => [
            'name' => 'meet_the_team',
            'view' => 'frontend.shortcodes.meet_the_team.index',
            'attributes' => ['section_tag', 'title', 'description', 'member_1', 'job_title_1', 'member_2', 'job_title_2', 'member_3', 'job_title_3','style']
        ],
        'mission_value_vision' => [
            'name' => 'mission_value_vision',
            'view' => 'frontend.shortcodes.mission_value_vision.index',
            'attributes' => ['section_tag', 'title', 'description', 'node_title_1', 'node_description_1', 'node_title_2', 'node_description_2', 'node_title_3', 'node_description_3','style']
        ],
        
        /// Services

        
        'double_screen' => [
            'name' => 'double_screen',
            'view' => 'frontend.shortcodes.double_screen.index',
            'attributes' => ['title_1', 'description_1', 'button_1', 'title_2', 'description_2', 'button_2','style']
        ],
        
        'projects' => [
            'name' => 'projects',
            'view' => 'frontend.shortcodes.projects.index', 
            'attributes' => ['title','projects','style']      
        ],

        'threed_scene' => [
            'name' => 'threed_scene',
            'view' => 'frontend.shortcodes.threed_scene.index',
            'attributes' => ['title', 'description','style']
        ],
   
    
    'custom_module' => [
        'name' => 'custom_module',
        'view' => 'frontend.shortcodes.custom_module.index',
        'attributes' => ['title','style']
    ],
    ];
};
