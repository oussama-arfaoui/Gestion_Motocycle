

    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.gallery_overview.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    
            'section_tag' => $section_tag = $section_tag ?? "",
            
            'title' => $title = $title ?? "",
            
            'subtitle' => $subtitle = $subtitle ?? "",
            
            'description' => $description = $description ?? "",
            
            'primary_button_label' => $primary_button_label = $primary_button_label ?? "",
            
            'primary_button_link' => $primary_button_link = $primary_button_link ?? "",
            
            'secondary_button_label' => $secondary_button_label = $secondary_button_label ?? "",
            
            'secondary_button_link' => $secondary_button_link = $secondary_button_link ?? "",
            
            'keyword' => $keyword = $keyword ?? "",
            
            'project_title_1' => $project_title_1 = $project_title_1 ?? "",
            
            'project_description_1' => $project_description_1 = $project_description_1 ?? "",
            
            'project_button_label_1' => $project_button_label_1 = $project_button_label_1 ?? "",
            
            'project_button_link_1' => $project_button_link_1 = $project_button_link_1 ?? "",
            
            'project_title_2' => $project_title_2 = $project_title_2 ?? "",
            
            'project_description_2' => $project_description_2 = $project_description_2 ?? "",
            
            'project_button_label_2' => $project_button_label_2 = $project_button_label_2 ?? "",
            
            'project_button_link_2' => $project_button_link_2 = $project_button_link_2 ?? "",
            
            'project_title_3' => $project_title_3 = $project_title_3 ?? "",
            
            'project_description_3' => $project_description_3 = $project_description_3 ?? "",
            
            'project_button_label_3' => $project_button_label_3 = $project_button_label_3 ?? "",
            
            'project_button_link_3' => $project_button_link_3 = $project_button_link_3 ?? "",
            
            'project_title_4' => $project_title_4 = $project_title_4 ?? "",
            
            'project_description_4' => $project_description_4 = $project_description_4 ?? "",
            
            'project_button_label_4' => $project_button_label_4 = $project_button_label_4 ?? "",
            
            'project_button_link_4' => $project_button_link_4 = $project_button_link_4 ?? "",
            
            'project_title_5' => $project_title_5 = $project_title_5 ?? "",
            
            'project_description_5' => $project_description_5 = $project_description_5 ?? "",
            
            'project_button_label_5' => $project_button_label_5 = $project_button_label_5 ?? "",
            
            'project_button_link_5' => $project_button_link_5 = $project_button_link_5 ?? "",
            
    ])
    