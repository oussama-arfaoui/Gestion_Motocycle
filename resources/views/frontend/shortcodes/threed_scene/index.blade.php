{{-- Index File --}}




    {{-- Determine which style to use --}}
    @php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.threed_scene.style.$style";
    @endphp

    {{-- Render the corresponding view --}}
    @includeIf($viewName, [
    
            'title' => $title = $title ?? "",
            
            'description' => $description = $description ?? "",
            
    ])
    