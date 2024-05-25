{{-- Index File --}}



    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.enterprise_description.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    
            'section_tag' => $section_tag = $section_tag ?? "",
            
            'title' => $title = $title ?? "",
            
            'subtitle' => $subtitle = $subtitle ?? "",
            
            'description' => $description = $description ?? "",
            
            'link_1' => $link_1 = $link_1 ?? "",
            
            'link_2' => $link_2 = $link_2 ?? "",
            
            'link_3' => $link_3 = $link_3 ?? "",
            
            'link_4' => $link_4 = $link_4 ?? "",
            
            'keyword' => $keyword = $keyword ?? "",
            
    ])
    