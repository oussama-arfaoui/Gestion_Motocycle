{{-- Index File --}}


    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.service_categories_list.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    
            'title' => $title = $title ?? "",
            
            'description' => $description = $description ?? "",
            
            'service_title_1' => $service_title_1 = $service_title_1 ?? "",
            
            'services_description_1' => $services_description_1 = $services_description_1 ?? "",
            
            'service_title_2' => $service_title_2 = $service_title_2 ?? "",
            
            'services_description_2' => $services_description_2 = $services_description_2 ?? "",
            
            'service_title_3' => $service_title_3 = $service_title_3 ?? "",
            
            'services_description_3' => $services_description_3 = $services_description_3 ?? "",
            
            'service_title_4' => $service_title_4 = $service_title_4 ?? "",
            
            'services_description_4' => $services_description_4 = $services_description_4 ?? "",
            
            'service_title_5' => $service_title_5 = $service_title_5 ?? "",
            
            'services_description_5' => $services_description_5 = $services_description_5 ?? "",
            
    ])
    