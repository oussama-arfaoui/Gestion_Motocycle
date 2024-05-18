{{-- Index File --}}



    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.history_through_years.style.$style";
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
            
            'year_1' => $year_1 = $year_1 ?? "",
            
            'year_event_title_1' => $year_event_title_1 = $year_event_title_1 ?? "",
            
            'year_event_description_1' => $year_event_description_1 = $year_event_description_1 ?? "",
            
            'year_2' => $year_2 = $year_2 ?? "",
            
            'year_event_title_2' => $year_event_title_2 = $year_event_title_2 ?? "",
            
            'year_event_description_2' => $year_event_description_2 = $year_event_description_2 ?? "",
            
            'year_3' => $year_3 = $year_3 ?? "",
            
            'year_event_title_3' => $year_event_title_3 = $year_event_title_3 ?? "",
            
            'year_event_description_3' => $year_event_description_3 = $year_event_description_3 ?? "",
            
            'year_4' => $year_4 = $year_4 ?? "",
            
            'year_event_title_4' => $year_event_title_4 = $year_event_title_4 ?? "",
            
            'year_event_description_4' => $year_event_description_4 = $year_event_description_4 ?? "",
            
            'year_5' => $year_5 = $year_5 ?? "",
            
            'year_event_title_5' => $year_event_title_5 = $year_event_title_5 ?? "",
            
            'year_event_description_5' => $year_event_description_5 = $year_event_description_5 ?? "",
            
            'year_6' => $year_6 = $year_6 ?? "",
            
            'year_event_title_6' => $year_event_title_6 = $year_event_title_6 ?? "",
            
            'year_event_description_6' => $year_event_description_6 = $year_event_description_6 ?? "",
            
            'year_7' => $year_7 = $year_7 ?? "",
            
            'year_event_title_7' => $year_event_title_7 = $year_event_title_7 ?? "",
            
            'year_event_description_7' => $year_event_description_7 = $year_event_description_7 ?? "",
            
            'year_8' => $year_8 = $year_8 ?? "",
            
            'year_event_title_8' => $year_event_title_8 = $year_event_title_8 ?? "",
            
            'year_event_description_8' => $year_event_description_8 = $year_event_description_8 ?? "",
            
            'year_9' => $year_9 = $year_9 ?? "",
            
            'year_event_title_9' => $year_event_title_9 = $year_event_title_9 ?? "",
            
            'year_event_description_9' => $year_event_description_9 = $year_event_description_9 ?? "",
            
            'year_10' => $year_10 = $year_10 ?? "",
            
            'year_event_title_10' => $year_event_title_10 = $year_event_title_10 ?? "",
            
            'year_event_description_10' => $year_event_description_10 = $year_event_description_10 ?? "",
            
    ])
    