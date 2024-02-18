{{-- Determine which style to use --}}
@php
    $style = $style ?? ''; // Default to empty string if style is not provided
    $viewName = "frontend.shortcodes.About_Sections.style.$style";

@endphp

{{-- Render the corresponding view --}}
@includeIf($viewName, [
    'image' => $image,
    'title' => $title,
    'subtitle' => $subtitle,
    'description' => $description,
])
