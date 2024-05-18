{{-- Index File --}}



    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.office_politics.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    
            'section_tag' => $section_tag = $section_tag ?? "",
            
            'title' => $title = $title ?? "",
            
            'subtitle' => $subtitle = $subtitle ?? "",
            
            'title_1' => $title_1 = $title_1 ?? "",
            
            'description_1' => $description_1 = $description_1 ?? "",
            
            'title_2' => $title_2 = $title_2 ?? "",
            
            'description_2' => $description_2 = $description_2 ?? "",
            
            'keyword' => $keyword = $keyword ?? "",
            
            'list_icon' => $list_icon = $list_icon ?? "",
            
            'list_node_1' => $list_node_1 = $list_node_1 ?? "",
            
            'list_node_2' => $list_node_2 = $list_node_2 ?? "",
            
            'list_node_3' => $list_node_3 = $list_node_3 ?? "",
            
            'list_node_4' => $list_node_4 = $list_node_4 ?? "",
            
            'list_node_5' => $list_node_5 = $list_node_5 ?? "",
            
            'list_node_6' => $list_node_6 = $list_node_6 ?? "",
            
            'list_node_7' => $list_node_7 = $list_node_7 ?? "",
            
            'list_node_8' => $list_node_8 = $list_node_8 ?? "",
            
            'list_node_9' => $list_node_9 = $list_node_9 ?? "",
            
            'list_node_10' => $list_node_10 = $list_node_10 ?? "",
            
    ])
    